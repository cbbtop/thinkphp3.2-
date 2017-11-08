<?php
namespace Home\Controller;
use phpDocumentor\Reflection\Types\Integer;
use Think\Controller;
/**
 * wikins开源博客
 * 基于thinkphp3.2框架开发
 * wilinks 版权所有
 * 博客地址：www.cbbtop.com
 */
class IndexController extends Controller
{
    public function _initialize() {
        $new_posts = D('posts')->order('created_at desc')->limit(8)->select();
        $new_comments = D('comments')->order('created_at desc')->limit(8)->select();
        foreach ($new_comments as $k => $v) {
            $user_id = $v['user_id'];
            $users = D('users')->where("id=$user_id")->select();
            $new_comments[$k]['user_id'] = $users[0]['name'];
        }
        //用户信息
        Vendor('qqConnect.qqConnectAPI');
        if ($_COOKIE['qq_accesstoken'] && $_COOKIE['qq_openid']){
            $qc = new \QC($_COOKIE['qq_accesstoken'],$_COOKIE['qq_openid']);
            $userinfo = $qc->get_user_info();
            //保存用户信息
            if ($userinfo['ret'] == 0 && !empty($userinfo)){
                $qq_openid = $_COOKIE['qq_openid'];
                $data = array(
                    'username' => $userinfo['nickname'],
                    'qq_openid' => $qq_openid,
                    'addtime' => date('Y-m-d H:i:s'),
                    'imgurl' => $userinfo['figureurl_qq_1'],
                );
                $where = array('qq_openid'=>$qq_openid);
                //表操作
                $visitor = D('visitor');
                $res= $visitor->where($where)->select();
                if ($res == false){
                    $add_data = $visitor->add($data);
                }
                $this->assign('userinfo',$userinfo);
            }else{
                echo '登录失败';
            }
        }

        $this->assign('re_comments',$new_comments);
        $this->assign('re_posts',$new_posts);
    }
    public function index()
    {
        $map['tag_id'] = array('lt',8);
        $p_num = 9;
        $p = trim(I('get.p')) == '' ? 1 : trim(I('get.p'));
        $posts =  D('posts')->where($map)->order('created_at desc')->page("$p,$p_num")->select();

        $count = D('posts')->where($map)->order('created_at desc')->count();
        $Page = new \Think\Page($count,$p_num);
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('posts',$posts);
        $this->display();
    }

    /**
     * 关于我们
     * @return [type] [description]
     */
    public function about()
    {
        $this->display();
    }

    public function archives()
    {
        $map2017['created_at'] = array('like','%2017%');
        $map2016['created_at'] = array('like','%2016%');

        $arr2017 = D('posts')->where($map2017)->order('created_at desc')->select();
        $arr2016 = D('posts')->where($map2016)->order('created_at desc')->select();

        $this->assign('posts2016',$arr2016);
        $this->assign('posts2017',$arr2017);
        $this->display();
    }

    public function video()
    {
        $map2017['tag_id'] = 8;
        $map2016['tag_id'] = 9;

        $arr2017 = D('posts')->where($map2017)->order('created_at desc')->select();
        $arr2016 = D('posts')->where($map2016)->order('created_at desc')->select();

        $this->assign('posts2016',$arr2016);
        $this->assign('posts2017',$arr2017);
        $this->display();
    }

    public function links()
    {
        $p = trim(I('get.p')) == '' ? 1 : trim(I('get.p'));

        $comments_links = D('comments_links')->order('created_at desc')->page($p.',2')->select();
        $links = D('links')->select();


        foreach ($comments_links as $k => $v) {
            $user_id = $v['user_id'];
            $users = D('users')->where("id=$user_id")->select();
            $comments_links[$k]['user_id'] = $users[0]['name'];
        }


        $count = D('comments_links')->count();
        $Page = new \Think\Page($count,2);//
        $show = $Page->show();

        $this->assign('page',$show);
        $this->assign('comments_links',$comments_links);
        $this->assign('links',$links);
        $this->display();
    }

    /**
     * 搜索功能
     * @return [type] [description]
     */
    public function search()
    {
        $tags = D('tag')->select();

        foreach ($tags as $k => $v) {
            $id = $v['id'];
            $count = D('posts')->where("tag_id=$id")->count();
            $tags[$k]['count'] = $count;
        }
        $this->assign('tags',$tags);
        $this->display();
    }
    /**
     * 搜索列表
     * @return [type] [description]
     */
    public function search_list(){
        if (IS_POST){
            $search = I('post.search');
            $map['title'] = array('like','%'.$search.'%');
            $search_list = D('posts')->where($map)->order('created_at desc')->select();
            $this->assign('search',$search);
            $this->assign('search_list',$search_list);
        }
        $this->display();
    }

    /**
     * 文章标签
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function tag($id)
    {
        $p = trim(I('get.p')) == '' ? 1 : trim(I('get.p'));
        $tags = D('tag')->where("id=$id")->select();
        $arr =  D('posts')->where("tag_id=$id")->order('created_at desc')->page($p.',8')->select();
        $count = D('posts')->where("tag_id=$id")->count();
        $Page = new \Think\Page($count,8);//
        $show = $Page->show();
        $this->assign('page',$show);
        $this->assign('tags',$tags);
        $this->assign('arr',$arr);
        $this->display();
    }

    /**
     * 文章
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $p = trim(I('get.p')) == '' ? 1 : trim(I('get.p'));
        $show = D('posts')->where("id=$id")->select();
        $comments = D('comments')->where("post_id=$id")->order('created_at desc')->page($p.',2')->select();
        $tags = D('tag')->select();

        foreach ($comments as $k => $v) {
            $user_id = $v['user_id'];
            $users = D('users')->where("id=$user_id")->select();
            $comments[$k]['user_id'] = $users[0]['name'];
        }
        //点赞状态获取
        $map['post_id'] = I('get.id');
        $map['user_id'] = 404;//游客
        $map['ip'] = get_client_ip();
        $zan_type = D('zans')->where($map)->select();

        //人气
        $looks_map['time'] = date('Y-m-d H:i:s');
        $res = D('looks')->where("post_id=$id")->select();
        if ($res){
            $looks_id = $res[0]['id'];
            $looks =  D('looks')->where("id=$looks_id")->setInc('num'); // num加 1
            $save =  D('looks')->where("id=$looks_id")->save($looks_map); // num加 1
        }else{
            $looks_map['post_id'] = $id;
            $looks_map['ip'] = get_client_ip();
            $looks_map['num'] = 1;
            $looks = D('looks')->add($looks_map);
        }
        //人气数量
        $looks_res = D('looks')->where("post_id=$id")->select();

        $count = D('comments')->where("post_id=$id")->count();
        $zans  = D('zans')->where("post_id=$id")->count();
        $Page = new \Think\Page($count,2);//
        $shows = $Page->show();
        $this->assign('page',$shows);
        $this->assign('looks_count',$looks_res[0]['num']);
        $this->assign('tags',$tags);
        $this->assign('show',$show);
        $this->assign('count',$count);
        $this->assign('zans',$zans);
        $this->assign('zan_type',$zan_type);
        $this->assign('comments',$comments);
        $this->display();
    }

    /**
     * 文章留言
     * @return [type] [description]
     */
    public function addcomments(){
         $ip['ip'] = get_client_ip();
         $id =I('post.id');
         $data['post_id'] = $id;
         $data['name'] = I('post.author');
         $data['ip'] = $ip['ip'];
         $data['content'] = I('post.text');
         $data['created_at'] = date('Y-m-d H:');
         $data['updated_at'] = date('Y-m-d H:');
         $comments = D('comments');
         $num = $comments->where($ip)->count();

         if ($num > 5 ){
            redirect("links", 3, '今天评论次数已经超过5次...');
         }
         $com = $comments->add($data);
         if ($com){
             redirect("show/id/$id", 1);
         }else{
             redirect("show/id/$id", 1);
         }

    }
    /**
     * 留言
     * @return [type] [description]
     */
    public function addcomments_links(){
        $ip['ip'] = get_client_ip();
        $data['name'] = I('post.author');
        $data['content'] = I('post.text');
        $data['ip'] = $ip['ip'];
        $data['created_at'] = date('Y-m-d H:');
        $data['updated_at'] = date('Y-m-d H:');
        $comments = D('comments_links');
        $num = $comments->where($ip)->count();
        if ($num > 5 ){
            redirect("links", 3, '今天评论次数已经超过5次...');
        }
        $com = $comments->add($data);
        if ($com){
            redirect("links", 3, 'pass...');
        }else{
            redirect("links", 3, 'over...');
        }

    }

    /**
     * 点赞
     * @return [type] [description]
     */
    public function addzans(){
        $zans = D('zans');
        $map['post_id'] = I('post.post_id');
        $map['user_id'] = 404;//游客
        $map['ip'] = get_client_ip();


        $unzan = $zans->where($map)->select();
        $map['created_at'] = date('Y-m-d H:');
        $map['updated_at'] = date('Y-m-d H:');

        if ($unzan){
            $del = $zans->where("id={$unzan[0]['id']}")->delete();
            $this->ajaxReturn(array(
                'code' => '点赞'
            ));
        }
        $res = $zans->add($map);
        if ($res){
            $this->ajaxReturn(array(
                'code' => '取消赞'
            ));
        }else{
            $this->ajaxReturn(array(
                'code' => '404'
            ));
        }
    }

    //第三方登录
    public function callback(){
        //请求accesstoken
        Vendor('qqConnect.qqConnectAPI');
        $oauth = new \Oauth();
        $accesstoken = $oauth->qq_callback();
        $openid = $oauth->get_openid();
        setcookie('qq_accesstoken',$accesstoken,time()+86400);
        setcookie('qq_openid',$openid,time()+86400);
        header("Location:index");

    }
    public function qqlogout(){
        setcookie('qq_accesstoken',null);
        setcookie('qq_openid',null);
        header("Location:index");
    }
    public function qqlogin(){
        //访问qq登录页面
        Vendor('qqConnect.qqConnectAPI');
        $oauth = new \Oauth();
        $oauth->qq_login();
    }


}