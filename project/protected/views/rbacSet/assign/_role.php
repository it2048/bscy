<div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
    已分配的任务：</br>
    <div id="assigned">
        <?php foreach ($models as $value) {
            echo '<label><input type="checkbox" name="tasked" value="'.$value.'">'.$value.'</label></br>';
        } ?>
    </div>
</div>
<div style="float:left; margin-top: 200px;">
    <div class="button"><div class="buttonContent"><button onclick="addTaskToRole();"><<</button></div></div>
    <div class="button"><div class="buttonContent"><button onclick="delTaskToRole();">>></button></div></div>
</div>

<div style="float:left; display:block; margin:10px; overflow:auto; width:240px; height:520px; overflow:auto; border:solid 1px #CCC; line-height:21px; background:#FFF;">
    未分配的任务：</br>
    <div id="assigning">
                <?php foreach ($task as $value) {
            echo '<label><input type="checkbox" name="tasking" value="'.$value.'">'.$value.'</label></br>';
        } ?>
    </div>
</div>