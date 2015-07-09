<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class HttpRequest extends CHttpRequest
{
    public $noCsrfValidationRoutes=array();

    protected function normalizeRequest()
    {
        //attach event handlers for CSRFin the parent
        parent::normalizeRequest();
        //remove the event handler CSRF if this is a route we want skipped
        if($this->enableCsrfValidation)
        {
            $url=Yii::app()->getUrlManager()->parseUrl($this);
            $t = strpos($url,"/");
            if($t!==FALSE)
            {
                $url = substr($url,0,$t);
                if(in_array($url,$this->noCsrfValidationRoutes))
                    Yii::app()->detachEventHandler('onBeginRequest',array($this,'validateCsrfToken'));
                
            }
        }
    }
}