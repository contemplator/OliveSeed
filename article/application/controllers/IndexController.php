<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class IndexController extends Zend_Controller_Action {

    protected $_secondsStart;




    public function indexAction(){

        $this->view->time = date('Y/m/d H:i:s');
    }


    public function helloAction(){

        if( $this->getRequest()->isPost() ){

            $name = $this->getRequest()->getPost('name');

            $this->view->name = $name;
        }

    }

    public function aboutAction(){


        
    }

    public function contactAction(){
        
    }


}












//        $db = $this->getInvokeArg('bootstrap')->getResource('db');
//        Zend_Db_Table_Abstract::setDefaultAdapter( $db ) ;
//        $inn = new Application_Model_InnTable();