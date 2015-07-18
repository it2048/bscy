<?php
/**
 * Created by PhpStorm.
 * User: sibenx
 * Date: 15/7/16
 * Time: 下午1:31
 */

class AdminorderController extends AdminSet
{
    /**
     * 违纪餐厅申请列表
     */
    public function actionIndex()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $criteria = new CDbCriteria;
        $uname = Yii::app()->user->getState('username');
        $criteria->addCondition("ct_no='{$uname}'");
        $pages['countPage'] = AppBsOrder::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsOrder::model()->findAll($criteria);

        $str = "";
        $adArr = array();
        foreach($allList as $val)
        {
            $str .= sprintf("'%s',",$val->emp_id);
        }
        if($str!="")
        {
            $str = rtrim($str,",");
            $modl = AppBsEmp::model()->findAll("em_id in({$str})");
            foreach($modl as $val)
            {
                $adArr[$val->em_id] = array("name"=>$val->name,"zw"=>$val->zw_name,"ct"=>$val->ct_name);
            }
        }

        $this->renderPartial('index', array(
            'models' => $allList,
            'arr'=>$adArr,
            'pages' => $pages),false,true);
    }

    /**
     * 违纪餐厅申请列表
     */
    public function actionAdmin()
    {
        //print_r(Yii::app()->user->getState('username'));
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        $pages['numPerPage'] = Yii::app()->getRequest()->getParam("numPerPage", 50); //每页多少条数据

        $criteria = new CDbCriteria;
        $pages['countPage'] = AppBsWj::model()->count($criteria);
        $criteria->limit = $pages['numPerPage'];
        $criteria->offset = $pages['numPerPage'] * ($pages['pageNum'] - 1);
        $criteria->order = 'id DESC';
        $allList = AppBsWj::model()->findAll($criteria);
        $this->renderPartial('index', array(
            'models' => $allList,
            'pages' => $pages),false,true);
    }

    /**
     * 添加幻灯
     */
    public function actionAdd()
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'wx_type';
        $criteria->distinct = TRUE; //是否唯一查询
        $allList = AppBsWj::model()->findAll($criteria);

        $this->renderPartial('add',array("models"=>$allList));
    }


    /**
     * 保存幻灯
     */
    public function actionSave()
    {
        $msg = $this->msgcode();
        $order_sfid = Yii::app()->getRequest()->getParam("order_sfid", ""); //身份证
        $order_emid = Yii::app()->getRequest()->getParam("order_emid", ""); //员工编号
//        $order_name = Yii::app()->getRequest()->getParam("order_name", ""); //员工名
//        $order_zw = Yii::app()->getRequest()->getParam("order_zw", ""); //员工职位
//
//        $order_ct = Yii::app()->getRequest()->getParam("order_ct", ""); //餐厅
        $order_qjl = Yii::app()->getRequest()->getParam("order_qjl", ""); //区经理
        $order_qyjl= Yii::app()->getRequest()->getParam("order_qyjl", ""); //区域经理
        $order_yglx = Yii::app()->getRequest()->getParam("order_yglx", 0); //员工类型

        $order_wjlx = Yii::app()->getRequest()->getParam("order_wjlx", ""); //违纪类型
        $order_wjtk = Yii::app()->getRequest()->getParam("order_wjtk", ""); //违纪条款
        $wj_sj = Yii::app()->getRequest()->getParam("wj_sj", ""); //违纪事件
        $wj_jl = Yii::app()->getRequest()->getParam("wj_jl", ""); //违纪结论

        $order_zj = Yii::app()->getRequest()->getParam("order_zj", ""); //违纪证据
        $wj_zl = Yii::app()->getRequest()->getParam("wj_zl", ""); //附加资料

        $allList = AppBsWj::model()->find("wj_tk=:wp",array(":wp"=>$order_wjtk));

        $cnt = 3;
        if(!empty($allList)&&!empty($allList->wj_zj)) {
            $wj = trim($allList->wj_zj);
            $cnt =$cnt + count(explode("\r\n", $wj));
        }

        if(!is_array($order_zj)||count($order_zj)<$cnt)
        {
            $msg['msg'] = "违纪证据必须全选";
        }
        elseif($order_sfid!=""&&$order_emid!="")
        {
            $model = new AppBsOrder();
            $model->emp_id = $order_emid;
            $model->q_jl = $order_qjl;
            $model->qy_jl = $order_qyjl;
            $model->wj_lx = $order_wjlx;

            $model->wj_tk = $order_wjtk;
            $model->wj_sj = $wj_sj;
            $model->wj_jl = $wj_jl;
            $model->type = $order_yglx;
            $model->fj = $wj_zl;

            $model->tj_time = time();
            $model->stage = TempList::$stage[0];
            $model->admin = $this->getUserName();
            $model->ct_no = $this->getUserName();

            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "创建成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
                $msg['msg'] = "身份证和员工编号不能为空";
        }
        echo json_encode($msg);
    }


    /**
     * 编辑幻灯
     */
    public function actionEdit()
    {
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        $model = array();
        if($id!="")
            $model = AppBsWj::model()->findByPk($id);
        $this->renderPartial('edit',array("models"=>$model));
    }


    /**
     * 更新幻灯
     */
    public function actionUpdate()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 1); //用户名
        $wj_type = Yii::app()->getRequest()->getParam("wj_type", ""); //违纪类型
        $wj_tk = Yii::app()->getRequest()->getParam("wj_tk", ""); //违纪条款
        $wj_al = Yii::app()->getRequest()->getParam("wj_al", ""); //违纪案例
        $wj_zl = Yii::app()->getRequest()->getParam("wj_zl", ""); //违纪资料

        $model = AppBsWj::model()->findByPk($id);
        if($wj_type!=""&&$wj_tk!=""&&!empty($model))
        {
            $model->wx_type = $wj_type;
            $model->wj_tk = $wj_tk;
            $model->wj_al = $wj_al;
            $model->wj_zj = $wj_zl;
            if($model->save())
            {
                $this->msgsucc($msg);
                $msg['msg'] = "修改成功";
            }else
            {
                $msg['msg'] = "存入数据库异常";
            }

        }else{
            if($msg["code"]!=3)
                $msg['msg'] = "必填项不能为空";
        }
        echo json_encode($msg);

    }

    /**
     * 删除幻灯
     */
    public function actionDel()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //用户名
        if($id!=0)
        {
            if(AppBsWj::model()->deleteByPk($id))
            {
                $this->msgsucc($msg);
            }
            else
                $msg['msg'] = "数据删除失败";
        }else
        {
            $msg['msg'] = "id不能为空";
        }
        echo json_encode($msg);
    }

    public function actionWj()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", ""); //违纪类型
        if(!empty($id))
        {
            $allList = AppBsWj::model()->findAll("wx_type=:wp",array(":wp"=>$id));

            if(!empty($allList))
            {
                $str = '<option value="">请选择</option>';
                foreach($allList as $val)
                {
                    $str .= sprintf("<option value='%s'>%s</option>",$val->wj_tk,$val->wj_tk);
                }
                $this->msgsucc($msg);
                $msg['data'] = $str;
            }
            else
                $msg['msg'] = "获取违纪条款失败";
        }else
        {
            $msg['msg'] = "违纪类型不能为空";
        }
        echo json_encode($msg);
    }


    public function actionTk()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", ""); //违纪条款
        if(!empty($id))
        {
            $allList = AppBsWj::model()->find("wj_tk=:wp",array(":wp"=>$id));
            if(!empty($allList)&&!empty($allList->wj_zj))
            {
                $arr = explode("\r\n",$allList->wj_zj);
                $str  ="";
                foreach($arr as $k=>$val)
                {
                    if(!empty($val))
                    $str .= sprintf('<input type="checkbox" name="order_zj[]" value="%s"/>%s、%s<br>',$k+4,$k+4,$val);
                }
                $this->msgsucc($msg);
                $msg['data'] = $str;
            }
            else
                $msg['msg'] = "获取证据列表失败";
        }else
        {
            $msg['msg'] = "违纪条款不能为空";
        }
        echo json_encode($msg);
    }

    /**
     * 通过身份证号获取信息
     */
    public function actionSf()
    {
        $msg = $this->msgcode();
        $id = Yii::app()->getRequest()->getParam("id", 0); //身份证
        if($id!=0)
        {
            $alt = AppBsEmp::model()->find('sf_id=:id',array(':id'=>$id));
            if(empty($alt))
            {
                $msg['msg'] = "员工不存在";
            }else
            {
                $arr = array();
                $arr['order_emid'] = $alt->em_id;
                $arr['order_name'] = $alt->name;
                $arr['order_zw'] = $alt->zw_name;
                $arr['order_ct'] = $alt->ct_name;
                $ttk = AppBsAdmin::model()->findByPk(strtolower($alt->hyp));
                $tmp = explode("\r\n",$ttk->desc);
                $qjl = "";
                $qy = "";
                foreach($tmp as $val)
                {
                    if(strpos($val,"区经理:")!==false)
                    {
                        $qjl = trim(str_replace('区经理:','',$val));
                        continue;
                    }
                    if(strpos($val,"营运经理:")!==false)
                    {
                        $qy = trim(str_replace('营运经理:','',$val));
                        continue;
                    }
                }
                $arr['order_qjl'] = $qjl;
                $arr['order_qyjl'] = $qy;
                $this->msgsucc($msg);
                $msg['data'] = $arr;

            }
        }else
        {
            $msg['msg'] = "身份证号不能为空";
        }
        echo json_encode($msg);
    }

}