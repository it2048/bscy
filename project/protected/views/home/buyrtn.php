<?php $home = Yii::app()->request->baseUrl."/public/home/";?>
<?php $this->widget('BannerWidget',array('type'=>2)); ?>
<div class="container">
    <div class="row">
        <div class="four_step clearfix">
            <p class="step1"><img src="<?php echo $home; ?>images/free.png" alt="">免费发布信息&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">选择交易种类&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">填写详情&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">发布成功</p>
        </div>
    </div>
</div>

</div>
<div class="container">
    <div class="f_cont">
        <div class="col-lg-6 col-sm-6 col-xs-12 f_success">
            <div class="wait_wrap">
                <img src="<?php echo $home; ?>images/success.png" alt="" class="">
                <p>发布成功，请等待管理员审核……</p>
                <div class="return_index">
                    <a href="" class="f_btn">返回首页</a>
                </div>
            </div>
        </div>
    </div>
</div>
