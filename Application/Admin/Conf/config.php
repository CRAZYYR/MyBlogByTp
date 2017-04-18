<?php
return array(
'DB_TYPE'   => 'mysql', // 数据库类型
'DB_HOST'   => '127.0.0.1', // 服务器地址
'DB_NAME'   => 'weibo', // 数据库名
'DB_USER'   => 'root', // 用户名
'DB_PWD'    => 'root', // 密码
'DB_PORT'   => 3306, // 端口
'DB_PARAMS' =>  array(), // 数据库连接参数
'DB_PREFIX' => 'hd_', // 数据库表前缀 
'DB_CHARSET'=> 'utf8', // 字符集
'DB_DEBUG'  =>  TRUE, // 数据库调试模式 
//异或密钥
'MYKEY_ZS'=>'afsewretthyjujsdfsf',
'URL_ROUTER_ON'   => true, //开启路由
//路由的规则定义
'URL_ROUTE_RULES'=>array(
    ':id\d'        => 'User/index',
),
);