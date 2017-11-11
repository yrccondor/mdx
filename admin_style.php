<?php
settings_errors();
$trueon=__('开启', 'mdx');
$falseoff=__('关闭', 'mdx');

//Some errors happend. I can't use WordPress Setting API. It said "Error: options page not found.", so I used another way to save the values.
wp_enqueue_script('media-upload');
wp_enqueue_script('my-upload', get_bloginfo('template_url' ).'/js/admin_upload.js');
//加载上传图片的js
wp_enqueue_script('thickbox');
//加载css(wp自带)
wp_enqueue_style('thickbox');
?>
<div class="wrap"><h1><?php _e('MDx主题 - 样式', 'mdx');?></h1>
<?php
if(($_POST['mdx_ref'] == 'true') && check_admin_referer('mdx_options_update')){
	$mdx_color_arr=array(
		'red'=>'#f44336',
		'pink'=>'#e91e63',
		'purple'=>'#9c27b0',
		'deep-purple'=>'#673ab7',
		'indigo'=>'#3f51b5',
		'blue'=>'#2196f3',
		'light-blue'=>'#03a9f4',
		'cyan'=>'#00bcd4',
		'teal'=>'#009688',
		'green'=>'#4caf50',
		'light-green'=>'#8bc34a',
		'lime'=>'#cddc39',
		'yellow'=>'#ffeb3b',
		'amber'=>'#ffc107',
		'orange'=>'#ff9800',
		'deep-orange'=>'#ff5722',
		'brown'=>'#795548',
		'grey'=>'#9e9e9e',
		'blue-grey'=>'#607d8b',
	);
	$mdx_act_arr=array(
		'red'=>'#ff5252',
		'pink'=>'#ff4081',
		'purple'=>'#e040fb',
		'deep-purple'=>'#7c4dff',
		'indigo'=>'#536dfe',
		'blue'=>'#448aff',
		'light-blue'=>'#40c4ff',
		'cyan'=>'#18ffff',
		'teal'=>'#64ffda',
		'green'=>'#69f0ae',
		'light-green'=>'#b2ff59',
		'lime'=>'#eeff41',
		'yellow'=>'#ffff00',
		'amber'=>'#ffd740',
		'orange'=>'#ffab40',
		'deep-orange'=>'#ff6e40',
	);
	update_option('mdx_styles', $_POST['mdx_styles']);
	update_option('mdx_styles_hex', $mdx_color_arr[$_POST['mdx_styles']]);
	update_option('mdx_styles_act', $_POST['mdx_styles_act']);
	update_option('mdx_act_hex', $mdx_act_arr[$_POST['mdx_styles_act']]);
	update_option('mdx_chrome_color', $_POST['mdx_chrome_color']);
	update_option('mdx_title_bar', $_POST['mdx_title_bar']);
	update_option('mdx_smooth_scroll', $_POST['mdx_smooth_scroll']);
	update_option('mdx_default_style', $_POST['mdx_default_style']);
	update_option('mdx_post_style', $_POST['mdx_post_style']);
	update_option('mdx_index_img', $_POST['mdx_index_img']);
	update_option('mdx_side_img', $_POST['mdx_side_img']);
	update_option('mdx_side_info', $_POST['mdx_side_info']);
	update_option('mdx_side_head', $_POST['mdx_side_head']);
	update_option('mdx_side_name', $_POST['mdx_side_name']);
	update_option('mdx_side_more', $_POST['mdx_side_more']);
	update_option('mdx_index_say', $_POST['mdx_index_say']);
	update_option('mdx_logo', $_POST['mdx_logo']);
	update_option('mdx_safari', $_POST['mdx_safari']);
	update_option('mdx_svg', $_POST['mdx_svg']);
	if($_POST['mdx_svg_color']=='--SaveToUseTheThemeColor--'){
		update_option('mdx_svg_color', $mdx_color_arr[$_POST['mdx_styles']]);
	}else{
		update_option('mdx_svg_color', $_POST['mdx_svg_color']);
	}
	update_option('mdx_footer_say', $_POST['mdx_footer_say']);
	update_option('mdx_footer', $_POST['mdx_footer']);
?>
<div class="notice notice-success is-dismissible">
<p><?php _e('设置已保存。', 'mdx'); ?></p>
</div>
<?php
}elseif(($_POST['mdx_ref'] == 'true') && !(check_admin_referer('mdx_options_update'))){
?>
<div class="notice notice-error is-dismissible">
<p><?php _e('更改未能保存。', 'mdx'); ?></p>
</div>
<?php
}?>
<form method="post" action="">
<?php
wp_nonce_field('mdx_options_update');
?>
<input type='hidden' name='mdx_ref' value='true'>
<table class="form-table">
<tr>
<th scope="row"><label for="mdx_styles"><?php _e('主题颜色', 'mdx');?></label></th>
<td>
<?php $mdx_v_styles=get_option('mdx_styles');?>
<select name="mdx_styles" id="mdx_styles">
	<option value="red" <?php if($mdx_v_styles=='red'){?>selected="selected"<?php }?>>Red</option>
	<option value="pink" <?php if($mdx_v_styles=='pink'){?>selected="selected"<?php }?>>Pink</option>
	<option value="purple" <?php if($mdx_v_styles=='purple'){?>selected="selected"<?php }?>>Purple</option>
	<option value="deep-purple" <?php if($mdx_v_styles=='deep-purple'){?>selected="selected"<?php }?>>Deep Purple</option>
	<option value="indigo" <?php if($mdx_v_styles=='indigo'){?>selected="selected"<?php }?>>Indigo</option>
	<option value="blue" <?php if($mdx_v_styles=='blue'){?>selected="selected"<?php }?>>Blue</option>
	<option value="light-blue" <?php if($mdx_v_styles=='light-blue'){?>selected="selected"<?php }?>>Light Blue</option>
	<option value="cyan" <?php if($mdx_v_styles=='cyan'){?>selected="selected"<?php }?>>Cyan</option>
	<option value="teal" <?php if($mdx_v_styles=='teal'){?>selected="selected"<?php }?>>Teal</option>
	<option value="green" <?php if($mdx_v_styles=='green'){?>selected="selected"<?php }?>>Green</option>
	<option value="light-green" <?php if($mdx_v_styles=='light-green'){?>selected="selected"<?php }?>>Light Green</option>
	<option value="lime" <?php if($mdx_v_styles=='lime'){?>selected="selected"<?php }?>>Lime</option>
	<option value="yellow" <?php if($mdx_v_styles=='yellow'){?>selected="selected"<?php }?>>Yellow</option>
	<option value="amber" <?php if($mdx_v_styles=='amber'){?>selected="selected"<?php }?>>Amber</option>
	<option value="orange" <?php if($mdx_v_styles=='orange'){?>selected="selected"<?php }?>>Orange</option>
	<option value="deep-orange" <?php if($mdx_v_styles=='deep-orange'){?>selected="selected"<?php }?>>Deep Orange</option>
	<option value="brown" <?php if($mdx_v_styles=='brown'){?>selected="selected"<?php }?>>Brown</option>
	<option value="grey" <?php if($mdx_v_styles=='grey'){?>selected="selected"<?php }?>>Grey</option>
	<option value="blue-grey" <?php if($mdx_v_styles=='blue-grey'){?>selected="selected"<?php }?>>Blue Grey</option>
</select>
<p class="description"><?php _e('主题颜色会影响所有页面的主色。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_styles_act"><?php _e('强调颜色', 'mdx');?></label></th>
<td>
<?php $mdx_v_styles_act=get_option('mdx_styles_act');?>
<select name="mdx_styles_act" id="mdx_styles_act">
	<option value="red" <?php if($mdx_v_styles_act=='red'){?>selected="selected"<?php }?>>Red</option>
	<option value="pink" <?php if($mdx_v_styles_act=='pink'){?>selected="selected"<?php }?>>Pink</option>
	<option value="purple" <?php if($mdx_v_styles_act=='purple'){?>selected="selected"<?php }?>>Purple</option>
	<option value="deep-purple" <?php if($mdx_v_styles_act=='deep-purple'){?>selected="selected"<?php }?>>Deep Purple</option>
	<option value="indigo" <?php if($mdx_v_styles_act=='indigo'){?>selected="selected"<?php }?>>Indigo</option>
	<option value="blue" <?php if($mdx_v_styles_act=='blue'){?>selected="selected"<?php }?>>Blue</option>
	<option value="light-blue" <?php if($mdx_v_styles_act=='light-blue'){?>selected="selected"<?php }?>>Light Blue</option>
	<option value="cyan" <?php if($mdx_v_styles_act=='cyan'){?>selected="selected"<?php }?>>Cyan</option>
	<option value="teal" <?php if($mdx_v_styles_act=='teal'){?>selected="selected"<?php }?>>Teal</option>
	<option value="green" <?php if($mdx_v_styles_act=='green'){?>selected="selected"<?php }?>>Green</option>
	<option value="light-green" <?php if($mdx_v_styles_act=='light-green'){?>selected="selected"<?php }?>>Light Green</option>
	<option value="lime" <?php if($mdx_v_styles_act=='lime'){?>selected="selected"<?php }?>>Lime</option>
	<option value="yellow" <?php if($mdx_v_styles_act=='yellow'){?>selected="selected"<?php }?>>Yellow</option>
	<option value="amber" <?php if($mdx_v_styles_act=='amber'){?>selected="selected"<?php }?>>Amber</option>
	<option value="orange" <?php if($mdx_v_styles_act=='orange'){?>selected="selected"<?php }?>>Orange</option>
	<option value="deep-orange" <?php if($mdx_v_styles_act=='deep-orange'){?>selected="selected"<?php }?>>Deep Orange</option>
</select>
<p class="description"><?php _e('强调颜色会影响所有页面的强调色。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('移动Chrome标题栏颜色', 'mdx');?></th>
<td>
<?php $mdx_v_chrome_color=get_option('mdx_chrome_color');?>
	<fieldset>
	<label><input type="radio" name="mdx_chrome_color" value="true" <?php if($mdx_v_chrome_color=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_chrome_color" value="false" <?php if($mdx_v_chrome_color=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，移动Chrome访问时，其标题栏的背景颜色会随主题颜色变化。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('自动隐藏应用栏', 'mdx');?></th>
<td>
<?php $mdx_v_title_bar=get_option('mdx_title_bar');?>
	<fieldset>
	<label><input type="radio" name="mdx_title_bar" value="true" <?php if($mdx_v_title_bar=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_title_bar" value="false" <?php if($mdx_v_title_bar=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，页面向下滚动时应用栏会向上隐藏，向上滚动时会出现。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_default_style"><?php _e('首页样式', 'mdx');?></label></th>
<td>
<?php $mdx_v_default_style=get_option('mdx_default_style');?>
<select name="mdx_default_style" id="mdx_default_style">
	<option value="1" <?php if($mdx_v_default_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
	<option value="2" <?php if($mdx_v_default_style=='2'){?>selected="selected"<?php }?>><?php _e('列表', 'mdx');?></option>
	<option value="3" <?php if($mdx_v_default_style=='3'){?>selected="selected"<?php }?>><?php _e('干净', 'mdx');?></option>
	<option value="4" <?php if($mdx_v_default_style=='4'){?>selected="selected"<?php }?>><?php _e('网格', 'mdx');?></option>
</select>
<p class="description"><?php _e('同时影响首页、搜索结果页、归档页的样式。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_post_style"><?php _e('文章页样式', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_style=get_option('mdx_post_style');?>
<select name="mdx_post_style" id="mdx_post_style">
	<option value="0" <?php if($mdx_v_post_style=='0'){?>selected="selected"<?php }?>><?php _e('标准', 'mdx');?></option>
	<option value="1" <?php if($mdx_v_post_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
	<option value="2" <?php if($mdx_v_post_style=='2'){?>selected="selected"<?php }?>><?php _e('通透', 'mdx');?></option>
</select>
<p class="description"><?php _e('同时影响文章页、单独页面的样式。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('首页图片', 'mdx');?></th>
<td>
<input name="mdx_index_img" type="url" id="mdx_index_img" value="<?php echo esc_attr(get_option('mdx_index_img'))?>" class="regular-text" readonly="readonly" required="required">
<button type="button" id="insert-media-button" class="button"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('你可以上传或指定你的媒体库中的图片作为首页上方显示的图片。点击弹出层中的“插入到文章”按钮以选定图片，弹出层中的其他选项不会生效。', 'mdx');?></p>
<img id="img1" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('抽屉菜单顶部图片', 'mdx');?></th>
<td>
<input name="mdx_side_img" type="url" id="mdx_side_img" value="<?php echo esc_attr(get_option('mdx_side_img'))?>" class="regular-text" readonly="readonly">
<button type="button" id="insert-media-button-3" class="button"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('选择一张图片作为抽屉顶部显示的图片。点击弹出层中的“插入到文章”按钮以选定图片，弹出层中的其他选项不会生效。', 'mdx');?></p>
<img id="img2" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('抽屉菜单顶部展示个人信息', 'mdx');?></th>
<td>
<?php $mdx_v_side_info=get_option('mdx_side_info');?>
	<fieldset>
	<label><input class="mdx_stbs2" type="radio" name="mdx_side_info" value="true" <?php if($mdx_v_side_info=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input class="mdx_stbs2" type="radio" name="mdx_side_info" value="false" <?php if($mdx_v_side_info=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，抽屉顶部会显示头像及名称，请在下方设置。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('抽屉菜单信息头像', 'mdx');?></th>
<td>
<input name="mdx_side_head" type="url" id="mdx_side_head" value="<?php echo esc_attr(get_option('mdx_side_head'))?>" class="regular-text mdx_stbsip22">
<button type="button" id="insert-media-button-4" class="button mdx_stbsip1"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('选择一张图片作为抽屉顶部显示的头像。留空则不显示。', 'mdx');?></p>
<img id="img3" style="width:100%;max-width:300px;height:auto;margin-top:5px;;margi-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('抽屉菜单信息名称', 'mdx');?></th>
<td>
<input name="mdx_side_name" type="text" id="mdx_side_name" value="<?php echo esc_attr(get_option('mdx_side_name'))?>" class="regular-text mdx_stbsip2" required="required">
<p class="description"><?php _e('填写抽屉信息的名称。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('抽屉菜单详细信息', 'mdx');?></th>
<td>
<input name="mdx_side_more" type="text" id="mdx_side_more" value="<?php echo esc_attr(get_option('mdx_side_more'))?>" class="regular-text mdx_stbsip2" required="required">
<p class="description"><?php _e('这里的内容会显示在抽屉菜单信息名称的下方。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('首页格言', 'mdx');?></th>
<td>
<input name="mdx_index_say" type="text" id="mdx_index_say" value="<?php echo esc_attr(get_option('mdx_index_say'))?>" class="regular-text">
<p class="description"><?php _e('这句话会展示在首页。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('网站Logo', 'mdx');?></th>
<td>
<input name="mdx_logo" type="url" id="mdx_logo" value="<?php echo esc_attr(get_option('mdx_logo'))?>" class="regular-text">
<button type="button" id="insert-media-button-2" class="button"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('选择一张图片作为网站Logo，若留空则会显示网站名称。点击弹出层中的“插入到文章”按钮以选定图片，弹出层中的其他选项不会生效。', 'mdx');?></p>
<img id="img4" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('Safari Touch Bar图标支持', 'mdx');?></th>
<td>
<?php $mdx_v_safari=get_option('mdx_safari');?>
	<fieldset>
	<label><input class="mdx_stbs" type="radio" name="mdx_safari" value="true" <?php if($mdx_v_safari=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input class="mdx_stbs" type="radio" name="mdx_safari" value="false" <?php if($mdx_v_safari=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	</fieldset>
	<p class="description"><?php _e('开启后会启用对Safari Touch Bar图标的支持，请在下方完成相关设置。<a href="https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/pinnedTabs/pinnedTabs.html" target="_blank">详细了解</a>', 'mdx');?>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_svg"><?php _e('Touch Bar图标地址', 'mdx');?></label></th>
<td><input class="mdx_stbsip regular-text mdx_stbsip3" name="mdx_svg" type="text" id="mdx_svg" value="<?php echo esc_attr(get_option('mdx_svg'))?>" required="required">
<p class="description" id="mdx_footer"><?php _e('请设置Touch Bar图标地址。格式为SVG，必须为单层，viewbox属性必须为"0 0 16 16"。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><label for="mdx_svg_color"><?php _e('Touch Bar图标背景颜色', 'mdx');?></label></th>
<td><input class="mdx_stbsip regular-text mdx_stbsip3" name="mdx_svg_color" type="text" id="mdx_svg_color" value="<?php echo esc_attr(get_option('mdx_svg_color'))?>" required="required">
<button type="button" id="change-color" class="button mdx_stbsip5"><?php _e('使用当前主题颜色', 'mdx');?></button>
<p class="description" id="mdx_footer"><?php _e('请设置Touch Bar图标背景颜色。16进制颜色或RGB颜色。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><label for="mdx_footer_say"><?php _e('页脚格言', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_footer_say" type="text" id="mdx_footer_say" value="<?php echo esc_attr(get_option('mdx_footer_say'))?>">
<button type="button" id="use-api" class="button mdx_stbsip7"><?php _e('使用一言API', 'mdx');?></button>
<p class="description" id="mdx_footer"><?php _e('这句话会显示在每个页面的页脚，如果不希望显示，请留空。若调用一言API，则每次页面刷新后都会显示不同的格言。此API来自 <a href="https://blog.lwl12.com/read/hitokoto-api.html" target="_blank">LWL</a>，虽然此来源较为安全，但还请注意安全风险。', 'mdx');?></p></td>
</tr>
<tr>
	<th scope="row"><label for="mdx_footer"><?php _e('页脚内容', 'mdx');?></label></th>
	<td><textarea name="mdx_footer" id="mdx_footer" rows="7" cols="50"><?php echo get_option('mdx_footer')?></textarea>
	<p class="description"><?php _e('在这里编辑页脚内容。受 WordPress 限制，不支持HTML格式。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"></th>
<td><p class="description" id="mdx_des"><?php _e('MDx主题兼容WordPress中文版ICP备案号功能，如使用中文版，请在 <i>WordPress设置-常规</i> 中填写备案号，MDx会将其显示在页脚并自动链接到 <i>中华人民共和国工业和信息化部</i> 网站。留空则不会显示。', 'mdx');?></p></td></tr></table><?php submit_button(); ?></form></div>