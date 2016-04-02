<body class="e-body">
<div class="top">

</div>
<div class="info-edit">
    <div class="form-flex1">
        <div class="ui-form-item dclor">
            <input type="text" name="sno" placeholder="请输入餐厅店号">
        </div>
    </div>
    <div class="form-flex1">
        <div class="ui-form-item dclor">
            <input type="text" name="sname" placeholder="请输入您的姓名">
        </div>
    </div>
    <div class="form-flex2">
        <div class="ui-form-item">
            <div class="ui-select">
                <select name="scate">
                    <?php
                    foreach(TempList::$arena as $k=>$val)
                        echo sprintf('<option value="%d">%s</option>',$k,$val);
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-flex3">
        <div class="ui-form-item dclor">
            <input type="text" size="12" name="scode" placeholder="请输入验证码">
        </div>
        <div class="pcode">
            <?php $this->widget('CCaptcha',array(
                'showRefreshButton'=>FALSE,
                'clickableImage'=>true,
                'imageOptions'=>array(
                    'alt'=>'点击换图',
                    'title'=>'点击换图',
                    'style'=>'cursor:pointer',
                    'padding'=>'6')
            )); ?>
        </div>
    </div>
    <div class="footer" >
        <div id="psave">确认</div>
    </div>

</div>
<div class="weui_dialog_alert hidden">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd">
            <strong class="weui_dialog_title">弹窗标题</strong>
        </div>
        <div class="weui_dialog_bd">弹窗内容，告知当前页面信息等</div>
        <div class="weui_dialog_ft">
            <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var palert = function(title,desc){
            $(".weui_dialog_title").html(title);
            $(".weui_dialog_bd").html(desc);
            $(".weui_dialog_alert").show();
        };
        var clk = true;

        $(".weui_btn_dialog").on("click",function(){
            clk = true;
            $("#psave").removeClass("weui_btn_disabled");
            $(".weui_dialog_alert").hide();
        });

        $("#psave").on("click",function(){
            if(!clk) return;
            var sno = $("input[name=sno]").val();
            var sname = $("input[name=sname]").val();
            var scate = $("select[name=scate]").val();
            console.log(scate);
            var scode = $("input[name=scode]").val();

            if(sno == '')
            {
                palert('发现一个问题','店号不能为空');
            }else if(sname == ''){
                palert('发现一个问题','姓名不能为空');
            }else if(scode == ''){
                palert('发现一个问题','验证码不能为空');
            }else
            {
                $("#psave").addClass("weui_btn_disabled");
                clk = false;
                $.ajax({
                    url: '<?=Yii::app()->createAbsoluteUrl('home/save',array("pid"=>isset($pid)?$pid:0)); ?>',
                    type: 'POST',
                    data: {sno:sno,sname:sname,scate:scate,scode:scode},
                    dataType: "json",
                    success: function(data) {
                        if(data.code==0)
                            palert('报名成功','恭喜您，报名成功！');
                        else
                            palert('发现一个问题',data.msg);
                    }
                });
            }
        });
    });
</script>
</body>