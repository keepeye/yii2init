<?php
/**
 * index.php.
 * @author keepeye <carlton.cheng@foxmail>
 * @license http://www.opensource.org/licenses/mit-license.php MIT
 */
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');//头部附加 ?>

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
        })
        $.post('<?=Url::to(['delete']);?>',{"ids":ids.join(',')},function(res){
            if (typeof(res) != 'object') {
                alert(res);
            } else {
                if (res.status == 1) {
                    window.location.reload();
                } else {
                    alert(res.message);
                }
            }
        })
    })
</script>
<?php $this->endBlock(); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="toolbar">
            <a href="<?=Url::to('add');?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i> 新增</a>
            <div style="display: inline-block;margin-left:15px;">
                <form class="form-inline" method='get' action="">
                    <div class="form-group">
                        <input type="text" name="search[refurl]" class="form-control" value="<?=isset($_GET['search']['refurl'])?$_GET['search']['refurl']:'';?>" placeholder="请输入关键词">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
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
                    <th>修改 删除</th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <button class="btn btn-primary btn-sm" id="batchDel">批量删除</button>
    </div>
</div>
