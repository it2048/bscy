<?php
/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * Date: 14-11-27
 * Time: 下午6:26
 */

class AppBsAdmin extends BsAdmin {

    /**
     * 实例化模型
     * @param string $classname
     * @return Authitem|void
     */
    public static function model($classname=__CLASS__)
    {
        return parent::model($classname);
    }

    /**
     * 将csv文件保存到数据库中
     *
     * @param string $loadPath csv文件的路径
     * @return int 成功条数
     */
    public function storeCsv($loadPath,$type)
    {
        $connection = Yii::app()->db;
        $sql = sprintf("REPLACE INTO %s(`username`, `tel`, `name`,
`dep_name`,`type`,`ct_name`,`dh_name`,`ct_boss`,`desc`) VALUES",$this->tableName()); //构造SQL
        $file_handle = fopen($loadPath, "r");
        $header = fgetcsv($file_handle);
        foreach($header as $k=>$val)
        {
            $header[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
        }
        $str = "";
        while (!feof($file_handle)) {
            $arr = fgetcsv($file_handle);
            if(empty($arr[0]))break;
            foreach($arr as $k=>$val)
            {
                $arr[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
            }
            $str .= $this->SetType($arr,$header,$type);
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
    private function SetType($arr,$header,$type)
    {
        if($type==1)
        {
            if(isset($arr[7])&&!empty($arr[0]))
            {
                $i = 5;
                $desc = "";
                while(!empty($header[$i]))
                {
                    $desc .= sprintf('%s:%s \r\n',$header[$i],$arr[$i]);
                    $i++;
                }
                return sprintf("('%s','%s','%s','%s',%s,'','','','%s'),",
                    strtolower($arr[0]),$arr[1],$arr[2],$arr[3]."-".$arr[4],$type,$desc);
            }
        }elseif($type==2)
        {
            if(isset($arr[7])&&!empty($arr[0]))
            {
                $i = 5;
                $desc = "";
                while(!empty($header[$i]))
                {
                    $desc .= sprintf('%s:%s \r\n',$header[$i],$arr[$i]);
                    $i++;
                }
                return sprintf("('%s','%s','%s','%s',%s,'%s','%s','%s','%s'),",
                    strtolower($arr[0]),$arr[1],$arr[2],$arr[3],2,$arr[4],strtoupper($arr[0]),$arr[2],$desc);
            }
        }elseif($type==3)
        {
            if(isset($arr[5])&&!empty($arr[0]))
            {
                $i = 5;
                $desc = "";
                while(!empty($header[$i]))
                {
                    $desc .= sprintf('%s:%s \r\n',$header[$i],$arr[$i]);
                    $i++;
                }
                return sprintf("('%s','%s','%s','%s',%s,'','','','%s'),",
                    strtolower($arr[0]),$arr[1],$arr[2],$arr[3].$arr[4],3,$desc);
            }
        }
    }
}