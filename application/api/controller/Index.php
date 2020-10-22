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
}