<?php
/**
 * wikins开源博客
 * 基于thinkphp3.2框架开发
 * wilinks 版权所有
 * 博客地址：www.cbbtop.com
 */
$MODULE_ALLOW_LIST = array('Admin', 'Home',);
return array(
    //'配置项'=>'配置值'
    'SHOW_PAGE_TRACE'	=> 	TRUE,
    'URL_MODEL'			=> 	2,

    //数据库设置
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '', // 服务器地址 
    'DB_NAME'               =>  '',          // 数据库名
    'DB_USER'               =>  '',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    // 'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

    /* 安全配置 */
    'URL_MODEL' => 2, //URL模式
    'DEFAULT_MODULE' => defined('DEFAULT_MODULE') ? DEFAULT_MODULE : 'Home',
    'MODULE_ALLOW_LIST' => $MODULE_ALLOW_LIST,
    'MODULE_DENY_LIST'   => array('Common','Runtime'),
    'DEFAULT_TIMEZONE'=>'Asia/Shanghai',

    /* SESSION配置 */
    'SESSION_AUTO_START' => true,
    'SESSION_EXPIRE' => 3600,

    /* 令牌配置 */
    'TOKEN_ON' => false, //是否开启令牌验证
    'TOKEN_NAME' => '__hash__', //令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => true, //令牌验证出错后是否重置令牌 默认为true

    /* 调试配置 */
    'SHOW_PAGE_TRACE' => false,

    /* 用户相关设置 */
    'USER_MAX_CACHE'     => 1500, //最大缓存用户数



     /* 自定义配置文件载入*/
     'LOAD_EXT_CONFIG'  => array(
         'QQ'=>'qq.config.php' //qq登录设置
     ),


);
