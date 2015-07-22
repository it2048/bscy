<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminart/index'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" mask="true" height="520" width="750" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminart/add');?>"><span>添加文章</span></a></li>
        </ul>
    </div>
    <table class="table" width="960" layoutH="76">
        <thead>
        <tr>
            <th width="40">编号</th>
            <th width="190">标题</th>
            <th width="540">内容</th>
            <th width="40">链接</th>
            <th width="80">编辑</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['title']; ?></td>
                <td title="<?php echo strip_tags($value['desc']); ?>"><?php echo trim(mb_substr(strip_tags($value['desc']),0,50,"utf-8"));?></td>
                <td><a href="<?php echo Yii::app()->createAbsoluteUrl('home/index',array('id'=>$value['id'])); ?>" class="btnView" target="_blank">文章查看</a></td>
                <td>
                    <a title="编辑" mask="true" height="520" width="750" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminart/edit',array('id'=>$value['id'])); ?>" class="btnEdit">编辑</a>
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