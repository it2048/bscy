<div class="weui_cells weui_cells_form">
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">店号</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <?=$model->sno?>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <?=$model->sname?>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">工作站</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <?=TempList::$arena[$model['scate']]?>
        </div>
    </div>
    <div class="weui_cell">
        <div class="weui_cell_hd"><label class="weui_label">餐厅</label></div>
        <div class="weui_cell_bd weui_cell_primary">
            <input class="weui_input" type="text" name="cname" value="<?=$model->ctname?>" placeholder="请输入餐厅名">
        </div>
    </div>
    <?php
    if($model->simg != '')
    {
        echo sprintf("<img width='77' height='77' src='%s/public/%s'><br>",Yii::app()->request->baseUrl,$model->simg);
    }
    ?>
    <div class="weui_cell">
        <div id="uploader"></div>
    </div>
    <div class="weui_cells_title">宣言</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea class="weui_textarea" placeholder="请输入宣言" rows="3"><?=$model->sdesc?></textarea>
            </div>
        </div>
    </div>
</div>
<div class="weui_btn_area"><a href="javascript:;" id="psave" class="weui_btn weui_btn_warn">保存&预览</a></div>
<div class="weui_btn_area"><a href="javascript:;" id="del" class="weui_btn weui_btn_plain_primary">删除</a></div>


<div class="weui_dialog_alert">
    <div class="weui_mask"></div>
    <div class="weui_dialog">
        <div class="weui_dialog_hd">
            <strong class="weui_dialog_title">弹窗标题</strong>
        </div>
        <div class="weui_dialog_bd">弹窗内容，告知当前页面信息等</div>
        <div class="weui_dialog_ft">
            <a href="javascript:;" class="weui_btn_dialog primary">确定</a>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var palert = function(title,desc){
            $(".weui_dialog_title").html(title);
            $(".weui_dialog_bd").html(desc);
            $(".weui_dialog_alert").show();
        };
        var clk = true;
        var img = '<?=$model->simg?>';
        $(".weui_dialog_alert").hide();
        $(".weui_btn_dialog").on("click",function(){
            clk = true;
            $("#psave").removeClass("weui_btn_disabled");
            $(".weui_dialog_alert").hide();
        });
        var oldFnUploader = $.fn.uploader;
        $.fn.uploader = function (options) {
            options = $.extend({
                title: '图片上传',
                maxCount: 4,
                maxWidth: 500,
                onChange: $.noop
            }, options);

            var html = '<div class="weui_uploader">\n                        <div class="weui_uploader_hd weui_cell">\n                            <div class="weui_cell_bd weui_cell_primary">' + options.title + '</div>\n                            <div class="weui_cell_ft">0/' + options.maxCount + '</div>\n                        </div>\n                        <div class="weui_uploader_bd">\n                            <ul class="weui_uploader_files">\n                            </ul>\n                            <div class="weui_uploader_input_wrp">\n                                <input class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif">\n                            </div>\n                        </div>\n                    </div>';
            this.html(html);

            var $uploader = this;
            var $files = this.find('.weui_uploader_files');
            var $file = this.find('.weui_uploader_input');
            var count = 0;
            $file.on('change', function (event) {
                var files = event.target.files;

                if (files.length === 0) {
                    return;
                }

                if (count >= options.maxCount) {
                    palert('发现一个问题','最多只能上传' + options.maxCount + '张图片');
                    return;
                }

                $.each(files, function (idx, file) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = new Image();
                        img.onload = function () {
                            // 不要超出最大宽度
                            var w = Math.min(options.maxWidth, img.width);
                            // 高度按比例计算
                            var h = img.height * (w / img.width);
                            var canvas = document.createElement('canvas');
                            var ctx = canvas.getContext('2d');
                            // 设置 canvas 的宽度和高度
                            canvas.width = w;
                            canvas.height = h;

                            var iphone = navigator.userAgent.match(/iPhone OS ([^\s]*)/);
                            if (iphone && iphone[1].substr(0, 1) == 7) {
                                if (img.width == 3264 && img.height == 2448) {
                                    // IOS7的拍照或选照片会被莫名地压缩，所以画板要height要*2
                                    ctx.drawImage(img, 0, 0, w, h * 2);
                                } else {
                                    ctx.drawImage(img, 0, 0, w, h);
                                }
                            } else {
                                ctx.drawImage(img, 0, 0, w, h);
                            }

                            var base64 = canvas.toDataURL('image/png');

                            $files.append('<li class="weui_uploader_file " style="background-image:url(' + base64 + ')"></li>');
                            ++count;
                            $uploader.find('.weui_uploader_hd .weui_cell_ft').text(count + '/' + options.maxCount);

                            options.onChange.call($uploader, {
                                lastModified: file.lastModified,
                                lastModifiedDate: file.lastModifiedDate,
                                name: file.name,
                                size: file.size,
                                type: file.type,
                                data: base64
                            });
                        };

                        img.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            });

            this.update = function (msg) {
                var $preview = $files.find('.weui_uploader_file').last();
                $preview.addClass('weui_uploader_status');
                $preview.html('<div class="weui_uploader_status_content">' + msg + '</div>');
            };

            this.success = function () {
                var $preview = $files.find('.weui_uploader_file').last();
                $preview.removeClass('weui_uploader_status');
                $preview.html('');
            };

            this.error = function () {
                var $preview = $files.find('.weui_uploader_file').last();
                $preview.addClass('weui_uploader_status');
                $preview.html('<div class="weui_uploader_status_content"><i class="weui_icon_warn"></i></div>');
            };

            return this;
        };
        $.fn.uploader.noConflict = function () {
            return oldFnUploader;
        };

        $('#uploader').uploader({
            maxCount: 1,
            onChange: function (file) {
                var update = this.update;
                var success = this.success;
                var error = this.error;
                $.ajax({
                    type: 'POST',
                    url: '<?=Yii::app()->createAbsoluteUrl('home/upload',array("id"=>$model->id)); ?>',
                    data: {
                        img: file.data
                    },
                    dataType: "json",
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.addEventListener('progress', function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total;
                                update(percentComplete + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function(res){
                        if(res.code == 0)
                        {
                            success();
                            img = res.data;
                        }
                        else
                            error();
                    },
                    error: function (err){
                        error();
                    }
                });
            }
        });

        $("#psave").on("click",function(){
            if(!clk) return;
            var cname = $("input[name=cname]").val();
            var content = $(".weui_textarea").val();
            if($.trim(cname) == '')
            {
                palert('发现一个问题','餐厅名不能为空');
            }else if($.trim(content) == ''){
                palert('发现一个问题','宣言不能为空');
            }else if(content.length > 1000){
                palert('发现一个问题','宣言不能多于1000字');
            }else
            {
                $("#psave").addClass("weui_btn_disabled");
                clk = false;
                $.ajax({
                    url: '<?=Yii::app()->createAbsoluteUrl('home/publish',array("id"=>$model->id)); ?>',
                    type: 'POST',
                    data: {cname:cname,content:content,img:img},
                    dataType: "json",
                    success: function(data) {
                        if(data.code==0)
                        {
                            window.location.href = data.data;
                        }
                        else
                            palert('发现一个问题',data.msg);
                    }
                });
            }
        });

        $("#del").on("click",function(){
            $.ajax({
                url: '<?=Yii::app()->createAbsoluteUrl('home/del',array("id"=>$model->id)); ?>',
                type: 'POST',
                dataType: "json",
                success: function(data) {
                    if(data.code==0)
                    {
                        window.location.href = data.data;
                    }else{
                        palert('发现一个问题',data.msg);

                    }
                }
            });

        });

    });
</script>