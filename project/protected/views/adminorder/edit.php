<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminorder/update'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>身份证号码：</label>
                <input  name="order_sfid" type="text" class="textInput required" size="30" alt="请输入您的身份证号码" value="<?php echo $atpt->sf_id;?>">
            </p>
            <p class="nowrap">
                <label>员工编号：</label>
                <input  name="order_id" type="hidden" value="<?php echo $atpo->id;?>">
                <input  name="order_emid" type="text" size="20" value="<?php echo $atpo->emp_id;?>">
            </p>
            <p class="nowrap">
                <label>员工姓名：</label>
                <input  name="order_name" type="text" size="20" value="<?php echo $atpt->name;?>">
            </p>
            <p class="nowrap">
                <label>职务：</label>
                <input  name="order_zw" type="text" size="20" value="<?php echo $atpt->zw_name;?>">
            </p>
            <p class="nowrap">
                <label>餐厅：</label>
                <input  name="order_ct" type="text" size="30" value="<?php echo $atpt->ct_name;?>">
            </p>
            <p class="nowrap">
                <label>区经理：</label>
                <input  name="order_qjl" type="text" size="20" value="<?php echo $atpo->q_jl;?>">
            </p>
            <p class="nowrap">
                <label>区域经理：</label>
                <input  name="order_qyjl" type="text" size="20" value="<?php echo $atpo->qy_jl;?>">
            </p>
            <p>
                <label>员工类型：</label>
                <select name="order_yglx">
                    <?php
                    foreach(TempList::$sf as $k=>$val)
                    {
                        $str = $k==$atpo->type?'selected="selected"':"";
                        echo sprintf('<option value="%s" %s>%s</option>',$k,$str,$val);
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>违纪类型：</label>
                <select name="order_wjlx">
                    <option value="">请选择</option>
                    <?php
                    foreach($models as $val)
                    {
                        $str = $val->wx_type==$atpo->wj_lx?'selected="selected"':"";
                        echo sprintf('<option value="%s" %s>%s</option>',$val->wx_type,$str,$val->wx_type);
                    }
                    ?>
                </select>
            </p>
            <p>
                <label>违纪条款：</label>
                <select name="order_wjtk">
                    <option value="<?php echo $atpo->wj_tk;?>"><?php echo $atpo->wj_tk;?></option>
                </select>
            </p>
            <p class="nowrap">
                <label>请填写违纪事件（需注明时间、地点、人物、事件）：</label>
                <textarea name="wj_sj" cols="50" rows="5"><?php echo $atpo->wj_sj;?></textarea>
            </p>
            <p class="nowrap">
                <label>请填写违纪结论（简述行为,例如：“经查证，你的XX行为给营运造成严重影响”）：</label>
                <textarea name="wj_jl" cols="50" rows="5"><?php echo $atpo->wj_jl;?></textarea>
            </p>
            <p class="nowrap">
                <label>其他补充证据：（请列明，如派出所立案证明等）</label>
                <textarea name="wj_zl" cols="50" rows="5"><?php echo $atpo->fj;?></textarea>
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

    $('select[name="order_wjlx"]').change(function(){
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('adminorder/wj'); ?>',
            type: 'POST',
            data: 'id='+$('select[name="order_wjlx"]').val()+'',
            dataType: "json",
            success: function(data) {

                if(data.code==0)
                {
                    $('select[name="order_wjtk"]').empty();
                    $('select[name="order_wjtk"]').append(data.data);
                }else
                {
                    alertMsg.error(data.msg); //返回错误
                }
            }
        });
    });

    $('select[name="order_wjtk"]').change(function(){
        $.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl('adminorder/tk'); ?>',
            type: 'POST',
            data: 'id='+$('select[name="order_wjtk"]').val()+'',
            dataType: "json",
            success: function(data) {
                if(data.code==0)
                {
                    $('#wjzl').html(data.data);
                }
            }
        });
    });


    $("input[name='order_sfid']").blur(function(){
        if($("input[name='order_sfid']").val()!="")
        {
            $.ajax({
                url: '<?php echo Yii::app()->createAbsoluteUrl('adminorder/sf'); ?>',
                type: 'POST',
                data: 'id='+$("input[name='order_sfid']").val()+'',
                dataType: "json",
                success: function(data) {
                    if(data.code==0)
                    {
                        $("input[name='order_emid']").val(data.data.order_emid);
                        $("input[name='order_name']").val(data.data.order_name);
                        $("input[name='order_zw']").val(data.data.order_zw);
                        $("input[name='order_ct']").val(data.data.order_ct);
                        $("input[name='order_qjl']").val(data.data.order_qjl);
                        $("input[name='order_qyjl']").val(data.data.order_qyjl);
                    }else
                    {
                        alertMsg.error(data.msg); //返回错误
                    }
                }
            });
        }

    });

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