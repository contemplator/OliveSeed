<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Version5 extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('blog', array(
             'id' => 
             array(
              'primary' => '1',
              'unsigned' => '1',
              'autoincrement' => '1',
              'type' => 'integer',
              'length' => '4',
             ),
             'user_id' => 
             array(
              'unsigned' => '1',
              'type' => 'integer',
              'length' => '4',
             ),
             'name' => 
             array(
              'notblank' => '1',
              'unique' => '1',
              'type' => 'string',
              'length' => '20',
             ),
             ), array(
             'primary' => 
             array(
              0 => 'id',
             ),
             'charset' => 'utf8',
             ));
        $this->addColumn('article', 'blog_id', 'integer', '4', array(
             'default' => '',
             'unsigned' => '1',
             ));
        $this->addColumn('user', 'blog_id', 'integer', '4', array(
             'unsigned' => '1',
             ));
//        $this->changeColumn('article', 'id', 'integer', '4', array(
//             'primary' => '1',
//             'unsigned' => '1',
//             'autoincrement' => '1',
//             ));
//        $this->changeColumn('article', 'title', 'string', '50', array(
//             'notblank' => '1',
//             ));
//        $this->changeColumn('article', 'user_id', 'integer', '4', array(
//             'unsigned' => '1',
//             ));
//        $this->changeColumn('article', 'category_id', 'integer', '4', array(
//             'unsigned' => '1',
//             ));
//        $this->changeColumn('article', 'text', 'string', '', array(
//             'default' => '',
//             ));
//        $this->changeColumn('article', 'date', 'timestamp', '25', array(
//             ));
//        $this->changeColumn('category', 'id', 'integer', '4', array(
//             'primary' => '1',
//             'unsigned' => '1',
//             'autoincrement' => '1',
//             ));
//        $this->changeColumn('category', 'name', 'string', '255', array(
//             'notblank' => '1',
//             ));
//        $this->changeColumn('user', 'id', 'integer', '4', array(
//             'primary' => '1',
//             'unsigned' => '1',
//             'autoincrement' => '1',
//             ));
//        $this->changeColumn('user', 'name', 'string', '20', array(
//             'notblank' => '1',
//             'unique' => '1',
//             ));
//        $this->changeColumn('user', 'password', 'string', '32', array(
//             'notblank' => '1',
//             ));
//        $this->changeColumn('user', 'email', 'string', '200', array(
//             'default' => '',
//             ));
//        $this->changeColumn('user', 'salt', 'string', '8', array(
//             'default' => '',
//             ));
//        $this->changeColumn('user', 'phonenumber', 'string', '20', array(
//             ));
    }

    public function down()
    {
        $this->dropTable('blog');
        $this->removeColumn('article', 'blog_id');
        $this->removeColumn('user', 'blog_id');
    }
}