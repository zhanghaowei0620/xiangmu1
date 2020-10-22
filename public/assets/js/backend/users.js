define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'users/index' + location.search,
                    add_url: 'users/add',
                    edit_url: 'users/edit',
                    del_url: 'users/del',
                    multi_url: 'users/multi',
                    import_url: 'users/import',
                    table: 'users',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'user_id',
                sortName: 'user_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'user_id', title: __('ID')},
                        {field: 'username', title: __('Username'), operate: 'LIKE'},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'tel', title: __('Tel')},
                        {field: 'cash_points', title: __('Cash_points'), operate:'BETWEEN'},
                        {field: 'bonus_points', title: __('Bonus_points'), operate:'BETWEEN'},
                        {field: 'star_level', title: __('Star_level')},
                        {field: 'stockholder', title: __('Stockholder'), searchList: {"0": __('否'), "1": __('预备股东'),"2": __('股东')}, formatter: Table.api.formatter.status},
                        {field: 'locked_points', title: __('Locked_points'), operate:'BETWEEN'},
                        {field: 'jackpot', title: __('Jackpot')},
                        {field: 'register_points', title: __('Register_points'), operate:'BETWEEN'},
                        {field: 'p_id', title: __('P_id')},
                        {field: 'status', title: __('Status'), searchList: {"0": __('未激活'), "1": __('已激活'),"2": __('空单'),"3": __('空转实')}, formatter: Table.api.formatter.status},
                        {field: 'first_charge', title: __('First_charge'), operate:'BETWEEN'},
                        {field: 'member.member_title', title: __('Member_id')},
                        {field: 'create_time', title: __('Create_time'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {
                            field: 'operate', 
                            title: __('Operate'), 
                            table: table, 
                            events: Table.api.events.operate, 
                            formatter: Table.api.formatter.operate,
                            buttons: [
                                {
                                    name: 'ajax',
                                    text: __('激活为空单'),
                                    title: __('激活为空单'),
                                    classname: 'btn btn-xs btn-success btn-magic btn-ajax',
                                    icon: 'fa fa-magic',
                                    url: 'users/activateEmptyList',
                                    confirm: '确认激活',
                                    visible:function(e){
                                        if(e.status == 0){
                                            return true;
                                        }
                                    },
                                    success: function (data, ret) {
                                        // Layer.alert(ret.msg);
                                        table.bootstrapTable('refresh');
                                        //如果需要阻止成功提示，则必须使用return false;
                                        //return false;
                                    },
                                    error: function (data, ret) {
                                        Layer.alert(ret.msg);
                                        return false;
                                    }
                                },
                            ]
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});