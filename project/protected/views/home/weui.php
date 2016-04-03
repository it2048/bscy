<body class="w-body">

<div class="demo-block">
        <div class="ui-flex ui-flex-pack-start">
            <div class="tx-img">
                <img src="<?=Yii::app()->request->baseUrl.'/public/'.$model->simg?>">
                <div class="span-name">擂主:<?=$model->sname?><br><div class="span-gzz"><?=TempList::$arena[$model['scate']]?>工作站</div></div>
            </div>
            <div class="span-xy">宣言：<?=mb_strcut($model->sdesc,0,68*3,'UTF-8')?></div>
        </div>
        <div class="ui-flex ui-flex-pack-center">

            <div class="ui-row-flex ui-whitespace ui-row-flex-ver">
                <div class="ui-col">
                    <div class="button-tz">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('home/edit'); ?>"><span class="span-zg">击打战鼓，我要挑擂！</span></a>
                    </div>
                </div>
                <div class="ui-col">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('home/edit'); ?>">
                        <div class="ggg"></div>

                    </a>
                </div>
            </div>


        </div>

</div>
</body>