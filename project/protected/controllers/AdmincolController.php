<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/15
 * Time: 下午5:53
 */

class AdmincolController extends AdminSet
{
    /**
     * 生成首页
     *
     */
    public function actionIndex()
    {
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['scol_time'] = Yii::app()->getRequest()->getParam("scol_time",date("Ym")); //时间
        $pages['pcol_time'] = Yii::app()->getRequest()->getParam("pcol_time",date("Ym")); //时间

        $pages['col_type'] = Yii::app()->getRequest()->getParam("col_type",0); //类型

        $name  = AppBsAdmin::model()->findByPk($this->getUserName());
        $ctnme = "";
        if(empty(trim($name->name)))
        {
            echo "没有您要查看的信息";die();
        }else
        {
            $ctnme = $name->name;
        }
        if($pages['col_type']!=8)
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$pages['scol_time']} AND month<={$pages['pcol_time']}
            AND (am='{$ctnme}' OR dm='{$ctnme}')");
            $pages['countPage'] = AppBsCol::model()->count($criteria);
            $criteria->limit = $pages['numPerPage'];
            $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
            $allList = AppBsCol::model()->findAll($criteria);
            $col = AppBsColi::model()->find("type=0 and month={$pages['scol_time']}");
            if(empty($col))
            {
                $ms = array();
            }else
            {
                $head = json_decode($col->desc,true);
                $ms = isset($head[$pages['col_type']])?$head[$pages['col_type']]:array();
            }
        }else
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$pages['scol_time']} AND month<={$pages['pcol_time']}");
            $criteria->addInCondition('ct_id',explode(",",$str));
            $pages['countPage'] = AppBsColyc::model()->count($criteria);
            $criteria->limit = $pages['numPerPage'];
            $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
            $allList = AppBsColyc::model()->findAll($criteria);
            $col = AppBsColi::model()->find("type=1 and month={$pages['scol_time']}");
            if(empty($col))
            {
                $ms = array();
            }else
            {
                $ms = json_decode($col->desc,true);
            }
        }

        //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',print_r($ms,true),8);

        $this->renderPartial('index', array(
            'models' => $allList,
            'head' => $ms,
            'pages' => $pages),false,true);
    }

    public function actionAdmin()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['scol_time'] = Yii::app()->getRequest()->getParam("scol_time",date("Ym")); //时间
        $pages['pcol_time'] = Yii::app()->getRequest()->getParam("pcol_time",date("Ym")); //时间

        $pages['col_type'] = Yii::app()->getRequest()->getParam("col_type",0); //类型


        if($pages['col_type']!=8)
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$pages['scol_time']} AND month<={$pages['pcol_time']}");
            $pages['countPage'] = AppBsCol::model()->count($criteria);
            $criteria->limit = $pages['numPerPage'];
            $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
            $allList = AppBsCol::model()->findAll($criteria);
            $col = AppBsColi::model()->find("type=0 and month={$pages['scol_time']}");
            if(empty($col))
            {
                $ms = array();
            }else
            {
                $head = json_decode($col->desc,true);
                $ms = isset($head[$pages['col_type']])?$head[$pages['col_type']]:array();
            }
        }else
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$pages['scol_time']} AND month<={$pages['pcol_time']}");
            $pages['countPage'] = AppBsColyc::model()->count($criteria);
            $criteria->limit = $pages['numPerPage'];
            $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
            $allList = AppBsColyc::model()->findAll($criteria);
            $col = AppBsColi::model()->find("type=1 and month={$pages['scol_time']}");
            if(empty($col))
            {
                $ms = array();
            }else
            {
                $ms = json_decode($col->desc,true);
            }
        }


        //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',print_r($ms,true),8);

        $this->renderPartial('admin', array(
            'models' => $allList,
            'head' => $ms,
            'pages' => $pages),false,true);
    }

    public function actionUseradd()
    {
        $this->renderPartial('useradd');
    }

    /**
     * 删除用户
     */
    public function actionUserdelete()
    {
        $msg = $this->msgcode();
        $username = Yii::app()->getRequest()->getParam("id", ""); //用户名
        if($username!="")
        {
            AppBsEmp::model()->deleteByPk($username);
            $this->msgsucc($msg);
        }else
        {
            $msg['msg'] = "编号不能为空";
        }
        echo json_encode($msg);
    }

    /**
     * 导入功能显示页面
     */
    public function actionVimport(){
        $this->renderPartial('_import');
    }


    /**
     * 导入功能显示页面
     */
    public function actionYc(){
        $this->renderPartial('_ycimport');
    }


    public function actionExport(){
        $this->renderPartial('_export');
    }

    public function actionYcexport(){
        $this->renderPartial('_ycexport');
    }

    public function actionExp()
    {
        $name  = AppBsAdmin::model()->findByPk($this->getUserName());
        $ctnme = "";
        if(empty(trim($name->name)))
        {
            echo "没有您要查看的信息";die();
        }else
        {
            $ctnme = $name->name;
        }

        $msg = $this->msgcode();
        $smonth = Yii::app()->getRequest()->getParam("smonth",date("Ym")); //时间
        $pmonth = Yii::app()->getRequest()->getParam("pmonth",date("Ym")); //时间

        $mcol_type= Yii::app()->getRequest()->getParam("mcol_type",0); //类型

        $col = AppBsColi::model()->find("type=0 and month={$smonth}");
        if(empty($col))
        {
            $msg['msg'] = sprintf("开始时间%s 该月数据为空，请重新选择开始时间",$smonth);
            echo $msg['msg'];
        }else
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$smonth} AND month<={$pmonth}
            AND (am='{$ctnme}' OR dm='{$ctnme}')");
            $allList = AppBsCol::model()->findAll($criteria);

                $head = json_decode($col->desc,true);
                $ms = isset($head[$mcol_type])?$head[$mcol_type]:array();

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="COL.csv"');
            header('Cache-Control: max-age=0');
            $fp = fopen('php://output', 'a');
            // 输出Excel列名信息

            $head1 = array("月份","AM","DM","餐厅编号","餐厅名");
            foreach($ms as $k=>$val)
            {
                if($k==="min")continue;
                if($k==="max")continue;
                array_push($head1,$val);

            }
            foreach ($head1 as $i => $v) {
                // CSV的Excel支持GBK编码，一定要转换，否则乱码
                $head1[$i] = iconv('utf-8', 'gbk', $v);
            }
            // 将数据通过fputcsv写到文件句柄
            fputcsv($fp, $head1);
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

                $mkl = explode("|!|",$value->desc);
                if(isset($ms['min']))
                {
                    $arrr = array($value->month,$value->am,$value->dm,$value->ct_id,$value->ct_name);

                    if(empty($ms['max']))
                        $mkl = array_merge($arrr,array_slice($mkl,$ms['min']));
                    else
                        $mkl = array_merge($arrr,array_slice($mkl,$ms['min'],$ms['max']));
                }
                $row = $mkl;
                foreach ($row as $i => $v) {
                    // CSV的Excel支持GBK编码，一定要转换，否则乱码
                    $row[$i] = iconv('utf-8', 'gbk', $v);
                }
                fputcsv($fp, $row);
            }

        }
    }

    public function actionExpyc()
    {
        $name  = AppBsAdmin::model()->findByPk($this->getUserName());
        $ctnme = "";
        if(empty(trim($name->name)))
        {
            echo "没有您要查看的信息";die();
        }else
        {
            $ctnme = $name->name;
        }
        $msg = $this->msgcode();
        $smonth = Yii::app()->getRequest()->getParam("smonth",date("Ym")); //时间
        $pmonth = Yii::app()->getRequest()->getParam("pmonth",date("Ym")); //时间

        $col = AppBsColi::model()->find("type=1 and month={$smonth}");
        if(empty($col))
        {
            $msg['msg'] = sprintf("开始时间%s 该月数据为空，请重新选择开始时间",$smonth);
            echo $msg['msg'];
        }else
        {
            $criteria = new CDbCriteria;
            $criteria->addCondition("month>={$smonth} AND month<={$pmonth}
            AND (am='{$ctnme}' OR dm='{$ctnme}')");

            $allList = AppBsColyc::model()->findAll($criteria);

            $ms = json_decode($col->desc,true);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="COL.csv"');
            header('Cache-Control: max-age=0');
            $fp = fopen('php://output', 'a');
            // 输出Excel列名信息

            $head1 = array("月份","AM","DM","餐厅编号","餐厅名");
            foreach($ms as $k=>$val)
            {
                array_push($head1,$val);
            }
            foreach ($head1 as $i => $v) {
                // CSV的Excel支持GBK编码，一定要转换，否则乱码
                $head1[$i] = iconv('utf-8', 'gbk', $v);
            }

            // 将数据通过fputcsv写到文件句柄
            fputcsv($fp, $head1);
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

                $mkl = explode("|!|",$value->desc);

                $arrr = array($value->month,$value->am,$value->dm,$value->ct_id,$value->ct_name);
                $mkl = array_merge($arrr,array_slice($mkl,4));

                $row = $mkl;
                foreach ($row as $i => $v) {
                    // CSV的Excel支持GBK编码，一定要转换，否则乱码
                    $row[$i] = iconv('utf-8', 'gbk', $v);
                }
                fputcsv($fp, $row);
            }

        }
    }

    /**
     * 导入功能
     */
    public function actionImport(){
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $month = Yii::app()->getRequest()->getParam("month", ""); //月份
        $type = Yii::app()->getRequest()->getParam("type", 0); //月份

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
                        $msg["msg"] = $type==0?AppBsCol::model()->storeCsv($dest_file_path,$month):
                            AppBsColyc::model()->storeCsv($dest_file_path,$month);
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
}