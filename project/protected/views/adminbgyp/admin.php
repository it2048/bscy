<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        申请月份：<input type="text" name="sq_time" size="10" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo $pages['sq_time']; ?>"/>
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
            <li><a class="icon" href="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/exp');?>" target="dwzExport" targetType="navTab" title="导出所有纪录"><span>导出所有纪录</span></a></li>
        </ul>
    </div>
    <table class="table" width="960" layoutH="110">
        <thead>
        <tr>
            <th width="40">申请部门</th>
            <th width="30">申请日期</th>
            <th width="30">所在城市</th>
            <th width="40">法人公司</th>
            <th width="30">申请人</th>
            <th width="40">商品编码</th>
            <th width="80">商品名称</th>
            <th width="20">单位</th>
            <th width="20">单价(元)</th>
            <th width="20">数量</th>
            <th width="30">金额(元)</th>
            <th width="20">部门主管</th>
            <th width="20">备注</th>
            <th width="40">操作</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['org']; ?></td>
                <td><?php echo $value['sq_time']; ?></td>
                <td><?php echo $value['city']; ?></td>
                <td><?php echo $value['company']; ?></td>
                <td><?php echo $value['sqr']; ?></td>
                <td><?php echo $value['code']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['dw']; ?></td>
                <td><?php echo $value['dj']; ?></td>
                <td><?php echo $value['cnt']; ?></td>
                <td><?php echo $value['money']; ?></td>
                <td><?php echo $value['boss']; ?></td>
                <td title="<?php echo $value['desc']; ?>"><?php echo $value['desc']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/bgdel',array('id'=>$value['id'])); ?>" class="btnDel">删除</a>

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
            navTab.reload(res.slidemanager);  //刷新主页面
        }
    }
</script>