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

	/* 文件上传相关配置 */
	'DOWNLOAD_UPLOAD' => array(
			'mimes'    => '', //允许上传的文件MiMe类型
			'maxSize'  => 5*1024*1024, //上传的文件大小限制 (0-不做限制)
			'exts'     => 'jpg,gif,png,jpeg,zip,rar,tar,gz,7z,doc,docx,txt,xml', //允许上传的文件后缀
			'autoSub'  => true, //自动子目录保存文件
			'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
			'rootPath' => './Uploads/Download/', //保存根路径
			'savePath' => '', //保存路径
			'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
			'saveExt'  => '', //文件保存后缀，空则使用原后缀
			'replace'  => false, //存在同名是否覆盖
			'hash'     => true, //是否生成hash编码
			'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
	), //下载模型上传配置（文件上传类配置）

	/* 编辑器图片上传相关配置 */
	'EDITOR_UPLOAD' => array(
			'mimes'    => '', //允许上传的文件MiMe类型
			'maxSize'  => 2*1024*1024, //上传的文件大小限制 (0-不做限制)
			'exts'     => 'jpg,gif,png,jpeg', //允许上传的文件后缀
			'autoSub'  => true, //自动子目录保存文件
			'subName'  => array('date', 'Y-m-d'), //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
			'rootPath' => './Uploads/Editor/', //保存根路径
			'savePath' => '', //保存路径
			'saveName' => array('uniqid', ''), //上传文件命名规则，[0]-函数名，[1]-参数，多个参数使用数组
			'saveExt'  => '', //文件保存后缀，空则使用原后缀
			'replace'  => false, //存在同名是否覆盖
			'hash'     => true, //是否生成hash编码
			'callback' => false, //检测文件是否存在回调函数，如果存在返回文件信息数组
	),

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


	),

	/* SESSION 和 COOKIE 配置 */
	'SESSION_PREFIX' => 'zl_home', //session前缀
	'COOKIE_PREFIX'  => 'zl_home_', // Cookie前缀 避免冲突
    'TMPL_ACTION_ERROR'         =>  'Common:error',   // 默认错误跳转对应的模板文件
	'TMPL_ACTION_SUCCESS'       =>  'Common:success',   // 默认成功跳转对应的模板文件
);