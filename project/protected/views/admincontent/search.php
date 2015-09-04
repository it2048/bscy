<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincontent/search'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        姓名：<input type="text" name="srh_name" class="textInput" value="<?php echo $pages['srh_name'];?>">
                    </td>
                    <td>
                        电话：<input type="text" name="srh_tel" class="textInput" value="<?php echo $pages['srh_tel'];?>">
                    </td>
                    <td>
                        用户名：<input type="text" name="srh_email" class="textInput" value="<?php echo $pages['srh_email'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        店号：<input type="text" name="srh_dh_name" class="textInput" value="<?php echo $pages['srh_dh_name'];?>">
                    </td>
                    <td>
                        餐厅名称：<input type="text" name="srh_ct_name" class="textInput" value="<?php echo $pages['srh_ct_name'];?>">
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
    <table class="table" width="1060" layoutH="108">
        <thead>
        <tr>
            <th width="80">邮箱名/店号</th>
            <th width="160">电话</th>
            <th width="60">姓名/餐厅经理</th>
            <th width="140">工作地点</th>
            <th width="80">类型</th>
            <th width="80">餐厅名称</th>
            <th width="320">详细信息</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['tel']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['dep_name']; ?></td>
                <td><?php echo TempList::$Type[$value['type']]; ?></td>
                <td><?php echo $value['ct_name']; ?></td>
                <td title="<?php echo $value['desc']; ?>"><?php echo $value['desc']; ?></td>
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