<div class="pageHeader">
    <form id="pagerForm" onsubmit="return navTabSearch(this);" action="<?php echo Yii::app()->createAbsoluteUrl('admincontent/usermanager'); ?>" method="post">
        <div class="searchBar">
            <table class="searchContent">
                <tbody><tr>
                    <td>
                        姓名：<input type="text" name="srh_name" class="textInput" value="<?php echo $pages['srh_name'];?>">
                    </td>
                    <td>
                        部门：<input type="text" name="srh_dep_name" class="textInput" value="<?php echo $pages['srh_dep_name'];?>">
                    </td>
                    <td>
                        类型：
                        <select name="srh_type">
                            <?php
                            foreach(TempList::$Type as $k=>$val)
                            {
                                $str = $k==$pages['srh_type']?"selected":"";
                                if($k!=0)
                                    echo sprintf('<option value="%s" %s>%s</option>',$k,$str,$val);
                                else
                                    echo "<option value='0' {$str}>所有</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        电话：<input type="text" name="srh_tel" class="textInput" value="<?php echo $pages['srh_tel'];?>">
                    </td>
                    <td>
                        店号：<input type="text" name="srh_dh_name" class="textInput" value="<?php echo $pages['srh_dh_name'];?>">
                    </td>
                    <td>
                        餐厅：<input type="text" name="srh_ct_name" class="textInput" value="<?php echo $pages['srh_ct_name'];?>">
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
            <li><a class="add" height="500" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/useradd');?>"><span>添加</span></a></li>
            <li><a title="导入数据" mask="true" height="200" target="dialog" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/vimport'); ?>" class="add"><span>导入数据</span></a></li>
            <li>
                <a title="确实要删除所有办公室记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/del',array('type'=>1)); ?>" class="delete"><span>删除办公室数据</span></a>
            </li>
            <li>
                <a title="确实要删除所有餐厅记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/del',array('type'=>2)); ?>" class="delete"><span>删除餐厅数据</span></a>
            </li>
            <li>
                <a title="确实要删除所有消配中心记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/del',array('type'=>3)); ?>" class="delete"><span>删除消配中心数据</span></a>
            </li>

        </ul>
    </div>
    <table class="table" width="1060" layoutH="138">
        <thead>
        <tr>
            <th width="100">用户名</th>
            <th width="200">电话</th>
            <th width="200">姓名</th>
            <th width="160">部门</th>
            <th width="160">店号</th>
            <th width="160">类型</th>
            <th width="160">餐厅名称</th>
            <th width="160">餐厅经理</th>
            <th width="160">详细信息</th>
            <th width="160">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($models as $value) {?>
            <tr>
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['tel']; ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['dep_name']; ?></td>
                <td><?php echo $value['dh_name']; ?></td>
                <td><?php echo TempList::$Type[$value['type']]; ?></td>
                <td><?php echo $value['ct_name']; ?></td>
                <td><?php echo $value['ct_boss']; ?></td>
                <td title="<?php echo $value['desc']; ?>"><?php echo $value['desc']; ?></td>
                <td>
                    <a title="确实要删除这条记录吗?" callback="deleteAuCall" target="ajaxTodo" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/userdelete',array('username'=>$value['username'])); ?>" class="btnDel">删除</a>
                    <a title="编辑" target="dialog" height="500" href="<?php echo Yii::app()->createAbsoluteUrl('admincontent/useredit',array('username'=>$value['username'])); ?>" class="btnEdit">编辑</a>
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