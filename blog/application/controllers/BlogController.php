<?php

    class BlogController extends Zend_Controller_Action {
        
        public function  preDispatch() {
        
        
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
            
//            echo $this->getRequest()->getParam('aaa') ; 
            
            $entries = Doctrine_Core::getTable('Blog')->findAll();
            $this->view->entries = $entries;
//            $blog1 = $entries[0] ; 
//            $article = $entries->getLatestArticle() ;
            
//            $this->view->article = $article;
            
//            $articles = $entries->getLatestArticle() ;
            
            
            
//            $this->view->
//            $table = Doctrine_Core::getTable('article');
//            $articles = $table->findBy('blog_id',)
            
        }
        
        public function getAction() {
            
            if($this->getRequest()->getParam('isMine')==true){
                
                $session = new Zend_Session_Namespace('Seed');
                $user = Doctrine_Core::getTable('User')->findOneBy('id', $session->user_id);
                $this->view->objectId = $user->blog_id;
                
            }
            else{
                
                $params = $this->getRequest()->getParam('blog_id');
                $this->view->objectId = $params;
                
            }
        }
        
        public function postAction() {
            
            $session = new Zend_Session_Namespace('Seed');
            if($this->getRequest()->isPost()){
                
                $params = $this->getRequest()->getPost();
                $blog = new Blog;
                $blog->name = $params['name'];
                $blog->user_id = $session->user_id;
                $blog->save();
                
                $q = Doctrine_Query::create()
                    ->update('User')
                    ->set('blog_id', $param->id)
                    ->where('id',$session->id);
                
                return $this->_helper->getHelper('Redirector')->gotoRoute(array('action' => 'index', 'controller' => 'index'));
            }
            
        }
        
    }

?>
