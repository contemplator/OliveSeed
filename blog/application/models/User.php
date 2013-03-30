<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends Doctrine_Record {


    protected $_data = array();

    public function  setTableDefinition() {

        $this->setTableName('user');

        $this->hasColumn( 'id','integer',4,array('primary'=>true,'unsigned'=>true,'autoincrement'=>true));
        $this->hasColumn( 'name' , 'string',20,array('notblank'=>true,'unique'=>true));
        $this->hasColumn( 'password','string',32,array('notblank'=>true));
        $this->hasColumn( 'email','string',200,array('default'=>''));
        $this->hasColumn( 'salt' , 'string' , 8 , array('default'=>''));
        $this->hasColumn('blog_id', 'integer', 4, array('unsigned' => true));
        $this->hasColumn( 'phoneNumber', 'string', 20);

    }

    public function  setUp() {
        parent::setUp();

        $this->hasMany('Article as Articles',array('local'=>'id','foreign'=>'user_id') );
        $this->hasOne('Blog', array('local' => 'id', 'foreign' => 'user_id', 'onDelete' => 'SET NULL'));
    }



    public function setPassword( $value ){

        $salt = substr( time() , 0 , 8 );

        $encoded_password = md5( $value . $salt );
        $this->_set('password' , $encoded_password );
        $this->_set('salt',$salt);
    }


    public function auth( $password ){


        return md5( $password.$this->salt ) == $this->password ;
    }


    public function signOut(){
        
        $session = new Zend_Session_Namespace('Seed');
        $session->user_id =null;
    }
}