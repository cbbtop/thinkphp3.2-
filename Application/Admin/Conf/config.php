<?php
/**
 * wikins开源博客
 * 基于thinkphp3.2框架开发
 * wilinks 版权所有
 * 博客地址：www.cbbtop.com
 */
return array(
	//'配置项'=>'配置值'
    'URL_MODEL' => 2, //URL模式

	/* 是否允许注册 */
	'USER_ALLOW_REGISTER' => true,

	/* 主题设置 */
	'DEFAULT_THEME' =>  'default',  // 默认模板主题名称
	/* 模板相关配置 */
	'TMPL_PARSE_STRING' => array(
			'__STATIC__' => __ROOT__ . '/static',
			'__ADDONS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/Addons',
			'__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
			'__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
			'__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
			'__IMAGES__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
			'__IMG__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/img',
			'__PICTURE__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/picture',
            '__ASSETS__' => __ROOT__ . '/Public/' . MODULE_NAME . '/assets',


	),

	/* SESSION 和 COOKIE 配置 */
	'SESSION_PREFIX' => 'zl_home', //session前缀
	'COOKIE_PREFIX'  => 'zl_home_', // Cookie前缀 避免冲突
    'TMPL_ACTION_ERROR'         =>  'Common:error',   // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'       =>  'Common:success',   // 默认成功跳转对应的模板文件
);