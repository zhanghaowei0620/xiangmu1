<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;
use think\Cookie;

/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 首页
     *
     */
    public function index()
    {
        $cate_id = $this->request->request('cate_id');
        $goosType = Db::table('fast_cate')->select();
        if($cate_id){
            $goodsInfo = Db::table('fast_goods')->where('cate_id',$cate_id)->select();  //商品
        }else{
            $goodsInfo = Db::table('fast_goods')->select();  //商品
        }
        
        $data = [
            'goodsCate' => $goosType,
            'goodsInfo' => $goodsInfo
        ];
        $this->success('请求成功',$data);
        
    }
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
    public function login(){
        $username = $this->request->request('username');
        $password = $this->request->request('password');
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


    /**
    *  业绩资产 
    */
    public function performance_Property(){
        $username = Cookie::get('aaa');
        $userInfo = Db::table('fast_users')->where('username',$username)->find();
        $this->success('请求成功',$userInfo);
    }

    /**
    * 个人中心
    */
    public function personaCenter(){
        $username = Cookie::get('aaa');
        $userInfo = Db::table('fast_users')->where('username',$username)->find();
        $this->success('请求成功',$userInfo);
    }

    /**
    *  添加会员 
    */
    public function userAdd(){
        $memberInfo =  Db::table('fast_member')->select();
        $userName = Cookie::get('aaa');
        $userInfo = Db::table('fast_users')->where('userName',$userName)->find();
        $data = [
            'memberInfo' => $memberInfo,
            'userName' => $userName
        ];
        $this->success('请求成功',$data);
    }

    /**
    * 添加会员-入库
    */
    public function userAddInsert(){
        $username = $this->request->request('username');
        $password = $this->request->request('password');
        $password1 = $this->request->request('password1');
        $tel = $this->request->request('tel');
        $name = $this->request->request('name');
        $user_id = $this->request->request('user_id');
        $member_id = $this->request->request('member_id');
        if($password == $password1){
            $insert = [
                'username' => $username,
                'password' => $password,
                'name' => $name,
                'tel' => $tel,
                'p_id' => $user_id,
                'member_id' =>  $member_id,
                'status' => 0,
                'create_time' => time()
            ];
            $userInsert = Db::table('fast_users')->insert($insert);
            if($userInsert){
                $this->success('添加成功');
            }else{
                $this->error('系统出现错误,请重试');
            }
        }else{
            $this->error('两次输入密码不相同');
        }
    }

    /**
    * 待审核会员列表
    */
    public function toAuditList(){
        $username =  Cookie('aaa');
        $user = Db::table('fast_users')->where('username',$username)->find();
        $userInfo = Db::table('fast_users')->where('status',0)->where('p_id',$user['user_id'])->select();
        $this->success('请求成功',$userInfo);
    }

    /**
     * 已审核列表
     */
    public function checkedList(){
        $username =  Cookie('aaa');
        $user = Db::table('fast_users')->where('username',$username)->find();
        $userInfo = Db::table('fast_users')->where('status','<>',0)->where('p_id',$user['user_id'])->select();
        $this->success('请求成功',$userInfo);
    }

    /**
     *  申请升级
     */
    public function apply(){
        $username =  Cookie('aaa');
        $user = Db::table('fast_users')->join('fast_member','fast_users.member_id = fast_member.member_id')->where('username',$username)->find();
        $member = Db::table('fast_member')->where('member_price','>',$user['member_price'])->select();
        dump($member);
    }
    public function applyUp(){
        $member_id = $this->request->request('member_id');
        $memberInfo = Db::table('fast_member')->where('member_id',$member_id)->find();
        $username =  Cookie('aaa');
        $user = Db::table('fast_users')->join('fast_member','fast_users.member_id = fast_member.member_id')->where('username',$username)->find();
        $member_price = $memberInfo['member_price'] - $user['member_price'];
        
    }

    /**
    *  复投
    */
    public function plural(){
        $username =  Cookie('aaa');
        $user = Db::table('fast_users')->join('fast_member','fast_users.member_id = fast_member.member_id')->where('username',$username)->find();
        $member = Db::table('fast_member')->where('member_price','>=',$user['member_price'])->select();
        dump($member);die;
    }


    /**
     * 修改密码
     */
    public function updatePassword(){
        $username =  Cookie('aaa');
        $oldPassword = $this->request->request('oldPassword');  //旧密码
        $newPassword = $this->request->request('newPassword');  //新密码
        $confirmPassword = $this->request->request('confirmPassword');  //确认密码
        if(!$oldPassword || !$newPassword || !$confirmPassword){
            $this->error('旧密码或新密码不能为空');
        }else{
            $userInfo = Db::table('fast_users')->where('username',$username)->find();
            if(password_verify($oldPassword,$userInfo['password']) == true){
                if($oldPassword == $newPassword){
                    $this->error('旧密码与新密码不能相同');
                }else{
                    if($newPassword == $confirmPassword){
                        $update = [
                            'password' => password_hash($newPassword,PASSWORD_DEFAULT),
                            'update_time' => time()
                        ];
                        $updateInfo = Db::table('fast_users')->where('user_id',$userInfo['user_id'])->update($update);
                        if($updateInfo){
                            $this->success('修改成功');
                        }else{
                            $this->error('修改失败');
                        }
                    }else{
                        $this->error('新密码与确认密码不相同,请重试');
                    }
                }
            }else{
                $this->error('旧密码错误,请重试');
            }
        }
    }

    /**
     * 修改资料
     */
    public function updateData(){
        $name = $this->request->request('name');  
        $tel = $this->request->request('tel');
        $username =  Cookie('aaa');
        $userInfo = Db::table('fast_users')->where('username',$username)->find();
        $update = [
            'name' => $name,
            'tel' => $tel,
            'update_time' => time()
        ];
        $updateInfo = Db::table('fast_users')->where('user_id',$userInfo['user_id'])->update($update);
        if($updateInfo){
            $this->success('修改成功');
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 账户转账
     */
    public function accountTransfer(){
        $username =  Cookie('aaa');
        $userInfo = Db::table('fast_users')->where('username',$username)->find();
        
        
    }

    /**
    * 微信支付
    */
    public function wxPay(){

    }
}