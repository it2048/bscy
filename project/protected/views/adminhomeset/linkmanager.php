<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminhomeset/linkmanager'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" mask="true" height="340" width="600" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminhomeset/linkadd');?>"><span>添加链接</span></a></li>
        </ul>
    </div>
    <table class="table" width="960" layoutH="76">
        <thead>
        <tr>
            <th width="20">编号</th>
            <th width="60">标题</th>
            <th width="20">图片</th>
            <th width="20">跳转</th>
            <th width="60">添加时间</th>
            <th width="60">添加人</th>
            <th width="40">类型</th>
            <th width="40">编辑</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td title="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></td>
                <td><a href="<?php echo $value['img_url']; ?>" class="btnView" target="_blank">图片查看</a></td>
                <td><a href="<?php echo $value['link_url']; ?>" class="btnView" target="_blank">地址查看</a></td>
                <td><?php echo date("Y-m-d H:i:s", $value['add_time']); ?></td>
                <td><?php echo $value['add_user']; ?></td>
                <td><?php echo $value['type']==0?"游戏专区":"合作媒体"; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminhomeset/linkdel',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>
                    <a title="编辑" mask="true" height="340" width="620" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminhomeset/linkedit',array('id'=>$value['id'])); ?>" class="btnEdit">编辑</a>
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
            navTab.reload(res.linkmanager);  //刷新主页面
        }
    }
</script>