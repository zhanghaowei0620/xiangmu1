<?php

namespace app\api\controller;
use app\common\controller\Api;
use app\common\model\Cate as CateModel;
use app\common\model\Banner as BannerModel;
use app\common\model\Goods as GoodsModel;
use app\common\model\News as NewsModel;
/**
 * 首页接口
 */
class Index extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**         
     * 首页
     */

    public function index()
    {
        
        $data['banner'] =  BannerModel::where("status",1)->field("image")->select();
        $data['cate'] = CateModel::where("status",1)->field("title")->select();
        $data['goods'] = GoodsModel::where("is_audit",1)->field("goods_id,goods_name,goods_price,goods_picture")->select();
        $data['news'] = NewsModel::order("weigh","asc")->field("id,title,createtime")->select();
        $this->success('请求成功',$data);
    
    }
}
