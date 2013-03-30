<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Guestbook {

    protected $_filepath;

    public function __construct($filepath = 'data/file.txt') {

        $this->_filepath = $filepath;
    }

    public function page($offset = 0, $size = 10) {


        $content = file($this->_filepath);

        return array_slice($content, $offset, $size);
    }

    public function write($name, $email, $text) {


        $fp = fopen($this->_filepath, 'a+');

        $text = nl2br($text);
        $text = str_replace("\n", '', $text);
        $text = str_replace("\r", '', $text);


        $datetime = date('Y/m/d H:i:s');

        /**
         * 把 姓名、信箱跟留言內容，合併成一行，之間以「,」間隔，存放到 $content 變數之中
         */
        $content = $name . '|@|' . $email . '|@|' . $text . '|@|' . $datetime . "<br />";




        if (fwrite($fp, $content)) {
            return true;
        }

        throw new Exception('無法正常寫入');
    }

}