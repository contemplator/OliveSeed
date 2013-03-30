<?php
include 'class.Guestbook.php';

/*
 * 若 $_POST['submit'] 裡有資料，
 * 才表示是使用者真的按下送出鈕，發送表單過來
 */
if ($_POST['submit']) {

    $gbook = new Guestbook('data/file.txt');


    try {
        $gbook->write($_POST['name'], $_POST['email'], $_POST['text']);

        echo '<a href="index.php">留言完成，前往看留言</a>';
        exit;
    } catch (Exception $e) {


        die('留言寫入失敗：' . $e->getMessage());
    }
}
?>



<html>
    <title>留言板的留言表單</title>
    <body>

        <form method="post" action="post.php">

            <p>姓名：<input type="text" name="name"></p>
            <p>信箱：<input type="text" name="email" size="40"></p>
            <p>請填寫留言：<br />
                <textarea name="text" rows="10" cols="40"></textarea>
            </p>

            <p><input type="submit" name="submit" value="送出" /></p>


        </form>
    </body>
</html>

