<?php $home = Yii::app()->request->baseUrl."/public/home/";?>
<?php $this->widget('BannerWidget',array('type'=>2)); ?>
<div class="container">
    <div class="row">
        <div class="four_step clearfix">
            <p class="step1"><img src="<?php echo $home; ?>images/free.png" alt="">免费发布信息&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">选择交易种类&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p>填写详情&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p>发布成功</p>
        </div>
    </div>
</div>

</div>
<div class="container">
    <div class="f_cont">
        <ul class="f_service row">
            <li class="col-lg-6 col-sm-6 col-xs-12">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('home/buypull');?>"><img src="<?php echo $home; ?>images/fb1.png" alt="">
                    <p>出售发布<br><span>发布额度出售信息</span></p></a>
            </li>
            <li class="col-lg-6 col-sm-6 col-xs-12">
                <a href="<?php echo Yii::app()->createAbsoluteUrl('home/buypush');?>"><img src="<?php echo $home; ?>images/fb2.png" alt="">
                    <p>求购发布<br><span>发布商品求购信息</span></p></a>
            </li>
        </ul>
    </div>
</div>
