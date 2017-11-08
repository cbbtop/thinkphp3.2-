<?php
namespace Admin\Controller;
use Think\Controller;

// wikins开源博客
// 基于thinkphp3.2框架开发
// wilinks 版权所有
// 博客地址：www.cbbtop.com

class UserController extends Controller
{

    /**
     * 登录
     * @return [type] [description]
     */
    public function login()
    {
        if (IS_POST){
            $user = D('users');
            $map['name'] = I('post.name');
            $map['password'] = md5(I('post.password'));
            $info = $user->where($map)->find();

            if ($info){
                $_SESSION['adminInfo'] = $info;
                $this->redirect('Index/index', null,2, '登录成功页面跳转中...');
            }else{
                $this->redirect('User/login', null,2, '用户名或密码错误...');
            }
        }else{
            $this->display();
        }

    }

        /**
         * 注册
         */
//    public function register()
//    {
//        if (IS_POST){
//            $user = D('users');
//            $map['name'] = I('post.name');
//            $map['password'] = md5(I('post.password'));
//            $map['created_at'] = date('Y-m-d H:');
//            $map['updated_at'] = date('Y-m-d H:');
//            $info = $user->add($map);
//            if ($info){
//                $this->redirect('User/login', null,2, '注册成功，跳转到登录页...');
//            }else{
//                $this->redirect('User/register', null,2, '注册失败页面跳转中...');
//            }
//        }
//        $this->display();
//    }
}