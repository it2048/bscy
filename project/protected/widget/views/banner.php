<?php
$home = Yii::app()->request->baseUrl."/public/home/";

$banStr = "";
foreach(TempList::$buyType as $key=>$val)
{
    $banStr .= sprintf('<span>|</span><a %s href="%s">%s</a>',$score==$key?'class="cur"':'',
        Yii::app()->createAbsoluteUrl('home/buy',array('type'=>$key)),$val);
}
$url = sprintf('<a href="%s" %s>首页</a>%s',Yii::app()->createAbsoluteUrl('home/index'),$score==0?'class="cur"':'',$banStr);

if($type==1) {?>
    <div class="container">
        <div class="row f_header">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="f_logo">
                    <img src="<?php echo $home; ?>images/logo.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="f_nav">
                    <?php echo $url;?>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="f_free">
                    <a href="<?php echo Yii::app()->createAbsoluteUrl('home/slttype');?>" class="f_btn">免费发布信息</a>
                </div>
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="container">
        <div class="row f_header">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="f_logo">
                    <img src="<?php echo $home; ?>images/logo.png" alt="">
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="f_nav pull-right">
                    <?php echo $url;?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>