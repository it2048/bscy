<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/20
 * Time: 下午1:22
 */

class AppBsTemp extends BsTemp{


    /**
     * 实例化模型
     * @param string $classname
     * @return Authitem|void
     */
    public static function model($classname = __CLASS__)
    {
        return parent::model($classname);
    }

    public function dealCsv($loadPath,$time)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("INSERT INTO %s(`desc`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $tmp = fgetcsv($file_handle);
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            if(date("Y/m/d",$time)>$arr[28]) continue;
            $taot = array(1,9,12,13,16,17,19,29,28,29,28);
            $desc = "";

            foreach($taot as $k=>$val)
            {
                $arr[$val] = trim(iconv("GBK","UTF-8//IGNORE", $arr[$val]));
                $xss = $arr[$val];
                if($k==7)
                    $xss = empty($arr[29])?"无固定期限":"固定期限";
                if($k==8)
                {
                    $xss = empty($arr[29])?"":$arr[28];
                }
                if($k==9)
                {
                    $xss = empty($arr[29])?"":$arr[29];
                }
                if($k==10)
                {
                    $xss = empty($arr[29])?$arr[28]:"";
                }
                $desc .= sprintf("%s|",$xss);
            }
            $desc = rtrim($desc,"|");
            $str .= sprintf("('%s'),",$desc);
        }
        fclose($file_handle);
        if(empty($str))
        {
            return "无数据需要更新";
        }
        else{
            $this->deleteAll();
            $sql .= rtrim($str,",");
            $sqlCom = $connection->createCommand($sql)->execute();
            return  "添加数据成功";
        }
    }
}