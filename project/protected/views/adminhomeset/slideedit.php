<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminhomeset/slideupdate'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>幻灯类型：</label>
                <select class="combox" name="slide_type">
                    <?php foreach(TempList::$slide as $k=>$val){
                        echo sprintf('<option value="%s" %s>%s</option>',$k,$models->type==$k?"selected":"",$val);
                    }?>
                </select>
            </p>
            <p>
                <label>幻灯状态：</label>
                <select class="combox" name="slide_status">
                    <option value="1" <?php echo $models->status==1?"selected":"";?>>永久下线</option>
                    <option value="0" <?php echo $models->status==0?"selected":"";?>>上线</option>
                </select>
            </p>
            <p class="nowrap">
                <label>幻灯标题：</label>
                <input  name="slide_title" type="text" class="textInput required" size="50" value="<?php echo $models->title;?>">
                <input  name="id" type="hidden" value="<?php echo $models->id;?>">
            </p>
            <?php if($models->img_url!=""){?><p class="nowrap"><label>图片地址：</label><img width="120" height="120" src="<?php echo Yii::app()->request->baseUrl.$models->img_url;?>"></p>
            <?php }?>
            <p class="nowrap">
                <label>图片上传：</label>
                <input name="slide_up" type="file">
            </p>
            <p class="nowrap">
                <label>跳转地址(视频地址)：</label>
                <input  name="slide_redirect" type="text" class="textInput" size="50" value="<?php echo $models->redirect_url;?>">
            </p>
            <p class="nowrap">
                <label>幻灯内容：</label>
                <textarea name="content" cols="50" rows="9"><?php echo $models->content;?></textarea>
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