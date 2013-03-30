<?php

class Article extends Doctrine_Record
{
    public function setTableDefinition(){
        parent::setTableDefinition();//先執行Doctrine_Record的function
        
        $this->setTableName('article');
        
        $this->hasColumn('id','integer',4,array('primary'=>true,'unsigned'=>true,'autoincrement'=>true));
        
        $this->hasColumn('title','string',255,array('default'=>''));
        $this->hasColumn('text','string',NULL,array('default'=>''));
        
        $this->hasColumn('user_id','integer',4,array('unsigned'=>true,'default'=>NULL));
        $this->hasColumn('category_id','integer',4,array('unsigned'=>true,'default'=>NULL));        
    }
    
    public function setUp(){
        $this->hasOne('User',array('local'=>'user_id','foreign'=>'id','onDelete'=>'SET NULL'));//一對一~一篇文章一個作者~一篇文章存有一個User的ID~此處的User_id~要對到外部的ID(在user理)
        $this->hasOne('Category',array('local'=>'category_id','foreign'=>'id','onDelete'=>'SET NULL'));
    }
    
    public function getText(){
        return nl2br($this->_get('text'));
        
    }
}
 