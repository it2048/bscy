<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/20
 * Time: 下午1:08
 */

class AdmincontractsController extends AdminSet
{


    /**
     * 导入功能显示页面
     */
    public function actionVimport(){
        $this->renderPartial('_import');
    }

    /**
     * 导入功能显示页面
     */
    public function actionDrdeal(){
        $this->renderPartial('_deal');
    }

    /**
     * 导入功能
     */
    public function actionDeal(){
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $month = Yii::app()->getRequest()->getParam("dl_time", ""); //月份

        $month = strtotime($month);
        if(!empty($_FILES['obj']['name']))
        {
            $_tmp_pathinfo = pathinfo($_FILES['obj']['name']);

            if (strtolower($_tmp_pathinfo['extension'])=="csv") {
                //设置文件路径
                $flname = "upload/emp".time().".".strtolower($_tmp_pathinfo['extension']);
                $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                $filepathh = dirname($dest_file_path);
                if (!file_exists($filepathh))
                    $b_mkdir = mkdir($filepathh, 0777, true);
                else
                    $b_mkdir = true;
                if ($b_mkdir && is_dir($filepathh)) {
                    //转存文件到 $dest_file_path路径
                    if (move_uploaded_file($_FILES['obj']['tmp_name'], $dest_file_path)) {
                        $msg["msg"] = AppBsTemp::model()->dealCsv($dest_file_path,$month);
                        $msg["code"] = 0;
                        unlink($dest_file_path);
                    } else {
                        $msg["msg"] = '文件上传失败';
                    }
                }
            } else {
                $msg["msg"] = '上传的文件格式需要是csv';
            }
        }
        echo json_encode($msg);
    }

    /**
     * 导入功能
     */
    public function actionImport(){
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $month = Yii::app()->getRequest()->getParam("month", ""); //月份

        $month = strtotime($month);
        if(!empty($_FILES['obj']['name']))
        {
            $_tmp_pathinfo = pathinfo($_FILES['obj']['name']);

            if (strtolower($_tmp_pathinfo['extension'])=="csv") {
                //设置文件路径
                $flname = "upload/emp".time().".".strtolower($_tmp_pathinfo['extension']);
                $dest_file_path = Yii::app()->basePath . '/../public/'.$flname;
                $filepathh = dirname($dest_file_path);
                if (!file_exists($filepathh))
                    $b_mkdir = mkdir($filepathh, 0777, true);
                else
                    $b_mkdir = true;
                if ($b_mkdir && is_dir($filepathh)) {
                    //转存文件到 $dest_file_path路径
                    if (move_uploaded_file($_FILES['obj']['tmp_name'], $dest_file_path)) {
                        $msg["msg"] = AppBsContracts::model()->storeCsv($dest_file_path,$month);
                        $msg["code"] = 0;
                        unlink($dest_file_path);
                    } else {
                        $msg["msg"] = '文件上传失败';
                    }
                }
            } else {
                $msg["msg"] = '上传的文件格式需要是csv';
            }
        }
        echo json_encode($msg);
    }


    /**
     * 合同追踪流程
     */
    public function actionIndex()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['yj_time'] = Yii::app()->getRequest()->getParam("yj_time", date('Y-m',time())); //每页多少条数据

        $tm = strtotime($pages['yj_time']);
        $tm = mktime(0,0,0,date("m",$tm),1,date("Y",$tm));
        $e2 = mktime(23,59,59,date('m',$tm),date('t'),date('Y',$tm));
        $criteria = new CDbCriteria;
        $uname = Yii::app()->user->getState('username');
        $bm_arr = AppBsEmp::model()->find("hyp='{$uname}'");
        if(!empty($bm_arr))
        {
            $bm_id = $bm_arr->bm_id;
            $criteria->addCondition("bm_id='{$bm_id}'");
            $criteria->addCondition("dr_time>={$tm} AND dr_time<={$e2}");
            $pages['countPage'] = AppBsContracts::model()->count($criteria);
            $criteria->limit = $pages['numPerPage'];
            $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
            $criteria->order = 'dr_time DESC';
            $allList = AppBsContracts::model()->findAll($criteria);
        }
        else
            $allList = array();


        $this->renderPartial('index', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    /**
     * 违纪餐厅申请列表
     */
    public function actionAdmin()
    {
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['slt'] = Yii::app()->getRequest()->getParam("slt", 0); //每页多少条数据


        $criteria = new CDbCriteria;
        $criteria->addCondition("stage = {$pages['slt']}");
        $pages['countPage'] = AppBsContracts::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'dr_time DESC';
        $allList = AppBsContracts::model()->findAll($criteria);

        $this->renderPartial('admin', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }


    /**
     * 添加幻灯
     */
    public function actionSh()
    {
        $msg = $this->msgcode();
        $ids = Yii::app()->getRequest()->getParam("ids", ""); //身份证

        if($this->Mail($ids)){
            $this->msgsucc($msg);
            AppBsContracts::model()->updateAll(array("yj_time"=>time()),"id in({$ids})");
        }
        else
            $msg['msg']="批量处理成功，但邮件发送失败，请刷新页面后手动发送邮件";
        echo json_encode($msg);
    }

    /**
     * 添加幻灯
     */
    public function actionPl()
    {
        $msg = $this->msgcode();
        $ids = Yii::app()->getRequest()->getParam("ids", ""); //身份证
        $type = Yii::app()->getRequest()->getParam("type", 0); //身份证
        $this->msgsucc($msg);
        AppBsContracts::model()->updateAll(array("stage"=>$type,"ct_time"=>time()),"id in({$ids})");
        echo json_encode($msg);
    }

    public function actionExp()
    {
        $allList = AppBsContracts::model()->findAll();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="劳动合同追踪信息表.csv"');
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'a');
        // 输出Excel列名信息
        $arr = TempList::$Contracts;
        array_push($arr,"导入时间");
        array_push($arr,"邮寄时间");
        array_push($arr,"餐厅处理时间");
        array_push($arr,"餐厅处理状态");

        $head = $arr;
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }
        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);
        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;

        foreach($allList as $value)
        {
            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }

            $dearr = explode("|",$value->desc);

            $row = array(-1=>$value['bm_id'])+$dearr+array(
                    19=>empty($value['dr_time'])?"":date("Y-m-d H:i:s",$value['dr_time']),
                    20=>empty($value['yj_time'])?"":date("Y-m-d H:i:s",$value['yj_time']),
                    21=>empty($value['ct_time'])?"":date("Y-m-d H:i:s",$value['ct_time']),
                    22=>TempList::$ct_status[$value['stage']]
                );
            foreach ($row as $i => $v) {
                // CSV的Excel支持GBK编码，一定要转换，否则乱码
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            fputcsv($fp, $row);
        }
    }

    public function actionExptp()
    {
        $allList = AppBsTemp::model()->findAll();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="续签人员信息表.csv"');
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'a');
        // 输出Excel列名信息
        $arr = TempList::$dc_tmp;
        $head = $arr;
        foreach ($head as $i => $v) {
            // CSV的Excel支持GBK编码，一定要转换，否则乱码
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }
        // 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $head);
        // 计数器
        $cnt = 0;
        // 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limit = 100000;

        foreach($allList as $value)
        {
            $cnt ++;
            if ($limit == $cnt) { //刷新一下输出buffer，防止由于数据过多造成问题
                ob_flush();
                flush();
                $cnt = 0;
            }
            $row = explode("|",$value->desc);
            foreach ($row as $i => $v) {
                // CSV的Excel支持GBK编码，一定要转换，否则乱码
                $row[$i] = iconv('utf-8', 'gbk', $v);
            }
            //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',print_r($row,true),8);
            fputcsv($fp, $row);
        }
    }

    public function Mail($ids)
    {
        if(empty($ids))
            return false;
        else
        {
            $allList = AppBsContracts::model()->findAll("id in({$ids})");
            $str = "";
            $adArr = array();
            foreach($allList as $val)
            {
                $str .= sprintf("'%s',",$val->bm_id);
            }
            if($str!="")
            {
                $str = rtrim($str,",");
                $str = array_unique(explode(",",$str));
                $str = implode(",",$str);

                $modl = AppBsEmp::model()->findAll("bm_id in({$str})");
                foreach($modl as $val)
                {
                    $email = sprintf("China.%s@yum.com",$val->hyp);
                    $adArr[$val->em_id] = array("email"=>$email,"name"=>$val->name);
                }
            }
            if(!empty($adArr))
            {
                $title = "劳动合同追踪流程";
                $body = "劳动合同已邮寄，请登录系统查看";
                $adArr1 = array();
                array_push($adArr1,array("email"=>"277253251@qq.com","name"=>"熊方磊"));
                array_push($adArr1,array("email"=>"nicky.zeng@yum.com","name"=>"Zeng,Nicky"));
                return $this->postmail($adArr1,$title,$body);
            }else
            {
                return false;
            }
        }
    }

    public function postmail(array $address,$Subject,$body){

        $mail = new PHPMailer(); //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host = "smtp.163.com"; //SMTP服务器 以163邮箱为例子
        $mail->Port = 25;  //邮件发送端口
        $mail->SMTPAuth   = true;  //启用SMTP认证
        $mail->CharSet  = "UTF-8"; //字符集
        $mail->Encoding = "base64"; //编码方式

        $mail->Username = "it2048@163.com";  //你的邮箱
        $mail->Password = "lnrxmvauvzdeujjy";  //你的密码
        $mail->Subject = $Subject; //邮件标题
        $mail->From = "it2048@163.com";  //发件人地址（也就是你的邮箱）
        $mail->FromName = "办公系统";  //发件人姓名
        if(is_array($address))
        {
            foreach($address as $val)
            {
                $mail->AddAddress($val['email'],$val['name']);//添加收件人（地址，昵称）
            }
        }else
        {
            $mail->AddAddress($address,$address);//添加收件人（地址，昵称）
        }
        $mail->IsHTML(true); //支持html格式内容
        $mail->Body = $body; //邮件主体内容
        //发送
        if(!$mail->Send()) {
            return false;
        } else {
            return true;
        }
    }

}