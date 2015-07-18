<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminwj/update'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>违纪类型：</label>
                <input  name="wj_type" type="text" class="textInput required" size="50" value="<?php echo $models->wx_type;?>">
                <input  name="id" type="hidden" value="<?php echo $models->id;?>">
            </p>
            <p class="nowrap">
                <label>违纪条款：</label>
                <input  name="wj_tk" type="text" class="textInput required" size="50" value="<?php echo $models->wj_tk;?>">
            </p>
            <p class="nowrap">
                <label>违纪案例：</label>
                <input  name="wj_al" type="text" class="textInput" size="50" value="<?php echo $models->wj_al;?>">
            </p>
            <p class="nowrap">
                <label>违纪证据（一行一条）：</label>
                <textarea name="wj_zl" cols="50" rows="9"><?php echo $models->wj_zj;?></textarea>
            </p>

        </div>
        <div class="formBar">
            <ul>
                <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">更新</button></div></div></li>
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
            navTab.reload(json.slidemanager);  //刷新主页面
            $.pdialog.closeCurrent();  //
        }
    }

</script>