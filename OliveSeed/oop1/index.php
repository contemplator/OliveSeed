<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



include 'class.Guestbook.php';


$gbook = new Guestbook('data/file.txt');

$pagesize = 10;

$page = 1;
$offset = ($page - 1) * $pagesize;

$entries = $gbook->page($offset, $pagesize);
?>



<html>
    <title>陽春的純文字留言板</title>
    <body>

        <a href="post.php">我要留言</a>

        <?php foreach ($entries as $entry): ?>
            <?php
            $data = explode('|@|', $entry);
            ?>


            <p>留言者姓名：<?php echo $data[0]; ?></p>
            <p>信箱：<?php echo $data[1]; ?></p>
            <p>內容：</p>
            <p><?php echo $data[2]; ?></p>
            <p>時間：<?php echo $data[3]; ?></p>


            <hr />


        <?php endforeach ?>

    </body>

</html>
