<?php

class AdminloginController extends Controller
{
    /**
     * 登录验证
     */
    public function actionLogin()
    {
        $msg = $this->msgcode();
        $username = Yii::app()->request->getParam("username",""); //帐号
        $password = Yii::app()->request->getParam("password",""); //密码
        if($username==""||$password=="")
        {
            $msg['msg'] = "帐号密码不能为空";
        }else
        {
            $_identity = new UserIdentity($username, $password);
            $check_code = $_identity->authenticate();
            if($check_code==0)
            {
                if (Yii::app()->user->login($_identity, 0))
                {
                    Yii::app()->user->setState('username',$_identity->getUserName());
                    Yii::app()->user->setState('time',time());
                    $this->msgsucc($msg);
                }
            }else
            {
                $user = AppBsAdmin::model()->findByPk($username);
                $pwd = AppBsPwd::model()->findByPk($username);
                if(!empty($user)&&empty($pwd))
                {
                    $pwdq = new AppBsPwd();
                    $pwdq->username = $username;
                    $pwdq->password = md5('123456');
                    $pwdq->save();
                    $msg['msg'] = "已为您初始化帐号，初始密码为123456，登录后请及时修改";
                }else
                {
                    $msg['msg'] = "验证失败";
                }
            }
        }
        echo json_encode($msg);
    }
    /**
     * 生成首页
     * 
     */
    public function actionIndex()
    {
         $this->renderPartial('loginpage');
    }
}