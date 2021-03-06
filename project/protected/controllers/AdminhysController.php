<?php

class AdminhysController extends AdminSet
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
        $pages['countPage'] = AppBsHys::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsHys::model()->findAll($criteria);
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
     * 保存幻灯
     */
    public function actionSave()
    {
        $msg = $this->msgcode();
        $hys_city = Yii::app()->getRequest()->getParam("hys_city", ""); //h会议室城市
        $hys_name = Yii::app()->getRequest()->getParam("hys_name", ""); //会议室名称
        $hys_num = Yii::app()->getRequest()->getParam("hys_num", ""); //会议室容纳人数
        $hys_desc = Yii::app()->getRequest()->getParam("hys_desc", ""); //会议室描述

        if($hys_city!=""&&$hys_name!="")
        {
            $model = new AppBsHys();
            $model->city = $hys_city;
            $model->name = $hys_name;
            $model->num = $hys_num;
            $model->desc = $hys_desc;
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
    public function actionEdit()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $model = array();
        if($id!="")
            $model = AppBsHys::model()->findByPk($id);
        $this->renderPartial('edit',array("models"=>$model));
    }


    /**
     * 更新幻灯
     */
    public function actionUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $hys_city = Yii::app()->getRequest()->getParam("hys_city", ""); //h会议室城市
        $hys_name = Yii::app()->getRequest()->getParam("hys_name", ""); //会议室名称
        $hys_num = Yii::app()->getRequest()->getParam("hys_num", ""); //会议室容纳人数
        $hys_desc = Yii::app()->getRequest()->getParam("hys_desc", ""); //会议室描述
        $model = AppBsHys::model()->findByPk($id);

        if($hys_city!=""&&$hys_name!="")
        {
            $model->city = $hys_city;
            $model->name = $hys_name;
            $model->num = $hys_num;
            $model->desc = $hys_desc;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "修改成功";
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
    public function actionDel()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            if(AppBsHys::model()->deleteByPk($id))
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
    public function actionDelor()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            if(AppBsDhy::model()->deleteByPk($id))
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
     * 幻灯片管理
     */
    public function actionManager()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据
        $pages['hys_time'] = Yii::app()->getRequest()->getParam("hys_time",date('Ymd')); //每页多少条数据


        $criteria = new CDbCriteria;
        $pages['countPage'] = AppBsHys::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsHys::model()->findAll($criteria);

        $model = AppBsDhy::model()->findAll("d_time={$pages['hys_time']}");
        $tk = array();
        foreach($model as $val)
        {
            if(!isset($tk[$val->hys_no]))
                $tk[$val->hys_no] = array();
            array_push($tk[$val->hys_no],array("k"=>$val->st_time,"j"=>$val->sp_time));
        }

        $this->renderPartial('manager', array(
            'models' => $allList,
            'tm'=>$tk,
            'pages' => $pages),false,true);
    }

    /**
     * 幻灯片管理
     */
    public function actionAdmin()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据
        $pages['hys_time'] = Yii::app()->getRequest()->getParam("hys_time",date('Ymd')); //每页多少条数据


        $criteria = new CDbCriteria;
        $pages['countPage'] = AppBsHys::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsHys::model()->findAll($criteria);

        $model = AppBsDhy::model()->findAll("d_time={$pages['hys_time']}");
        $tk = array();
        foreach($model as $val)
        {
            if(!isset($tk[$val->hys_no]))
                $tk[$val->hys_no] = array();
            array_push($tk[$val->hys_no],array("k"=>$val->st_time,"j"=>$val->sp_time));
        }

        $this->renderPartial('admin', array(
            'models' => $allList,
            'tm'=>$tk,
            'pages' => $pages),false,true);
    }

    /**
     * 幻灯片管理
     */
    public function actionDetail()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 500); //每页多少条数据
        $pages['hys_time'] = Yii::app()->getRequest()->getParam("hysyd_time",date('Ymd')); //每页多少条数据

        $pages['id'] = Yii::app()->getRequest()->getParam("id",0); //会议室编号

        $criteria = new CDbCriteria;
        $criteria->addCondition("hys_no={$pages['id']}");
        $criteria->addCondition("d_time={$pages['hys_time']}");

        $pages['countPage'] = AppBsDhy::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsDhy::model()->findAll($criteria);

        $hys = AppBsHys::model()->findByPk($pages['id']);

        $this->renderPartial('detail', array(
            'models' => $allList,
            'hys'=>$hys,
            'pages' => $pages),false,true);
    }
    public function actionAdmind()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 500); //每页多少条数据
        $pages['hys_time'] = Yii::app()->getRequest()->getParam("hysyd_time",date('Ymd')); //每页多少条数据

        $pages['id'] = Yii::app()->getRequest()->getParam("id",0); //会议室编号

        $criteria = new CDbCriteria;
        $criteria->addCondition("hys_no={$pages['id']}");
        $criteria->addCondition("d_time={$pages['hys_time']}");

        $pages['countPage'] = AppBsDhy::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsDhy::model()->findAll($criteria);

        $hys = AppBsHys::model()->findByPk($pages['id']);

        $this->renderPartial('admin_d', array(
            'models' => $allList,
            'hys'=>$hys,
            'pages' => $pages),false,true);
    }


    /**
     * 编辑幻灯
     */
    public function actionOrder()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $time = Yii::app()->getRequest()->getParam("hysyd_time",date('Ymd')); //每页多少条数据

        $model = array();
        if($id!="")
            $model = AppBsHys::model()->findByPk($id);
        $this->renderPartial('order',array("models"=>$model,"time"=>$time));
    }

    /**
     * 保存幻灯
     */
    public function actionSetorder()
    {
        $msg = $this->msgcode();
        $dhys_id = Yii::app()->getRequest()->getParam("dhys_id", 0); //会议室编号
        $dhys_time = Yii::app()->getRequest()->getParam("dhys_time", ""); //预定日期
        $dhys_sttime = Yii::app()->getRequest()->getParam("dhys_sttime", ""); //开始时间
        $dhys_sptime = Yii::app()->getRequest()->getParam("dhys_sptime", ""); //结束时间

        $dhys_ydbm = Yii::app()->getRequest()->getParam("dhys_ydbm", ""); //预定部门
        $dhys_ydr = Yii::app()->getRequest()->getParam("dhys_ydr", ""); //预定人
        $dhys_zcr = Yii::app()->getRequest()->getParam("dhys_zcr", ""); //主持人
        $dhys_yhr = Yii::app()->getRequest()->getParam("dhys_yhr", ""); //参加人

        $dhys_nr = Yii::app()->getRequest()->getParam("dhys_nr", ""); //内容
        $dhys_zj = Yii::app()->getRequest()->getParam("dhys_zj", array()); //需要的设备


        if($dhys_time<date('Ymd'))
        {
            $msg['msg'] = "预定日期不能小于当前日期";
        }
        elseif($dhys_sttime>=$dhys_sptime)
        {
            $msg['msg'] = "开始时间必须小于结束时间";

        }
        elseif($dhys_id!=""&&$dhys_time!=""&&$dhys_ydbm!=""&&$dhys_ydr!="")
        {
            $mod = AppBsDhy::model()->findAll("hys_no={$dhys_id} AND d_time = {$dhys_time} AND ((st_time<{$dhys_sttime} AND
            sp_time>{$dhys_sttime}) OR (st_time<{$dhys_sptime} AND sp_time>{$dhys_sptime}) OR
            (st_time>={$dhys_sttime} AND sp_time<={$dhys_sptime}))");
            if(empty($mod))
            {
                $model = new AppBsDhy();
                $model->d_time = $dhys_time;
                $model->d_bm = $dhys_ydbm;
                $model->ydr = $dhys_ydr;
                $model->d_nr = $dhys_nr;

                $model->d_hyr = $dhys_zcr;
                $model->d_cjr = $dhys_yhr;
                $model->st_time = $dhys_sttime;
                $model->sp_time = $dhys_sptime;

                $model->hys_no = $dhys_id;
                $model->ljx = in_array(1,$dhys_zj)?1:0;
                $model->ht = in_array(2,$dhys_zj)?1:0;
                $model->ykq = in_array(3,$dhys_zj)?1:0;

                if($model->save())
                {
                    $this->msgsucc($msg);
                    $msg['msg'] = "添加成功";
                }else
                {
                    $msg['msg'] = "SOS开始时间与结束时间只支持整点";
                }
            }else
            {
                $msg['msg'] = "^_^ Sorry!该时间段会议室被占用，请重新填写时间";
            }

        }else{
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);
    }

}