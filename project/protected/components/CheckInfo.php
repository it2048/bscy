<?php

/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * Date: 14-11-25
 * Time: 下午9:33
 */
class CheckInfo {

    /**
     * 验证Email格式
     * @param type $email
     */
    public static function email($email) {
        if (preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,4}$/',$email)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * 正则验证手机号码
     * @param type $phone
     * @return boolean
     */
    public static function phone($phone)
    {
        $reg = '/^1[34578][0-9]{9}/';
        if (preg_match($reg,$phone)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * 验证QQ号码
     * @param type $qq
     * @return boolean
     */
    public static function qq($qq)
    {
        if (preg_match('/^\d[0-9]{5,15}$/',$qq)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function check_account($str)
    {
        $reg3 = '/^[\_a-zA-Z0-9]+$/';
        if (preg_match($reg3,$str)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
