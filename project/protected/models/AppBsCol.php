<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/24
 * Time: 上午1:31
 */
class AppBsCol extends BsCol
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


    private  function getArr($tp1,$colAll)
    {
        $sendArr = array();
        foreach($tp1 as $k=>$val)
        {
            $tp1[$k] = trim(iconv("GBK","UTF-8//IGNORE", $val));
        }
        $sendArr[0] = array_slice($tp1,4,$colAll[0]);
        $sendArr[1] = array_slice($tp1,$colAll[0],$colAll[1]-$colAll[0]);
        $sendArr[2] = array_slice($tp1,$colAll[1],$colAll[2]-$colAll[1]);
        $sendArr[3] = array_slice($tp1,$colAll[2],$colAll[3]-$colAll[2]);
        $sendArr[4] = array_slice($tp1,$colAll[3],$colAll[4]-$colAll[3]);
        $sendArr[5] = array_slice($tp1,$colAll[4],$colAll[5]-$colAll[4]);
        $sendArr[6] = array_slice($tp1,$colAll[5]);
        return $sendArr;
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
        $i = 0;
        $colAll = array();
        foreach($tp as $k=>$val)
        {
            if($k!==0&&trim($val) != "")
            {
                $colAll[$i] = $k;
                $i++;
            }
        }
        $tp1 = fgetcsv($file_handle);
        $sendArr = $this->getArr($tp1,$colAll);

        $tp2 = fgetcsv($file_handle);
        $sendArr2 = $this->getArr($tp2,$colAll);

        foreach($sendArr2 as $k=>$val)
        {
            foreach($val as $k1=>$v1)
            {
                if($sendArr[$k][$k1]=="")
                    $sendArr[$k][$k1] = isset($sendArr[$k][$k1-1])?$sendArr[$k][$k1-1]:$sendArr[$k][$k1];
                $sendArr2[$k][$k1] = $sendArr[$k][$k1].$v1;
            }
            if($k==0)
            {
                $sendArr2[$k]['min'] = 4;
                $sendArr2[$k]['max'] = $colAll[0];
            }elseif($k==6)
            {
                $sendArr2[$k]['min'] = $colAll[5];
                $sendArr2[$k]['max'] = "";
            }
            else{
                $n = $k-1;
                $sendArr2[$k]['min'] = $colAll[$n];
                $sendArr2[$k]['max'] = $colAll[$k]-$colAll[$n];
            }
        }
        $dec = json_encode($sendArr2);


        $model = AppBsColi::model()->findByPk($month);
        if(empty($model))
        {
            $model = new AppBsColi();
            $model->month = $month;
            $model->type = 0;
        }
        $model->desc  = $dec;
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