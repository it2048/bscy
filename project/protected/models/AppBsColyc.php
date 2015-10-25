<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/21
 * Time: 下午1:37
 */

class AppBsColyc extends BsColyc
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

    private  function getArr($tp1)
    {
        foreach($tp1 as $k=>$val)
        {
            $tp1[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
        }
        return $tp1;
    }
    /**
     * 将csv文件保存到数据库中
     *
     * @param string $loadPath csv文件的路径
     * @return int 成功条数
     */
    public function storeCsv($loadPath,$month)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("INSERT INTO %s(`month`,`am`,`dm`,`ct_id`,`desc`,`ct_name`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $tp = fgetcsv($file_handle);
        $tp = $this->getArr($tp);
        array_splice($tp,0,4);
        $model = AppBsColi::model()->find("type=1 and month={$month}");
        if(empty($model))
        {
            $model = new AppBsColi();
            $model->month = $month;
            $model->type = 1;
        }
        $model->desc  = json_encode($tp);
        $model->save();
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            foreach($arr as $k=>$val)
            {
                $arr[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
            }
            $desca = implode("|!|",$arr);
            if(isset($arr[3])&&!empty($arr[0]))
            {
                $str .= sprintf("('%s','%s','%s','%s','%s','%s'),",$month,
                    $arr[0],$arr[1],$arr[2],$desca,$arr[3]);
            }
        }
        fclose($file_handle);
        if(empty($str))
        {
            return "更新数据失败";
        }
        else{
            $this->deleteAll("month=:mh",array(":mh"=>$month));
            $sql .= rtrim($str,",");
            $sqlCom = $connection->createCommand($sql)->execute();
            return  "添加数据成功";
        }
    }
}