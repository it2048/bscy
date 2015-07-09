<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserIdentity extends CUserIdentity  
{
    
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }
    
    public function authenticate()  
    {
        $record= AppBsPwd::model()->findByAttributes(array('username'=>$this->username));
        if($record===null)  
            $this->errorCode=self::ERROR_USERNAME_INVALID;  
        else if($record->password!==md5($this->password))  
            $this->errorCode=self::ERROR_PASSWORD_INVALID;  
        else  
        {  
            $this->username=$record->username;
            $this->errorCode=self::ERROR_NONE;  
        }
        return $this->errorCode;
    }
    public function getUserName()
    {
        return $this->username;
    }
}

