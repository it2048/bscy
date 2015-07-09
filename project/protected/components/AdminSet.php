<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class AdminSet extends Controller
{
    
    public function filters()
    {
        return array(
            'AuthCheck'
        );
    }
    public function getUserName()
    {
        return Yii::app()->user->getState('username');
    }
    
    /**
     * 进行权限检查的内联过滤器
     * 当权限检查失败时抛出全局异常
     * 
     * @param CFilterChain $filterChains
     */
    public function filterAuthCheck($filterChains)
    {
        // 未登录用户直接调转到首页，强制重新登录
        if (Yii::app()->user->isGuest)
            $this->redirect (Yii::app ()->createAbsoluteUrl ('adminlogin/index'));
        KefuRbacTool::getInstance()->checkAccess();
        $filterChains->run();
    }
    
        /**
     * 统一格式化输出信息
     * @param array $out_info
     * @return string
     */
    public function output(array $data)
    {
        return json_encode($data);
    }
}
