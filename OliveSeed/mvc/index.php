<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

error_reporting(E_ALL ^ E_NOTICE);
ini_set('display_errors', 'On');
date_default_timezone_set('Asia/Taipei');

// 嵌入組態設定檔，裡面目前只有資料庫的設定參數
require 'config.php';
// 嵌入各 controller class
require 'Guestbook.Controller.php';
require 'Index.Controller.php';




// 把組態檔裡的變數資料，包成一個陣列
$config = array(
    'dbuser' => $dbuser,
    'dbpassword' => $dbpassword,
    'dbhost' => $dbhost,
    'dbname' => $dbname
);

/**
 *  包成 request 物件(陣列)，這裡我們只做讀取 HTTP GET 丟過來的參數
 *  實際上 request 裡應該也要包含 post 過來的資料，不過我們先簡化
 */
if (empty($_GET['controller']))
    $_GET['controller'] = 'index';
if (empty($_GET['action']))
    $_GET['action'] = 'index';

$request = array(
    'controller' => $_GET['controller'],
    'action' => $_GET['action']
);





/**
 * 動態依 request 中的 controller 參數來決定要執行哪一個 Controller
 */
$controllerName = $request['controller'];
$controllerToCalled = ucfirst($controllerName) . 'Controller';
/**
 * 產生要執行的 controller 物件
 * 同時把 request物件與 組態資料 丟到 controller 裡
 */
$main = new $controllerToCalled($request, $config);

/** 開始執行 * */
$main->run();
?>
