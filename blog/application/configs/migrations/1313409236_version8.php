<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version8 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->addColumn('article', 'top', 'boolean', '1', array(
             'default' => '0',
             ));
    }

    public function down()
    {
        $this->removeColumn('article', 'top');
    }
}