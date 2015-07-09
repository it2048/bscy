<?php $home = Yii::app()->request->baseUrl."/public/home/";?>
<?php $this->widget('BannerWidget',array('type'=>1)); ?>
<div class="f_banner banner_bg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-6 col-xs-12 pull-right">
                <div class="login_wrap" id="flower_login">
                    <a href="javascript:;" class="go_login" id="register_show">注册</a>
                    <a href="" class="register">欢迎登录</a>
                    <div class="login_border">
                        <form action="">
                            <input type="text" class="form-control fj_user" placeholder="手机号码">
                            <input type="password" class="form-control fj_user" placeholder="密码">
                            <div class="row">
                                <div class="col-sm-7 col-xs-12">
                                    <input type="text" class="form-control fj_user"  placeholder="请输入验证码" name="verifycode" id="verifycode">
                                </div>
                                <div class="col-sm-5 col-xs-12">
                                    <img src="<?php echo $home; ?>images/yzm.png" alt="" style="cursor:pointer;">
                                </div>
                            </div>
                            <p class="f_forget clearfix"><a href="">忘记密码？</a></p>
                            <button type="button" class="btn register_btn">登录花白</button>
                        </form>
                    </div>
                </div>
                <div class="login_wrap" id="flower_register" style="display:none;">
                    <a href="javascript:;" class="go_login" id="login_show">登录</a>
                    <a href="" class="register">注册账号</a>
                    <div class="login_border">
                        <form action="">
                            <input type="text" class="form-control fj_user" placeholder="手机号码">
                            <input type="password" class="form-control fj_user" placeholder="密码">
                            <input type="text" class="form-control fj_user" placeholder="电子邮箱">
                            <div class="row" style="margin-bottom:10px; margin-right:0;">
                                <div class=" col-sm-7 col-xs-12">
                                    <input type="text" class="form-control fj_user"  placeholder="请输入验证码" name="verifycode" id="verifycode">
                                </div>
                                <div class=" col-sm-5 col-xs-12">
                                    <button type="button" class="btn fj_btn">获取手机验证码</button>
                                </div>
                            </div>
                            <button type="button" class="btn register_btn">注册花白</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="query">
        <?php
        $i = 1;
        foreach($slider as $val)
        {
            printf('<a href="javascript:;" imgurl="background:url(%s) no-repeat center top #1583db;" %s>%s</a>',
                Yii::app()->request->baseUrl.$val['img_url'],$i==1?'class="cur"':'',$i);
            $i++;
        }
        ?>
    </div>
</div>
<div class="container">
<div class="row f_cont">
    <div class="col-lg-9 col-sm-9 col-xs-12">
        <p class="hot_search">热门搜索：<a href="">iphone6</a><a href="">iphone6</a><a href="">iphone6</a></p>
        <div class="search_border">
            <form action="">
                <input type="text" class="search_input" placeholder="搜索您需要的服务">
                <input type="submit" class="search_submit" value="搜索">
            </form>
        </div>
        <h3 class="info_title">热门买卖信息<span>Popular trading information</span></h3>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg1"><a href="" class="f_more">更多&nbsp;&gt;</a>我要出售</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg2"><a href="" class="f_more">更多&nbsp;&gt;</a>我要求购</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                        <p><span>40分钟前</span><a href="javascript:;">9折收购iPhone6 Plus</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-xs-12">
        <div class="trade_wrap">
            <img src="<?php echo $home; ?>images/done.png" alt="">
            <div class="trade_all">
                <p><a href="">9折求购iphon购iphone69折求购iphone6</a><span>40分钟前</span></p>
                <p><a href="">9折求购iphone69折求购iphone6</a><span>40分钟前</span></p>
                <p><a href="">9折求购iphone69折求购iphone6</a><span>40分钟前</span></p>
                <p><a href="">9折求购iphone69折求购iphone6</a><span>40分钟前</span></p>
                <p><a href="">9折求购iphone69折求购iphone6</a><span>40分钟前</span></p>
                <p><a href="">9折求购iphone69折求购iphone6</a><span>40分钟前</span></p>
            </div>
        </div>
        <a href=""><img src="<?php echo $home; ?>images/gg1.png" alt="" class="imgset"></a>
    </div>
</div>
<a href=""><img src="<?php echo $home; ?>images/gg2.png" alt="" class="imgset2"></a>
<div class="row">
    <div class="col-lg-9 col-sm-9 col-xs-12">
        <h3 class="info_title">分类信息<span style="margin-left:-70px;">Classifiled information</span></h3>
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg3"><a href="" class="f_more">更多&nbsp;&gt;</a>京小白</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_sell">[出售]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg4"><a href="" class="f_more">更多&nbsp;&gt;</a>花小呗</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_sell">[出售]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg5"><a href="" class="f_more">更多&nbsp;&gt;</a>任小付</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_sell">[出售]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 f_box">
                <h3 class="tbg6"><a href="" class="f_more">更多&nbsp;&gt;</a>闪小白</h3>
                <div class="info_show">
                    <div class="info_all">
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_sell">[出售]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                        <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone69折求购iphone6</a></p>
                    </div>
                    <div class="btn_wrap">
                        <a href="" class="f_btn">发布信息</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-3 col-xs-12">
        <a href=""><img src="<?php echo $home; ?>images/gg3.png" alt="" class="imgset3"></a>
        <a href=""><img src="<?php echo $home; ?>images/gg5.png" alt="" class="imgset3"></a>
        <a href=""><img src="<?php echo $home; ?>images/gg6.png" alt="" class="imgset3"></a>
        <a href=""><img src="<?php echo $home; ?>images/gg7.png" alt="" class="imgset3"></a>
    </div>
</div>
<a href=""><img src="<?php echo $home; ?>images/gg2.png" alt="" class="imgset4"></a>
<div class="row">
    <div class="col-lg-9 col-sm-9 col-xs-12">
        <h3 class="info_title">其他交易信息<span style="margin-left:-95px;">Other transaction information</span></h3>
        <div class="info_show" style="border-top:1px solid #a9a9a9; margin-top:30px;">
            <div class="info_all">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <p><span>40分钟前</span><a href="javascript:;"><b class="f_buy">[求购]</b>9折求购iphone6 plus</a></p>
                </div>
            </div>
            <div class="btn_wrap">
                <a href="" class="f_btn">发布信息</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-3 col-xs-12">
        <a href=""><img src="<?php echo $home; ?>images/gg8.png" alt="" class="imgset4"></a>
        <a href=""><img src="<?php echo $home; ?>images/gg9.png" alt="" class="imgset4"></a>
        <a href=""><img src="<?php echo $home; ?>images/gg1.png" alt="" class="imgset4"></a>
    </div>
</div>
<h3 class="info_title">诚信榜单<span style="margin-left:-45px;">Honesty list</span></h3>
<ul class="f_shop clearfix">
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
    <li><a href=""><img src="<?php echo $home; ?>images/photo.png" alt="">
            <p>阿强专卖店<br><span>已成交：169笔</span></p></a></li>
</ul>
<div class="user_show clearfix">
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <a href=""><p class="common bigv">阿强专卖店<br><span>已成交：169笔</span></p></a>
    </div>
    <div class="col-lg-2 col-sm-2 col-xs-12 user_border">
        <div class="join_wrap">
            <a href="" class="f_btn">我要加入</a>
        </div>
    </div>
</div>
<a href="" class="f_join">如何成为推荐用户？</a>
<div class="f_partner">
    <h3 class="info_title">合作伙伴<span style="margin-left:-35px;">Partners</span></h3>
    <div class="partners">
        <?php foreach($lnikArr as $k=>$val){
            echo sprintf('<a href="%s"><img src="%s%s" alt="%s"></a>',$val['link_url'],Yii::app()->request->baseUrl,$val['img_url'],$val['title']);
        }?>
    </div>
</div>
</div>