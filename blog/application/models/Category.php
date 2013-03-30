<?php

class Category extends Doctrine_Record{
    
    public function setTableDefinition(){
        
        $this->setTableName('category');
        
        $this->hasColumn('id','integer',4,array('primary'=>true,'unsigned'=>true,'autoincrement'=>true));
        $this->hasColumn('name','string',255,array('notblank'=>true));
    }
    
    public function  setUp() {
        
        $this->hasMany('Article as Articles',array('local'=>'id','foreign'=>'category_id') );
    }
}

?>
