<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminemp/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        姓名：<input type="text" name="emp_name" value="<?php echo $pages['emp_name'];?>"/>
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
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminemp/vimport'); ?>" class="add"><span>导入数据</span></a></li>
        </ul>
    </div>
    <table class="table" width="1060" layoutH="110">
        <thead>
        <tr>
            <th width="100">员工编号</th>
            <th width="100">姓名</th>
            <th width="100">餐厅编号</th>
            <th width="100">部门编号</th>
            <th width="160">身份证编号</th>
            <th width="100">职位名称</th>
            <th width="160">餐厅名称</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) { ?>
            <tr>
                <td><?php echo $value['em_id']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['hyp']; ?></td>
                <td><?php echo $value['bm_id']; ?></td>
                <td><?php echo $value['sf_id']; ?></td>
                <td><?php echo $value['zw_name']; ?></td>
                <td><?php echo $value['ct_name']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminemp/userdelete',array('id'=>$value['em_id'])); ?>" class="btnDel">删除</a>
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