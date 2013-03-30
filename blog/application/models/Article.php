<?php

class Article extends Doctrine_Record{
    
    CONST READTYPE_LIST = 'list' ;
    CONST READTYPE_SUMMARY = 'summary' ; 
    
    public function setTableDefinition(){
        
        $this->setTableName('article');
        $this->hasColumn('id', 'integer', 4, array('primary' => true, 'unsigned'=>true,'autoincrement'=>true));
        $this->hasColumn('title', 'string', 50, array('notblank' => true));
        $this->hasColumn('date', 'timestamp');
        $this->hasColumn('user_id','integer',4,array('unsigned'=>true,'default'=>NULL));
        $this->hasColumn('blog_id', 'integer', 4, array('default' => '','unsigned'=>true));
        $this->hasColumn('category_id','integer',4,array('unsigned'=>true,'default'=>NULL));  
        $this->hasColumn('text', 'string',NULL,array('default'=>''));
        $this->hasColumn('popularity', 'integer', 100, array('default' => '0'));
        $this->hasColumn('top', 'boolean', 1 , array('default' => '0'));
    }
    
    public function setUp(){
        parent::setUp();
        $this->hasOne('User', array('local' => 'user_id', 'foreign' => 'id', 'onDelete' => 'SET NULL'));
        $this->hasOne('Category', array('local' => 'category_id', 'foreign' => 'id', 'onDelete' => 'SET NULL'));
        $this->hasOne('Blog', array('local' => 'blog_id', 'foreign' => 'id', 'onDelete' => 'SET NULL'));
    }
    
    public function getText(){
        return nl2br($this->_get('text'));
    }
    
    public function summary($length = 25) {
        
        $words = nl2br(Lib_Functions::convertSummary($this->text,$length));
         
        if(strlen($words)<strlen($this->text)){
            $words = $words."...";
            
        }
        return $words;
        
    }
    
    public function addPopularity(){
        $this->popularity = $this->popularity + 1 ;
        
        $this->save(); 
    }
    
//    public function click(){
//        
//        if()//轉到article/get
//        {
//            //column人氣裡的數字+1
//        }
//    }
    
}
