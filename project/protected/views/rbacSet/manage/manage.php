<form id="pagerForm" action="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/authmanage'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="25" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
	<div class="panelBar">
		<ul class="toolBar">
			<li><a class="add" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/authadd');?>"><span>添加</span></a></li>
			<li><a class="add" target="navTab" rel="batch_navtab" href="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/authlist');?>"><span>批量操作</span></a></li>
		</ul>
	</div>
	<table class="table" width="900" layoutH="76">
		<thead>
			<tr>
				<th width="600">名称</th>
				<th width="230">属性</th>
				<th width="70">操作</th>
			</tr>
		</thead>
		<tbody>
            <?php foreach ($models as $value) {?>
			<tr id="<?php echo $value['name']; ?>">
				<td><?php echo $value['name']; ?></td>
				<td><?php echo AppAuthitem::$TYPES[$value['type']]; ?></td>
				<td>
					<a title="确实要删除这些记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AuthDelete',array('name'=>urlencode($value['name']))); ?>" class="btnDel">删除</a>
					<a title="编辑" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/authedit',array('name'=>urlencode($value['name']))); ?>" class="btnEdit">编辑</a>
				</td>
			</tr>
            <?php }?>
		</tbody>
	</table>
	<div class="panelBar">
            <div class="pages">
                <span>共<?php echo $pages['countPage'];?>条</span>
            </div>        
        <div class="pagination" targetType="navTab" totalCount="<?php echo $pages['countPage'];?>" numPerPage="30" pageNumShown="10" currentPage="<?php echo $pages['pageNum'];?>"></div>
	</div>
</div>
<script type="text/javascript">
function deleteAuCall(res)
{
    if(res['code']!=0)
        alert("删除失败");
    else
        $('#'+res['name']).remove();
}
</script>