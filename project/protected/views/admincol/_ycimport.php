<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admincol/import',array("type"=>1)); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>选择处理日期：</label>
                <input type="text" name="month" size="10" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo date('Ym',time());?>"/>
            </p>
            <p>
                <label>csv文件上传：</label>
                <input name="obj" type="file" class="valid" style="margin-left: 0px; width: 160px;">
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