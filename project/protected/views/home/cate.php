<style type="text/css">
    html, body { height: 100%; background-color: #fbf9fe; }
    .weui_tab {
        overflow: hidden;
    }
    .weui_tab_bd .weui_tab_bd_item {
        display: none;
        height: 100%;
        overflow: auto;
    }
    .weui_tab_bd .weui_tab_bd_item.weui_tab_bd_item_active {
        display: block;
    }

</style>
<div class="weui_tab">
    <div class="weui_tab_bd">
        <div id="tab1" class="weui_tab_bd_item weui_tab_bd_item_active">
            <div class="weui_cells weui_cells_access">
                <?php foreach($model['tb0'] as $val){?>
                <a class="weui_cell" href="<?=Yii::app()->createAbsoluteUrl('home/info',['id'=>$val['id']]); ?>">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p><?=$val['sname'].'-'.TempList::$arena[$val['scate']]?></p>
                    </div>
                    <div class="weui_cell_ft"><?=date('Y/m/d',$val['addtime'])?></div>
                </a>
                <?php }?>
            </div>
        </div>
        <div id="tab2" class="weui_tab_bd_item">
            <?php foreach($model['tb1'] as $val){?>
                <a class="weui_cell" href="<?=Yii::app()->createAbsoluteUrl('home/info',['id'=>$val['id']]); ?>">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p><?=$val['sname'].'-'.TempList::$arena[$val['scate']]?></p>
                    </div>
                    <div class="weui_cell_ft"><?=date('Y/m/d',$val['addtime'])?></div>
                </a>
            <?php }?>
        </div>
    </div>
    <div class="weui_tabbar">
        <a href="#tab1" id="tba1" class="weui_tabbar_item weui_bar_item_on">
            <div class="weui_tabbar_icon">
                <img src="<?=Yii::app()->request->baseUrl."/public/home/" ?>img/icon_nav_article.png" alt="">
            </div>
            <p class="weui_tabbar_label">申请列表</p>
        </a>
        <a href="#tab2" id="tba2" class="weui_tabbar_item">
            <div class="weui_tabbar_icon">
                <img src="<?=Yii::app()->request->baseUrl."/public/home/" ?>img/icon_nav_cell.png" alt="">
            </div>
            <p class="weui_tabbar_label">已分享</p>
        </a>

    </div>
</div>
<script type="text/javascript">

    $(function(){
        var act = function(type){
            $("#tba"+type).removeClass('weui_bar_item_on').addClass("weui_bar_item_on");
            $("#tab"+type).removeClass('weui_tab_bd_item_active').addClass("weui_tab_bd_item_active");

            if(type == 1)
            {
                $("#tba2").removeClass('weui_bar_item_on');
                $("#tab2").removeClass('weui_tab_bd_item_active');
            }else{
                $("#tba1").removeClass('weui_bar_item_on');
                $("#tab1").removeClass('weui_tab_bd_item_active');
            }
        };

        $("#tba1").on("click",function(){
            act(1);
        });
        $("#tba2").on("click",function(){
            act(2);
        });
    });
</script>