<?php

namespace app\admin\controller;

use app\common\controller\Backend;
use app\common\model\Users as UsersModel;
/**
 * 
 *
 * @icon fa fa-users
 */
class Users extends Backend
{
    
    /**
     * Users模型对象
     * @var \app\common\model\Users
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Users;

    }

    public function import()
    {
        parent::import();
    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
    /**
     * 查看
     */
        /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags', 'trim']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                    ->with(['member'])
                    ->where($where)
                    ->order($sort, $order)
                    ->paginate($limit);

            foreach ($list as $row) {
                $row->getRelation('member')->visible(['member_title']);
            }

            $result = array("total" => $list->total(), "rows" => $list->items());

            return json($result);
        }
        return $this->view->fetch();        
    }




    /**
     * 激活为空单
     */
    public function activateEmptyList()
    {

        $ids = input("ids");
        $res = UsersModel::where('user_id', $ids)->update(['status' => '2']);
        if($res){
            $this->success("激活成功");
        }else{
            $this->error("激活失败");
        }

    }

}
