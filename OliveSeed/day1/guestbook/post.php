<?php
/**
 * 2011.6.15
 * Q.1
 * 那天有提到，這個留言板留言時不能使「,」，
 * 因為會破壞掉儲存檔案的資料分隔（以,做為間隔）格式
 * 請大家可以試試看，怎麼把這個問題處理掉！
 * Q.2
 * 可以試試看，替留言增加紀錄「留言時間」這個資料進去
 * 請參考函式庫中的
 *  date 函式 http://php.net/manual/en/function.date.php
 */
/*
 * 若 $_POST['submit'] 裡有資料，
 * 才表示是使用者真的按下送出鈕，發送表單過來
 */
if ($_POST['submit']) {

    // 利用 fopen() 函式執行開檔動作，傳入目標檔案的路徑，以及開檔的模式，
    // 第二個參數「a+」是指從檔尾寫入資料附加上去，所以 $fp 會指向檔案的尾端位置
    $fp = fopen('data/file.txt', 'a+');

    /*
     * 處理 POST 過來的 text 資料，
     * 把 換行符號轉換成 <br /> 的 html 標籤
     */
    $_POST['text'] = nl2br($_POST['text']);

    /**
     * 並為了確保真的沒有換行符號，再進行一次 str_replace，把 "\n" 這個特殊字元都換成 '' 空字元
     */
    $_POST['text'] = str_replace("\n", '', $_POST['text']);


    /**
     * 把 姓名、信箱跟留言內容，合併成一行，之間以「,」間隔，存放到 $content 變數之中
     */
    $content = $_POST['name'] . ',' . $_POST['email'] . ',' . $_POST['text'] . "\n";

    if (fwrite($fp, $content)) {
        echo '<a href="index">留言完成，前往看留言</a>';
        exit;
    }

    die('留言寫入失敗：可能是 data 資料夾不存在或不能寫入的關係');
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

