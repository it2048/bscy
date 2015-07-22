<?php

class HomeController extends Controller
{

    public function actionIndex()
    {
        $id = Yii::app()->getRequest()->getParam("id", ""); //月份
        $model = AppBsArt::model()->findByPk($id);
        $this->renderPartial('index',array(
            'models' => $model));
    }

}