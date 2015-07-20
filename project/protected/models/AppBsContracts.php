<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/20
 * Time: 下午1:22
 */

class AppBsContracts extends BsContracts{


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
    public function storeCsv($loadPath,$month)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("INSERT INTO %s(`dr_time`,`bm_id`,`desc`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $tmp = fgetcsv($file_handle);
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            $desc = "";
            foreach($arr as $k=>$val)
            {
                $arr[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
                if($k>0&&!empty($tmp[$k]))
                {
                    $desc .= sprintf('%s|',$arr[$k]);
                }
            }
            $desc = rtrim($desc,"|");
            //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',$desc,8);

            if(isset($arr[7])&&!empty($arr[0]))
            {
                $str .= sprintf("(%d,'%s','%s'),",$month,$arr[0],$desc);
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

    public function dealCsv($loadPath)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("INSERT INTO %s(`dr_time`,`bm_id`,`desc`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $tmp = fgetcsv($file_handle);
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            $desc = "";
            foreach($arr as $k=>$val)
            {
                $arr[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
                if($k>0&&!empty($tmp[$k]))
                {
                    $desc .= sprintf('%s|',$arr[$k]);
                }
            }
            $desc = rtrim($desc,"|");
            //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',$desc,8);

            if(isset($arr[7])&&!empty($arr[0]))
            {
                $str .= sprintf("(%d,'%s','%s'),",$month,$arr[0],$desc);
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