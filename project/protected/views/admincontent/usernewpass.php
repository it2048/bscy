<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admincontent/usernewsave'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>旧密码：</label>
                <input type="password" id="old_password" name="oldpassword" size="30" minlength="4" maxlength="20" class="required alphanumeric textInput valid">
            </p>
            <p>
                <label>密码：</label>
                <input type="password" id="cp_password" name="password" size="30" minlength="4" maxlength="20" class="required alphanumeric textInput valid">
            </p>
            <p>
                <label>确认密码：</label>
                <input type="password" id="rePassword" name="rePassword" size="30" equalto="#cp_password" class="required alphanumeric textInput error">
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
            alertMsg.correct(json.msg); //返回错误
            $.pdialog.closeCurrent();  //
        }
    }

</script>