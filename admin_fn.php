<?php
settings_errors();
$trueon=__('开启', 'mdx');
$falseoff=__('关闭', 'mdx');

wp_enqueue_script('media-upload');
wp_enqueue_script('my-tag', get_bloginfo('template_url' ).'/js/admin_tag.js');
//加载上传图片的js
wp_enqueue_script('thickbox');
//加载css(wp自带)
wp_enqueue_style('thickbox');
?>
<div class="wrap"><h1><?php _e('MDx主题 - 功能', 'mdx');?></h1>
<?php
if(($_POST['mdx_ref'] == 'true') && check_admin_referer('mdx_options_update')){
	update_option('mdx_night_style', $_POST['mdx_night_style']);
	update_option('mdx_auto_night_style', $_POST['mdx_auto_night_style']);
	update_option('mdx_notice', $_POST['mdx_notice']);
	update_option('mdx_open_side', $_POST['mdx_open_side']);
	update_option('mdx_img_box', $_POST['mdx_img_box']);
	update_option("mdx_readmore", $_POST['mdx_readmore']);
	update_option("mdx_post_money", $_POST['mdx_post_money']);
	update_option("mdx_lazy_load_mode", $_POST['mdx_lazy_load_mode']);
	update_option('mdx_read_pro', $_POST['mdx_read_pro']);
	update_option('mdx_auto_scroll', $_POST['mdx_auto_scroll']);
	update_option('mdx_load_pro', $_POST['mdx_load_pro']);
	update_option('mdx_post_list_1', $_POST['mdx_post_list_1']);
	update_option('mdx_post_list_2', $_POST['mdx_post_list_2']);
	update_option('mdx_real_search', $_POST['mdx_real_search']);
	update_option('mdx_seo_key', $_POST['mdx_seo_key']);
	update_option('mdx_auto_des', $_POST['mdx_auto_des']);
	update_option('mdx_seo_des', $_POST['mdx_seo_des']);
	
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
<th scope="row"><?php _e('夜间模式', 'mdx');?></th>
<td>
<?php $mdx_v_night_style=get_option('mdx_night_style');?>
	<fieldset>
	<label><input class="mdx_stbs" type="radio" name="mdx_night_style" value="true" <?php if($mdx_v_night_style=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input class="mdx_stbs" type="radio" name="mdx_night_style" value="false" <?php if($mdx_v_night_style=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，侧边栏中会出现夜间模式切换按钮。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('自动夜间模式', 'mdx');?></th>
<td>
<?php $mdx_v_auto_night_style=get_option('mdx_auto_night_style');?>
	<fieldset>
	<label><input class="mdx_stbsip" type="radio" name="mdx_auto_night_style" value="true" <?php if($mdx_v_auto_night_style=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input class="mdx_stbsip" type="radio" name="mdx_auto_night_style" value="false" <?php if($mdx_v_auto_night_style=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('<strong>仅当开启夜间模式功能后此选项方可生效。</strong>开启后，22:30至第二天5:30之间打开页面时自动加载夜间模式。优先级低于用户自行设置。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
	<th scope="row"><label for="mdx_notice"><?php _e('网站公告', 'mdx');?></label></th>
	<td><textarea name="mdx_notice" id="mdx_notice" rows="7" cols="50"><?php echo esc_attr(get_option('mdx_notice'))?></textarea>
	<p class="description"><?php _e('在这里编辑网站公告。公告会显示在首页文章列表的顶部，留空则不会显示。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('使用手势打开抽屉菜单', 'mdx');?></th>
<td>
<?php $mdx_v_open_side=get_option('mdx_open_side');?>
	<fieldset>
	<label><input type="radio" name="mdx_open_side" value="true" <?php if($mdx_v_open_side=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_open_side" value="false" <?php if($mdx_v_open_side=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，可以通过从屏幕左侧向中心滑动的方式调出抽屉菜单。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('ImgBox', 'mdx');?></th>
<td>
<?php $mdx_v_img_box=get_option('mdx_img_box');?>
	<fieldset>
	<label><input type="radio" name="mdx_img_box" value="true" <?php if($mdx_v_img_box=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_img_box" value="false" <?php if($mdx_v_img_box=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，对于文章内包裹在指向自身的链接中的图片可点击查看大图。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_readmore"><?php _e('“阅读更多”文本自定义', 'mdx');?></label></th>
<td><input name="mdx_readmore" type="text" id="mdx_readmore" value="<?php echo esc_attr(get_option('mdx_readmore'))?>" class="regular-text">
<p class="description" id="mdx_footer"><?php _e('在此自定义“阅读更多”按钮上的文本。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('赞赏二维码', 'mdx');?></th>
<td>
<input name="mdx_post_money" type="text" id="mdx_post_money" value="<?php echo esc_attr(get_option('mdx_post_money'))?>" class="regular-text">
<button type="button" id="insert-media-button" class="button"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('你可以上传或指定你的媒体库中的图片作为赞赏二维码。当此空不为空时将在文章底部显示赞赏按钮。', 'mdx');?></p>
<img id="img1" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('阅读进度展示', 'mdx');?></th>
<td>
<?php $mdx_v_read_pro=get_option('mdx_read_pro');?>
	<fieldset>
	<label><input type="radio" name="mdx_read_pro" value="true" <?php if($mdx_v_read_pro=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_read_pro" value="false" <?php if($mdx_v_read_pro=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，会在文章/单独页面展示阅读进度。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_lazy_load_mode"><?php _e('LazyLoad 模式', 'mdx');?></label></th>
<td>
<?php $mdx_v_lazy_load_mode=get_option('mdx_lazy_load_mode');?>
<select name="mdx_lazy_load_mode" id="mdx_lazy_load_mode">
	<option value="speed" <?php if($mdx_v_lazy_load_mode=='speed'){?>selected="selected"<?php }?>><?php _e('速度优先', 'mdx');?></option>
	<option value="seo1" <?php if($mdx_v_lazy_load_mode=='seo1'){?>selected="selected"<?php }?>><?php _e('SEO优先（轻度）', 'mdx');?></option>
	<option value="seo2" <?php if($mdx_v_lazy_load_mode=='seo2'){?>selected="selected"<?php }?>><?php _e('SEO优先（重度）', 'mdx');?></option>
</select>
<p class="description"><?php _e('LazyLoad 即图片会在即将滚动到屏幕内时才开始加载的技术（可能会影响 SEO）。此设置会影响图片加载模式。<br>速度优先：几乎所有图片都会使用 LazyLoad<br>SEO优先（轻度）：除文章内使用的图片外几乎所有图片都会使用 LazyLoad<br>SEO优先（重度）：文章内使用的图片和文章列表使用的图片不会使用 LazyLoad，但仍有少量装饰性图片会使用', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('转移设备时记录阅读进度', 'mdx');?></th>
<td>
<?php $mdx_v_auto_scroll=get_option('mdx_auto_scroll');?>
	<fieldset>
	<label><input type="radio" name="mdx_auto_scroll" value="true" <?php if($mdx_v_auto_scroll=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_auto_scroll" value="false" <?php if($mdx_v_auto_scroll=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，文章中通过二维码转移到其他设备阅读时会自动记录阅读进度并滚动。建议在网页加载速度较快时启用。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('页面加载进度条', 'mdx');?></th>
<td>
<?php $mdx_v_load_pro=get_option('mdx_load_pro');?>
	<fieldset>
	<label><input type="radio" name="mdx_load_pro" value="true" <?php if($mdx_v_load_pro=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_load_pro" value="false" <?php if($mdx_v_load_pro=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，文章/单独页面加载时会在页面顶部显示加载进度条（仅动画，非真实进度），页面加载完成后消失。', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_post_list_1"><?php _e('文章列表详细信息 - 位置1', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_list_1=get_option('mdx_post_list_1');?>
<select name="mdx_post_list_1" id="mdx_post_list_1">
	<option value="view" <?php if($mdx_v_post_list_1=='view'){?>selected="selected"<?php }?>>浏览量</option>
	<option value="time" <?php if($mdx_v_post_list_1=='time'){?>selected="selected"<?php }?>>发表时间</option>
	<option value="comments" <?php if($mdx_v_post_list_1=='comments'){?>selected="selected"<?php }?>>评论数</option>
</select>
<p class="description"><?php _e('详细信息显示在文章列表每篇文章的底部。在此指定你希望展示的信息。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_post_list_2"><?php _e('文章列表详细信息 - 位置2', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_list_2=get_option('mdx_post_list_2');?>
<select name="mdx_post_list_2" id="mdx_post_list_2">
	<option value="view" <?php if($mdx_v_post_list_2=='view'){?>selected="selected"<?php }?>>浏览量</option>
	<option value="time" <?php if($mdx_v_post_list_2=='time'){?>selected="selected"<?php }?>>发表时间</option>
	<option value="comments" <?php if($mdx_v_post_list_2=='comments'){?>selected="selected"<?php }?>>评论数</option>
</select>
<p class="description"><?php _e('详细信息显示在文章列表每篇文章的底部。在此指定你希望展示的信息。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_share_area"><?php _e('分享到的服务商', 'mdx');?></label></th>
<td>
<?php $mdx_v_share_area=get_option('mdx_share_area');?>
<select name="mdx_share_area" id="mdx_share_area">
	<option value="all" <?php if($mdx_v_share_area=='all'){?>selected="selected"<?php }?>>所有服务</option>
	<option value="china" <?php if($mdx_v_share_area=='china'){?>selected="selected"<?php }?>>只有中国国内服务商</option>
	<option value="oversea" <?php if($mdx_v_share_area=='oversea'){?>selected="selected"<?php }?>>只有国际服务商</option>
</select>
<p class="description"><?php _e('指定你想提供给访问者的分享服务商。<br>“只有中国国内服务商”提供：微博、QQ、QQ 空间 的分享<br>“只有国际服务商”提供：Telegrame、Google+、Twitter、Facebook 的分享<br>无论如何，“生成分享图”始终启用。同时，由于微信 SDK 限制，MDx 无法集成微信分享，你可以自行完善。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('点击顶部栏返回顶部', 'mdx');?></th>
<td>
<?php $mdx_v_tap_to_top=get_option('mdx_tap_to_top');?>
	<fieldset>
	<label><input type="radio" name="mdx_tap_to_top" value="true" <?php if($mdx_v_tap_to_top=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_tap_to_top" value="false" <?php if($mdx_v_tap_to_top=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，点击顶部栏可以返回页面顶部，具体效果参考 知乎/QQ 空间 客户端。此设置影响所有页面。</strong>', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('文末推荐文章', 'mdx');?></th>
<td>
<?php $mdx_v_you_may_like=get_option('mdx_you_may_like');?>
	<fieldset>
	<label><input type="radio" name="mdx_you_may_like" value="true" <?php if($mdx_v_you_may_like=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_you_may_like" value="false" <?php if($mdx_v_you_may_like=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，文章末会展示最多7篇相似文章。相似文章基于相同分类或相同标签的文章。</strong>', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_you_may_like_text"><?php _e('推荐文章标题', 'mdx');?></label></th>
<td><input name="mdx_you_may_like_text" type="text" id="mdx_you_may_like_text" value="<?php echo esc_attr(get_option('mdx_you_may_like_text'))?>" class="regular-text" require>
<p class="description"><?php _e('在此设置推荐文章模块的标题。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('实时搜索', 'mdx');?></th>
<td>
<?php $mdx_v_real_search=get_option('mdx_real_search');?>
	<fieldset>
	<label><input type="radio" name="mdx_real_search" value="true" <?php if($mdx_v_real_search=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_real_search" value="false" <?php if($mdx_v_real_search=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，进行搜索时会随用户输入实时反馈搜索结果。<strong>需要WordPress REST API支持。此API默认开启，请确保你没有将其关闭。</strong>', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_seo_key"><?php _e('SEO关键词', 'mdx');?></label></th>
<td><input name="mdx_seo_key" type="text" id="mdx_seo_key" value="<?php echo esc_attr(get_option('mdx_seo_key'))?>" class="regular-text">
<p class="description" id="mdx_footer"><?php _e('用半角逗号分割关键词，数量在5个以内最佳。留空代表不开启此功能。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('自动生成网页描述', 'mdx');?></th>
<td>
<?php $mdx_v_auto_des=get_option('mdx_auto_des');?>
	<fieldset>
	<label><input type="radio" name="mdx_auto_des" value="true" <?php if($mdx_v_auto_des=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
	<label><input type="radio" name="mdx_auto_des" value="false" <?php if($mdx_v_auto_des=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
	<p class="description"><?php _e('开启后，会自动生成SEO网页描述。<strong>对首页无效，请在下方输入首页描述。</strong>', 'mdx');?></p>
	</fieldset>
</td>
</tr>
<tr>
	<th scope="row"><label for="mdx_seo_des"><?php _e('SEO描述', 'mdx');?></label></th>
	<td><textarea name="mdx_seo_des" id="mdx_seo_des" rows="7" cols="50"><?php echo esc_attr(get_option('mdx_seo_des'))?></textarea>
	<p class="description"><?php _e('在这里编辑网页描述。如开启自动生成网页描述功能，则此空仅对首页有效，其他页面会自动生成网页描述。此空留空则表示关闭全局SEO描述功能。', 'mdx');?></p></td>
</tr>
</table><?php submit_button(); ?></form></div>