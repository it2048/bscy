<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminwj/index'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" mask="true" height="400" width="600" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminwj/add');?>"><span>添加违纪</span></a></li>
        </ul>
    </div>
    <table class="table" width="960" layoutH="76">
        <thead>
        <tr>
            <th width="20">编号</th>
            <th width="120">违纪类型</th>
            <th width="120">违纪条款</th>
            <th width="160">违纪案例</th>
            <th width="200">违纪证据</th>
            <th width="40">编辑</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['wx_type']; ?></td>
                <td><?php echo $value['wj_tk']; ?></td>
                <td><?php echo $value['wj_al']; ?></td>
                <td title="<?php echo $value['wj_zj']; ?>"><?php echo $value['wj_zj']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminwj/del',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>
                    <a title="编辑" mask="true" height="400" width="620" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminwj/edit',array('id'=>$value['id'])); ?>" class="btnEdit">编辑</a>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>共<?php echo $pages['countPage'];?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $pages['countPage'];?>" numPerPage="<?php echo $pages['numPerPage'];?>" pageNumShown="10" currentPage="<?php echo $pages['pageNum'];?>"></div>
    </div>
</div>
<script type="text/javascript">
    function deleteAuCall(res)
    {
        if(res.code!=0)
            alertMsg.error("删除失败");
        else
        {
            navTab.reload(res.slidemanager);  //刷新主页面
        }
    }
</script>