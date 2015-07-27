<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        邮寄时间：<input type="text" name="yj_time" size="18" class="date" dateFmt="yyyy-MM" readonly="true" value="<?php echo $pages['yj_time'];?>"/>

                    </td>
                    <td>
                        <div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
                    </td>
                </tr>
                </tbody></table>
        </div>
        <input type="hidden" name="pageNum" value="<?php echo $pages['pageNum'];?>" /><!--【必须】value=1可以写死-->
        <input type="hidden" name="numPerPage" value="50" /><!--【可选】每页显示多少条-->
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a title="批量签收设置" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/pl',array("type"=>1));?>" class="add"><span>批量签收设置</span></a></li>
            <li><a title="批量离职设置" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/pl',array("type"=>2));?>" class="add"><span>批量离职设置</span></a></li>

        </ul>
    </div>
    <table class="table" width="960" layoutH="110">
        <thead>
        <tr>
            <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
            <th width="40">导入日期</th>
            <?php
            $arrt = array(1,5,7,8,9,10,11,13,14,15);
            foreach(TempList::$Contracts as $k=>$val)
            {
                if(in_array($k,$arrt))
                echo sprintf('<th width="60">%s</th>',$val);
            }
            ?>
            <th width="40">餐厅处理日期</th>
            <th width="40">餐厅处理状态</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><input name="ids" value="<?php echo $value['id']; ?>" type="checkbox"></td>
                <td><?php echo date('Y-m-d H:i:s',$value['dr_time']); ?></td>
                <?php
                $arr = explode("|",$value->desc);
                foreach($arr as $k=>$val)
                {
                    if(in_array($k+1,$arrt))
                    {
                        printf('<td title="%s">%s</td>',$val,$val);
                    }
                }
                ?>
                <td><?php echo empty($value['ct_time'])?"":date('Y-m-d H:i:s',$value['ct_time']); ?></td>
                <td><?php echo TempList::$ct_status[$value->stage]; ?></td>

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