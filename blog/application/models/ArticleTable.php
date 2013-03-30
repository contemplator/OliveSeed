<?php

class ArticleTable extends Doctrine_Table{
    
    public function findLatestArticleByBlogId($blog_id){ //接受參數$blog_id
     
//        $q = Doctrine_Query::create();
//        $q->from('Article a')->where('a.blog_id =?',$blog_id)
//                ->orderBy('a.date DESC')
//                ->limit(1);
        
        
        $q = Doctrine_Query::create()
                ->from('Article')
                ->where('blog_id=?',$blog_id)
                ->orderBy('date DESC')
                ->limit(1);
        return $q->fetchOne();
//        $users = $q->execute();
        
//        $q = Doctrine_Core::getTable('Article')->createQuery('a');
        
        
//        $q = Doctrine_Core::getTable('Article')
//                ->$this->createQuery('')
//                ->where('blog_id =?',$blog_id)
                
        
//        return $q->fetchOne(); //查出此blog的最近文章
    }
}

?>
