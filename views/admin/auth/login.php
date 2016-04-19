<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <?= Html::csrfMetaTags() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>登录</title>
    <link href="<?=Url::to('/static/admin/css/style.default.css');?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=Url::to('/static/admin/js/html5shiv.js');?>"></script>
    <script src="<?=Url::to('/static/admin/js/respond.min.js');?>"></script>
    <![endif]-->
</head>

<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="signinpanel">

        <div class="row">

            <div class="col-md-7">

                <div class="signin-info">
                    <h5><strong>用户须知</strong></h5>
                    <ul>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 请使用chrome或者火狐浏览器访问</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 请不要禁用javascript和cookie</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 长时间不用请关闭页面或退出登录</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 初次登录请及时修改密码</li>
                        <li><i class="fa fa-arrow-circle-o-right mr5"></i> 等等...</li>
                    </ul>
                </div><!-- signin0-info -->

            </div><!-- col-sm-7 -->

            <div class="col-md-5">
                <?=Html::beginForm('','post',['id'=>'form1']);?>
                    <h4 class="nomargin">用户登录</h4>
                    <p class="mt5 mb20 text-danger" id="message"></p>
                    <input type="text" class="form-control uname" name="username" placeholder="用户名" />
                    <input type="password" class="form-control pword" name="password" placeholder="密码" />
                    <button type="submit" class="btn btn-success btn-block">登 录</button>
                <?=Html::endForm();?>
            </div><!-- col-sm-5 -->

        </div><!-- row -->

        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2016. All Rights Reserved.
            </div>
            <div class="pull-right">
                Created By: <a href="http://www.woyoo.com/" target="_blank">南京沃游</a>
            </div>
        </div>

    </div><!-- signin -->

</section>

<script src="<?=Url::to('/static/admin/js/jquery-1.10.2.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/jquery-migrate-1.2.1.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/bootstrap.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/modernizr.min.js');?>"></script>
<script src="<?=Url::to('/static/admin/js/retina.min.js');?>"></script>

<script>
    jQuery(window).load(function() {
        // Page Preloader
        jQuery('#status').fadeOut();
        jQuery('#preloader').delay(350).fadeOut(function(){
            jQuery('body').delay(350).css({'overflow':'visible'});
        });
    });
    //submit form
    $("#form1").submit(function(){
        var formdata = $(this).serialize();
        var url = $(this).attr('action') || '';
        var method = $(this).attr('method') || 'get';
        $.ajax({
            url:url,
            method:method,
            dataType:'json',
            data:formdata,
            error:function(){
                alert("请求失败,请重试")
            },
            success:function(res){
                if (typeof res == 'object') {
                    if (!res.status && res.error) {
                        $("#message").html(res.error);
                    } else {
//                        console.log(res);
                        var redirect = res.redirect || '/';
                        window.location.href = redirect;
                    }
                } else {
                    alert(res);
                }
            }
        })
        return false;
    })
</script>
</body>
</html>