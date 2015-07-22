<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminart/update'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>文章标题：</label>
                <input  name="id" type="hidden" value="<?php echo $models->id;?>">
                <input  name="art_title" type="text" class="textInput required" size="50" value="<?php echo $models->title;?>">
            </p>
            <div class="divider"></div>
            请添加文章内容或在文章中上传文件：<br>
            <p class="nowrap">
                <textarea class="editor" name="art_desc" rows="30" cols="96"
                          upLinkUrl="<?php echo Yii::app()->createAbsoluteUrl('adminart/upload'); ?>" upLinkExt="zip,rar,txt"><?php echo $models->desc;?></textarea>
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