<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <?php $home = Yii::app()->request->baseUrl."/public/home/";?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1，maximum-scale=1, user-scalable=no">
    <title>首页</title>
    <link href="<?php echo $home; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $home; ?>css/platform.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-8 col-xs-12 pull-right">
                <div class="f_right">
                    <a href="">登录</a><a href="">注册</a>
                    <span>客服专线：400-8888-111</span>
                </div>
            </div>
            <div class="col-lg-4 col-sm-4 col-xs-12">
                <div class="location">
                    <span class="position">成都</span>
                    <span>[切换城市]</span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $content; ?>
<div class="f_footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <p class="hot_line">热线电话：<b>400-1234-123</b></p>
                <img src="<?php echo $home; ?>images/footer_logo.png" alt="" class="bottom_fl">
                <div class="ewm">
                    <img src="<?php echo $home; ?>images/ewm.png" alt=""><p>扫描二维码关注花呗网公众账号</p>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12 f_end">
                <p style="margin:0">关注我们</p>
                <a href="javascript:;"><img src="<?php echo $home; ?>images/gz1.png" alt=""></a> <a href="javascript:;"><img src="<?php echo $home; ?>images/gz2.png" alt=""></a> <a href="javascript:;"><img src="<?php echo $home; ?>images/gz3.png" alt=""></a> <a href="javascript:;"><img src="<?php echo $home; ?>images/gz4.png" alt=""></a> <a href="javascript:;"><img src="<?php echo $home; ?>images/gz5.png" alt=""></a>
                <p>帮助中心</p>
                <a href="">客户服务</a><span>|</span><a href="">客户服务</a><span>|</span><a href="">客户服务</a><span>|</span><a href="">客户服务</a>
                <p>关于我们</p>
                <a href="">客户服务</a><span>|</span><a href="">客户服务</a><span>|</span><a href="">客户服务</a><span>|</span><a href="">客户服务</a>
            </div>
        </div>
    </div>
</div>
<script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo $home; ?>js/bootstrap.min.js"></script>
<script src="<?php echo $home; ?>js/index.js"></script>
</body>
</html>