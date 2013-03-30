<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Taipei');

include 'db.php';
include 'class.Guestbook.php';


$gbook = new Guestbook($dbhost, $dbuser, $dbpassword, $dbname);


//$gbook->$action();




$pagesize = 10;

$page = 1;
$offset = ($page - 1) * $pagesize;

$entries = $gbook->page($offset, $pagesize);
?>



<html>
    <title>陽春的純文字留言板</title>
    <body>

        <h1>歡迎觀看陽春留言板</h1>
        <a href="post.php">我要留言</a>

        <?php foreach ($entries as $data): ?>



            <p>留言者姓名：<?php echo $data['name']; ?></p>
            <p>信箱：<?php echo $data['email']; ?></p>
            <p>內容：</p>
            <p><?php echo nl2br($data['text']); ?></p>
            <p>時間：<?php echo date('Y/m/d H:i', $data['datetime']); ?></p>


            <hr />


        <?php endforeach ?>

    </body>

</html>
