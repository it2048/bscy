<?php $home = Yii::app()->request->baseUrl."/public/home/";?>
<?php $this->widget('BannerWidget',array('type'=>2)); ?>
<div class="container">
    <div class="row">
        <div class="four_step clearfix">
            <p class="step1"><img src="<?php echo $home; ?>images/free.png" alt="">免费发布信息&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">选择交易种类&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p class="cur">填写详情&nbsp;&nbsp;&nbsp;&nbsp;&gt;</p><p>发布成功</p>
        </div>
    </div>
</div>
<div class="container">
    <div class="row f_publish">
        <h3 class="publish_title"><img src="<?php echo $home; ?>images/fb1.png" alt="">出售发布<span>发布额度出售信息</span></h3>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span>*</span>出售类别：</label>
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" value="option1" checked><span>京小白</span>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option2"><span>京小白</span>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option3"><span>京小白</span>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option4"><span>京小白</span>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option5"><span>京小白</span>
                    </label>
                    <label>
                        <input type="radio" name="optionsRadios" value="option6"><span>京小白</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span>*</span>出售额度：</label>
            </div>
            <div class="col-sm-4 col-xs-12 form-group">
                <input type="text" class="form-control form_money" id="" placeholder="">
            </div>
            <div class="col-sm-6 col-xs-12">
                <p class="yuan">元<span>（请使用小写人民币输入金额）</span></p>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span></span>折扣：</label>
            </div>
            <div class="col-sm-4 col-xs-12 form-group">
                <input type="text" class="form-control form_discount" id="" placeholder="">
            </div>
            <div class="col-sm-6 col-xs-12">
                <p class="yuan">%<span>（请输入1-100的数字）</span><span class="calculate">折后金额：<b>3000</b>元</span></p>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-8">
                <label for="" class="form_name"><span>*</span>交易方式（多选）：</label>
            </div>
            <div class="col-sm-10 col-xs-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" value=""> <span>网上个人交易</span>
                    </label>
                    <label>
                        <input type="checkbox" value=""> <span>同城见面交易</span>
                    </label>
                    <label class="posi">
                        <input type="checkbox" value=""> <span class="recommend">商家担保交易</span><div class="posi_para">图鉴爱你的喊口号是东方红烧开后放</div>
                    </label>
                </div>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span></span>所在区域：</label>
            </div>
            <div class="col-sm-10 col-xs-12 zone_select">
                <select id="deliverprovince" name="deliverprovince"  class="form-control"></select>
                <select id="delivercity" name="delivercity" class="form-control"></select>
                <select id="deliverarea" name="deliverarea" class="form-control"></select>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span>*</span>联系人：</label>
            </div>
            <div class="col-sm-4 col-xs-12 form-group">
                <input type="text" class="form-control" id="" placeholder="">
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span>*</span>QQ号码：</label>
            </div>
            <div class="col-sm-4 col-xs-12 form-group">
                <input type="text" class="form-control" id="" placeholder="">
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span>*</span>联系电话：</label>
            </div>
            <div class="col-sm-4 col-xs-12 form-group">
                <input type="text" class="form-control" id="" placeholder="">
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6">
                <label for="" class="form_name"><span></span>备注：</label>
            </div>
            <div class="col-sm-6 col-xs-12 form-group">
                <textarea class="form-control" rows="5"></textarea>
                <p>（请勿在备注里输入任何联系方式，否则无法通过审核）</p>
            </div>
        </div>
        <div class="row flower_form">
            <div class="col-sm-2 col-xs-6"></div>
            <div class="col-sm-10 col-xs-12 flower_sure">
                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <a href="" class="f_btn">确定和发布</a>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" value="" checked> <span>我已认真阅读<a href="">《花白网用户协议》</a>，并同意协议条款。</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/Address.js"></script>
        <script>
            window.onload=function(){new PCAS("deliverprovince","delivercity","deliverarea");}
        </script>
    </div>
</div>
