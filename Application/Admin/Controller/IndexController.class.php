<?php
namespace Admin\Controller;

// wikins开源博客
// 基于thinkphp3.2框架开发
// wilinks 版权所有
// 博客地址：www.cbbtop.com

class IndexController extends CommonController
{

    public function index()
    {
        $this->display();
    }

    public function posts()
    {
        $posts = D('posts');
        $postsList = $posts->order('created_at desc')->select();
        $this->assign('postsList',$postsList);
        $this->display();
    }

    public function addpost()
    {
        $posts = D('posts');
        $tag = D('tag');
        $tagList = $tag->field('id,tag')->select();

        $this->assign('tagList',$tagList);
        if (IS_POST){
            // 图片文件上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;//设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->saveName  =     date('Y-m-d',time()).mt_rand();
            $upload->autoSub = false;// 关闭子目录
            $upload->savePath  =      'posts/'; // 设置附件上传目录    // 上传文件
            $info   =   $upload->upload();
            // 添加form表单数据
            $map['title']  = I('post.title');
            $map['content'] = html_entity_decode(I('post.content'));
            $map['user_id']  = 2;
            $map['image'] = $info['photo']['savename'];
            $map['created_at']    = date('Y-m-d H:');
            $map['updated_at'] = date('Y-m-d H:');
            $map['tag_id'] = I('post.tag');
            $res = $posts->add($map);

            if($info && $res) {
                // 上传成功
                $this->redirect('Index/posts', null,2, '上传成功页面跳转中...');
            }else{
                $this->redirect('Index/posts', null,2, '上传失败页面跳转中...');
            }
        } else {
            $this->display();
        }

    }

    public function editpost()
    {
        $posts = D('posts');
        $tag = D('tag');
        $id = (I('get.id') == '') ? I('post.posts_id') : I('get.id');
        $tagList = $tag->field('id,tag')->select();
        $arr = $posts->where("id=$id")->select();
        $this->assign('posts',$arr);
        $this->assign('tagList',$tagList);

        if (IS_POST){
            // 图片文件上传
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;//设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->saveName  =     date('Y-m-d',time()).mt_rand();
            $upload->autoSub = false;// 关闭子目录
            $upload->savePath  =      'posts/'; // 设置附件上传目录    // 上传文件
            $info   =   $upload->upload();
            // 添加form表单数据
            $image = ($info['photo']['savename'] == '') ? $arr[0]['image']:$info['photo']['savename'];
            $map['id'] = I('post.posts_id');
            $map['title']  = I('post.title');
            $map['content'] = html_entity_decode(I('post.content'));
            $map['user_id']  = 2;
            $map['image'] = $image;
            $map['updated_at'] = date('Y-m-d H:');
            $map['tag_id'] = $id;
            $res = $posts->save($map);

            if($info && $res) {
                // 上传成功
                $url = './Uploads/posts/'.$arr[0]['image'];
                unlink($url);
                $this->redirect('Index/posts', null,2, '修改成功页面跳转中...');
            }else{
                $this->redirect('Index/posts', null,2, '修改失败页面跳转中...');
            }
        } else {
            $this->display();
        }
    }

    public function delpost($id)
    {
        $posts = D('posts');
        $arr = $posts->where("id=$id")->select();
        $res = $posts->delete($id);
        $url = './Uploads/posts/'.$arr[0]['image'];
        unlink($url);
        if($res) {
            // 上传成功
            $this->redirect('/Admin/Index/posts');

        }else{
            $this->redirect('/Admim/Index/posts', null,1, '删除失败页面跳转中...');

        }
    }
}