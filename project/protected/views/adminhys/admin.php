<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adminhys/admin'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        日期：<input type="text" name="hys_time" size="10" class="date" dateFmt="yyyyMMdd" readonly="true" value="<?php echo $pages['hys_time']; ?>"/>
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
    <table class="table" width="960" layoutH="86">
        <thead>
        <tr>
            <th width="20">编号</th>
            <th width="60">城市</th>
            <th width="80">会议室名称</th>
            <th width="30">容纳人数</th>
            <th width="200">描述</th>
            <th width="380">预定情况(只显示已预定)</th>
            <th width="120">点击放大镜看详情</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['city']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['num']; ?></td>
                <td title="<?php echo $value['desc']; ?>"><?php echo $value['desc']; ?></td>
                <td><?php
                    if(!empty($tm[$value['id']]))
                    {
                        foreach($tm[$value['id']] as $val)
                        {
                            echo sprintf("%s-%s点, \r\n",$val['k'],$val['j']);
                        }
                    }
                    ?></td>
                <td>
                    <a title="查看预定详情" mask="true" height="500" width="720" rel="dlg_page13" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('adminhys/admind',array('id'=>$value['id'],"hysyd_time"=>$pages['hys_time'])); ?>" class="btnLook">查看预定详情</a>
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