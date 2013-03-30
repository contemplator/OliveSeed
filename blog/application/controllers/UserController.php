<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserController extends Zend_Controller_Action {


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

    public function postAction(){

        if( $this->getRequest()->isPost() ){

            $params = $this->getRequest()->getPost();

            $user = new User();
            $user->name = $params['name'];
            $user->email = $params['email'] ;
            $user->password = $params['password'];
            $user->phoneNumber = $params['phoneNumber'];

            try{
                $user->save();
            } catch( Doctrine_Validator_Exception $e ){

                $error =  $e->getMessage();

                $this->view->error = $error ;

                return $this->render();
                
            }


            return $this->_helper->getHelper('Redirector')->gotoRoute(array('action'=>'sign'));
        }



        
    }

    public function signAction(){

        if( $this->_user /*不懂這個條件的意思*/){

        }

        if( $this->getRequest()->isPost() ){

            $params = $this->getRequest()->getPost();

            if( $user = $this->_table->signIn( $params['name'] , $params['password'])){


                return $this->_helper->getHelper('Redirector')->gotoRoute(array('action'=>'index','controller'=>'index'));
                
            }

            switch( $user ){
                case -1 :
                    $error = '使用者名稱錯誤' ;
                    break;
                case -2:
                    $error = '密碼錯誤';
                    break;

            }


            $this->view->error = $error ;
            
        }
        
    }

    public function signoutAction(){


        $this->_user->signOut();
        return $this->_helper->getHelper('Redirector')->gotoRoute(array('action'=>'index','controller'=>'index'));
    }
    
    public function indexAction() {
        
        $param = $this->getRequest()->getParams();
        $blogs = Doctrine_Core::getTable('Blog')->findBy('user_id',$param['user_id']);
        $this->view->blogs = $blogs;
        
    }

}