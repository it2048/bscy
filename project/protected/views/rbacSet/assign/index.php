<div class="panelBar">
	<ul class="toolBar">
	<li><span>点击下面分类</span></li>
	</ul>
</div>
<div class="pageContent">
	<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li><a href="javascript:;"><span>为用户分配角色</span></a></li>
					<li><a href="javascript:;"><span>为角色分配任务</span></a></li>
					<li><a href="javascript:;"><span>为任务分配操作</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent" layoutH="68">
            <div>
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    用户：</br>
                    <?php foreach ($models as $value) {
                                    echo '<label><input type="radio" name="authuser" value="'.$value['username'].'">'.$value['username'].'</label></br>';
                            }?>
                </div>
                <div id="userAssign">
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    已分配的角色：</br>
                    <div id="assigned">
                        
                    </div>
                </div>
                <div style="float:left; margin-top: 200px;">
                    <div class="button"><div class="buttonContent"><button><<</button></div></div>
                    <div class="button"><div class="buttonContent"><button>>></button></div></div>
                </div>
                
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    未分配的角色：</br>
                    <div id="assigning">
                    </div>
                </div>
                </div>
            </div>
            <!-- 华丽的分割线，为角色分配任务 -->
            <div>
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    角色：</br>
                    <?php foreach ($roles as $value) {
                                    echo '<label><input type="radio" name="authrole" value="'.$value['name'].'">'.$value['name'].'</label></br>';
                            }?>
                </div>
                <div id="roleAssign">
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    已分配的任务：</br>
                    <div id="assigned">
                        
                    </div>
                </div>
                <div style="float:left; margin-top: 200px;">
                    <div class="button"><div class="buttonContent"><button><<</button></div></div>
                    <div class="button"><div class="buttonContent"><button>>></button></div></div>
                </div>
                
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    未分配的任务：</br>
                    <div id="assigning">
                    </div>
                </div>
                </div>
            </div>
            
            <!-- 华丽的分割线，为任务分配操作 -->
            <div>
                <div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    任务：</br>
                    <?php foreach ($tasks as $value) {
                                    echo '<label><input type="radio" name="authtask" value="'.$value['name'].'">'.$value['name'].'</label></br>';
                            }?>
                </div>
                <div id="taskAssign">
                <div style="float:left; display:block; margin:10px; overflow:auto; width:340px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    已分配的操作：</br>
                    <div id="assigned">
                        
                    </div>
                </div>
                <div style="float:left; margin-top: 200px;">
                    <div class="button"><div class="buttonContent"><button><<</button></div></div>
                    <div class="button"><div class="buttonContent"><button>>></button></div></div>
                </div>
                
                <div style="float:left; display:block; margin:10px; overflow:auto; width:340px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
                    未分配的操作：</br>
                    <div id="assigning">
                    </div>
                </div>
                </div>
            </div>
		</div>
		<div class="tabsFooter">
			<div class="tabsFooterContent"></div>
		</div>
	</div>
</div>


<script type="text/javascript">
/**
 * 选择用户获取用户权限列表
 */
    $("input[name=authuser]").click(function(){
        var _email = $(':radio[name="authuser"]:checked').val();
        $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignGet'); ?>", {email: _email}, function(data) {
                $("#userAssign").html(data);
        });    
    });
/**
 * addRoleToUser 为用户增加权限
 */
function addRoleToUser() {
    var _email = $(':radio[name="authuser"]:checked').val();
    var _roling="";  
    $("input[name=roling]").each(function() {  
        if ($(this).attr("checked")) {  
            _roling += ","+$(this).val();
        }  
    });  
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignRoleToUser'); ?>", {email: _email,roling:_roling}, function(data) {
         $("#userAssign").html(data);
    }); 
}

/**
 * delRoleToUser 删除用户指定权限
 */
function delRoleToUser() {
    var _email = $(':radio[name="authuser"]:checked').val();
    var _roled="";  
    $("input[name=roled]").each(function() {  
        if ($(this).attr("checked")) {  
            _roled += ","+$(this).val();  
        }  
    });  
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignDelRoleToUser'); ?>", {email: _email,roled:_roled}, function(data) {
         $("#userAssign").html(data);
    }); 
}

/*     华丽的分割线      角色分配任务                  */

/**
 * 选择角色获取角色任务列表
 */
    $("input[name=authrole]").click(function(){
        var _name = $(':radio[name="authrole"]:checked').val();
        $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignRoleGet'); ?>", {name: _name}, function(data) {
                $("#roleAssign").html(data);
        });    
    });
/**
 * addTaskToRole 为角色增加任务
 */
function addTaskToRole() {
    var _name = $(':radio[name="authrole"]:checked').val();
    var _tasking="";  
    $("input[name=tasking]").each(function() {  
        if ($(this).attr("checked")) {  
            _tasking += ","+$(this).val();
        }  
    });  
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignTaskToRole'); ?>", {name: _name,tasking:_tasking}, function(data) {
         $("#roleAssign").html(data);
    }); 
}

/**
 * delTaskToRole 删除角色指定的任务
 */
function delTaskToRole() {
    var _name = $(':radio[name="authrole"]:checked').val();
    var _tasked="";  
    $("input[name=tasked]").each(function() {  
        if ($(this).attr("checked")) {  
            _tasked += ","+$(this).val();  
        }  
    });  
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignDelTaskToRole'); ?>", {name: _name,tasked:_tasked}, function(data) {
         $("#roleAssign").html(data);
    }); 
}


/*     华丽的分割线      任务分配操作                  */

/**
 * 选择任务获取任务操作列表
 */
    $("input[name=authtask]").click(function(){
        var _name = $(':radio[name="authtask"]:checked').val();
        $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignTaskGet'); ?>", {name: _name}, function(data) {
                $("#taskAssign").html(data);
        });    
    });
/**
 * addOperaToTask 为角色增加任务
 */
function addOperaToTask() {
    var _name = $(':radio[name="authtask"]:checked').val();
    var _tasking="";  
    $("input[name=opering]").each(function() {  
        if ($(this).attr("checked")) {  
            _tasking += ","+$(this).val();
        }  
    });
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignOperaToTask'); ?>", {name: _name,tasking:_tasking}, function(data) {
         $("#taskAssign").html(data);
    }); 
}

/**
 * delOperaToTask 删除角色指定的任务
 */
function delOperaToTask() {
    var _name = $(':radio[name="authtask"]:checked').val();
    var _tasked="";  
    $("input[name=opered]").each(function() {  
        if ($(this).attr("checked")) {  
            _tasked += ","+$(this).val();  
        }  
    });
    $.post("<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AssignDelOperaToTask'); ?>", {name: _name,tasked:_tasked}, function(data) {
         $("#taskAssign").html(data);
    }); 
}
</script>