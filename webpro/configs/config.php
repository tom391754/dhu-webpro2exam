<?php 

error_reporting(E_ALL);

//define('APP_HOME', dirname(dirname(__FILE__)) . '/');
define('APP_HOME', dirname(dirname(__FILE__)) . '/');
define('PATH_WRITABLE', APP_HOME . 'writable/');
error_reporting(E_ALL ^ E_DEPRECATED);
$guestbookDBCfg  = array(
    'host'     => 'localhost',   //服务器
    'user'     => 'root',        //数据库用户名
    'pass'     => '391754',          //数据库密码
    'dbName'   => 'webpro',   //数据库
    'port'     => '3306',        //端口
    'charset'  => 'utf8',        //字符集
);

set_include_path(
'.' . PATH_SEPARATOR .
APP_HOME . '/libs' . PATH_SEPARATOR .
get_include_path()
);