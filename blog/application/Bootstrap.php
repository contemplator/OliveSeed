<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initDoctrine() {

        $doctrine = $this->getOption('doctrine');

        $this->getApplication()->getAutoloader()
                ->registerNamespace('sfYaml')
                ->pushAutoloader(array('Doctrine_Core', 'autoload'), 'sfYaml');

        spl_autoload_register( array('Doctrine_Core', 'modelsAutoload'));

        $manager = Doctrine_Manager::getInstance();

        $manager->setAttribute(Doctrine_Core::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        $manager->setAttribute(
                Doctrine_Core::ATTR_MODEL_LOADING,
                Doctrine_Core::MODEL_LOADING_CONSERVATIVE
        );

        $manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);
        $manager->setAttribute(Doctrine_Core::ATTR_QUOTE_IDENTIFIER, true);
        $manager->setAttribute(Doctrine_Core::ATTR_VALIDATE, Doctrine_Core::VALIDATE_ALL);

        $conn = Doctrine_Manager::connection($doctrine['dsn'], 'doctrine');
        $conn->setAttribute(Doctrine_Core::ATTR_USE_NATIVE_ENUM, true);

        try{
            $conn->setCharset('utf8');
    }catch(Exception $e){
    }

        Doctrine_Core::loadModels($doctrine['models_path']);
        return $conn;
    }

}

