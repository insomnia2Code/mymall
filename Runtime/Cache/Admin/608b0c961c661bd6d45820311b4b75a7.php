<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OneThink管理平台</title>
    <link href="/mymall/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/mymall/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/mymall/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/mymall/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/mymall/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/mymall/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/mymall/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/mymall/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/mymall/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Login/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
    <script type="text/javascript" src="/mymall/Public/static/uploadify/jquery.uploadify.min.js"></script>
    <div class="main-title cf">
        <h2>
            <?php echo isset($info['id'])?'编辑':'添加';?>商品
        </h2>
    </div>
    <!-- 标签页导航 -->
<div class="tab-wrap">
    <div class="tab-content">
    <!-- 表单 -->
    <form id="form" action="" method="post" class="form-horizontal">
        <!-- 基础文档模型 --> 
        <ul class="tab-nav nav">
            <span class="current"><a >基本信息</a></span>
            <span><a >商品属性</a></span> 
            <span><a >详细描述</a></span>       
        </ul>
        <div class="form_pos">       
            <div class="form_tab">
                <div class="form-item">
                    <label class="item-label">商品名称</label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="goods_name" value="<?php echo ((isset($info["goods_name"]) && ($info["goods_name"] !== ""))?($info["goods_name"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品货号(No)<span class="check-tips">（用于分别商品）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="good_no" value="<?php echo ((isset($info["good_no"]) && ($info["good_no"] !== ""))?($info["good_no"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品分类<?php echo ($info["cat_id"]); ?><span class="check-tips">（用于后台显示的配置标题）</span></label>
                    <div class="controls">
                       <select name="cat_id">
                            <?php if(is_array($Menus)): $i = 0; $__LIST__ = $Menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menu["id"]); ?>" <?php if($info[cat_id] == $menu[id]): ?>selected<?php endif; ?>><?php echo ($menu["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品品牌<span class="check-tips">（用于后台显示的配置标题）</span></label>
                    <div class="controls">
                        <select name="brand_id">
                            <?php if(is_array($Menus)): $i = 0; $__LIST__ = $Menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menu["brand_id"]); ?>"><?php echo ($menu["brand_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品价格<span class="check-tips">（用于后台显示的配置标题）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="shop_price" value="<?php echo ((isset($info["shop_price"]) && ($info["shop_price"] !== ""))?($info["shop_price"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品市场价<span class="check-tips">（用于后台显示的配置标题）</span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="market_price" value="<?php echo ((isset($info["market_price"]) && ($info["market_price"] !== ""))?($info["market_price"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品库存<span class="check-tips"></span></label>
                    <div class="controls">
                        <input type="text" class="text input-large" name="goods_num" value="<?php echo ((isset($info["goods_num"]) && ($info["goods_num"] !== ""))?($info["goods_num"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">是否上架<span class="check-tips"></span></label>
                    <div class="controls">
                        <label class="radio"><input type="radio" name="is_on_sale" value="1" checked="checked">是</label>
                        <label class="radio"><input type="radio" name="is_on_sale" value="0">否</label>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">缩略图</label>
                    <div class="controls">
                        <input type="file" id="upload_picture_thumb">
                        <input type="hidden" name="thumb" id="cover_id_thumb" value="<?php echo ($info['thumb']); ?>"/>
                        <div class="upload-img-box">
                        <?php if(!empty($info['thumb'])): ?><div class="upload-pre-item"><img src=".<?php echo ($info['thumb']); ?>"/></div><?php endif; ?>
                        </div>
                    </div>
                   
                </div>
                    <!--缩略图结束-->
                <div class="form-item">
                    <label class="item-label">商品相册</label>
                    <div class="controls">
                        <input type="file" id="upload_picture_picurl">
                        <div id="picurl">

                        </div>
                        <div class="upload-img-box">
                        <?php if(!empty($info['picurl'])): if(is_array($info['picurl'])): $i = 0; $__LIST__ = $info['picurl'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$picurl): $mod = ($i % 2 );++$i;?><div class="upload-pre-item"><img src="<?php echo (get_cover($picurl,'path')); ?>"/></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="form_tab">            
                <div class="form-item">
                    <label class="item-label">推荐<span class="check-tips"></span></label>
                    <div class="controls">
                        <label class="radio"><input type="checkbox" name="is_best" value="1">精品</label>
                        <label class="radio"><input type="checkbox" name="is_new" value="1">新品</label>
                        <label class="radio"><input type="checkbox" name="is_hot" value="1">热卖</label>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品类型</label>
                    <div class="controls">
                        <select name="type" id="type">
                            <?php if(is_array($Product)): $i = 0; $__LIST__ = $Product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pro): $mod = ($i % 2 );++$i;?><option value="<?php echo ($pro["id"]); ?>" <?php if($pro[id] == $info[type]): ?>selected<?php endif; ?>><?php echo ($pro["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">商品属性<span class="check-tips">（用于分别商品）</span></label>
                    <div class="controls">
                        <table class="attr_table" id="attr_table">
                            
                            <tr><td colspan="10" style="text-align:left;"><span id="addattr">新增</span></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form_tab">            
                <div class="form-item">
                    <label class="item-label">商品描述<span class="check-tips"></span></label>
                    <div class="controls">
                       <input type="text" class="text input-large" name="description" value="<?php echo ((isset($info["description"]) && ($info["description"] !== ""))?($info["description"]):''); ?>">
                    </div>
                </div>
                <div class="form-item">
                    <label class="item-label">详细描述<span class="check-tips"></span></label>
                    <div class="controls">
                        <label class="textarea">
                            <textarea name="content"><?php echo ($info["content"]); ?></textarea>
                            </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-item cf">
            <button class="btn submit-btn ajax-post hidden" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            <a class="btn btn-return" href="<?php echo U('article/index?cate_id='.$cate_id);?>">返 回</a>
            
            <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>"/>
            <input type="hidden" name="pid" value="<?php echo ((isset($info["pid"]) && ($info["pid"] !== ""))?($info["pid"]):''); ?>"/>
            <input type="hidden" name="model_id" value="<?php echo ((isset($info["model_id"]) && ($info["model_id"] !== ""))?($info["model_id"]):''); ?>"/>
            <input type="hidden" name="group_id" value="<?php echo ((isset($info["group_id"]) && ($info["group_id"] !== ""))?($info["group_id"]):''); ?>"/>
            <input type="hidden" name="category_id" value="<?php echo ((isset($info["category_id"]) && ($info["category_id"] !== ""))?($info["category_id"]):''); ?>">
        </div>
    </form>
    </div>
</div>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/mymall", //当前网站地址
            "APP"    : "/mymall/admin.php?s=", //当前项目地址
            "PUBLIC" : "/mymall/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/mymall/Public/static/think.js"></script>
    <script type="text/javascript" src="/mymall/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
<link href="/mymall/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css">
<?php if(C('COLOR_STYLE')=='blue_color') echo '<link href="/mymall/Public/static/datetimepicker/css/datetimepicker_blue.css" rel="stylesheet" type="text/css">'; ?>
<link href="/mymall/Public/static/datetimepicker/css/dropdown.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/mymall/Public/static/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/mymall/Public/static/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
<script type="text/javascript">
//上传图片
/* 初始化上传插件 */
$("#upload_picture_thumb").uploadify({
    "height"          : 30,
    "swf"             : "/mymall/Public/static/uploadify/uploadify.swf",
    "fileObjName"     : "download",
    "buttonText"      : "上传图片",
    "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
    "width"           : 120,
    'removeTimeout'   : 1,
    'fileTypeExts'    : '*.jpg; *.png; *.gif;*.jpeg;',
    "onUploadSuccess" : uploadPicturethumb,
    'onFallback' : function() {
        alert('未检测到兼容版本的Flash.');
    }
});
function uploadPicturethumb(file, data){
    var data = $.parseJSON(data);
    var src = '';
    if(data.status){
        $("#cover_id_thumb").val(data.path);
        src = data.url || '/mymall' + data.path
        $("#cover_id_thumb").parent().find('.upload-img-box').html(
            '<div class="upload-pre-item"><img src="' + src + '"/></div>'
        );
    } else {
        updateAlert(data.info);
        setTimeout(function(){
            $('#top-alert').find('button').click();
            $(that).removeClass('disabled').prop('disabled',false);
        },1500);
    }
}
//上传多张图片
$("#upload_picture_picurl").uploadify({
    "height"          : 30,
    "swf"             : "/mymall/Public/static/uploadify/uploadify.swf",
    "fileObjName"     : "download",
    "buttonText"      : "上传图片",
    "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
    "width"           : 120,
    'removeTimeout'   : 1,
    'fileTypeExts'    : '*.jpg; *.png; *.gif;*.jpeg;',
    "onUploadSuccess" : uploadPicturepicurl,
    'onFallback' : function() {
        alert('未检测到兼容版本的Flash.');
    }
});
function uploadPicturepicurl(file, data){
    var data = $.parseJSON(data);
    var src = '';
    if(data.status){
        $("#picurl").append(
            '<input type="hidden" name="picurl[]" value="'+data.id+'"/>'
        );
        src = data.url || '/mymall' + data.path
        $("#picurl").parent().find('.upload-img-box').append(
            '<div class="upload-pre-item"><img src="' + src + '"/></div>'
        );
    } else {
        updateAlert(data.info);
        setTimeout(function(){
            $('#top-alert').find('button').click();
            $(that).removeClass('disabled').prop('disabled',false);
        },1500);
    }
}
</script>
<script type="text/javascript">

//单选、复选框 是否选中
Think.setValue("is_on_sale", <?php echo ((isset($info["is_on_sale"]) && ($info["is_on_sale"] !== ""))?($info["is_on_sale"]): 1); ?>);
Think.setValue("is_hot", <?php echo ((isset($info["is_hot"]) && ($info["is_hot"] !== ""))?($info["is_hot"]): 0); ?>);
Think.setValue("is_new", <?php echo ((isset($info["is_new"]) && ($info["is_new"] !== ""))?($info["is_new"]): 0); ?>);
Think.setValue("is_best", <?php echo ((isset($info["is_best"]) && ($info["is_best"] !== ""))?($info["is_best"]): 0); ?>);

//导航高亮
highlight_subnav('<?php echo U('index');?>');

$('#submit').click(function(){
    $('#form').submit();
});

$(function(){

    //加载属性
    $('#type').change(function(){

        $.post('<?php echo U("Admin/Goods/getAttr");?>',{type:$(this).val()},function(data){
            if(data.status){
                $('#attr_table').append(data.content.top);
                $('#attr_table').append(data.content.content)
                $contentTop = data.content.top;
                $contentCont = data.content.content;
            }else{
            }
        })
    });

    $('#addattr').click(function(){
        $('#attr_table').append($contentCont);
    });

    $('#attr_table').on('click', '.del_attr', function(){
          $(this).parent().parent().remove();
    });

    $('.date').datetimepicker({
        format: 'yyyy-mm-dd',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();
    //选项卡
    $(".nav span").click(function(){
        $(this).addClass('current').siblings().removeClass('current');
        $('.form_pos .form_tab').eq($(this).index()).show().siblings().hide();
    });
    <?php if(C('OPEN_DRAFTBOX') and (ACTION_NAME == 'add' or $info['status'] == 3)): ?>//保存草稿
    var interval;
    $('#autoSave').click(function(){
        var target_form = $(this).attr('target-form');
        var target = $(this).attr('url')
        var form = $('.'+target_form);
        var query = form.serialize();
        var that = this;

        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query).success(function(data){
            if (data.status==1) {
                updateAlert(data.info ,'alert-success');
                $('input[name=id]').val(data.data.id);
            }else{
                updateAlert(data.info);
            }
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        })

        //重新开始定时器
        clearInterval(interval);
        autoSaveDraft();
        return false;
    });

    //Ctrl+S保存草稿
    $('body').keydown(function(e){
        if(e.ctrlKey && e.which == 83){
            $('#autoSave').click();
            return false;
        }
    });

    //每隔一段时间保存草稿
    function autoSaveDraft(){
        interval = setInterval(function(){
            //只有基础信息填写了，才会触发
            var title = $('input[name=title]').val();
            var name = $('input[name=name]').val();
            var des = $('textarea[name=description]').val();
            if(title != '' || name != '' || des != ''){
                $('#autoSave').click();
            }
        }, 1000*parseInt(<?php echo C('DRAFT_AOTOSAVE_INTERVAL');?>));
    }
    autoSaveDraft();<?php endif; ?>

});
</script>

</body>
</html>