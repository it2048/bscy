<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/24
 * Time: 上午1:31
 */
class AppBsColi extends BsColi
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

    /**
     * 将csv文件保存到数据库中
     *
     * @param string $loadPath csv文件的路径
     * @return int 成功条数
     */
    public function storeCsv($loadPath,$type,$month)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("INSERT INTO %s(`sp_id`,`sp_name`,`sp_dw`,`sp_mn`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        fgetcsv($file_handle);
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            foreach($arr as $k=>$val)
            {
                $arr[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
            }
            if(isset($arr[3])&&!empty($arr[0]))
            {
                $str .= sprintf("('%s','%s','%s','%s'),",
                    $arr[0],$arr[1],$arr[2],$arr[3]);
            }
        }
        fclose($file_handle);
        if(empty($str))
        {
            return "更新数据失败";
        }
        else{
            $this->deleteAll();
            $sql .= rtrim($str,",");
            $sqlCom = $connection->createCommand($sql)->execute();
            return  "添加数据成功";
        }
    }
}