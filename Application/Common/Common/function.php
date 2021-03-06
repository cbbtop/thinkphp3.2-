<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/18
 * Time: 15:10
 */
/**
 * 调试输出函数
 * @param  mix $val 调试输出源数据
 * @param bool $dump 是否启用var_dump调试
 * @param bool $exit 是否在调用结束后设置断点
 * retur void
 */
function debug($val,$dump = false,$exit = true){
    //自动调用函数名称$func
    if ($dump){
        $func = 'var_dump';
    }else{
        $func = (is_array($val) || is_object($val)) ? 'print_r' : 'printf';
    }
    header("Content-type:text/html;charset=utf-8");
    echo '<pre>debug output:<hr/>';
    $func($val);
    echo '</pre>';
    if ($exit) exit;
}