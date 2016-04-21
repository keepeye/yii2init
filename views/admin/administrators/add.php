<?php
/**
 * add.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader">
    <h2><i class="fa fa-home"></i> 系统用户管理 <span>添加用户</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $("#_form1").ajaxForm({
        dataType:'json',
        success:function(res){
            if (typeof res == 'object') {
                if (!res.status) {
                    alert(res.message || '表单提交失败,返回数据格式错误')
                } else {
                    alert('添加成功');
                    location.reload();
                }
            } else {
                alert(res);
            }
        }
    })
</script>
<?php $this->endBlock(); ?>

<div class="panel panel-default">
    <?=Html::beginForm('','post',['class'=>'form-horizontal form-bordered','id'=>'_form1']);?>
    <div class="panel-body">
        <div class="form-group">
            <label class="col-sm-3 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="text" name="username" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">密码</label>
            <div class="col-sm-6">
                <input type="text" name="password" class="form-control" required value="000000">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">姓名</label>
            <div class="col-sm-6">
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">邮箱</label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">电话</label>
            <div class="col-sm-6">
                <input type="text" name="phone" class="form-control">
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
    <?=Html::endForm();?>
</div>