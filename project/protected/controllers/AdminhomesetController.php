<?php

class AdminhomesetController extends AdminSet
{
    /**
     * 幻灯片管理
     */
    public function actionSlideManager()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $criteria = new CDbCriteria;
        $pages['countPage'] = AppHbSlide::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppHbSlide::model()->findAll($criteria);
        $this->renderPartial('slidemanager', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    /**
     * 链接管理
     */
    public function actionLinkManager()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $criteria = new CDbCriteria;
        $pages['countPage'] = AppHbLink::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppHbLink::model()->findAll($criteria);
        $this->renderPartial('linkmanager', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    /**
     * 添加幻灯
     */
    public function actionSlideAdd()
    {
        $this->renderPartial('slideadd');
    }


    /**
     * 添加链接
     */
    public function actionLinkAdd()
    {
        $this->renderPartial('linkadd');
    }

    /**
     * 保存幻灯
     */
    public function actionSlideSave()
    {
        $msg = $this->msgcode();
        $type = Yii::app()->getRequest()->getParam("slide_type", 1); //用户名
        $title = Yii::app()->getRequest()->getParam("slide_title", ""); //用户名

        $redirect = Yii::app()->getRequest()->getParam("slide_redirect", ""); //用户名
        $content = Yii::app()->getRequest()->getParam("content", ""); //用户名
        $username = $this->getUserName(); //用户名

        if(!empty($_FILES['slide_up']['name']))
        {
            $img = array("png","jpg");
            $_tmp_pathinfo = pathinfo($_FILES['slide_up']['name']);
            if (in_array(strtolower($_tmp_pathinfo['extension']),$img)) {
                //设置图片路径
                $flname = Yii::app()->params['filetmpcache'].'/'.time().".".md5($username).".".$_tmp_pathinfo['extension'];
                $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                $filepathh = dirname($dest_file_path);
                if (!file_exists($filepathh))
                    $b_mkdir = mkdir($filepathh, 0777, true);
                else
                    $b_mkdir = true;
                if ($b_mkdir && is_dir($filepathh)) {
                    //转存文件到 $dest_file_path路径
                    if (move_uploaded_file($_FILES['slide_up']['tmp_name'], $dest_file_path)) {
                        $img_url ='/public/'.$flname;
                    }
                }
            } else {
                $msg["msg"] = '上传的文件格式只能为jpg,png';
                $msg["code"] = 3;
            }
        }

        if($username!=""&&$title!=""&&$img_url!="")
        {
            $model = new AppHbSlide();
            $model->title = $title;
            $model->type = $type;
            $model->status = 0;
            $model->img_url = $img_url;
            $model->redirect_url = $redirect;
            $model->content = $content;
            $model->add_time = time();
            $model->add_user = $username;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "添加成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }
            
        }else{
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);
    }


    /**
     * 编辑幻灯
     */
    public function actionSlideEdit()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $model = array();
        if($id!="")
            $model = AppHbSlide::model()->findByPk($id);
        $this->renderPartial('slideedit',array("models"=>$model));
    }


    /**
     * 保存链接
     */
    public function actionLinkSave()
    {
        $msg = $this->msgcode();
        $type = Yii::app()->getRequest()->getParam("link_type", 0); //0游戏专区，1合作媒体
        $title = Yii::app()->getRequest()->getParam("link_title", ""); //标题
        $img_url = Yii::app()->getRequest()->getParam("link_img", ""); //图片地址
        $redirect = Yii::app()->getRequest()->getParam("link_redirect", ""); //跳转地址
        $username = $this->getUserName(); //用户名
        if($img_url=="")
        {
            if(!empty($_FILES['link_up']['name']))
            {
                $img = array("png","jpg");
                $_tmp_pathinfo = pathinfo($_FILES['link_up']['name']);
                if (in_array(strtolower($_tmp_pathinfo['extension']),$img)) {
                    //设置图片路径
                    $flname = Yii::app()->params['filetmpcache'].'/'.time().".".md5($username).".".$_tmp_pathinfo['extension'];
                    $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                    $filepathh = dirname($dest_file_path);
                    if (!file_exists($filepathh))
                        $b_mkdir = mkdir($filepathh, 0777, true);
                    else
                        $b_mkdir = true;
                    if ($b_mkdir && is_dir($filepathh)) {
                        //转存文件到 $dest_file_path路径
                        if (move_uploaded_file($_FILES['link_up']['tmp_name'], $dest_file_path)) {
                            $img_url ='/public/'.$flname;
                        }
                    }
                } else {
                    $msg["msg"] = '上传的文件格式只能为jpg,png';
                    $msg["code"] = 3;
                }
            }
        }
        if($username!=""&&$title!=""&&$img_url!="")
        {
            $model = new AppHbLink();
            $model->title = $title;
            $model->type = $type;
            $model->img_url = $img_url;
            $model->link_url = $redirect;
            $model->add_time = time();
            $model->add_user = $username;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "添加成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);
    }
    /**
     * 编辑链接
     */
    public function actionLinkEdit()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $model = array();
        if($id!="")
            $model = AppHbLink::model()->findByPk($id);
        $this->renderPartial('linkedit',array("models"=>$model));
    }

    
    /**
     * 上传文件到服务器
     */
    public function actionImgUpload() {
        
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
            $username = md5($this->getUserName()); //用户名
            $_tmp_pathinfo = pathinfo($_FILES[$inputName]['name']);
            //设置图片路径
            $flname = Yii::app()->params['filetmpcache'].'/'.time().".".$username.".".$_tmp_pathinfo['extension'];
            $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
            $filepathh = dirname($dest_file_path);
            if (!file_exists($filepathh))
                $b_mkdir = mkdir($filepathh, 0777, true);
            else
                $b_mkdir = true;
            if ($b_mkdir && is_dir($filepathh)) {
                //转存文件到 $dest_file_path路径
                if (move_uploaded_file($_FILES[$inputName]['tmp_name'], $dest_file_path)) {
                    $img_url ='http://rs.windplay.cn/public/'.$flname;
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
    
    /**
     * 更新幻灯
     */
    public function actionSlideUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $type = Yii::app()->getRequest()->getParam("slide_type", 1); //用户名
        $status = Yii::app()->getRequest()->getParam("slide_status", 0); //用户名
        $title = Yii::app()->getRequest()->getParam("slide_title", ""); //用户名
        $redirect = Yii::app()->getRequest()->getParam("slide_redirect", ""); //用户名
        
        $content = Yii::app()->getRequest()->getParam("content", ""); //用户名
        $username = $this->getUserName(); //用户名
        $model = AppHbSlide::model()->findByPk($id);
        $img_url = $model->img_url;
        if(!empty($_FILES['slide_up']['name']))
        {
            $img = array("png","jpg");
            $_tmp_pathinfo = pathinfo($_FILES['slide_up']['name']);
            if (in_array(strtolower($_tmp_pathinfo['extension']),$img)) {
                //设置图片路径
                $flname = Yii::app()->params['filetmpcache'].'/'.time().".".md5($username).".".$_tmp_pathinfo['extension'];
                $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                $filepathh = dirname($dest_file_path);
                if (!file_exists($filepathh))
                    $b_mkdir = mkdir($filepathh, 0777, true);
                else
                    $b_mkdir = true;
                if ($b_mkdir && is_dir($filepathh)) {
                    //转存文件到 $dest_file_path路径
                    if (move_uploaded_file($_FILES['slide_up']['tmp_name'], $dest_file_path)) {
                        $img_url ='/public/'.$flname;
                        if(strpos($model->img_url,"http://")===false)
                            @unlink(Yii::app()->basePath . '/..'.$model->img_url);
                    }
                }
            } else {
                $msg["msg"] = '上传的文件格式只能为jpg,png';
                $msg["code"] = 3;
            }
        }


        if($username!=""&&$title!=""&&$img_url!=""&&$id!="")
        {
            $model->title = $title;
            $model->type = $type;
            $model->status = $status;
            $model->img_url = $img_url;
            $model->redirect_url = $redirect;
            $model->content = $content;
            $model->add_time = time();
            $model->add_user = $username;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "更新成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }
            
        }else
        {
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);
    }

    /**
     * 更新链接
     */
    public function actionLinkUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $type = Yii::app()->getRequest()->getParam("link_type", 0); //0游戏专区，1合作媒体
        $title = Yii::app()->getRequest()->getParam("link_title", ""); //标题
        $img_url = Yii::app()->getRequest()->getParam("link_img", ""); //图片地址
        $redirect = Yii::app()->getRequest()->getParam("link_redirect", ""); //跳转地址
        $username = $this->getUserName(); //用户名
        $model = AppHbLink::model()->findByPk($id);
        if($img_url=="")
        {
            if(!empty($_FILES['link_up']['name']))
            {
                $img = array("png","jpg");
                $_tmp_pathinfo = pathinfo($_FILES['link_up']['name']);
                if (in_array(strtolower($_tmp_pathinfo['extension']),$img)) {
                    //设置图片路径
                    $flname = Yii::app()->params['filetmpcache'].'/'.time().".".md5($username).".".$_tmp_pathinfo['extension'];
                    $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                    $filepathh = dirname($dest_file_path);
                    if (!file_exists($filepathh))
                        $b_mkdir = mkdir($filepathh, 0777, true);
                    else
                        $b_mkdir = true;
                    if ($b_mkdir && is_dir($filepathh)) {
                        //转存文件到 $dest_file_path路径
                        if (move_uploaded_file($_FILES['link_up']['tmp_name'], $dest_file_path)) {
                            $img_url ='/public/'.$flname;
                            if(strpos($model->img_url,"http://")===false)
                                @unlink(Yii::app()->basePath . '/..'.$model->img_url);
                        }
                    }
                } else {
                    $msg["msg"] = '上传的文件格式只能为jpg,png';
                    $msg["code"] = 3;
                }
            }
        }
        if($username!=""&&$title!=""&&$img_url!="")
        {
            $model->title = $title;
            $model->type = $type;
            $model->img_url = $img_url;
            $model->link_url = $redirect;
            $model->add_time = time();
            $model->add_user = $username;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "添加成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);
    }
    

    /**
     * 删除幻灯
     */
    public function actionSlideDel()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            //图片需要一起删除
            $img = AppHbSlide::model()->findByPk($id);
            if(AppHbSlide::model()->deleteByPk($id))
            {
                if(strpos($img->img_url,"http://")===false)
                    @unlink(Yii::app()->basePath . '/..'.$img->img_url);
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
     * 删除链接
     */
    public function actionLinkDel()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            //图片需要一起删除
            $img = AppHbLink::model()->findByPk($id);
            if(AppHbLink::model()->deleteByPk($id))
            {
                if(strpos($img->img_url,"http://")===false)
                    @unlink(Yii::app()->basePath . '/..'.$img->img_url);
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
}