<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincol/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        选择月份：<input type="text" name="col_time" size="18" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['col_time'];?>"/>
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
        </ul>
    </div>
    <table class="table" width="2060" layoutH="110">
        <thead>
        <tr>
            <th width="100">餐厅名称</th>
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