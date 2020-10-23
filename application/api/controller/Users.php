<?php

namespace app\api\controller;
use app\common\controller\Api;

use app\common\model\Cate as CateModel;
use app\common\model\Banner as BannerModel;
use app\common\model\Goods as GoodsModel;
use app\common\model\News as NewsModel;

use think\Db;
use think\Cookie;
use think\Request;


/**
 * 首页接口
 */
class Users extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 
     * 注册
     */ 
    public function register(){
        $username = $this->request->request('username');
        $password = $this->request->request('password');
        if(!$username || !$password){
            $this->error('用户名或密码不能为空');
        }else{
            $userInfo = Db::table('fast_users')->where('username',$username)->find();
            if($userInfo){
                $this->error('用户名已存在');
            }else{
                $insert = [
                    'username' => $username,
                    'password' => password_hash($password,PASSWORD_DEFAULT),
                    'create_time' => time()
                ];
                $userInfo = Db::table('fast_users')->insert($insert);
                if($userInfo){
                    $this->success('注册成功');
                }else{
                    $this->error('系统出现错误,请重试');
                }
            } 
        }
    }

    /**
     * 
     * 登录
     */ 
    public function login(Request $request){
        $username = Request::instance()->post('username');
        $password = Request::instance()->post('password');
        // $username = '测试';
        // $password = '1212';
        if(!$username || !$password){
            $this->error('用户名或密码不能为空');
        }else{
            $userInfo = Db::table('fast_users')->where('username',$username)->find();
            if($userInfo){
                if(password_verify($password,$userInfo['password']) == true){
                    Cookie::set('aaa',$username);
                    $this->success('登录成功');
                }else{
                    $this->error('密码错误,请重试');
                }
            }else{
                $this->error('当前登录用户不存在,请确认用户名是否正确');
            }
        }
    }
}