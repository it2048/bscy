<div class="pageContent">
    <form method="post" action="<?php echo Yii::app()->createAbsoluteUrl('admincol/exp'); ?>" class="pageForm required-validate" enctype="multipart/form-data">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>选择开始日期：</label>
                <input type="text" name="smonth" size="10" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo date('Ym');?>"/>
            </p>
            <p>
                <label>选择结束日期：</label>
                <input type="text" name="pmonth" size="10" class="date" dateFmt="yyyyMM" readonly="true" value="<?php echo date('Ym',time());?>"/>
            </p>
            <p>
                <label>选择导出类型：</label>
                <select name="mcol_type">
                    <?php
                    foreach(TempList::$col as $k=>$val)
                    {
                        echo sprintf('<option value="%s">%s</option>',$k,$val);
                    }
                    ?>
                </select>
            </p>

        </div>
        <div class="formBar">
            <ul>
                <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
                <li><div class="buttonActive"><div class="buttonContent"><button type="submit">确定导出</button></div></div></li>
                <li><div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div></li>
            </ul>
        </div>
    </form>
</div>