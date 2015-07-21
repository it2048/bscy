<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminhys/setorder'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>会议室：</label>
                <input  name="dhys_id" type="hidden" value="<?php echo $models->id;?>">
                <input  name="dhys_desc" type="text" class="textInput" readonly size="40" value="<?php
                echo sprintf('%s-%s,容纳%s人',$models->city,$models->name,$models->num);?>">
            </p>
            <p class="nowrap">
                <label>预定日期：</label>
                <input type="text" name="dhys_time" size="10" class="date" dateFmt="yyyyMMdd" readonly="true" value="<?php echo date('Ymd'); ?>"/>
            </p>
            <p class="nowrap">
                <label>开始时间(24小时制)：</label>
                <input  name="dhys_sttime" type="text" min="0" max="24" class="textInput required number" size="10" value="">
            </p>
            <p class="nowrap">
                <label>结束时间(24小时制)：</label>
                <input  name="dhys_sptime" type="text" min="0" max="24" class="textInput required number" size="10" value="">
            </p>
            <p class="nowrap">
                <label>预定部门：</label>
                <input  name="dhys_ydbm" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>预定人：</label>
                <input  name="dhys_ydr" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>会议主持人：</label>
                <input  name="dhys_zcr" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>与会人员</label>
                <textarea name="dhys_yhr" cols="50" rows="4"></textarea>
            </p>
            <p class="nowrap">
                <label>会议内容</label>
                <textarea name="dhys_nr" cols="50" rows="4"></textarea>
            </p>
            <div class="divider"></div>
            请勾选需要的设备：<br>
            <p class="nowrap">
            <div style="margin-left: 130px;">
                <input type="checkbox" name="dhys_zj[]" value="1" />1、是否需要连接线
                <br><input type="checkbox" name="dhys_zj[]" value="2" />2、是否需要话筒
                <br><input type="checkbox" name="dhys_zj[]" value="3" />3、是否需要遥控器
            </div>
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