<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/admin'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        餐厅处理状态：
                        <select name="slt">
                            <?php
                            foreach(TempList::$ct_status as $k=>$val)
                            {
                                $str = $k==$pages['slt']?'selected="selected"':"";
                                echo sprintf('<option value="%s" %s>%s</option>',$k,$str,$val);
                            }
                            ?>
                        </select>
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
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/vimport'); ?>" class="add"><span>导入数据</span></a></li>
            <li><a title="发送邮件告知餐厅已邮寄" target="selectedTodo" callback="updateAuCall" rel="ids" postType="string" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/sh');?>" class="add"><span>批量发送邮件告知餐厅已邮寄</span></a></li>
            <li><a class="icon" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/exp');?>" target="dwzExport" targetType="navTab" title="导出所有纪录"><span>导出所有纪录</span></a></li>
            <li class="line">line</li>
            <li><a title="导入餐厅人事基本数据表" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/drdeal'); ?>" class="delete"><span>导入餐厅人事基本数据表</span></a></li>
            <li><a class="icon" href="<?php echo Yii::app()->createAbsoluteUrl('admincontracts/exptp');?>" target="dwzExport" targetType="navTab" title="导出续签人员信息"><span>导出续签人员信息</span></a></li>

        </ul>
    </div>
    <table class="table" width="960" layoutH="112">
        <thead>
        <tr>
            <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
            <th width="40">导入日期</th>
            <?php
            foreach(TempList::$Contracts as $val)
            {
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
                <td><?php echo $value['bm_id']; ?></td>
                <?php
                    $arr = explode("|",$value->desc);
                    foreach($arr as $val)
                    {
                        printf('<td title="%s">%s</td>',$val,$val);
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