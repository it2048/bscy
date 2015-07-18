<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admincontent/userupdate'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>用户名：</label>
                <input readonly="true"  name="username" type="text" class="textInput readonly" size="30" value="<?php echo $models->username;?>">
            </p>
            <p>
                <label>密码：</label>
                <input type="password" id="cp_password" name="password" size="30" minlength="6" maxlength="20" class="alphanumeric textInput valid">
            </p>
            <p>
                <label>确认密码：</label>
                <input type="password" id="rePassword" name="rePassword" size="30" equalto="#cp_password" class="alphanumeric textInput error">
            </p>
            <p>
                <label>联系电话：</label>
                <input  name="tel" type="text" class="textInput" size="30" value="<?php echo $models->tel;?>">
            </p>
            <p>
                <label>类型：</label>
                <select name="type">
                    <?php
                    foreach(TempList::$Type as $k=>$val)
                    {
                        $str = $models->type==$k?"selected":"";
                        echo printf('<option value="%s" %s>%s</option>',$k,$str,$val);
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>姓名：</label>
                <input  name="name" type="text" class="textInput" size="30" value="<?php echo $models->name;?>">
            </p>
            <p>
                <label>部门名称：</label>
                <input  name="dep_name" type="text" class="textInput" size="30" value="<?php echo $models->dep_name;?>">
            </p>
            <p>
                <label>餐厅名称：</label>
                <input  name="ct_name" type="text" class="textInput" size="30" value="<?php echo $models->ct_name;?>">
            </p>
            <p>
                <label>店号：</label>
                <input  name="dh_name" type="text" class="textInput" size="30" value="<?php echo $models->dh_name;?>">
            </p>
            <p>
                <label>餐厅经理：</label>
                <input  name="ct_boss" type="text" class="textInput" size="30" value="<?php echo $models->ct_boss;?>">
            </p>
            <p>
                <label>详细信息：</label>
                <textarea name="desc" cols="30" rows="6" class="textInput"><?php echo $models->desc;?></textarea>
            </p>
        </div>
        <div class="formBar">
            <ul>
                <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>
<script type="text/javascript">
    /**
     * 回调函数
     */
    function viData(json) {
        if(json.code!=0)
        {
            alertMsg.error(json.msg); //返回错误
        }
        else
        {
            alertMsg.correct("更新成功"); //返回错误
            navTab.reload(json.usermaneger);  //刷新主页面
            $.pdialog.closeCurrent();  //
        }
    }

</script>