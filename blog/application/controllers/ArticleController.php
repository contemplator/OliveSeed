<?php

class ArticleController extends Zend_Controller_Action{
    
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
    
    public function indexAction(){
        
//        $params = $this->getRequest()->getParams();
        
        
        
        $blogId = $this->getRequest()->getParam('blog_id') ; 
        $articles = Doctrine_Query::create()
                ->select('*')
                ->from('Article')
                ->where('blog_id',$blogId)
                ->orderBy('top,date DESC')->execute();
        //  echo $blogId; exit;
        $this->view->articles = $articles;        
        
        $table = Doctrine_Core::getTable('Category');
            $categories = $table->findAll(); //請tabla把所有資料撈出來
            $this->view->categories =$categories;
        //$this->rend('filename') *isnot path
        //It's to inter the center web
        if( $readType =  $this->getRequest()->getParam('readtype') ){
           
            $this->render( $readType ) ;
        }
        
        if($this->getRequest()->isPost()){
            $category_id = $this->getRequest()->getPost();
            return $this->_helper->getHelper('Redirector')->gotoRoute(array('action' => 'class', 'controller' => 'article','category_id'=>$category_id));
        }
        
    }
    
    public function postAction(){
        
        $session = new Zend_Session_Namespace('Seed');
        $user = Doctrine_Core::getTable('User')->find($session->user_id) ;
        $blog_id = $user->Blog->id ;
//        $blogs = $user->Blogs;
        
//        $blog = Doctrine_Query::create()
//                ->select('*')
//                ->from('Blog')
//                ->where('user_id',$session->user_id)
//                        ->execute();
//        echo $blog->user_id; exit;
        $datetime = $this->view->time = date('Y-m-d H:i:s');
        $this->view->time = $datetime;
        if($this->getRequest()->isPost()){

            $data = $this->getRequest()->getPost();
            $article = new Article();  //新增
            $article->title = $data['title'];
            $article->text = $data['text'];
            $article->category_id = $data['category_id'];
            $article->date = $data['date'];
            $article->top = $data['top'];
            $article->user_id = $session->user_id;
            $article->blog_id = $blog_id;
            $article->save();//存取以上資料
            $this->render('index');  //??

            }

            $table = Doctrine_Core::getTable('Category');
            $categories = $table->findAll(); //請tabla把所有資料撈出來
            $this->view->categories =$categories;

    }
    
    public function classAction(){
        
        $table = Doctrine_Core::getTable('Article'); //取出blog資料庫裡的article資料表
        $params = $this->getRequest()->getParams(); //宣告變數是取得的變數->url候的變數
        $articles = $table->findBy("category_id" , $params["category_id"] ); //第一個參數->資料表,第二個參數->參考值
        $this->view->articles = $articles;
        //和index/class一樣
    }
    
    public function putAction(){
        /**
         * 已編輯完成，POST過來
         */
        if($posts = $this->getRequest()->getPost())
        {
            if($id = $this->getRequest()->getParam('id')) //取變數id
            {
                $text = array( //宣告陣列 待修改 將可能有修改的寫在Action中
                    'title'         =>  $posts['title'],
                    'date'          =>  $posts['date'],
                    'text'          =>  $posts['text']
                );
                
                $where['id = ?'] = $id; //sql語法
                $this->_db->update('article',$data,$where);
                
                $this->_helper->getHelper('Redirector')->gotoRoute(
                array('controller'=> 'article','action'=>'index','id'=>$id));
            }
            
        }
        /**
         * 尚未編輯完成，先選出物件塞入VIEW
         */
        else //??
        {
            if($id = $this->getRequest()->getParam('id'))
            {
                $this->_db->setFetchMode(Zend_Db::FETCH_OBJ);

                $sql = 'SELECT * FROM article WHERE id = ?';
                $this->view->edit = $this->_db->fetchRow($sql,$id);
            }
        }
        $table = Doctrine_Core::getTable('Category');
        $categories = $table->findAll(); //請tabla把所有資料撈出來
        $this->view->categories =$categories;
    }
    
    public function deleteAction(){
        
        if($id = $this->getRequest()->getParam('id'))
        {
            $where['id = ?'] = $id;
            $this->_db->delete('article',$where);
            
            $this->_helper->getHelper('Redirector')->gotoRoute(
            array('controller'=> 'article','action'=>'index'));
        }
    }
    
    public function getAction() {
        
        
        $article_id = $this->getRequest()->getParam('article_id');
        $article = Doctrine_Core::getTable('Article')->find($article_id) ;
                
        $article->addPopularity();
        
        $this->view->article = $article;
        
        
//        $q = Doctrine_Query::create()
//            ->update('Article')
//            ->set('popularity', 'popularity + 1')
//            ->where('id=?',$article_id)->execute();
        
    }
    
    public function testAction() {
        
        $articles = Doctrine_Core::getTable('Article')->findAll();
        $this->view->articles = $articles;
    }
    
}
?>
