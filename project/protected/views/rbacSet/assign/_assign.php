<div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
    已分配的角色：</br>
    <div id="assigned">
        <?php foreach ($models as $value) {
            echo '<label><input type="checkbox" name="roled" value="'.$value.'">'.$value.'</label></br>';
        } ?>
    </div>
</div>
<div style="float:left; margin-top: 200px;">
    <div class="button"><div class="buttonContent"><button onclick="addRoleToUser();"><<</button></div></div>
    <div class="button"><div class="buttonContent"><button onclick="delRoleToUser();">>></button></div></div>
</div>

<div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
    未分配的角色：</br>
    <div id="assigning">
                <?php foreach ($role as $value) {
            echo '<label><input type="checkbox" name="roling" value="'.$value.'">'.$value.'</label></br>';
        } ?>
    </div>
</div>