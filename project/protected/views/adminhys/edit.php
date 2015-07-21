<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminhys/update'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>所在城市：</label>
                <input  name="hys_city" type="text" class="textInput required" size="40" value="<?php echo $models->city;?>">
            </p>
            <p class="nowrap">
                <label>会议室名称：</label>
                <input  name="hys_name" type="text" class="textInput required" size="40" value="<?php echo $models->name;?>">
            </p>
            <p class="nowrap">
                <label>容纳人数：</label>
                <input  name="hys_num" type="text" class="textInput required number" size="10" value="<?php echo $models->num;?>">
            </p>
            <p class="nowrap">
                <label>会议室描述</label>
                <textarea name="hys_desc" cols="50" rows="9"><?php echo $models->desc;?></textarea>
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
            alertMsg.correct("保存成功"); //返回错误
            navTab.reload(json.slidemanager);  //刷新主页面
            $.pdialog.closeCurrent();  //
        }
    }

</script>