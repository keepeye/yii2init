<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>后台管理</title>
    <link href="<?=Url::to('/static/admin/css/style.default.css');?>" rel="stylesheet">
    <link href="<?=Url::to('/static/admin/css/custom.css');?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=Url::to('/static/admin/js/html5shiv.js');?>"></script>
    <script src="<?=Url::to('/static/admin/js/respond.min.js');?>"></script>
    <![endif]-->
    <?php if (isset($this->blocks['header'])): ?>
        <?= $this->blocks['header'] ?>
    <?php endif; ?>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- 页面加载中 -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>
<section>

    <div class="leftpanel">

        <div class="logopanel">
            <h1><span>[</span> 后台管理 <span>]</span></h1>
        </div><!-- LOGO -->

        <div class="leftpanelinner">
            <h5 class="sidebartitle">导航</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li><a href="<?=Url::toRoute('/admin/index');?>"><i class="fa fa-home"></i> <span>后台首页</span></a></li>
                <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>系统用户</span></a>
                    <ul class="children">
                        <li><a href="<?=Url::to(['/admin/administrators']);?>"><i class="fa fa-caret-right"></i> 用户列表</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>其他菜单</span></a>
                    <ul class="children">
                        <li><a href="#"><i class="fa fa-caret-right"></i> 子菜单1</a></li>
                        <li><a href="#"><span class="pull-right badge badge-info">new</span><i class="fa fa-caret-right"></i> 子菜单2</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- 左侧菜单 -->
    </div><!-- 左侧panel -->

    <div class="mainpanel">
        <div class="headerbar">
            <a class="menutoggle"><i class="fa fa-bars"></i></a>
            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="padding:14px 10px;">
                                管理员
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="<?=Url::to(['admin/profile-settings/password']);?>"><i class="glyphicon glyphicon-cog"></i> 帐号设置</a></li>
                                <li><a href="<?=Url::toRoute(['admin/auth/logout']);?>"><i class="glyphicon glyphicon-log-out"></i> 注销</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- 头部右侧 -->

        </div><!-- 头部 -->
        <div class="contentpanel">
            <?= $content ?>
        </div>
    </div><!-- 主面板 -->
</section>

<script src="<?=Url::to('/static/admin/js/jquery-1.10.2.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/jquery-migrate-1.2.1.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/bootstrap.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/modernizr.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/jquery.sparkline.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/toggles.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/retina.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/jquery.cookies.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/custom.js');?>"></script>

<?php if (isset($this->blocks['footer'])): ?>
    <?= $this->blocks['footer'] ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>