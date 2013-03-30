<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class IndexController extends Zend_Controller_Action {

    protected $_secondsStart;
    protected $_user = NULL ;
    protected $_table = NULL;

    public function  preDispatch() {
        
        //要正確執行要有UserTable裡的function
        parent::preDispatch();


        $this->_table = Doctrine_Core::getTable('User');

        if( $this->_user = $this->_table->initUser() ){
            $this->view->logined = true;
        }
        else{
            $this->view->logined = false;
        }
            
        
    }
    public function indexAction(){
       
        //$table = Doctrine_Core::getTable('Article');//table名字
        //$articles = $table->findBy(); //複數
        //$this->view->articles = $articles;
    }
    
    public function classAction(){
        
    }
    
    public function userAction(){
        
    }


}












//        $db = $this->getInvokeArg('bootstrap')->getResource('db');
//        Zend_Db_Table_Abstract::setDefaultAdapter( $db ) ;
//        $inn = new Application_Model_InnTable();