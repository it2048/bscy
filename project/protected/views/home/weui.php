
    <div class="demo-block">
        <div class="ui-flex ui-flex-pack-start">
            <div class="tx-img">
                <img src="<?=Yii::app()->request->baseUrl.'/public/'.$model->simg?>">
            </div>
            <div class="span-xy">宣言：<?=mb_strcut($model->sdesc,0,68*3,'UTF-8')?></div>
        </div>
        <div class="ui-flex ui-flex-pack-center">
            <div class="button-tz">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('home/edit'); ?>"><span class="span-zg">击打战鼓，我要挑擂！</span></a>
            </div>
        </div>
    </div>