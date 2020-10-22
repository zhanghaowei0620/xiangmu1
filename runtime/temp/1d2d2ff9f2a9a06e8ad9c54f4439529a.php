<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"D:\phpstudy_pro\WWW\xiangmu1\public/../application/admin\view\users\edit.html";i:1603090776;s:71:"D:\phpstudy_pro\WWW\xiangmu1\application\admin\view\layout\default.html";i:1602833989;s:68:"D:\phpstudy_pro\WWW\xiangmu1\application\admin\view\common\meta.html";i:1602833989;s:70:"D:\phpstudy_pro\WWW\xiangmu1\application\admin\view\common\script.html";i:1602833989;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">
<meta name="referrer" content="never">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<?php if(\think\Config::get('fastadmin.adminskin')): ?>
<link href="/assets/css/skins/<?php echo \think\Config::get('fastadmin.adminskin'); ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">
<?php endif; ?>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>

    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !\think\Config::get('fastadmin.multiplenav') && \think\Config::get('fastadmin.breadcrumb')): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <?php if($auth->check('dashboard')): ?>
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                    <?php endif; ?>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Username'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-username" data-rule="required" class="form-control" name="row[username]" type="text" value="<?php echo htmlentities($row['username']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Password'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-password" data-rule="required" class="form-control" name="row[password]" type="text" value="<?php echo htmlentities($row['password']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Create_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-create_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[create_time]" type="text" value="<?php echo $row['create_time']?datetime($row['create_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Update_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-update_time" data-rule="required" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[update_time]" type="text" value="<?php echo $row['update_time']?datetime($row['update_time']):''; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cash_points'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-cash_points" data-rule="required" class="form-control" step="0.01" name="row[cash_points]" type="number" value="<?php echo htmlentities($row['cash_points']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bonus_points'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-bonus_points" class="form-control" step="0.01" name="row[bonus_points]" type="number" value="<?php echo htmlentities($row['bonus_points']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Star_level'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-star_level" class="form-control" name="row[star_level]" type="number" value="<?php echo htmlentities($row['star_level']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Stockholder'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-stockholder" class="form-control" name="row[stockholder]" type="number" value="<?php echo htmlentities($row['stockholder']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Locked_points'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-locked_points" class="form-control" step="0.01" name="row[locked_points]" type="number" value="<?php echo htmlentities($row['locked_points']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Jackpot'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-jackpot" class="form-control" name="row[jackpot]" type="number" value="<?php echo htmlentities($row['jackpot']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Register_points'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-register_points" class="form-control" step="0.01" name="row[register_points]" type="number" value="<?php echo htmlentities($row['register_points']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('P_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-p_id" data-rule="required" data-source="p/index" class="form-control selectpage" name="row[p_id]" type="text" value="<?php echo htmlentities($row['p_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-status" data-rule="required" class="form-control" name="row[status]" type="number" value="<?php echo htmlentities($row['status']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('First_charge'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-first_charge" class="form-control" step="0.01" name="row[first_charge]" type="number" value="<?php echo htmlentities($row['first_charge']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Member_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-member_id" data-rule="required" data-source="member/index" class="form-control selectpage" name="row[member_id]" type="text" value="<?php echo htmlentities($row['member_id']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Tel'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-tel" class="form-control" name="row[tel]" type="number" value="<?php echo htmlentities($row['tel']); ?>">
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>
