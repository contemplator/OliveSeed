#!C:/Appserv/php5/php.exe -q
<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';


$application = new Zend_Application( APPLICATION_ENV , APPLICATION_PATH . '/configs/application.ini' );
$application->bootstrap()->bootstrap('doctrine');

$cli = new Doctrine_Cli( $application->getOption('doctrine'));
$cli->run( $_SERVER['argv']);

?>