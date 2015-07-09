<div class="pageContent">
	<form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AuthSave'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this, editCpt);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>名称：</label>
				<input name="name" class="required" type="text" size="30" value="<?php echo $AuthEow['name']?>" alt="请输入名称"/>
                <input name="nameOld" type="hidden" size="30" value="<?php echo $AuthEow['name']?>"/>
			</p>
            <p>
				<label>类型：</label>
				<select name="type" class="required combox">
					<option value="1" <?php echo $AuthEow['type']==1?"selected":""; ?>><?php echo AppAuthitem::$TYPES[1]; ?></option>
					<option value="2" <?php echo $AuthEow['type']==2?"selected":""; ?>><?php echo AppAuthitem::$TYPES[2]; ?></option>
				</select>
			</p>
			<p>
				<label>描述：</label>
				<input name="description" type="text" size="30" value="<?php echo $AuthEow['description']?>"/>
			</p>
			<p>
				<label>业务规则：</label>
				<input type="text" value="<?php echo $AuthEow['bizrule']?>" name="bizrule" class="textInput">
			</p>
			<p>
				<label>规则数组：</label>
				<input name="data" type="text" size="30" value="<?php echo $AuthEow['data']?>" />
			</p>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>
<script type="text/javascript">
/**
 * editCpt
 */
function editCpt(json) {
    navTab.reload(json.sys_setting);
    alertMsg.correct('您的数据修改成功！');
    $.pdialog.closeCurrent(); 
}
</script>
