<form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminwj/index'); ?>" method="post">
    <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
    <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
</form>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a title="批量资料审核通过" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sh',array("stage"=>1));?>" class="delete"><span>资料审核通过</span></a></li>
            <li><a title="DM/AM审核通过，进入盖章流程" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sh',array("stage"=>2));?>" class="edit"><span>DM/AM审核通过，进入盖章流程</span></a></li>
            <li><a title="协议已邮寄/交给助理" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sh',array("stage"=>3));?>" class="add"><span>协议已邮寄/交给助理</span></a></li>
            <li><a title="收到返寄，结案" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sh',array("stage"=>4));?>" class="delete"><span>收到返寄，结案</span></a></li>
            <li class="line">line</li>
            <li><a class="icon" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/exp');?>" target="dwzExport" targetType="navTab" title="导出所有违纪纪录"><span>导出所有违纪纪录</span></a></li>

        </ul>
    </div>
    <table class="table" width="1160" layoutH="76">
        <thead>
        <tr>
            <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
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
            <th width="120">特殊期员工</th>

            <th width="100">补充证据</th>
            <th width="60">提交日期</th>
            <th width="60">生效日期</th>
            <th width="100">目前进度</th>
            <th width="60">违纪时间</th>
            <th width="100">处理HR邮箱</th>

            <th width="220">编辑</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><input name="ids" value="<?php echo $value['id']; ?>" type="checkbox"></td>
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
                <td title="<?php echo $value['wj_yf']; ?>"><?php echo $value['wj_yf']; ?></td>

                <td title="<?php echo $value['wj_jl']; ?>"><?php echo $value['wj_jl']; ?></td>
                <td title="<?php echo $value['fj']; ?>"><?php echo $value['fj']; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$value['tj_time']); ?></td>
                <td><?php echo empty($value['sx_time'])?"":date("Y-m-d H:i:s",$value['sx_time']); ?></td>
                <td title="<?php echo $value['stage']; ?>"><?php echo $value['stage']; ?></td>
                <td><?php echo empty($value['wj_time'])?"":date("Y-m-d H:i:s",$value['wj_time']); ?></td>
                <td><?php echo $value['tz_email']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/del',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>
                    <a title="编辑" mask="true" height="400" width="620" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/edit',array('id'=>$value['id'])); ?>" class="btnEdit">编辑</a>
                    <a title="添加生效日期" mask="true" height="300" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sx',array('id'=>$value['id'])); ?>" class="btnAdd">添加生效日期</a>
                    <a title="添加处理人" mask="true" height="300" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminorder/clr',array('id'=>$value['id'])); ?>" class="btnAssign">添加处理人</a>

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
            navTab.reload(res.orderadmin);  //刷新主页面
        }
    }

    function updateAuCall(res)
    {
        if(res.code!=0)
            alertMsg.error(res.msg);
        else
        {
            navTab.reload(res.orderadmin);  //刷新主页面
        }
    }
</script>