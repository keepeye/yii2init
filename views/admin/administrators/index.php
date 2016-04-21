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
    <h2><i class="fa fa-home"></i> 系统用户管理 <span>用户列表</span></h2>
</div>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('footer');//尾部附加 ?>
<script>
    //全选
    $("#selectAll").click(function(){
        $("input[name='ids[]']").prop('checked',$(this).prop('checked'));
    });
    //批量删除
    $("#batchDel").click(function(){
        var ids = [];
        $("input[name='ids[]']:checked").each(function(){
            ids.push($(this).val());
        });
        if (!window.confirm('确定要删除id为['+ids+']的这些用户吗?')) {
            return false;
        }
        $.ajax({
            url: '<?=Url::to(['delete']);?>',
            dataType: 'json',
            data: {"ids": ids.join(',')},
            error: function (res) {
                alert('发送请求失败,请重试');
            },
            success: function (res) {
                if (typeof(res) != 'object') {
                    alert(res);
                } else {
                    if (res.status == 1) {
                        window.location.reload();
                    } else {
                        alert(res.message || '删除失败');
                    }
                }
            }
        })
    })
</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?=Url::to(['add']);?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> 新增</a>
            <div style="display: inline-block;margin-left:15px;">
                <?=Html::beginForm('','get',['class'=>'form-inline']);?>
                <div class="form-group">
                    <input type="text" class="form-control" name="search[username]" value="<?=\yii\helpers\ArrayHelper::getValue(Yii::$app->request->queryParams,'search.username');?>" placeholder="请输入用户名">
                </div>
                <button type="submit" class="btn btn-primary">搜 索</button>
                <?=Html::endForm();?>
            </div>
        </div>
        <h4>系统用户列表</h4>
    </div>
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>uid</th>
                <th>用户名</th>
                <th>姓名</th>
                <th>email</th>
                <th>电话</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($list as $item): ?>
                <tr>
                    <th><input type="checkbox" name="ids[]" value="<?=$item->id;?>"></th>
                    <th><?=$item->id;?></th>
                    <th><?=$item->username;?></th>
                    <th><?=$item->name;?></th>
                    <th><?=$item->email;?></th>
                    <th><?=$item->phone;?></th>
                    <th><?=$item->created_at;?></th>
                    <th>
                    <td class="table-action">
                        <a href="<?=Url::to(['edit','id'=>$item->id]);?>"><i class="fa fa-pencil"></i></a>
                        <a href="<?=Url::to(['delete','ids'=>$item->id]);?>" onclick="return confirm('确定删除?')"><i class="fa fa-trash-o"></i></a>
                    </td>
                    </th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div>
            <?=\yii\widgets\LinkPager::widget(['pagination' => $pages]);?>
        </div>
        <button class="btn btn-primary btn-sm" id="batchDel">批量删除</button>
    </div>
</div>
