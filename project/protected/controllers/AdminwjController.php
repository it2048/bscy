<?php

class AdminwjController extends AdminSet
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
        $pages['countPage'] = AppBsWj::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsWj::model()->findAll($criteria);
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
        $wj_type = Yii::app()->getRequest()->getParam("wj_type", ""); //违纪类型
        $wj_tk = Yii::app()->getRequest()->getParam("wj_tk", ""); //违纪条款
        $wj_al = Yii::app()->getRequest()->getParam("wj_al", ""); //违纪案例
        $wj_zl = Yii::app()->getRequest()->getParam("wj_zl", ""); //违纪资料

        if($wj_type!=""&&$wj_tk!="")
        {
            $model = new AppBsWj();
            $model->wx_type = $wj_type;
            $model->wj_tk = $wj_tk;
            $model->wj_al = $wj_al;
            $model->wj_zj = $wj_zl;
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
            $model = AppBsWj::model()->findByPk($id);
        $this->renderPartial('edit',array("models"=>$model));
    }


    /**
     * 更新幻灯
     */
    public function actionUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $wj_type = Yii::app()->getRequest()->getParam("wj_type", ""); //违纪类型
        $wj_tk = Yii::app()->getRequest()->getParam("wj_tk", ""); //违纪条款
        $wj_al = Yii::app()->getRequest()->getParam("wj_al", ""); //违纪案例
        $wj_zl = Yii::app()->getRequest()->getParam("wj_zl", ""); //违纪资料

        $model = AppBsWj::model()->findByPk($id);
        if($wj_type!=""&&$wj_tk!=""&&!empty($model))
        {
            $model->wx_type = $wj_type;
            $model->wj_tk = $wj_tk;
            $model->wj_al = $wj_al;
            $model->wj_zj = $wj_zl;
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
            if(AppBsWj::model()->deleteByPk($id))
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

}