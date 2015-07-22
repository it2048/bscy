<?php
/**
 * Created by PhpStorm.
 * User: xfl
 * Date: 2015/7/9
 * Time: 19:12
 */

class AppBsArt extends BsArt
{

    /**
     * 实例化模型
     * @param string $classname
     * @return Authitem|void
     */
    public static function model($classname = __CLASS__)
    {
        return parent::model($classname);
    }
}