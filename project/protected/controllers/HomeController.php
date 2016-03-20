<?php

class HomeController extends Controller
{

    public $layout = '//layouts/wx';


    public function actionIndex()
    {
        $id = Yii::app()->getRequest()->getParam("id", ""); //月份
        $model = AppBsArt::model()->findByPk($id);
        $this->renderPartial('index',array(
            'models' => $model));
    }

    public function postmail(array $address,$Subject,$body){

        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host = Yii::app()->params['smtp']; //SMTP服务器 以163邮箱为例子
        $mail->Port = Yii::app()->params['port'];  //邮件发送端口
        $mail->SMTPAuth   = true;  //启用SMTP认证
        $mail->CharSet  = "UTF-8"; //字符集
        $mail->Encoding = "base64"; //编码方式

        $mail->Username = Yii::app()->params['email'];  //你的邮箱
        $mail->Password = Yii::app()->params['pass'];  //你的密码
        $mail->Subject = $Subject; //邮件标题
        $mail->From = Yii::app()->params['email'];  //发件人地址（也就是你的邮箱）
        $mail->FromName = "办公系统";  //发件人姓名
        if(is_array($address))
        {
            foreach($address as $val)
            {
                $mail->AddAddress($val['email'],$val['name']);//添加收件人（地址，昵称）
            }
        }else
        {
            $mail->AddAddress($address,$address);//添加收件人（地址，昵称）
        }
        $mail->IsHTML(true); //支持html格式内容
        $mail->Body = $body; //邮件主体内容
        //发送
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

    public function actionW()
    {
        return $this->render('weui');
    }
    public function actionEdit()
    {
        return $this->render('edit');
    }

}