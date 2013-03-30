<?php

class Lib_Functions{

   static function convertSummary( $html , $length = 100 , $encoding = "UTF-8")
    {
            $html = trim($html,"\n" );
            $text = str_replace("\n","",$html);
            $text = strip_tags( $text);
            return mb_substr( $text , 0 , $length , $encoding );
    }
}

?>
