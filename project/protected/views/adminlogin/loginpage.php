<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php $home = Yii::app()->request->baseUrl."/public/dwz/";?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo Yii::app()->name;?></title>
        <link href="<?php echo $home; ?>admincss/dwzthemes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo $home; ?>admincss/dwzthemes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo $home; ?>admincss/dwzthemes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
        <link href="<?php echo $home; ?>admincss/dwzthemes/css/login.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $home; ?>adminjs/jquery-1.7.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $home; ?>adminjs/jquery.validate.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="login">
            <div id="login_header">
                <h1 class="login_logo">
                    <a href="#"><img src="<?php echo $home; ?>admincss/dwzthemes/default/images/login_logo.gif" /></a>
                </h1>
                <div class="login_headerContent">
                    <div class="navList">
                        <ul>
                            <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('home/index',array('id'=>3)); ?>"">共享文件夹</a></li>
                        </ul>
                    </div>
                    <h2 class="login_title"><img src="<?php echo $home; ?>admincss/dwzthemes/default/images/login_title.png" /></h2>
                </div>
            </div>
            <div id="login_content">
                <div class="loginForm">
                    <form id="frm_login" method="post">
                        <br /><br />
                        <p>
                            <label>帐号：</label>
                            <input type="text" id="username" name="username" size="20" class="login_input" />
                            <input type="hidden" value="<?php echo Yii::app()->getRequest()->getCsrfToken(); ?>" name="csrf_token" />
                        </p>
                        <p>
                            <label>密码：</label>
                            <input type="password" id="password" name="password" size="20" class="login_input" />
                        </p>
                        <div class="login_bar">
                            <input type="button" class="sub" id="btn_login" />
                            <p style="color: red;" id="error_msg"></p>
                        </div>
                    </form>
                </div>
                <div class="login_banner"><img src="<?php echo $home; ?>admincss/dwzthemes/default/images/login_banner.jpg" /></div>
                <div class="login_main">
                    <ul class="helpList">
                        <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('home/index',array('id'=>1)); ?>">忘记密码怎么办？</a></li>
                        <li><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('home/index',array('id'=>2)); ?>">总是提示权限不足？</a></li>
                    </ul>
                    <div class="login_inner">
                        <p>如果你没有帐号和密码，请找管理员申请</p>
                        <p>如果系统有使用不方便的地方请联系开发团队</p>
                    </div>
                </div>
            </div>
            <div id="login_footer">
                Copyright &copy; 百胜餐饮
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_login").click(loginSystem);
        $("#username").keydown(function(evt){
            if (13 == evt.keyCode){
                $("#password").focus();
            }
        });
        $("#password").keydown(function(evt){
            if (13 == evt.keyCode){
                loginSystem();
            }
        });
        $("#username").focus();
    });
            
    function loginSystem()
    {
        var _username = $("#username").val();
        var _password = $("#password").val();
        var _csrf = $('input[name="csrf_token"]').val();
        var _url = "<?php echo Yii::app()->createAbsoluteUrl('adminlogin/login'); ?>";
        var _param = {'username':_username, 'password':_password,'csrf_token':_csrf};
        $.ajax({
            type: 'POST',
            url: _url,
            data: _param,
            dataType: "json",
            success: function(obj) {
                if (obj.code == 0)
                    window.location.href = "<?php echo Yii::app()->createAbsoluteUrl('admincontent/index'); ?>/";
                else
                {
                    $("#error_msg").html(obj.msg);
                }
            }
        });
    }
</script>