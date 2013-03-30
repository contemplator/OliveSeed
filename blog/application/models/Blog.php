<?php

class Blog extends Doctrine_Record {


    protected $_data = array();

    public function  setTableDefinition() {

        $this->setTableName('blog');

        $this->hasColumn( 'id','integer',4,array('primary'=>true,'unsigned'=>true,'autoincrement'=>true));
        $this->hasColumn('user_id', 'integer', 4, array('unsigned' => true));
        $this->hasColumn( 'name' , 'string',20,array('notblank'=>true,'unique'=>true));
        
    }

    public function  setUp() {
        parent::setUp();
        $this->hasOne('User', array('local' => 'id', 'foreign' => 'blog_id', 'onDelete' => 'SET NULL'));
        $this->hasMany('Article as Articles', array('local' => 'id', 'foreign' => 'blog_id'));
    }
    
    public function getLatestArticle() {
        
        $article = Doctrine_Core::getTable('Article')->findLatestArticleByBlogId($this->id);
       
        return $article;
    }
    
    
}
?>
