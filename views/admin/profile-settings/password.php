<?php
use yii\helpers\Html;

?>
<?php $this->beginBlock('header');//头部附加 ?>

<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    $("#password_form").submit(function () {
        var formdata = $(this).serialize();
        var url = $(this).attr('action') || '';
        var method = $(this).attr('method') || 'get';
        $.ajax({
            url: url,
            method: method,
            dataType: 'json',
            data: formdata,
            error: function () {
                alert("请求失败，请重试")
            },
            success: function (res) {
                if (typeof res == 'object') {
                    if (!res.status) {
                        alert(res.message);
                    } else {
                        alert('修改成功');
                        location.reload();
                    }
                } else {
                    alert(res);
                }
            }
        })
        return false;
    })
</script>
<?php $this->endBlock(); ?>

<div class="panel panel-default">
    <?= Html::beginForm('', 'post', ['class' => 'form-horizontal form-bordered', 'id' => 'password_form']); ?>
    <div class="panel-heading">
        <h4 class="panel-title">修改密码</h4>

        <p>在这里可以修改你的登录密码</p>
    </div>
    <div class="panel-body panel-body-nopadding">
        <div class="form-group">
            <label class="col-sm-3 control-label">原密码</label>

            <div class="col-sm-6">
                <input type="text" name="oldpassword" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">新密码</label>

            <div class="col-sm-6">
                <input type="text" name="password" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">重复新密码</label>

            <div class="col-sm-6">
                <input type="text" name="repeat-password" class="form-control" required>
            </div>
        </div>

    </div>
    <!-- panel-body -->
    <div class="panel-footer">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <button class="btn btn-primary">提交</button>
            </div>
        </div>
    </div>
    <!-- panel-footer -->
    <?= Html::endForm(); ?>
</div><!-- panel -->