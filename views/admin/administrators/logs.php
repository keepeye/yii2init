<?php
/**
 * index.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php $this->beginBlock('breadcrumb');//面包屑导航 ?>
<div class="pageheader">
    <h2><i class="fa fa-home"></i> 系统用户管理 <span>登录日志</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>

</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-body">
        <?=Html::beginForm('','get',['class'=>'form-inline']);?>
            <div class="form-group">
                <input type="text" class="form-control" name="search[username]" value="<?=\yii\helpers\ArrayHelper::getValue(Yii::$app->request->queryParams,'search.username');?>" placeholder="请输入用户名">
            </div>
            <button type="submit" class="btn btn-primary">搜 索</button>
        <?=Html::endForm();?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>动作</th>
                <th>uid</th>
                <th>用户名</th>
                <th>ip</th>
                <th>时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $item): ?>
                <tr>
                    <th><?=$item->type;?></th>
                    <th><?=$item->uid;?></th>
                    <th><?=$item->username;?></th>
                    <th><?=$item->ip;?></th>
                    <th><?=$item->created_at;?></th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div>
            <?=\yii\widgets\LinkPager::widget(['pagination' => $pages]);?>
        </div>
    </div>
</div>
