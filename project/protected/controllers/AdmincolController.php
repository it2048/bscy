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
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $pages['col_time'] = Yii::app()->getRequest()->getParam("col_time",date("Ym")); //时间
        $pages['col_type'] = Yii::app()->getRequest()->getParam("col_type",0); //类型

        $criteria = new CDbCriteria;
        $criteria->addCondition('month='.$pages['col_time']);
        $pages['countPage'] = AppBsCol::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $allList = AppBsCol::model()->findAll($criteria);
        $col = AppBsColi::model()->findByPk($pages['col_time']);
        if(empty($col))
        {
            $ms = array();
        }else
        {
            $head = json_decode($col->desc,true);
            $ms = isset($head[$pages['col_type']])?$head[$pages['col_type']]:array();
        }

        //file_put_contents('/Applications/XAMPP/xamppfiles/htdocs/t.log',print_r($ms,true),8);

        $this->renderPartial('index', array(
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
     * 导入功能
     */
    public function actionImport(){
        $msg = array("code" => 1, "msg" => "上传失败", "obj" => NULL);
        $month = Yii::app()->getRequest()->getParam("month", ""); //月份
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
                        $msg["msg"] = AppBsCol::model()->storeCsv($dest_file_path,$month);
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