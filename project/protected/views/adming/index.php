<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('adming/index'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        餐厅编号：<input type="text" id="sno" size="30" name="sno" value="<?php echo $pages['sno'];?>"/>
                    </td>
                    <td>
                        工作站类型：
                        <select name="scate">
                            <option value="0">所有</option>
                            <?php
                            foreach(TempList::$arena as $k=>$val)
                            {
                                $str = $k==$pages['scate']?"selected":"";
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
    <table class="table" width="960" layoutH="86">
        <thead>
        <tr>
            <th width="20">编号</th>
            <th width="40">餐厅编号</th>
            <th width="60">参赛人姓名</th>
            <th width="100">工作站</th>
            <th width="60">图片地址</th>
            <th width="80">描述</th>
            <th width="60">餐厅名</th>
            <th width="60">时间</th>
            <th width="40">是否分享</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['sno']; ?></td>
                <td><?php echo $value['sname']; ?></td>
                <td><?php echo TempList::$arena[$value['scate']]; ?></td>
                <td>
                    <?php if(!empty($value['simg'])){ ?>
<a title="查看" target="_blank" href="<?='http://yumzhaopin.cn/bscy/project/public/'.$value['simg'] ?>" class="btnView">查看</a>

                    <?php }?></td>
                <td title="<?php echo $value['sdesc']; ?>"><?php echo $value['sdesc']; ?></td>
                <td><?php echo $value['ctname']; ?></td>
                <td><?php echo date('Y-m-d H:i:s',$value['addtime']); ?></td>
                <td><?php echo $value['publish']==1?'已分享':'未分享'; ?></td>
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