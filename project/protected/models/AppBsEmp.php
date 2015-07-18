<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/15
 * Time: 下午5:50
 */

class AppBsEmp extends BsEmp
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
        $sql = sprintf("INSERT INTO %s(`em_id`,`name`,`hyp`,`bm_id`,`sf_id`,`zw_name`,`ct_name`) VALUES",$this->tableName()); //构造SQL
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
            if(isset($arr[7])&&!empty($arr[0]))
            {
                $str .= sprintf("('%s','%s','%s','%s','%s','%s','%s-%s'),",
                    $arr[0],$arr[1],strtolower($arr[2]),$arr[3],$arr[4],$arr[5],$arr[7],$arr[6]);
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