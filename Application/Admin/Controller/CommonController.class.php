<?php
namespace Admin\Controller;
// wikins开源博客
// 基于thinkphp3.2框架开发
// wilinks 版权所有
// 博客地址：www.cbbtop.com
use Symfony\Component\Routing\Matcher\Dumper\DumperPrefixCollection;

class CommonController extends \Think\Controller {
    public function _initialize(){

        if (!$_SESSION['adminInfo']) {
            $this->redirect('Admin/User/login', null,2, '请登陆...');
            exit;
        }
    }
}