<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincol/admin'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        选择开始月份：<input type="text" name="scol_time" size="8" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['scol_time'];?>"/>
                    </td>
                    <td>
                        选择结束月份：<input type="text" name="pcol_time" size="8" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['pcol_time'];?>"/>
                    </td>
                    <td>
                        类型：
                        <select name="col_type">
                            <?php
                            foreach(TempList::$col as $k=>$val)
                            {
                                $str = $k==$pages['col_type']?"selected":"";
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
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincol/vimport'); ?>" class="add"><span>导入数据</span></a></li>
            <li><a title="导入异常工时" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincol/yc'); ?>" class="add"><span>导入异常工时</span></a></li>

        </ul>
    </div>
    <table class="table" width="2060" layoutH="110">
        <thead>
        <tr>
            <th width="100">月份</th>
            <th width="100">AM</th>
            <th width="100">DM</th>
            <th width="100">餐厅编号</th>
            <th width="100">餐厅名</th>
            <?php

            foreach($head as $k=>$val)
            {
                if($k==="min")continue;
                if($k==="max")continue;
                echo sprintf('<th width="100">%s</th>',$val);
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) { ?>
            <tr>
                <td><?php echo $value['month']; ?></td>
                <td><?php echo $value['am']; ?></td>
                <td><?php echo $value['dm']; ?></td>
                <td><?php echo $value['ct_id']; ?></td>
                <td><?php echo $value['ct_name']; ?></td>
                <?php
                $mkl = explode("|!|",$value->desc);
                if(isset($head['min']))
                {
                    if(empty($head['max']))
                        $mkl = array_slice($mkl,$head['min']);
                    else
                        $mkl = array_slice($mkl,$head['min'],$head['max']);
                    foreach($mkl as $bl)
                    {
                        echo sprintf('<td>%s</td>',$bl);
                    }
                }else
                {
                    foreach($mkl as $k=>$bl)
                    {
                        if($k<4)continue;
                        echo sprintf('<td>%s</td>',$bl);
                    }
                }
                ?>
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
            navTab.reload(res.mobile_game_config);  //刷新主页面
        }

    }
</script>