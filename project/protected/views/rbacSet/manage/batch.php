<div layoutH="44" style=" float:left; display:block; margin:10px; overflow:auto; width:400px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
<p>批量添加 操作</p>
<form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AuthBatchAdd'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,batchAdd);">
<ul class="tree treeFolder treeCheck expand" oncheck="batchGetCheck" id="ul_tree_userlist0">
    <?php foreach ($endArr as $key=>$value) { 
        if(!empty($value)){
        ?>
	<li><a><?php echo $key;?></a>
		<ul>
            <?php foreach ($value as $val) {
                    echo '<li><a tname="'.$val.'" tvalue="'.$val.'">'.$val.'</a></li>';
                }?>
		</ul>
	</li>
        <?php }}?>
</ul>
<input type="hidden" id="batch_auth_add" name="batch_auth_add">
<input type="submit" value="确定添加"/>
</form>
</div>

<div layoutH="44" style=" float:left; display:block; margin:10px; overflow:auto; width:400px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
<p>批量删除 操作</p>
<form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('rbacSet/AuthBatchDelete'); ?>" class="pageForm required-validate" onsubmit="return validateCallback(this,batchAdd);">
<ul class="tree treeFolder treeCheck expand" oncheck="batchDelCheck" id="ul_tree_userlist1">
    <?php foreach ($savedArr as $key=>$value) { 
        if(!empty($value)){
        ?>
	<li><a ><?php echo $key;?></a>
		<ul>
            <?php foreach ($value as $val) {
                    echo '<li><a tname="name" tvalue="'.$val.'">'.$val.'</a></li>';
                }?>
		</ul>
	</li>
        <?php }}?>
</ul>
<input type="hidden" id="batch_auth_delete" name="batch_auth_delete">
<input type="submit" value="确定删除"/>
</form>
</div>

<script type="text/javascript"> 
function batchAdd(json) {
    navTab.reload(json.batch_navtab);
    
}
function batchGetCheck(){
	var _tmp_arr = new Array();
     $('.checked :checkbox',$('#ul_tree_userlist0')).each(function(i){
            if($(this).val()!='on')
            _tmp_arr.push($(this).val());
	});
    $('#batch_auth_add').val(_tmp_arr.join(','));
	
}
function batchDelCheck(){
	var _tmp_arr = new Array();
     $('.checked :checkbox',$('#ul_tree_userlist1')).each(function(i){
            if($(this).val()!='on')
            _tmp_arr.push($(this).val());
	});
    $('#batch_auth_delete').val(_tmp_arr.join(','));
	
}

</script>