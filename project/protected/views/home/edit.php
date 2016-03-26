<div class="weui_msg">
    <div class="weui_text_area">
        <h2 class="weui_msg_title">我要挑战</h2>
    </div>
</div>
<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">店号</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="text" name="sno" placeholder="请输入您所在餐厅的店号">
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="text" name="sname" placeholder="请输入您的姓名">
        </div>
    </div>
    <div class="weui_cell weui_cell_select weui_select_after">
        <div class="weui_cell_hd">
            选择工作站
        </div>
        <div class="weui_cell_bd weui_cell_primary">
            <select class="weui_select" name="scate">
                <?php
                foreach(TempList::$arena as $k=>$val)
                    echo sprintf('<option value="%d">%s</option>',$k,$val);
                ?>
            </select>
        </div>
    </div>
    <div class="weui_cell weui_vcode">
        <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="text" name="scode" placeholder="请输入验证码">
        </div>
        <div class="weui_cell_ft">
            <?php $this->widget('CCaptcha',array(
                'showRefreshButton'=>FALSE,
                'clickableImage'=>true,
                'imageOptions'=>array(
                    'alt'=>'点击换图',
                    'title'=>'点击换图',
                    'style'=>'cursor:pointer',
                    'padding'=>'4')
            )); ?>
        </div>
    </div>
</div>
<div class="weui_btn_area"><a href="javascript:;" id="psave" class="weui_btn weui_btn_warn">确认</a></div>
<div class="weui_dialog_alert">
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
        $(".weui_dialog_alert").hide();

        $(".weui_btn_dialog").on("click",function(){
            clk = true;
            $("#psave").removeClass("weui_btn_disabled");
            $(".weui_dialog_alert").hide();
        });

        $("#psave").on("click",function(){
            if(!clk) return;
            var sno = $("input[name=sno]").val();
            var sname = $("input[name=sname]").val();
            var scate = $("input[name=scate]").val();
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