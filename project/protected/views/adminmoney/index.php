<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminmoney/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        开始时间：<input type="text" id="tmstart" name="tmstart" size="8" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['tmstart'];?>"/>
                    </td>
                    <td>
                        结束时间：<input type="text" id="tmstop" name="tmstop" size="8" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['tmstop'];?>"/>
                    </td>
                    <td>
                        类型：
                        <select name="srh_service">
                            <?php
                            foreach(TempList::$service as $k=>$val)
                            {
                                $str = $k==$pages['srh_service']?"selected":"";
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
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminmoney/vimport'); ?>" class="add"><span>导入数据</span></a></li>
        </ul>
    </div>
    <table class="table" width="1060" layoutH="90">
        <thead>
        <tr>
            <th width="100">月份</th>
            <th width="200">姓名</th>
            <th width="160">成本中心编号</th>
            <th width="160">员工编号</th>
            <th width="160">工资类型</th>
            <th width="160">详细信息</th>
            <th width="160">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {
            $tal = explode("|",$value['desc']);
            $arr = $value['type']==1?TempList::$PT:TempList::$FC;

            $desc = "";
            foreach($arr as $k=>$val)
            {
                $desc .= sprintf("%s:%s \r\n",$val,$tal[$k]);
            }
            ?>
            <tr>
                <td><?php echo $value['month']; ?></td>
                <td><?php echo $value['yg_name']; ?></td>
                <td><?php echo $value['cb_id']; ?></td>
                <td><?php echo $value['yg_id']; ?></td>
                <td><?php echo TempList::$service[$value['type']]; ?></td>
                <td title="<?php echo $desc; ?>">
                    <?php echo $desc; ?>
                </td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/userdelete',array('username'=>$value['id'])); ?>" class="btnDel">删除</a>
                    <a title="编辑" target="dialog" height="500" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/useredit',array('username'=>$value['id'])); ?>" class="btnEdit">编辑</a>
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
            navTab.reload(res.mobile_game_config);  //刷新主页面
        }

    }
</script>