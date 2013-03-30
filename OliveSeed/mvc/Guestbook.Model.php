<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GuestbookModel {

    public function __construct($dbhost, $dbuser, $dbpassword, $dbname) {


        mysql_connect($dbhost, $dbuser, $dbpassword) or die(mysql_error());
        mysql_select_db($dbname) or die(mysql_error());
    }

    public function page($offset = 0, $size = 10, $order = 'ASC') {


        $sql = "SELECT * FROM `guestbook` ORDER BY `datetime` " . $order . " LIMIT  " . $offset . ',' . $size;


        $result = mysql_query($sql);

        $array = array();
        while ($data = mysql_fetch_assoc($result)) {

            $array[] = $data;
        }

        return $array;
//        $content = file( $this->_filepath );
//
//        return array_slice( $content , $offset , $size );
    }

    public function write($name, $email, $text) {

        $datetime = time();

        $sql = "INSERT `guestbook`(`name`,`email`,`text`,`datetime`) VALUES(
               '$name','$email','$text','$datetime'
            )";

        if (mysql_query($sql)) {
            return true;
        }

        throw new Exception('無法正常寫入:' . mysql_error());
    }

}