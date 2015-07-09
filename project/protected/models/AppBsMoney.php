<?php
/**
 * Created by PhpStorm.
 * User: xfl
 * Date: 2015/7/9
 * Time: 19:12
 */

class AppBsMoney extends BsMoney
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
        $sql = sprintf("INSERT INTO %s(`type`, `month`, `cb_id`,
`yg_id`,`yg_name`,`desc`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $header = fgetcsv($file_handle);
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
                $i = 3;
                $desc = "";
                while(!empty($header[$i]))
                {
                    $desc .= sprintf('%s|',$arr[$i]);
                    $i++;
                }
                $str .= sprintf("(%s,%s,'%s','%s','%s','%s'),",$type,$month,
                    $arr[0],$arr[1],$arr[2],$desc);
            }
        }
        fclose($file_handle);
        if(empty($str))
        {
            return "更新数据失败";
        }
        else{
            $sql .= rtrim($str,",");
            $sqlCom = $connection->createCommand($sql)->execute();
            return  "添加数据成功";
        }
    }
}