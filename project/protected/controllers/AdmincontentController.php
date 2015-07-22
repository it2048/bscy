<?php

class AdmincontentController extends AdminSet
{
    /**
     * 生成首页
     *
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect (Yii::app ()->createAbsoluteUrl ('adminlogin/index'));
    }
    
    /**
     * 用户管理
     */
    public function actionUserManager()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据


        $pages['srh_email'] = Yii::app()->getRequest()->getParam("srh_email",""); //按名称查询
        $pages['srh_det'] = Yii::app()->getRequest()->getParam("srh_det",""); //按名称查询


        $pages['srh_name'] = Yii::app()->getRequest()->getParam("srh_name",""); //按名称查询
        $pages['srh_dep_name'] = Yii::app()->getRequest()->getParam("srh_dep_name",""); //按部门名称查询
        $pages['srh_tel'] = Yii::app()->getRequest()->getParam("srh_tel",""); //按电话查询
        $pages['srh_dh_name'] = Yii::app()->getRequest()->getParam("srh_dh_name",""); //按店号查询
        $pages['srh_ct_name'] = Yii::app()->getRequest()->getParam("srh_ct_name",""); //按餐厅名称查询
        $pages['srh_type'] = Yii::app()->getRequest()->getParam("srh_type",""); //按餐厅名称查询


        $criteria = new CDbCriteria;
        !empty($pages['srh_name'])&&$criteria->addSearchCondition('name', $pages['srh_name']);
        !empty($pages['srh_dep_name'])&&$criteria->addSearchCondition('dep_name', $pages['srh_dep_name']);
        !empty($pages['srh_tel'])&&$criteria->addSearchCondition('tel', $pages['srh_tel']);
        !empty($pages['srh_dh_name'])&&$criteria->addSearchCondition('dh_name', $pages['srh_dh_name']);
        !empty($pages['srh_ct_name'])&&$criteria->addSearchCondition('ct_name', $pages['srh_ct_name']);
        !empty($pages['srh_type'])&&$criteria->addCondition('type='.$pages['srh_type']);

        !empty($pages['srh_email'])&&$criteria->addSearchCondition('username', $pages['srh_email']);
        !empty($pages['srh_det'])&&$criteria->addSearchCondition("`desc`", $pages['srh_det']);


        $pages['countPage'] = AppBsAdmin::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $allList = AppBsAdmin::model()->findAll($criteria);
        $this->renderPartial('usermanager', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }


    public function actionSearch()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据


        $pages['srh_email'] = Yii::app()->getRequest()->getParam("srh_email",""); //按名称查询
        $pages['srh_det'] = Yii::app()->getRequest()->getParam("srh_det",""); //按名称查询


        $pages['srh_name'] = Yii::app()->getRequest()->getParam("srh_name",""); //按名称查询
        $pages['srh_dep_name'] = Yii::app()->getRequest()->getParam("srh_dep_name",""); //按部门名称查询
        $pages['srh_tel'] = Yii::app()->getRequest()->getParam("srh_tel",""); //按电话查询
        $pages['srh_dh_name'] = Yii::app()->getRequest()->getParam("srh_dh_name",""); //按店号查询
        $pages['srh_ct_name'] = Yii::app()->getRequest()->getParam("srh_ct_name",""); //按餐厅名称查询
        $pages['srh_type'] = Yii::app()->getRequest()->getParam("srh_type",""); //按餐厅名称查询


        $criteria = new CDbCriteria;
        !empty($pages['srh_name'])&&$criteria->addSearchCondition('name', $pages['srh_name']);
        !empty($pages['srh_dep_name'])&&$criteria->addSearchCondition('dep_name', $pages['srh_dep_name']);
        !empty($pages['srh_tel'])&&$criteria->addSearchCondition('tel', $pages['srh_tel']);
        !empty($pages['srh_dh_name'])&&$criteria->addSearchCondition('dh_name', $pages['srh_dh_name']);
        !empty($pages['srh_ct_name'])&&$criteria->addSearchCondition('ct_name', $pages['srh_ct_name']);
        !empty($pages['srh_type'])&&$criteria->addCondition('type='.$pages['srh_type']);

        !empty($pages['srh_email'])&&$criteria->addSearchCondition('username', $pages['srh_email']);
        !empty($pages['srh_det'])&&$criteria->addSearchCondition('`desc`', $pages['srh_det']);


        $pages['countPage'] = AppBsAdmin::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $allList = AppBsAdmin::model()->findAll($criteria);
        $this->renderPartial('search', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    /**
     * 重置密码
     */
    public function actionUsermm()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("uname", 0); //用户名
        if($id!="")
        {
            $model = AppBsPwd::model()->findByPk($id);
            if(empty($model))
            {
                $model = new AppBsPwd();
                $model->username = $id;
            }
            $model->password = md5("123456");
            if($model->save())
                $this->msgsucc($msg);
        }else
        {
            $msg['msg'] = "帐号不能为空";
        }
        echo json_encode($msg);
    }

    public function actionUseradd()
    {
        $this->renderPartial('useradd');
    }
    /**
     * 删除用户
     */
    public function actionUserdelete()
    {
        $msg = $this->msgcode();
        $username = Yii::app()->getRequest()->getParam("username", ""); //用户名
        if($username!="")
        {
            if(AppBsAdmin::model()->deleteByPk($username))
            {
                AppBsPwd::model()->deleteByPk($username);
                $this->msgsucc($msg);
            }
            else
                $msg['msg'] = "数据删除失败";
        }else
        {
            $msg['msg'] = "用户名不能为空";
        }
        echo json_encode($msg);
    }

    public function actionDel()
    {
        $msg = $this->msgcode();
        $type = Yii::app()->getRequest()->getParam("type", ""); //用户名
        if(AppBsAdmin::model()->deleteAll("type=:tp",array(":tp"=>$type)))
        {
            $this->msgsucc($msg);
        }
        else
            $msg['msg'] = "数据删除失败";
        echo json_encode($msg);
    }
    /**
     * 编辑用户
     */
    public function actionUseredit()
    {
        $username = Yii::app()->getRequest()->getParam("username", ""); //用户名
        if($username!="")
        {
            $model = AppBsAdmin::model()->findByPk($username);
            if(!empty($model))
            {
                $this->renderPartial('useredit',array(
                    "models"=>$model
                ));die();
            }     
        }
        $this->renderPartial('useradd');
    }

    
    /**
     * 用户自己修改密码
     */
    public function actionUsernewpass()
    {
        $model = NULL;
        $this->renderPartial('usernewpass');
    }
    /**
     * 用户修改密码
     */
    public function actionUsernewsave()
    {
        $msg = $this->msgcode();
        $oldpassword = Yii::app()->getRequest()->getParam("oldpassword", ""); //用户名
        $password = Yii::app()->getRequest()->getParam("password", ""); //用户名
        $username = $this->getUserName(); //用户名
        if($username!="")
        {
            $model = AppBsPwd::model()->findByPk($username);
            if($password===""||$oldpassword===""||$model->password!=md5($oldpassword)||empty($model))
            {
                $msg['msg'] = "旧密码输入错误";
            }else{
                $model->password = md5($password);
                if($model->save())
                {
                    $this->msgsucc($msg);
                    $msg['msg'] = "保存成功，请退出后重新登录";
                }else
                {
                    $msg['msg'] = "存入数据库异常";
                }
            }  
        }else
            $msg['msg'] = "您没有权限修改别人的密码";
        echo json_encode($msg);
    }
    
    /**
     * 添加用户
     */
    public function actionUsersave()
    {
        $msg = $this->msgcode();
        $username = Yii::app()->getRequest()->getParam("username", ""); //用户名
        $password = Yii::app()->getRequest()->getParam("password", ""); //用户名
        $tel = Yii::app()->getRequest()->getParam("tel", ""); //电话
        $name = Yii::app()->getRequest()->getParam("name", ""); //姓名
        $dep_name = Yii::app()->getRequest()->getParam("dep_name", ""); //部门名
        $type = Yii::app()->getRequest()->getParam("type", 0); //类型
        $ct_name = Yii::app()->getRequest()->getParam("ct_name", ""); //餐厅名称
        $dh_name = Yii::app()->getRequest()->getParam("dh_name", ""); //店号
        $ct_boss = Yii::app()->getRequest()->getParam("ct_boss", ""); //餐厅经理
        $desc = Yii::app()->getRequest()->getParam("desc", ""); //详细信息

        if($username===""||$password==="")
        {
            $msg['msg'] = "帐号密码不能为空";
        }else{
            $rsAdmin = new AppBsAdmin();
            $rsAdmin->username =  strtolower($username);
            $rsAdmin->name = $name;
            $rsAdmin->tel = $tel;
            $rsAdmin->dep_name = $dep_name;
            $rsAdmin->type = $type;
            $rsAdmin->ct_name = $ct_name;
            $rsAdmin->dh_name = strtoupper($dh_name);
            $rsAdmin->ct_boss = $ct_boss;
            $rsAdmin->desc = $desc;

            if($rsAdmin->save())
            {
                $pwd = new AppBsPwd();
                $pwd->username =  strtolower($username);
                $pwd->password = md5($password);
                $pwd->save();
                $this->msgsucc($msg);
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }
        }
        echo json_encode($msg);
    }
    /**
     * 更新用户
     */
    public function actionUserupdate()
    {
        $msg = $this->msgcode();
        $username = Yii::app()->getRequest()->getParam("username", ""); //用户名
        $password = Yii::app()->getRequest()->getParam("password", ""); //用户名
        $tel = Yii::app()->getRequest()->getParam("tel", ""); //电话
        $name = Yii::app()->getRequest()->getParam("name", ""); //姓名
        $dep_name = Yii::app()->getRequest()->getParam("dep_name", ""); //部门名
        $type = Yii::app()->getRequest()->getParam("type", 0); //类型
        $ct_name = Yii::app()->getRequest()->getParam("ct_name", ""); //餐厅名称
        $dh_name = Yii::app()->getRequest()->getParam("dh_name", ""); //店号
        $ct_boss = Yii::app()->getRequest()->getParam("ct_boss", ""); //餐厅经理
        $desc = Yii::app()->getRequest()->getParam("desc", ""); //详细信息


        if($username==="")
        {
            $msg['msg'] = "帐号不能为空";
        }else{
            $rsAdmin = AppBsAdmin::model()->findByPk($username);
            if($password!=="")
            {
                $pwd = AppBsPwd::model()->findByPk($username);
                if(empty($pwd))
                {
                    $pwd = new AppBsPwd();
                    $pwd->username =  strtolower($username);
                }
                $pwd->password = md5($password);
                $pwd->save();
            }
            $rsAdmin->name = $name;
            $rsAdmin->tel = $tel;
            $rsAdmin->dep_name = $dep_name;
            $rsAdmin->type = $type;
            $rsAdmin->ct_name = $ct_name;
            $rsAdmin->dh_name = strtoupper($dh_name);
            $rsAdmin->ct_boss = $ct_boss;
            $rsAdmin->desc = $desc;
            if($rsAdmin->save())
            {
                $this->msgsucc($msg);
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }
        }
        echo json_encode($msg);
    }

    /**
     * 导入功能显示页面
     */
    public function actionVimport(){
        $this->renderPartial('_import');
    }

    /**
     * 导入功能
     */
    public function actionImport(){
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $type = Yii::app()->getRequest()->getParam("imtype", ""); //类型
        if(!empty($_FILES['obj']['name']))
        {
            $_tmp_pathinfo = pathinfo($_FILES['obj']['name']);

            if (strtolower($_tmp_pathinfo['extension'])=="csv") {
                //设置文件路径
                $flname = "upload/".time().".".strtolower($_tmp_pathinfo['extension']);
                $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                $filepathh = dirname($dest_file_path);
                if (!file_exists($filepathh))
                    $b_mkdir = mkdir($filepathh, 0777, true);
                else
                    $b_mkdir = true;
                if ($b_mkdir && is_dir($filepathh)) {
                    //转存文件到 $dest_file_path路径
                    if (move_uploaded_file($_FILES['obj']['tmp_name'], $dest_file_path)) {
                        $msg["msg"] = AppBsAdmin::model()->storeCsv($dest_file_path,$type);
                        $msg["code"] = 0;
                        unlink($dest_file_path);
                    } else {
                        $msg["msg"] = '文件上传失败';
                    }
                }
            } else {
                $msg["msg"] = '上传的文件格式需要是csv';
            }
        }
        echo json_encode($msg);
    }
}