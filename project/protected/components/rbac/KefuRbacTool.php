<?php
/**
 * Created by PhpStorm.
 * User: xiongfanglei
 * Date: 14-12-2
 * Time: 上午10:33
 */
class KefuRbacTool extends BaseTool
{

    private static $instance;

    /**
     * Yii的权限管理对象
     * @var CAuthManager
     */
    protected $auth;

    protected function __construct()
    {
        $this->auth = Yii::app()->authManager;
    }

    /**
     * 单例构造器
     *
     * @return KefuRbacTool
     */
    public static function getInstance()
    {
        if (NULL == KefuRbacTool::$instance)
            KefuRbacTool::$instance = new KefuRbacTool();
        return KefuRbacTool::$instance;
    }

    /**
     * 获取当前的操作标识，按照客服系统的构造方式来指明操作名
     * 操作名的构成方法： 控制器名-动作名 (controller_name-action_name)
     */
    public function getCurrentOperation()
    {
        return Yii::app()->controller->id . '-' .
        Yii::app()->controller->action->id;
    }

    /**
     * 检查是否有同名的权限条目
     *
     * @param string $auth_item_name
     * @throws RbacException
     */
    protected function checkAuthItemExists($auth_item_name)
    {
        $auth_item = $this->auth->getAuthItem($auth_item_name);
        if (is_object($auth_item))
            throw new RbacException(
                RbacException::getException(RbacException::EXP_AUTH_ITEM_EXISTS),
                RbacException::EXP_AUTH_ITEM_EXISTS);
    }

    /**
     * 创建操作权限
     *
     * @param string $operation 操作名称
     * @param string $desc 操作描述
     * @return boolean
     */
    public function createOperation($operation, $desc = '')
    {
        $auth_operation = $this->auth->getAuthItem($operation);
        if (!empty($auth_operation) &&
            (CAuthItem::TYPE_OPERATION == $auth_operation->type))
        {
            return TRUE;
        }
        else
            return (NULL != $this->auth->createOperation($operation, $desc));
    }

    /**
     * 创建操作任务
     *
     * @param string $task 任务名称
     * @param string $desc 任务描述
     * @return boolean
     */
    public function createTask($task, $desc = '')
    {
        $auth_task = $this->auth->getAuthItem($task);
        if (!empty($auth_task) &&
            (CAuthItem::TYPE_TASK == $auth_task->type))
        {
            return TRUE;
        }
        else
            return (NULL != $this->auth->createTask($task, $desc));
    }

    /**
     * 创建权限角色
     *
     * @param string $role 角色名称
     * @param string $desc 角色描述
     * @return boolean
     */
    public function createRole($role, $desc = '')
    {
        $auth_role = $this->auth->getAuthItem($role);
        if (!empty($auth_role) &&
            (CAuthItem::TYPE_ROLE == $auth_role->type))
        {
            return TRUE;
        }
        else
            return (NULL != $this->auth->createRole($role, $desc));
    }

    /**
     * 获取指定的权限操作对象
     *
     * @param string $operation 操作名称
     * @return CAuthItem
     */
    public function getOperation($operation)
    {
        $auth_operation = $this->auth->getAuthItem($operation);
        return (!empty($auth_operation) &&
            ($auth_operation->type == CAuthItem::TYPE_OPERATION)) ?
            $auth_operation : NULL;
    }

    /**
     * 获取指定的权限任务
     *
     * @param string $task
     * @return CAuthItem
     */
    public function getTask($task)
    {
        $auth_operation = $this->auth->getAuthItem($task);
        return (!empty($auth_operation) &&
            ($auth_operation->type == CAuthItem::TYPE_TASK)) ?
            $auth_operation : NULL;
    }

    /**
     * 获取指定的权限角色
     *
     * @param string $role
     * @return CAuthItem
     */
    public function getRole($role)
    {
        $auth_operation = $this->auth->getAuthItem($role);
        return (!empty($auth_operation) &&
            ($auth_operation->type == CAuthItem::TYPE_ROLE)) ?
            $auth_operation : NULL;
    }

    /**
     * 获取系统中所有的权限操作，按照系统自定义的方法生成字符串
     *
     * @return array 系统中的所有权限操作名列表
     */
    public function getAllActions()
    {
        $ret_operations = array();
        $controllers = $this->allControllers();
        foreach ($controllers as $_item_controller)
        {
            $actions = $this->allActions($_item_controller);
            foreach ($actions as $_item_action)
            {
                array_push($ret_operations, $_item_controller . '-' . $_item_action);
            }
        }
        return $ret_operations;
    }

    /**
     * 获取所有权限操作
     * @param string 用户ID
     * @return array
     */
    public function getOperations($user_id = NULL)
    {
        return $this->auth->getOperations($user_id);
    }

    /**
     * 获取所有权限任务
     * @param string $user_id
     * @return array
     */
    public function getTasks($user_id = NULL)
    {
        return $this->auth->getTasks($user_id);
    }

    /**
     * 以数组方式返回所以的任务列表
     *
     * @param string $user_id
     * @return array
     */
    public function getTasksArray($user_id = NULL)
    {
        $array_all_tasks = array();
        $all_tasks = $this->auth->getTasks($user_id);
        if (is_array($all_tasks))
        {
            foreach ($all_tasks as $task_item)
            {
                array_push($array_all_tasks, $task_item->getName());
            }
        }
        return $array_all_tasks;
    }

    /**
     * 获取所有权限角色
     * @param string $user_id
     * @return array
     */
    public function getRoles($user_id)
    {
        return $this->auth->getRoles($user_id);
    }

    /**
     * 将角色赋予用户
     *
     * @param string $auth_role 角色名称
     * @param string $user_id 用户id
     */
    public function assign($auth_role, $user_id)
    {
        if (!$this->auth->isAssigned($auth_role, $user_id))
            $this->auth->assign($auth_role, $user_id);
        return TRUE;
    }

    /**
     * 撤销一条角色授权
     * @param string $auth_role
     * @param string $user_id
     * @return boolean
     */
    public function revoke($auth_role, $user_id)
    {
        return $this->auth->revoke($auth_role, $user_id);
    }

    /**
     * 检查用户是否有权利执行某项操作
     *
     * @param string $operation
     * @param string $user_id
     */
    public function checkAccess($operation = '', $user_id = '')
    {
        if ('' == $user_id)
            $user_id = Yii::app()->user->id;
        if (in_array($user_id, Yii::app()->params['super_admin']))
            return TRUE;
        if ('' == $operation)
            $operation = strtolower((Yii::app()->controller->id . 'Controller' . '-' .
                Yii::app()->controller->action->id));
        if (!$this->auth->checkAccess($operation, $user_id))
        {
            echo '<span style="color:red;">'.KefuExceptionType::translateError(KefuExceptionType::ERR_LACK_AUTHORITY).'</span>'.$operation;
            die();
        }
    }

    /**
     * 获取指定任务下面的所有操作信息
     *
     * @param string $task 任务名称
     */
    public function getChildOperations($task)
    {
        $array_opers = array();
        $task_obj = $this->auth->getAuthItem($task);
        if (is_object($task_obj) &&
            (CAuthItem::TYPE_TASK == $task_obj->getType()))
        {
            $chilren = $task_obj->getChildren();
            foreach ($chilren as $item)
            {
                array_push($array_opers, array(
                    'name' => $item->getName(),
                    'desc' => $item->getDescription()
                ));
            }
        }

        return $array_opers;
    }

    /**
     * 获取指定角色名称下的所有任务
     *
     * @param string $role 角色名称
     */
    public function getChildTasks($role)
    {
        $array_tasks = array();
        $role_obj = $this->auth->getAuthItem($role);
        if (is_object($role_obj) &&
            (CAuthItem::TYPE_ROLE == $role_obj->getType()))
        {
            $children = $role_obj->getChildren();
            foreach ($children as $item)
            {
                array_push($array_tasks, array(
                    'name' => $item->getName(),
                    'desc' => $item->getDescription()
                ));
            }
        }
        return $array_tasks;
    }

    /**
     * 为指定任务指派附属操作
     *
     * @param string $task 任务名称
     * @param string $operation 操作名称
     * @return boolean 操作结果
     */
    public function addTaskChild($task, $operation)
    {
        $ret_oper = FALSE;
        $auth_item = $this->auth->getAuthItem($task);
        if (is_object($auth_item) &&
            (CAuthItem::TYPE_TASK == $auth_item->getType()))
        {
            $ret_oper = $auth_item->hasChild($operation) ? (null) : $auth_item->addChild($operation);
        }

        return $ret_oper;
    }

    /**
     * 删除指定任务的子操作
     *
     * @param string $task 任务名称
     * @param string $operation 操作名称
     */
    public function removeTaskChild($task, $operation)
    {
        $ret_oper = FALSE;
        $auth_item = $this->auth->getAuthItem($task);
        if (is_object($auth_item) &&
            (CAuthItem::TYPE_TASK == $auth_item->getType()))
        {
            $ret_oper = $auth_item->removeChild($operation);
        }
        return $ret_oper;
    }

    /**
     * 删除指定的认证条目
     *
     * @param string $auth_name
     * @return boolean
     */
    public function removeAuthItem($auth_name)
    {
        return $this->auth->removeAuthItem($auth_name);
    }

    /**
     * 未指定角色指派附属任务
     *
     * @param string $role 角色名称
     * @param string $task 任务名称
     * @return boolean
     */
    public function addRoleChild($role, $task)
    {
        $ret_oper = FALSE;
        $auth_item = $this->auth->getAuthItem($role);
        if (is_object($auth_item) &&
            (CAuthItem::TYPE_ROLE == $auth_item->getType()))
        {
            $ret_oper = $auth_item->hasChild($task) ? (null) : $auth_item->addChild($task);
        }
        return $ret_oper;
    }

    /**
     * 删除指定角色下的子任务
     * @param string $role
     * @param string $task
     */
    public function removeRoleChild($role, $task)
    {
        $ret_oper = FALSE;
        $auth_item = $this->auth->getAuthItem($role);
        if (is_object($auth_item) &&
            (CAuthItem::TYPE_ROLE == $auth_item->getType()))
        {
            $ret_oper = $auth_item->removeChild($task);
        }
        return $ret_oper;
    }

    /**
     * 获取指定角色下面的所有任务的标签集合
     *
     * @param string $role
     * @return array
     */
    public function getAllTaskLabelOnRole($role)
    {
        $arr_labels = array();

        $arr_tasks = $this->getChildTasks($role);
        if (is_array($arr_tasks))
        {
            foreach ($arr_tasks as $task_item)
            {
                array_push($arr_labels, $task_item['name']);
            }
        }

        return $arr_labels;
    }

    /**
     * 判断指定角色里面是否有指定的任务
     *
     * @param string $role
     * @param string $task
     * @return boolean
     */
    public function containsTask($role, $task)
    {
        $ret_check = FALSE;

        $role_item = $this->getRole($role);
        if (!empty($role))
        {
            $arr_child_tasks = $role_item->getChildren();
            if (is_array($arr_child_tasks))
            {
                foreach ($arr_child_tasks as $task_item)
                {
                    if (($task == $task_item->getName())
                        && ($task_item->getType() == CAuthItem::TYPE_TASK))
                    {
                        $ret_check = TRUE;
                        break;
                    }
                }
            }
        }

        return $ret_check;
    }

    /**
     * 用户身上的所有任务，包括用户身上的任务和用户身上的角色拥有的任务
     *
     * @param string $user_id 用户的邮箱地址
     * @return array
     */
    public function getAllTaskOnRole($user_id)
    {
        // 直接属于用户的任务
        $direct_tasks = $this->getTasks($user_id);

        $assigned_tasks = array();
        $arr_roles = $this->getRoles($user_id);
        if (is_array($arr_roles))
        {
            foreach ($arr_roles as $role_item)
            {
                // 遍历角色，获取所有任务
                $arr_tasks = $role_item->getChildren();
                if (is_array($arr_tasks))
                {
                    foreach ($arr_tasks as $task_item)
                    {
                        array_push($assigned_tasks, $task_item->getName());
                    }
                }
            }
        }
        if (is_array($direct_tasks))
        {
            foreach ($direct_tasks as $d_task_item)
            {
                array_push($assigned_tasks, $d_task_item->getName());
            }
        }
        return $assigned_tasks;
    }
    /**
     * 返回属于指定用户的所有任务
     * 客户端用户界面上显示的内容应该是由服务器分派的角色任务来决定的。
     * 具有某种任务就应该显示某个任务的界面，因此界面设计应该严格按照”根据任务进行UI聚合“的原则进行
     *
     * @param string $user_id
     * @return array
     */
    public function getAllTasks($user_id)
    {
        // 直接属于用户的任务
        $direct_tasks = $this->getTasks($user_id);

        $assigned_tasks = array();
        /*
          $arr_roles = $this->getRoles($user_id);
          if (is_array($arr_roles))
          {
          foreach ($arr_roles as $role_item)
          {
          // 遍历角色，获取所有任务
          $arr_tasks = $role_item->getChildren();
          if (is_array($arr_tasks))
          {
          foreach ($arr_tasks as $task_item)
          {
          array_push($assigned_tasks, $task_item->getName());
          }
          }
          }
          }
         */
        if (is_array($direct_tasks))
        {
            foreach ($direct_tasks as $d_task_item)
            {
                array_push($assigned_tasks, $d_task_item->getName());
            }
        }
        return $assigned_tasks;
    }

    /**
     * 返回属于指定用户的所有操作
     *
     * @param string $user_id
     * @return array 以操作名称为键的数组
     */
    public function getAllOperationsBelong($user_id)
    {
        // 直接属于用户的操作
        $direct_opers = $this->getOperations($user_id);

        $assigned_opers = array();
        // 获取用户拥有的所有角色
        $arr_roles = $this->getRoles($user_id);
        if (is_array($arr_roles))
        {
            foreach ($arr_roles as $role_item)
            {
                // 遍历角色，获取所有的任务
                $arr_tasks = $role_item->getChildren();
                if (is_array($arr_tasks))
                {
                    foreach ($arr_tasks as $task_item)
                    {
                        $arr_opers = $task_item->getChildren();
                        if (is_array($arr_opers))
                        {
                            foreach ($arr_opers as $oper_item)
                            {
                                array_push($assigned_opers, $oper_item->getName());
                            }
                        }
                    }
                }
            }
        }
        /**
         * 合并玩家拥有的直接任务和间接任务
         */
        if (is_array($direct_opers))
        {
            foreach ($direct_opers as $alone_oper_item)
            {
                array_push($assigned_opers, $alone_oper_item->getName());
            }
        }
        return $assigned_opers;
    }

    /**
     * 判断指定用户是否拥有某项角色
     *
     * @param string $user_id
     * @param string $role
     * @return boolean
     */
    public function hasRole($user_id, $role)
    {
        return $this->auth->isAssigned($role, $user_id);
    }

    /**
     * 获取指定用户身上的所有角色，以及每个角色下的任务
     * @param string $user_id 用户邮箱
     */
    public function getTasksGroupByRole($user_id)
    {
        $ret_role_list = array();
        $roles = $this->auth->getRoles($user_id);
        if (is_array($roles))
        {
            foreach ($roles as $role_item)
            {
                $tasks_list = array();
                $tasks = $role_item->getChildren();
                foreach ($tasks as $task_item)
                    array_push ($tasks_list, $task_item->getName());
                array_push($ret_role_list, array(
                    $role_item->getName() => $tasks_list
                ));
            }
        }
        return $ret_role_list;
    }

    /**
     * 通过角色名称获取
     * @param type $role
     * @return array
     */
    public function getTasksonrole($role)
    {
        $ret_task_list = array();
        $obj_role = $this->auth->getAuthItem($role);
        if (is_object($obj_role) && (CAuthItem::TYPE_ROLE == $obj_role->type))
        {
            $role_children = $obj_role->getChildren();
            foreach ($role_children as $_task_item)
            {
                if ($_task_item->type == CAuthItem::TYPE_TASK)
                    array_push ($ret_task_list, $_task_item->getName());
            }
        }
        return $ret_task_list;
    }

    /**
     * 是否存在默认角色
     * @return boolean
     */
    public function existDefaultRole()
    {
        $ret_code = FALSE;
        $default_role = $this->auth->getAuthItem(Yii::app()->params['defaultrole']);
        if (is_object($default_role) && (CAuthItem::TYPE_ROLE == $default_role->type))
        {
            $ret_code = TRUE;
        }
        return $ret_code;
    }

}