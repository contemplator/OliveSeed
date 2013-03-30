<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh" lang="zh">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CSS教學</title>
        <link rel="stylesheet" type="text/css" href="stylesheet/reset.css"/>
        <link rel="stylesheet" type="text/css" href="stylesheet/theme.css"/>
        <link rel="stylesheet" type="text/css" href="stylesheet/text.css"/>

        <style type="text/css">
            p.ex_a { color:#0000ff;}
        </style>

    </head>

    <body id="example">

        <h1>CSS範例</h1><br/>

        <h2>一、建立樣式表的方式</h2><br/>

        <h3>行內樣式</h3>
        <p style="color: #ff0000;">我是行內樣式範例</p>

        <h3>嵌入樣式</h3>
        <p class="ex_a">我是嵌入樣式範例</p>

        <h3>連結樣式</h3>
        <p class="ex_b">我是連結樣式範例</p>

        <hr />

        <h2>二、選擇器</h2><br/>

        <h3>關聯選擇器</h3>

        <div>
            <p>我是關聯選擇器範例</p>
        </div>
<br/>
        <h3>子選擇器</h3>

        <p>
            <span><em>我是</em></span><em>子選擇器</em>範例
        </p>
<br/>
        <h3>關聯式類別選擇器</h3>

        <p class="ex_a">我是<span>關聯式類別選擇器</span>範例</p>
<br/>
        <h3>相鄰同輩選擇器</h3>

        <p>我是相鄰同輩選擇器範例</p>
        <p>我是相鄰同輩選擇器範例</p>

        <hr />

    </body>

</html>




