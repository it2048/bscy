<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminwj/index'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" mask="true" height="500" width="700" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/add');?>"><span>添加违纪</span></a></li>
        </ul>
    </div>
    <table class="table" width="1060" layoutH="76">
        <thead>
        <tr>
            <th width="20">员工编号</th>
            <th width="60">员工姓名</th>
            <th width="60">员工身份</th>
            <th width="60">职务</th>
            <th width="60">店号</th>
            <th width="60">餐厅</th>
            <th width="60">区经理</th>
            <th width="60">区域经理</th>
            <th width="60">违纪类型</th>
            <th width="60">违纪条款</th>
            <th width="120">违纪事件</th>
            <th width="120">违纪结论</th>
            <th width="100">补充证据</th>
            <th width="60">提交日期</th>
            <th width="60">生效日期</th>
            <th width="100">目前进度</th>
            <th width="60">违纪时间</th>
            <th width="100">处理HR邮箱</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['emp_id']; ?></td>
                <td><?php echo $value['yg_name']; ?></td>
                <td><?php echo TempList::$sf[$value['type']]; ?></td>
                <td><?php echo $value['yg_zw']; ?></td>
                <td><?php echo $value['ct_no']; ?></td>
                <td><?php echo $value['yg_ct']; ?></td>
                <td><?php echo $value['q_jl']; ?></td>
                <td><?php echo $value['qy_jl']; ?></td>
                <td title="<?php echo $value['wj_lx']; ?>"><?php echo $value['wj_lx']; ?></td>
                <td title="<?php echo $value['wj_tk']; ?>"><?php echo $value['wj_tk']; ?></td>
                <td title="<?php echo $value['wj_sj']; ?>"><?php echo $value['wj_sj']; ?></td>
                <td title="<?php echo $value['wj_jl']; ?>"><?php echo $value['wj_jl']; ?></td>
                <td title="<?php echo $value['fj']; ?>"><?php echo $value['fj']; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$value['tj_time']); ?></td>
                <td><?php echo empty($value['sx_time'])?"":date("Y-m-d H:i:s",$value['sx_time']); ?></td>
                <td title="<?php echo $value['stage']; ?>"><?php echo $value['stage']; ?></td>
                <td><?php echo empty($value['wj_time'])?"":date("Y-m-d H:i:s",$value['wj_time']); ?></td>
                <td><?php echo $value['tz_email']; ?></td>
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