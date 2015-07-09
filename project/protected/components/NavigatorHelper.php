<?php
/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * 导航栏工具
 * Date: 14-12-2
 * Time: 上午10:17
 */
class NavigatorHelper
{

    private static $_instance;
    private $user_id;
    private $is_super_user = FALSE;

    /**
     * 当前用户的可支配任务
     * @var Object
     */
    private $list_pre_tasks = array();

    /**
     * 单例
     * @return NavigatorHelper
     */
    public static function getInstance()
    {
        if (NULL == NavigatorHelper::$_instance)
            NavigatorHelper::$_instance = new NavigatorHelper ();
        return NavigatorHelper::$_instance;
    }

    public function __construct()
    {
        $this->user_id = Yii::app()->user->id;
        // 对于超级用户，功能导航栏全开
        if (in_array($this->user_id, Yii::app()->params['super_admin']))
            $this->is_super_user = TRUE;
        $_list_tasks = KefuRbacTool::getInstance()->getAllTaskOnRole($this->user_id);
        foreach ($_list_tasks as $_raw_task_item)
        {
            $_rights_tmp = explode('-', $_raw_task_item);
            $pre_label = (2 == count($_rights_tmp)) ? $_rights_tmp[1] : $_rights_tmp[0];
            if (!in_array($pre_label, $this->list_pre_tasks))
                array_push($this->list_pre_tasks, $pre_label);
        }
    }

    public function actionTest()
    {
        echo '<pre>'.print_r($this->list_pre_tasks, true).'</pre>';
        echo $this->user_id;
    }


    /**
     * 打印导航栏信息
     *
     * @param String $belong
     * @param String $action
     * @param String $rel
     * @param String $label
     */
    public function printNavigator($action, $rel, $label, $param = array(),$external="false")
    {
        if (in_array($label, $this->list_pre_tasks) || $this->is_super_user)
        {
            echo sprintf('<li><a href="%s" target="navTab" external="%s" rel="%s">%s</a></li>',
                Yii::app()->createAbsoluteUrl($action, $param),$external, $rel, $label);
        }
    }
}