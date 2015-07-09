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
        <a href="javascript:;" imgurl="background:url(images/banner.png) no-repeat center top #1583db;" class="cur">1</a><a href="javascript:;" imgurl="background:url(images/gg4.png) no-repeat center top #1583db;">2</a><a href="javascript:;" imgurl="background:url(images/gg5.png) no-repeat center top #1583db;">3</a><a href="javascript:;" imgurl="background:url(images/banner.png) no-repeat center top #1583db;">4</a>
    </div>
</div>
<div class="container">
    <div class="row f_cont">
        <ul class="f_service clearfix">
            <li>
                <img src="<?php echo $home; ?>images/fw1.png" alt="">
                <p>我们的服务<br><span>提供互联网金融信息发布服务</span><br><span>和交易信息发布</span></p>
            </li>
            <li>
                <img src="<?php echo $home; ?>images/fw2.png" alt="">
                <p>安全可靠<br><span>我们提供商家用户监管制度</span><br><span>及信用评级</span></p>
            </li>
            <li>
                <img src="<?php echo $home; ?>images/fw3.png" alt="">
                <p>海量信息<br><span>花白网提供最全面最丰富的</span><br><span>交易信息</span></p>
            </li>
            <li>
                <img src="<?php echo $home; ?>images/fw4.png" alt="">
                <p>我们的服务<br><span>打造最安全的互联网金融</span><br><span>信息发布平台</span></p>
            </li>
        </ul>
    </div>
</div>
