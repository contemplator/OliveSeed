<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UserTable extends Doctrine_Table {



    public function initUser(){


        $session = new Zend_Session_Namespace('Seed');

        if( $session->user_id ){

         
            return $this->find( $session->user_id );
        }
        return false;
    }


    public function signIn( $username , $password ){



        $user = $this->findOneByName( $username ); // == $this->findBy( 'name' , $username );
        if( $user == false ) return -1 ;

        if( $user->auth( $password ) ){


            $session = new Zend_Session_Namespace('Seed');
            $session->user_id = $user->id ;


            return $user ;


        }

        return -2;
    }

}