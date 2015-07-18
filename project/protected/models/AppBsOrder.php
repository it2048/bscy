<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/16
 * Time: 下午1:36
 */
class AppBsOrder extends BsOrder
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