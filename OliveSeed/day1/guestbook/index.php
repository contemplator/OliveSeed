<?php
$content = file('data/file.txt');
?>

<html>
    <title>陽春的純文字留言板</title>
    <body>

        <a href="post.php">我要留言</a>

        <?php for ($i = 0; $i < count($content); $i++): ?>
            <?php
            // $content[$i] 等於一筆留言的資料列，姓名、信箱、留言內容以「,」間隔
            // 利用 explode() 函式，將 content[$i] 以「,」折開，回傳 array 給 data
            $data = explode(',', $content[$i]);
            ?>


            <p>留言者姓名：<?php echo $data[0]; ?></p>
            <p>信箱：<?php echo $data[1]; ?></p>
            <p>內容：</p>
            <p><?php echo $data[2]; ?></p>


            <hr />


        <?php endfor ?>

    </body>

</html>
