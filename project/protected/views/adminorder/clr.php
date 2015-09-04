<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminorder/sxsave'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>员工编号：</label>
                <input  name="wj_bh" type="text" readonly="readonly" size="50" value="<?php echo $model->emp_id;?>">
                <input  name="sx_id" type="hidden" value="<?php echo $model->id;?>">
            </p>
            <p class="nowrap">
                <label>违纪事件：</label>
                <textarea name="wj_qyj" cols="40" rows="3"><?php echo $model->wj_sj;?></textarea>
            </p>
            <p class="nowrap">
                <label>处理HR邮箱：</label>
                <input  name="wj_email" type="text" class="textInput email" size="40" value="<?php echo $model->tz_email;?>">
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
            navTab.reload(json.network_supervisor_verify);  //刷新主页面
            $.pdialog.closeCurrent();  //
        }
    }
</script>