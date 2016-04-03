<?php

class AdmingController extends AdminSet
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

        $pages['scate'] = Yii::app()->getRequest()->getParam("scate", 0); //每页多少条数据

        $pages['sno'] = Yii::app()->getRequest()->getParam("sno", ""); //每页多少条数据


        $criteria = new CDbCriteria;
        $pages['scate']&&$criteria->addCondition("scate={$pages['scate']}");
        $pages['sno']&&$criteria->addCondition("sno='{$pages['sno']}'");


        $pages['countPage'] = Arena::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = Arena::model()->findAll($criteria);
        $this->renderPartial('index', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

}