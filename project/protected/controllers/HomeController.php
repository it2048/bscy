<?php

class HomeController extends Controller
{

    public $layout = '//layouts/wx';

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xfdfdfe,
                'maxLength' => '4', // 最多生成几个字符
                'minLength' => '4', // 最少生成几个字符
                'height' => '36',
                'width' => '84',
            ),
        );
    }

    public function actionW()
    {
        $id = intval(trim(Yii::app()->request->getParam("id",0)));  //店号
        $area = Arena::model()->findByPk($id);
        if(!empty($area)&&$area->publish != 0)
        {
            return $this->render('weui',['model'=>$area]);
        }else
        {
            echo '非法的访问';
        }
    }
    public function actionEdit()
    {
        //刷新前端验证码
        $this->createAction('captcha')->getVerifyCode(true);
        return $this->render('edit');
    }

    public function actionDel()
    {
        $id = intval(trim(Yii::app()->request->getParam("id",0)));  //店号
        $uname = $this->getU();
        $area = Arena::model()->findByPk($id);
        if(!empty($area)&&$uname != $area->sno){
            $msg['msg'] = "您没权限操作";
        }else
        {
            $path = Yii::app()->basePath . '/../public/';
            if(!empty($area)&&!empty($area->simg)&&file_exists($path.$area->simg)){
               unlink($path.$area->simg);
            }
            if(!empty($area))
            {
                $area->delete();
                $this->msgsucc($msg);
            }
        }
        echo json_encode($msg);
    }

    /**
     * 保存编辑内容
     *
     */
    public function actionSave()
    {
        $msg = $this->msgcode();
        $sno = strtolower(trim(Yii::app()->request->getParam("sno","")));  //店号
        $sname = trim(Yii::app()->request->getParam("sname","")); //用户名
        $scate = intval(Yii::app()->request->getParam("scate",1)); //密码
        $scode = trim(Yii::app()->request->getParam("scode","")); //验证码
        $pid = strtolower(trim(Yii::app()->request->getParam("pid","")));  //店号

        if($sno=="")
        {
            $msg["msg"] = "店号不能为空";
        }
        elseif($sname == "")
        {
            $msg["msg"] = "姓名不能为空";
        }
        elseif($scate<1 || $scate>5){
            $msg["msg"] = "工作站不存在";
        }elseif($scode == ""){
            $msg["msg"] = "验证码不能为空";
        }elseif(strlen($scode) != 4){
            $msg["msg"] = "验证码位数错误";
        }
        else
        {
            $chk = $this->createAction('captcha')->getVerifyCode();
            //刷新前端验证码
            $this->createAction('captcha')->getVerifyCode(true);
            if(strtolower($chk)==strtolower($scode))
            {
                $msg["msg"] = "验证码错误，请点击图片刷新重试";
            }else
            {
                $admm = AppBsAdmin::model()->find("type = 2 AND username = :um",array(":um"=>$sno));
                if(empty($admm))
                {
                    $msg['msg'] = "请输入正确的店号";
                }else
                {
                    $model = Arena::model()->find("sno = :sno AND sname = :um",array(":sno"=>$sno,":um"=>$sname));
                    if(empty($model)){
                        $model = new Arena();
                        $model->sno = $sno;
                        $model->sname = $sname;
                        $model->scate = $scate;
                        $model->pid = $pid;
                        $model->addtime = time();
                        if($model->save())
                        {
                            $this->msgsucc($msg);
                        }else
                        {
                            $msg['msg'] = "申请失败，请重试";
                        }
                    }else
                    {
                        $msg['msg'] = "您已经报名成功，请耐心等待结果……";
                    }
                }
            }
        }
        echo json_encode($msg);
    }


    public function actionLogin()
    {
        $uname = Yii::app()->user->getState('username');
        if(!empty($uname)){
            $this->redirect (Yii::app ()->createAbsoluteUrl ('home/cate'));
        }else
        {
            //刷新前端验证码
            $this->createAction('captcha')->getVerifyCode(true);
            return $this->render('login');
        }
    }

    public function actionGo()
    {
        $msg = $this->msgcode();
        $sno = strtolower(trim(Yii::app()->request->getParam("sno","")));  //店号
        $swp = trim(Yii::app()->request->getParam("swp","")); //用户名
        $scode = trim(Yii::app()->request->getParam("scode","")); //验证码

        if($sno=="")
        {
            $msg["msg"] = "店号不能为空";
        }
        elseif($swp == "")
        {
            $msg["msg"] = "密码不能为空";
        }
        elseif($scode == ""){
            $msg["msg"] = "验证码不能为空";
        }elseif(strlen($scode) != 4){
            $msg["msg"] = "验证码位数错误";
        }
        else
        {
            $chk = $this->createAction('captcha')->getVerifyCode();
            //刷新前端验证码
            $this->createAction('captcha')->getVerifyCode(true);
            if(strtolower($chk)!=strtolower($scode))
            {
                $msg["msg"] = "验证码错误，请点击图片刷新重试";
            }else
            {
                $_identity = new UserIdentity($sno, $swp);
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
                    $user = AppBsAdmin::model()->find("type = 2 AND username = :um",array(":um"=>$sno));
                    $pwd = AppBsPwd::model()->findByPk($sno);
                    if(!empty($user)&&empty($pwd))
                    {
                        $pwdq = new AppBsPwd();
                        $pwdq->username = $sno;
                        $pwdq->password = md5('123456');
                        $pwdq->save();
                        $msg['msg'] = "已为您初始化帐号，请重新登录";
                    }else
                    {
                        $msg['msg'] = "验证失败";
                    }
                }
            }
        }
        echo json_encode($msg);
    }

    public function getU(){
        $uname = Yii::app()->user->getState('username');
        if(empty($uname))
        {
            if(!Yii::app()->request->isAjaxRequest)
            {
                $this->redirect (Yii::app ()->createAbsoluteUrl ('home/login'));
                die();
            }else{
                echo json_encode([
                    'code' => 99,
                    'msg' => '无权限',
                    'data' => null
                ]);
                die();
            }
        }else
        {
            return $uname;
        }

    }

    public function actionCate()
    {
        $uname = $this->getU();

        $model = Arena::model()->findAll("sno = :sno order by addtime desc",array(":sno"=>$uname));
        $arr = ['tb0'=>[],'tb1'=>[]];
        foreach($model as $val){
            array_push($arr['tb'.$val->publish],
                [
                    'id' => $val->id,
                    'sname' => $val->sname,
                    'scate' => $val->scate,
                    'addtime' => $val->addtime
                ]);
        }
        return $this->render('cate',array('model'=>$arr));

    }

    public function actionInfo()
    {
        $id = intval(Yii::app()->request->getParam("id","")); //编号
        $uname = $this->getU();
        $model = Arena::model()->find("sno = :sno and id = :id",array(":sno"=>$uname,":id"=>$id));
        if(empty($model))
        {
            $this->redirect (Yii::app ()->createAbsoluteUrl ('home/cate'));

        }else
        {
            return $this->render('info',array('model'=>$model));

        }
    }


    public function actionUpload()
    {
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $id = intval(Yii::app()->request->getParam("id","")); //编号
        $img = trim(Yii::app()->request->getParam("img","")); //编号
        $uname = $this->getU();
            $model = Arena::model()->find("sno = :sno and id = :id",array(":sno"=>$uname,":id"=>$id));
            if(empty($model))
            {
                $msg["msg"] = '您没有权限上传头像';
            }else
            {
                if(!empty($img))
                {
                    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $img, $result)){
                        if($result[2] == 'png' || $result[2] == 'jpg' )
                        {
                            $flname = "img/head-".$id.".".$result[2];
                            $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                            if (file_put_contents($dest_file_path, base64_decode(str_replace($result[1],'',$img)))){
                                $msg["code"] = 0;
                                $msg["data"] = $flname;
                            }else
                            {
                                $msg["msg"] = '文件上传失败';
                            }
                        }else{
                            $msg["msg"] = '上传的文件格式需要是png,jpg';
                        }
                    }else
                    {
                        $msg["msg"] = '上传的文件格式需要是png,jpg';
                    }
                }else
                {
                    $msg["msg"] = '上传的图片不能为空';
                }
            }
        echo json_encode($msg);
    }


    public function actionPublish()
    {
        $msg = $this->msgcode();
        $id = intval(trim(Yii::app()->request->getParam("id","")));  //店号
        $cname = trim(Yii::app()->request->getParam("cname","")); //用户名
        $content = trim(Yii::app()->request->getParam("content","")); //内容
        $img = trim(Yii::app()->request->getParam("img",""));

        if($id=="")
        {
            $msg["msg"] = "编号不能为空";
        }
        elseif($cname == "")
        {
            $msg["msg"] = "餐厅名不能为空";
        }elseif($content == "")
        {
            $msg["msg"] = "宣言不能为空";
        }
        else
        {
            $uname = $this->getU();
            $area = Arena::model()->findByPk($id);
            if(empty($area))
            {
                $msg['msg'] = "挑战者不存在";
            }elseif(!file_exists(Yii::app()->basePath . '/../public/'.$img))
            {
                $msg['msg'] = "请上传图片";
            }elseif($uname != $area->sno){
                $msg['msg'] = "您没权限操作";
            }
            else
            {
                $area->ctname = $cname;
                $area->sdesc = $content;
                $area->publish = 1;
                $area->simg = $img;
                if($area->save())
                {
                    $this->msgsucc($msg);
                    $msg['data'] = Yii::app()->createAbsoluteUrl('home/w',array("id"=>$id));
                }else
                {
                    $msg['msg'] = "失败，请重试";
                }
            }

        }
        echo json_encode($msg);
    }

}