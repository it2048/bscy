<?php

/**
 * RbacSetController 主要做基于角色的权限管理设置
 *
 * @author 熊方磊 <xiongfanglei@kingsoft.com>
 */
class RbacSetController extends AdminSet{

    /**
     * 列表所有的操作，角色，任务
     */
    public function actionAuthManage() {
        //先获取当前是否有页码信息
        $pages['pageNum'] = Yii::app()->getRequest()->getParam("pageNum", 1); //当前页
        $pages['countPage'] = Yii::app()->getRequest()->getParam("countPage", 0); //总共多少记录
        //构造SQL
        $criteria = new CDbCriteria;
        $criteria->addCondition("type!=:type");
        $criteria->params[':type'] = 0;
        $criteria->limit = 30;
        $criteria->offset = 30 * ($pages['pageNum'] - 1);
        if (empty($pages['countPage']))
            $pages['countPage'] = AppAuthitem::model()->count($criteria);
        $models = AppAuthitem::model()->findAll($criteria);
        $this->renderPartial('manage/manage', array(
            'models' => $models,
            'pages' => $pages,), false, true);
    }

    /**
     * 根据name生成编辑页面
     */
    public function actionAuthEdit() {
        $authName = Yii::app()->getRequest()->getParam("name", "");
        $AuthEow = AppAuthitem::model()->findbyPk($authName); //通过主键获取所有信息
        $this->renderPartial('manage/_authedit', array(
            'AuthEow' => $AuthEow), false, true);
    }

    /**
     * 根据name生成编辑页面
     */
    public function actionAuthAdd() {
        $this->renderPartial('manage/_authadd');
    }

    /**
     * 删除一行数据，由于removeAuthItem()方法无法捕获beforeDelete，选择传统删除方法
     */
    public function actionAuthDelete($name) {
        $ret_info = array("code"=>-1);
        $AppAuthitem = AppAuthitem::model()->findByPk($name);
        if ($AppAuthitem->delete()) {
            $ret_info['code'] = 0;
            $ret_info['name'] = $name;
        }
        echo $this->output($ret_info);
    }

    /**
     * 插入一行新数据
     */
    public function actionAuthInsert() {
        $name = Yii::app()->getRequest()->getParam("name", "");
        $type = Yii::app()->getRequest()->getParam("type", "");
        $desc = Yii::app()->getRequest()->getParam("description", "");
        $bizrule = Yii::app()->getRequest()->getParam("bizrule", "");
        $data = Yii::app()->getRequest()->getParam("data", "");
        $ret_info = array("code"=>-1);

        $AuthEow = new AppAuthitem(); //通过主键获取所有信息
        $AuthEow->attributes = array(
            'name' => $name,
            'type' => $type,
            'description' => $desc,
            'bizrule' => $bizrule,
            'data' => $data);
        if ($AuthEow->save()) {
            $ret_info['code'] = 0;
            $ret_info['info'] = array(
                'name' => $name
            );
        }
        echo $this->output($ret_info);
    }

    /**
     * 保存编辑过的 Auth
     */
    public function actionAuthSave() {
        $nameOld = Yii::app()->getRequest()->getParam("nameOld", "");
        $name = Yii::app()->getRequest()->getParam("name", "");
        $type = Yii::app()->getRequest()->getParam("type", "");
        $desc = Yii::app()->getRequest()->getParam("description", "");
        $bizrule = Yii::app()->getRequest()->getParam("bizrule", "");
        $data = Yii::app()->getRequest()->getParam("data", "");
        $ret_info = array("code"=>-1);

        $AuthEow = AppAuthitem::model()->findbyPk($nameOld); //通过主键获取所有信息
        $AuthEow->attributes = array(
            'name' => $name,
            'type' => $type,
            'description' => $desc,
            'bizrule' => $bizrule,
            'data' => $data,);
        if ($AuthEow->save()) {
            $ret_info['code'] = 0;
            $ret_info['info'] = array(
                'name' => $nameOld
            );
        }
        echo $this->output($ret_info);
    }

    /**
     * 列表所有未添加的控制器和方法
     */
    public function actionAuthList() {
        $endArr = array(); //最后要的数据
        $savedArr = array(); //已经存在的Auth
        $models = AppAuthitem::model()->findAll();
        $AllAuth = array();
        foreach ($models as $value) {
            $AllAuth[] = $value['name'];
        }
        //获取所有action
        $arr = KefuRbacTool::getInstance()->allControllers();
        foreach ($arr as $value) {
            $AllArr[$value] = KefuRbacTool::getInstance()->allActions($value);
            foreach ($AllArr[$value] as $val) {
                if (!in_array($val, $AllAuth)) {
                    $endArr[$value][] = $val;
                } else {
                    $savedArr[$value][] = $val;
                }
            }
        }
        $this->renderPartial('manage/batch', array(
            'endArr' => $endArr, 'savedArr' => $savedArr), false, true);
    }

    /**
     * 批量增加
     * @return array
     */
    public function ActionAuthBatchAdd() {
        $ret_info = array("code"=>-1);
        //获取的内容为逗号分割的字符串
        $batch_auth_add = empty($_POST['batch_auth_add']) ? "" : $_POST['batch_auth_add'];
        if (!empty($batch_auth_add)) {
            $batchArr = explode(",", $batch_auth_add);
            //循环遍历增加
            foreach ($batchArr as $value) {
                $AuthEow = new AppAuthitem();
                $AuthEow->name = $value;
                $AuthEow->type = 0;
                $AuthEow->save();
            }
            $ret_info['code'] = 0;
            $ret_info['info'] = array(
                'name' => 'xfl_Auth_add'
            );
        }
        echo $this->output($ret_info);
    }

    /**
     * 批量删除
     * @return array
     */
    public function ActionAuthBatchDelete() {
        $ret_info = array("code"=>-1);
        //获取的内容为逗号分割的字符串
        $batch_auth_delete = empty($_POST['batch_auth_delete']) ? "" : $_POST['batch_auth_delete'];
        if (!empty($batch_auth_delete)) {
            $batchArr = explode(",", $batch_auth_delete);
            //循环遍历删除
            foreach ($batchArr as $value) {
                KefuRbacTool::getInstance()->removeAuthItem($value);
            }
            $ret_info['code'] = 0;
            $ret_info['info'] = array(
                'name' => 'xfl_Auth_delete'
            );
            echo $this->output($ret_info);
        }
    }

    /**
     * 职能分配功能 主函数
     */

    public function actionAssignToUsers() {
        $models = AppBsAdmin::model()->findAll();
        $criteria = new CDbCriteria();
        $criteria->addCondition("type=:type");
        $criteria->params[':type'] = 2;
        $roles = AppAuthitem::model()->findAll($criteria);

        $criteriab = new CDbCriteria();
        $criteriab->addCondition("type=:type");
        $criteriab->params[':type'] = 1;
        $tasks = AppAuthitem::model()->findAll($criteriab);

        $this->renderPartial('assign/index', array(
            'models' => $models, 'roles' => $roles, 'tasks' => $tasks), false, true);
    }

    /**
     * 职能分配功能-为用户分配角色
     */

    public function actionAssignGet() {

        $email = Yii::app()->getRequest()->getParam("email", "");
        if (!empty($email)) {
            $this->_refreshRole($email);
        }
    }

    /**
     * 职能分配功能-为角色分配任务
     */

    public function actionAssignRoleGet() {

        $name = Yii::app()->getRequest()->getParam("name", "");
        if (!empty($name)) {
            $this->_refreshTask($name);
        }
    }

    /**
     * 职能分配功能-为任务分配操作
     */

    public function actionAssignTaskGet() {

        $name = Yii::app()->getRequest()->getParam("name", "");
        if (!empty($name)) {
            $this->_refreshOpera($name);
        }
    }

    /**
     * 任务分配功能
     */

    public function actionAssignTaskToRole() {
        $name = Yii::app()->getRequest()->getParam("name", "");
        $tasking = Yii::app()->getRequest()->getParam("tasking", "");
        if (!empty($name) && !empty($tasking)) {
            $rolArr = explode(",", $tasking);
            //循环遍历增加
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->addRoleChild($name, $value);
                }
            }
            $this->_refreshTask($name);
        }
    }

    /**
     * 任务删除操作
     */

    public function actionAssignDelOperaToTask() {
        $name = Yii::app()->getRequest()->getParam("name", "");
        $tasked = Yii::app()->getRequest()->getParam("tasked", "");
        if (!empty($name) && !empty($tasked)) {
            $rolArr = explode(",", $tasked);
            //循环遍历增加
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->removeTaskChild($name, $value);
                }
            }
            $this->_refreshOpera($name);
        }
    }

    /**
     * 任务分配操作
     */

    public function actionAssignOperaToTask() {
        $name = Yii::app()->getRequest()->getParam("name", "");
        $tasking = Yii::app()->getRequest()->getParam("tasking", "");
        if (!empty($name) && !empty($tasking)) {
            $rolArr = explode(",", $tasking);
            //循环遍历删除
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->addTaskChild($name, $value);
                }
            }
            $this->_refreshOpera($name);
        }
    }

    /**
     * 任务删除功能
     */

    public function actionAssignDelTaskToRole() {
        $name = Yii::app()->getRequest()->getParam("name", "");
        $tasked = Yii::app()->getRequest()->getParam("tasked", "");
        if (!empty($name) && !empty($tasked)) {
            $rolArr = explode(",", $tasked);
            //循环遍历增加
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->removeRoleChild($name, $value);
                }
            }
            $this->_refreshTask($name);
        }
    }

    /**
     * 职能分配功能
     */

    public function actionAssignRoleToUser() {
        $email = Yii::app()->getRequest()->getParam("email", "");
        $roling = Yii::app()->getRequest()->getParam("roling", "");
        if (!empty($email) && !empty($roling)) {
            $rolArr = explode(",", $roling);
            //循环遍历增加
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->assign($value, $email);
                }
            }
            $this->_refreshRole($email);
        }
    }

    /**
     * 职能删除功能
     */

    public function actionAssignDelRoleToUser() {
        $email = Yii::app()->getRequest()->getParam("email", "");
        $roled = Yii::app()->getRequest()->getParam("roled", "");
        if (!empty($email) && !empty($roled)) {
            $rolArr = explode(",", $roled);
            //循环遍历增加
            foreach ($rolArr as $value) {
                if (!empty($value)) {
                    KefuRbacTool::getInstance()->revoke($value, $email);
                }
            }
            $this->_refreshRole($email);
        }
    }

    //刷新用户权限
    private function _refreshRole($email) {
        $criteriab = new CDbCriteria;
        $criteriab->addCondition("userid=:type");
        $criteriab->params[':type'] = $email;
        $models = Authassignment::model()->findAll($criteriab);
        $assignedArr = array();
        foreach ($models as $value) {
            $assignedArr[] = $value['itemname'];
        }
        $criteria = new CDbCriteria;
        $criteria->addCondition("type=:type");
        $criteria->params[':type'] = 2;
        $role = AppAuthitem::model()->findAll($criteria);
        $assigningArr = array();
        foreach ($role as $value) {
            if (!in_array($value['name'], $assignedArr)) {
                $assigningArr[] = $value['name'];
            }
        }
        $this->renderPartial('assign/_assign', array('models' => $assignedArr, 'role' => $assigningArr));
    }

    //刷新角色的任务
    private function _refreshTask($name) {
        $criteriab = new CDbCriteria;
        $criteriab->addCondition("parent=:type");
        $criteriab->params[':type'] = $name;
        $models = Authitemchild::model()->findAll($criteriab);
        $assignedArr = array();
        foreach ($models as $value) {
            $assignedArr[] = $value['child'];
        }
        $criteria = new CDbCriteria;
        $criteria->addCondition("type=:type");
        $criteria->params[':type'] = 1;
        $role = AppAuthitem::model()->findAll($criteria);
        $assigningArr = array();
        foreach ($role as $value) {
            if (!in_array($value['name'], $assignedArr)) {
                $assigningArr[] = $value['name'];
            }
        }
        $this->renderPartial('assign/_role', array('models' => $assignedArr, 'task' => $assigningArr));
    }

    //刷新任务的操作
    private function _refreshOpera($name) {
        $criteriab = new CDbCriteria;
        $criteriab->addCondition("parent=:type");
        $criteriab->params[':type'] = $name;
        $models = Authitemchild::model()->findAll($criteriab);
        $assignedArr = array();
        foreach ($models as $value) {
            $assignedArr[] = $value['child'];
        }
        $criteria = new CDbCriteria;
        $criteria->addCondition("type=:type");
        $criteria->params[':type'] = 0;
        $role = AppAuthitem::model()->findAll($criteria);
        $assigningArr = array();
        foreach ($role as $value) {
            if (!in_array($value['name'], $assignedArr)) {
                $assigningArr[] = $value['name'];
            }
        }
        $this->renderPartial('assign/_task', array('models' => $assignedArr, 'opera' => $assigningArr));
    }

}
