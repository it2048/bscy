<?php

class AdminartController extends AdminSet
{
    /**
     * 幻灯片管理
     */
    public function actionIndex()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $criteria = new CDbCriteria;
        $pages['countPage'] = AppBsArt::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsArt::model()->findAll($criteria);
        $this->renderPartial('index', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }


    /**
     * 添加幻灯
     */
    public function actionAdd()
    {
        $this->renderPartial('add');
    }


    /**
     * 保存文章
     */
    public function actionSave()
    {
        $msg = $this->msgcode();
        $title = Yii::app()->getRequest()->getParam("art_title", ""); //违纪类型
        $desc = Yii::app()->getRequest()->getParam("art_desc", ""); //违纪条款

        if($title!=""&&$desc!="")
        {
            $model = new AppBsArt();
            $model->title = $title;
            $model->desc = $desc;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "添加成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
                $msg['msg'] = "文章标题和内容不能为空";
        }
        echo json_encode($msg);
    }


    /**
     * 编辑幻灯
     */
    public function actionEdit()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $model = array();
        if($id!="")
            $model = AppBsArt::model()->findByPk($id);
        $this->renderPartial('edit',array("models"=>$model));
    }


    /**
     * 更新幻灯
     */
    public function actionUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $title = Yii::app()->getRequest()->getParam("art_title", ""); //违纪类型
        $desc = Yii::app()->getRequest()->getParam("art_desc", ""); //违纪条款
        $model = AppBsArt::model()->findByPk($id);

        if($title!=""&&$desc!="")
        {
            $model->title = $title;
            $model->desc = $desc;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "修改成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
            $msg['msg'] = "文章标题和内容不能为空";
        }
        echo json_encode($msg);

    }

    /**
     * 删除幻灯
     */
    public function actionDel()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            if(AppBsArt::model()->deleteByPk($id))
            {
                $this->msgsucc($msg);
            }
            else
                $msg['msg'] = "数据删除失败";
        }else
        {
            $msg['msg'] = "id不能为空";
        }
        echo json_encode($msg);
    }

    /**
     * 上传文件到服务器
     */
    public function actionUpload() {

        $localName = "";
        $inputName = "filedata";
        $upExt='rar,zip,jpg,jpeg,gif,png,swf';//上传扩展名
        $err = "";
        $msg = "";

        $upfile = @$_FILES[$inputName];
        if (!isset($upfile))
            $err = '文件域的name错误';
        elseif (!empty($upfile['error'])) {
            switch ($upfile['error']) {
                case '1':
                    $err = '文件大小超过了php.ini定义的upload_max_filesize值';
                    break;
                case '2':
                    $err = '文件大小超过了HTML定义的MAX_FILE_SIZE值';
                    break;
                case '3':
                    $err = '文件上传不完全';
                    break;
                case '4':
                    $err = '无文件上传';
                    break;
                case '6':
                    $err = '缺少临时文件夹';
                    break;
                case '7':
                    $err = '写文件失败';
                    break;
                case '8':
                    $err = '上传被其它扩展中断';
                    break;
                case '999':
                default:
                    $err = '无有效错误代码';
            }
        } elseif (empty($upfile['tmp_name']) || $upfile['tmp_name'] == 'none')
            $err = '无文件上传';
        else {
            $_tmp_pathinfo = pathinfo($_FILES[$inputName]['name']);
            //设置图片路径
            $flname = 'upload/'.time().".".$_tmp_pathinfo['extension'];
            $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
            $filepathh = dirname($dest_file_path);
            if (!file_exists($filepathh))
                $b_mkdir = mkdir($filepathh, 0777, true);
            else
                $b_mkdir = true;
            if ($b_mkdir && is_dir($filepathh)) {
                //转存文件到 $dest_file_path路径
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest_file_path)) {
                    $img_url ='/bscy/project/public/'.$flname;
                    $msg="{'url':'".$img_url."','localname':'".$this->jsonString($localName)."','id':1}";
                }
            }
        }
        echo "{'err':'".$this->jsonString($err)."','msg':".$msg."}";

    }
    private function jsonString($str)
    {
        return preg_replace("/([\\\\\/'])/",'\\\$1',$str);
    }



}