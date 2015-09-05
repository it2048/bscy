<div class="pageContent">
    <table class="table" width="100%" layoutH="48">
        <thead>
        <tr>
            <th width="80">预定日期</th>
            <th width="120">预定部门</th>
            <th width="80">预定人</th>
            <th width="120" align="center">会议内容</th>
            <th width="80">会议主持人</th>
            <th width="120">与会人员</th>
            <th width="80">会议时间</th>
            <th width="120">所需会议室</th>
            <th width="70">连接线</th>
            <th width="70">话筒</th>
            <th width="70">遥控器</th>
            <th width="70">编辑</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['d_time']; ?></td>
                <td><?php echo $value['d_bm']; ?></td>
                <td><?php echo $value['ydr']; ?></td>
                <td title="<?php echo $value['d_nr']; ?>"><?php echo $value['d_nr']; ?></td>
                <td><?php echo $value['d_hyr']; ?></td>
                <td title="<?php echo $value['d_cjr']; ?>"><?php echo $value['d_cjr']; ?></td>
                <td><?php echo $value['st_time']."-".$value['sp_time']; ?></td>
                <td><?php echo $hys->name; ?></td>
                <td><?php echo $value['ljx']==1?"需要":""; ?></td>
                <td><?php echo $value['ht']==1?"需要":""; ?></td>
                <td><?php echo $value['ykq']==1?"需要":""; ?></td>
                <td>                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminhys/delor',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>
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
            alertMsg.correct("删除成功，请手动刷新");
        }
    }
</script>
