<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/save'); ?>" class="pageForm required-validate" onsubmit="return iframeCallback(this, viData);" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p class="nowrap">
                <label>申请部门：</label>
                <input  name="bgyp_org" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>所在城市：</label>
                <input  name="bgyp_city" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>法人公司：</label>
                <input  name="bgyp_company" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>申请人：</label>
                <input  name="bgyp_sqr" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>商品名称：</label>
                <input  name="bgyp_name" id="bgyp_name" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>商品编号：</label>
                <input  name="bgyp_code" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>商品单位：</label>
                <input  name="bgyp_dw" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>商品单价：</label>
                <input  name="bgyp_dj" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>商品数量：</label>
                <input  name="bgyp_cnt" type="text" class="textInput required number" size="40" value="">
            </p>
            <p class="nowrap">
                <label>总金额：</label>
                <input  name="bgyp_money" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>部门主管：</label>
                <input  name="bgyp_boss" type="text" class="textInput required" size="40" value="">
            </p>
            <p class="nowrap">
                <label>备注</label>
                <textarea name="bgyp_desc" cols="50" rows="9"></textarea>
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
    $(function() {
        $("#bgyp_name").autocomplete({
            data: [<?php
           foreach ($mod as $val) {
               printf("['%s',%d],",$val->sp_name,$val->id);
           }
           ?>],
            minChars: 0,
            onItemSelect:function($alt){
                var id = $alt.data[0];
                $.ajax({
                    url: '<?php echo Yii::app()->createAbsoluteUrl('adminbgyp/item'); ?>',
                    type: 'POST',
                    data: 'id='+id,
                    dataType: "json",
                    success: function(data) {
                        if(data.code==0)
                        {
                            $("input[name='bgyp_code']").val(data.data.bh);
                            $("input[name='bgyp_dw']").val(data.data.dw);
                            $("input[name='bgyp_dj']").val(data.data.dj);
                        }
                    }
                });
            }
        });
    });

    $("input[name='bgyp_cnt']").blur(function(){
        if($("input[name='bgyp_cnt']").val()!="")
        {
            var mn = $("input[name='bgyp_cnt']").val()*$("input[name='bgyp_dj']").val();
            $("input[name='bgyp_money']").val(mn.toFixed(2));
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