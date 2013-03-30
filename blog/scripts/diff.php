#!C:/Appserv/php5/php.exe -q
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING );

define( 'APPLICATION_ENV' , 'development' );
define( 'APPLICATION_PATH' , '../application/');

set_include_path(implode(PATH_SEPARATOR, array(
    APPLICATION_PATH . '../library',
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

$application = new Zend_Application( APPLICATION_ENV , APPLICATION_PATH . 'configs/application.ini' );
$application->bootstrap()->bootstrap('doctrine');

$doctrine = $application->bootstrap()->getOption('doctrine');

$newYaml = $doctrine['yaml_schema_path'] . "/schema_new.yml";
Doctrine_Core::generateYamlFromModels( $newYaml, $doctrine['models_path'] );

$pathToMigration = $doctrine['migrations_path'];
$pathYamlFrom = $doctrine['yaml_schema_path'] . '/schema.yml';
$pathYamlTo = $newYaml;

$changes = Doctrine_Core::generateMigrationsFromDiff(  $pathToMigration , $pathYamlFrom , $pathYamlTo );

$changeNum = count( $changes , true ) - count( $changes );

if( $changeNum > 0 ){

    $pathYamlLast = $doctrine['yaml_schema_path'] . '/schema_last.yml';

    @unlink( $pathYamlLast );
    rename( $pathYamlFrom , $pathYamlLast );
    rename( $pathYamlTo , $pathYamlFrom );

    $path = $doctrine['migrations_path'];
    $migration = new Doctrine_Migration( $path );

    echo 'New migrations created!' . "\n";
} else {
    @unlink( $pathYamlTo );
    echo 'There is no difference' . "\n";
}

?>