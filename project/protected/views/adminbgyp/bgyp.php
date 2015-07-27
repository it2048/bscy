<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/bgyp'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        商品名称：<input type="text" id="sp_name" size="30" name="sp_name" value="<?php echo $pages['sp_name'];?>"/>
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
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/vimport'); ?>" class="add"><span>导入数据</span></a></li>
        </ul>
    </div>
    <table class="table" width="610" layoutH="110">
        <thead>
        <tr>
            <th width="90">商品编号</th>
            <th width="300">商品名称</th>
            <th width="60">单位</th>
            <th width="60">价格</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) { ?>
            <tr>
                <td><?php echo $value['sp_id']; ?></td>
                <td><?php echo $value['sp_name']; ?></td>
                <td><?php echo $value['sp_dw']; ?></td>
                <td><?php echo $value['sp_mn']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/del',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>
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
    $(function() {
        $("#sp_name").autocomplete({
            data: [<?php
           foreach ($mod as $val) {
               printf("['%s',%d],",$val->sp_name,$val->sp_id);
           }
           ?>],
            minChars: 0
        });
    });
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