<?php

class ArticleController extends Zend_Controller_Action{
    
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
    
    public function indexAction() {
        
    }
    
    public function postAction(){
        
    }
    
    public function editAction() {
        
    }
    
    public function classAction() {
        
    }
}

?>
