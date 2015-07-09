<?php

/**
 * Description of KefuException
 * 自定义系统异常类
 * 
 * Create time : 2012-12-12 9:36:44
 * UTF-8
 * @author xiongfanglei
 */
class KefuException extends Exception{
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}
