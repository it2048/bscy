<div class="weui_msg">
    <div class="weui_text_area">
        <h2 class="weui_msg_title"><?=$model->ctname?></h2>


        <p class="weui_msg_desc">
            <img width="160" height="160" style="border-radius:80px;width: 160px;height: 160px;"
                 src="<?=Yii::app()->request->baseUrl.'/public/'.$model->simg?>">
        </p><br>
        <h4>擂主：<?=$model->sname?> <br>  工作站：<?=TempList::$arena[$model['scate']]?>
        </h4>
        <br>
        <p class="weui_msg_desc" style="text-align: left;">
            <?=$model->sdesc?>
        </p>

    </div>
    <div style="margin-bottom: 40px;">
    <a href="<?php echo Yii::app()->createAbsoluteUrl('home/edit'); ?>" class="weui_btn weui_btn_primary">我要挑战</a>
</div>
</div>