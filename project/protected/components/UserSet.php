<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class UserSet extends Controller
{

    public function filters()
    {
        return array(
            'AuthCheck'
        );
    }

    /**
     * 进行权限检查的内联过滤器
     * 当权限检查失败时抛出全局异常
     *
     * @param CFilterChain $filterChains
     */
    public function filterAuthCheck($filterChains)
    {

        if(empty(Yii::app()->session['info']))
        {
            $this->redirect (Yii::app ()->createAbsoluteUrl ('passport/index'));
        }else
        {
            if(Yii::app()->session['info']['logintime']+86400<time())
            {
                $this->redirect (Yii::app ()->createAbsoluteUrl ('passport/index'));
            }
        }

        $filterChains->run();
    }

}
