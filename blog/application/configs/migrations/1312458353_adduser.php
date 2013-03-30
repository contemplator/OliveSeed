<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Adduser extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('user', array(
             'id' => 
             array(
              'primary' => true,
              'unsigned' => true,
              'autoincrement' => true,
              'type' => 'integer',
              'length' => 4,
             ),
             'name' => 
             array(
              'notblank' => true,
              'unique' => true,
              'type' => 'string',
              'length' => 20,
             ),
             'password' => 
             array(
              'notblank' => true,
              'type' => 'string',
              'length' => 32,
             ),
             'email' => 
             array(
              'email' => true,
              'type' => 'string',
              'length' => 200,
             ),
             'salt' => 
             array(
              'default' => '',
              'type' => 'string',
              'length' => 8,
             ),
             'phonenumber' => 
             array(
              'type' => 'string',
              'length' => 20,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('user');
    }
}