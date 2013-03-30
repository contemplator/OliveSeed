<?php

class ArticleController extends Zend_Controller_Action{
    
    public function indexAction(){
        $table = Doctrine_Core::getTable('Article');//table名字
        $articles = $table->findAll(); //複數
        
        $this->view->articles = $articles;
    }
    
    public function postAction(){
        
        if($this->getRequest()->isPost()){
            
            $data = $this->getRequest()->getPost();
            $article = new Article();  //新增
            $article->title = $data['title'];
            $article->text = $data['text'];
            $article->category_id = $data['category_id'];
            $article->save();//存取以上資料
            $this->_redirect('/article/');  //重新導向article
            
        }
        
        $table = Doctrine_Core::getTable('Category');
        $categories = $table->findAll(); //請tabla把所有資料撈出來
        
        $this->view->categories =$categories;
        
    }
    
    public function categoryAction(){
        
        $table = Doctrine_Core::getTable('Article'); //取出test資料庫裡的article資料表
        $params = $this->getRequest()->getParams(); //宣告變數是取得的變數
        $articles = $table->findBy("category_id" , $params["category_id"] );
        $this->view->articles = $articles;
    }
}

?>
