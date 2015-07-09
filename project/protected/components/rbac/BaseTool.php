<?php
/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * Date: 14-12-2
 * Time: 上午10:32
 */
class BaseTool
{
    /**
     * 获取应用中所有的控制器
     *
     * @return string
     */
    public function allControllers()
    {
        $arr_controllers = array();
        $dir_controller = Yii::app()->basePath . DIRECTORY_SEPARATOR . 'controllers';
        if (is_dir($dir_controller))
        {
            if (($h_dir = @opendir($dir_controller)))
            {
                while ($file = readdir($h_dir))
                {
                    $match_times = preg_match('/(.*Controller).php$/', $file, $match_class);
                    if (is_int($match_times) &&
                        (1 == $match_times))
                    {
                        array_push($arr_controllers, $match_class[1]);
                    }
                }
            }
        }

        return $arr_controllers;
    }

    /**
     * 获取指定控制器下的所有action
     *
     * @param string $controller
     * @return array
     */
    public function allActions($controller = '')
    {
        return empty($controller) ? $this->_allActions() :
            $this->_allActionsInController($controller);
    }

    /**
     * 获取所有控制器下面的所有动作
     * @return array
     */
    private function _allActions()
    {
        $arr_actions = array();
        $_controllers = $this->allControllers();
        foreach ($_controllers as $_controller_item)
        {
            $arr_actions = array_merge($arr_actions,
                $this->_allActionsInController($_controller_item));
        }
        return $arr_actions;
    }

    /**
     * 获取指定控制其下面的所有动作
     * @param string $controller
     * @return array
     */
    private function _allActionsInController($controller)
    {
        $arr_actions = array();
        $module_name = 'application.controllers.' . $controller;
        Yii::import($module_name);
        if (class_exists($controller))
        {
            $allActions = get_class_methods($controller);
            foreach ($allActions as $_action)
            {
                if (preg_match('/^action(.*)/', $_action, $_matchs))
                {
                    if ($_matchs[1] != 's')
                        array_push($arr_actions, strtolower($controller.'-'.$_matchs[1]));
                }
            }
        }
        return $arr_actions;
    }
}