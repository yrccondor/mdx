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
<div class="wrap"><h1><?php _e('MDx 主题 - 功能', 'mdx');?></h1>
<?php
if((isset($_POST['mdx_ref']) && $_POST['mdx_ref'] == 'true') && check_admin_referer('mdx_options_update')){
    mdx_update_option('mdx_install', $_POST['mdx_install']);
    if(isset($_POST['mdx_night_style'])){
        mdx_update_option('mdx_night_style', $_POST['mdx_night_style']);
    }else{
        mdx_update_option('mdx_night_style', 'false');
    }
    if(isset($_POST['mdx_auto_night_style'])){
        mdx_update_option('mdx_auto_night_style', $_POST['mdx_auto_night_style']);
    }else{
        mdx_update_option('mdx_auto_night_style', 'false');
    }
    mdx_update_option('mdx_notice', htmlentities(stripslashes($_POST['mdx_notice'])));
    mdx_update_option('mdx_open_side', $_POST['mdx_open_side']);
    mdx_update_option('mdx_widget', $_POST['mdx_widget']);
    mdx_update_option('mdx_cookie', htmlentities(stripslashes($_POST['mdx_cookie'])));
    mdx_update_option('mdx_allow_scale', $_POST['mdx_allow_scale']);
    mdx_update_option('mdx_reduce_motion', $_POST['mdx_reduce_motion']);
    mdx_update_option('mdx_img_box', $_POST['mdx_img_box']);
    mdx_update_option("mdx_readmore", $_POST['mdx_readmore']);
    mdx_update_option("mdx_post_money", $_POST['mdx_post_money']);
    mdx_update_option('mdx_read_pro', $_POST['mdx_read_pro']);
    mdx_update_option('mdx_auto_scroll', $_POST['mdx_auto_scroll']);
    mdx_update_option('mdx_toc', $_POST['mdx_toc']);
    mdx_update_option('mdx_load_pro', $_POST['mdx_load_pro']);
    mdx_update_option('mdx_post_list_1', $_POST['mdx_post_list_1']);
    mdx_update_option('mdx_post_list_2', $_POST['mdx_post_list_2']);
    mdx_update_option('mdx_post_list_3', $_POST['mdx_post_list_3']);
    mdx_update_option('mdx_post_edit_time', $_POST['mdx_post_edit_time']);
    mdx_update_option('mdx_author_card', $_POST['mdx_author_card']);
    mdx_update_option("mdx_lazy_load_mode", $_POST['mdx_lazy_load_mode']);
    mdx_update_option("mdx_lazyload_fallback", $_POST['mdx_lazyload_fallback']);
    mdx_update_option("mdx_enhanced_ajax", $_POST['mdx_enhanced_ajax']);
    mdx_update_option('mdx_speed_pre', $_POST['mdx_speed_pre']);
    mdx_update_option('mdx_share_area', $_POST['mdx_share_area']);
    mdx_update_option('mdx_tap_to_top', $_POST['mdx_tap_to_top']);
    mdx_update_option('mdx_hot_posts', $_POST['mdx_hot_posts']);
    mdx_update_option('mdx_hot_posts_num', $_POST['mdx_hot_posts_num']);
    mdx_update_option('mdx_hot_posts_cat', $_POST['mdx_hot_posts_cat']);
    mdx_update_option('mdx_hot_posts_text', $_POST['mdx_hot_posts_text']);
    mdx_update_option('mdx_all_posts_text', $_POST['mdx_all_posts_text']);
    mdx_update_option('mdx_you_may_like', $_POST['mdx_you_may_like']);
    mdx_update_option('mdx_you_may_like_way', $_POST['mdx_you_may_like_way']);
    mdx_update_option('mdx_you_may_like_text', $_POST['mdx_you_may_like_text']);
    mdx_update_option('mdx_real_search', $_POST['mdx_real_search']);
    mdx_update_option('mdx_comment_ajax', $_POST['mdx_comment_ajax']);
    mdx_update_option('mdx_ad', htmlentities(stripslashes($_POST['mdx_ad'])));
    mdx_update_option('mdx_logged_in_ad', $_POST['mdx_logged_in_ad']);
    mdx_update_option('mdx_comment_ajax', $_POST['mdx_comment_ajax']);
    mdx_update_option('mdx_seo_key', $_POST['mdx_seo_key']);
    mdx_update_option('mdx_auto_des', $_POST['mdx_auto_des']);
    mdx_update_option('mdx_seo_des', htmlentities(stripslashes($_POST['mdx_seo_des'])));
    mdx_update_option('mdx_head_js', htmlentities(stripslashes($_POST['mdx_head_js'])));
    mdx_update_option('mdx_footer_js', htmlentities(stripslashes($_POST['mdx_footer_js'])));
    mdx_update_option('mdx_icp_num', $_POST['mdx_icp_num']);
?>
<div class="notice notice-success is-dismissible">
<p><?php _e('设置已保存。', 'mdx'); ?></p>
</div>
<?php
}elseif((isset($_POST['mdx_ref']) && $_POST['mdx_ref'] == 'true') && !(check_admin_referer('mdx_options_update'))){
?>
<div class="notice notice-error is-dismissible">
<p><?php _e('更改未能保存。', 'mdx'); ?></p>
</div>
<?php
}?>
<?php if(get_option('mdx_new_ver') !=get_option('mdx_version')){?>
<div class="notice notice-info is-dismissible">
<p><?php _e('MDx 已发布新版本 ', 'mdx');echo get_option('mdx_new_ver');_e('。<a href="/wp-admin/admin.php?page=mdx_about">重新检查</a>', 'mdx');?></p>
</div>
<?php }?>
<form method="post" action="">
<?php
wp_nonce_field('mdx_options_update');
?>
<input type='hidden' name='mdx_ref' value='true'>
<table class="form-table">
<tr>
<th scope="row"><?php _e('WordPress 安装方式', 'mdx');?></th>
<td>
<?php $mdx_v_install=mdx_get_option('mdx_install');
$mdx_subdir = __('常规安装', 'mdx');
if(stripos(explode('//', home_url())[1], "/")){
    $mdx_subdir = __('子目录安装', 'mdx');
}?>
    <fieldset>
    <label><input type="radio" name="mdx_install" value="normal" <?php if($mdx_v_install=='normal'){?>checked="checked"<?php }?>> <?php _e('常规', 'mdx');?></label><br>
    <label><input type="radio" name="mdx_install" value="sub" <?php if($mdx_v_install=='sub'){?>checked="checked"<?php }?>> <?php _e('子目录', 'mdx');?></label><br>
    <p class="description"><?php _e('为了更好地实现某些功能，MDx 需要知道你的 WordPress 的安装方式。如果你不确定，请参考下方的检测结果。<br>MDx 检测到你的 WordPress 似乎是', 'mdx');?><strong><?php echo $mdx_subdir;?>。</strong></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('夜间模式', 'mdx');?></th>
<td>
<?php $mdx_v_night_style=mdx_get_option('mdx_night_style');?>
<select<?php if(mdx_get_option('mdx_styles_dark')!=="disable"){echo " disabled";}?> class="mdx_stbs" name="mdx_night_style" id="mdx_night_style">
    <option value="true" <?php if($mdx_v_night_style=='true'){?>selected="selected"<?php }?>><?php echo $trueon;?></option>
    <option value="oled" <?php if($mdx_v_night_style=='oled'){?>selected="selected"<?php }?>><?php echo $trueon;?> (OLED)</option>
    <option value="false" <?php if($mdx_v_night_style=='false'){?>selected="selected"<?php }?>><?php echo $falseoff;?></option>
</select>
<p class="description"><?php _e('开启后，侧边栏中会出现夜间模式切换按钮。<strong>如果你启用了“黑暗主题”，那么夜间模式将会自动禁用。</strong>', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('自动夜间模式', 'mdx');?></th>
<td>
<?php $mdx_v_auto_night_style=mdx_get_option('mdx_auto_night_style');?>
<select class="mdx_stbsip" name="mdx_auto_night_style" id="mdx_auto_night_style">
    <option value="system" <?php if($mdx_v_auto_night_style=='system'){?>selected="selected"<?php }?>><?php _e("跟随系统", "mdx");?></option>
    <option value="true" <?php if($mdx_v_auto_night_style=='true'){?>selected="selected"<?php }?>><?php echo _e("跟随时间", "mdx");?></option>
    <option value="false" <?php if($mdx_v_auto_night_style=='false'){?>selected="selected"<?php }?>><?php echo $falseoff;?></option>
</select>
<p class="description"><?php _e('<strong>仅当开启夜间模式功能后此选项方可生效。</strong><br><ul><li><code>跟随系统</code>：夜间模式随用户系统的配色方案实时切换，优先级低于用户自行设置</li><li><code>跟随时间</code>：22:30 至第二天 5:30 之间打开页面时自动加载夜间模式，优先级低于用户自行设置</li></ul>', 'mdx');?></p>
</td>
</tr>
<tr><td> </td></tr>
<tr>
    <th scope="row"><label for="mdx_notice"><?php _e('网站公告', 'mdx');?></label></th>
    <td><textarea name="mdx_notice" id="mdx_notice" rows="7" cols="50"><?php echo esc_attr(mdx_get_option('mdx_notice'))?></textarea>
    <p class="description"><?php _e('在这里编辑网站公告。公告会显示在首页文章列表的顶部，留空则不会显示。支持 <code>HTML</code> 格式.', 'mdx');?></p></td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('使用手势打开抽屉菜单', 'mdx');?></th>
<td>
<?php $mdx_v_open_side=mdx_get_option('mdx_open_side');?>
    <fieldset>
    <label><input type="radio" name="mdx_open_side" value="true" <?php if($mdx_v_open_side=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_open_side" value="false" <?php if($mdx_v_open_side=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，可以通过从屏幕左侧向中心滑动的方式调出抽屉菜单。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('右侧小工具栏', 'mdx');?></th>
<td>
<?php $mdx_v_widget=mdx_get_option('mdx_widget');?>
    <fieldset>
    <label><input type="radio" name="mdx_widget" value="true" <?php if($mdx_v_widget=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_widget" value="false" <?php if($mdx_v_widget=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，每个页面右下角都会显示小工具栏浮动按钮。小工具栏默认隐藏，可以通过从屏幕右侧侧向中心滑动或按钮调出右侧小工具栏。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_cookie"><?php _e('Cookie 使用提示 (GDPR)', 'mdx');?></label></th>
    <td><textarea name="mdx_cookie" id="mdx_cookie" rows="7" cols="50"><?php echo esc_attr(mdx_get_option('mdx_cookie'))?></textarea>
    <p class="description"><?php _e('Cookie 使用提示将会在用户第一次访问站点时显示，以向用户说明你站点的 Cookie 政策。如果你的站点有来自欧盟地区的访客，此选项可能会很有用。<br>在这里编辑 Cookie 使用提示，支持 <code>HTML</code>，留空则不会显示。', 'mdx');?></p></td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('允许用户缩放页面', 'mdx');?></th>
<td>
<?php $mdx_v_allow_scale=mdx_get_option('mdx_allow_scale');?>
    <fieldset>
    <label><input type="radio" name="mdx_allow_scale" value="true" <?php if($mdx_v_allow_scale=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_allow_scale" value="false" <?php if($mdx_v_allow_scale=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('如果允许用户缩放页面，用户将可以放大页面。这可能会破坏页面结构，但有助于视力障碍用户更好地阅读。关闭即可将页面的缩放强制固定在默认倍率。注意，不同浏览器对此可能会有不同的表现。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('允许使用减弱动画模式', 'mdx');?></th>
<td>
<?php $mdx_v_reduce_motion=mdx_get_option('mdx_reduce_motion');?>
    <fieldset>
    <label><input type="radio" name="mdx_reduce_motion" value="true" <?php if($mdx_v_reduce_motion=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_reduce_motion" value="false" <?php if($mdx_v_reduce_motion=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，如果用户的系统开启了减弱动画模式，MDx 会自动地尽可能减弱网页内的动画。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('ImgBox', 'mdx');?></th>
<td>
<?php $mdx_v_img_box=mdx_get_option('mdx_img_box');?>
    <fieldset>
    <label><input type="radio" name="mdx_img_box" value="true" <?php if($mdx_v_img_box=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_img_box" value="false" <?php if($mdx_v_img_box=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，对于文章内包裹在指向自身的链接中的图片可点击查看大图。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_readmore"><?php _e('“阅读更多”文本自定义', 'mdx');?></label></th>
<td><input name="mdx_readmore" type="text" id="mdx_readmore" value="<?php echo esc_attr(mdx_get_option('mdx_readmore'))?>" class="regular-text">
<p class="description" id="mdx_footer"><?php _e('在此自定义“阅读更多”按钮上的文本。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('赞赏二维码', 'mdx');?></th>
<td>
<input name="mdx_post_money" type="text" id="mdx_post_money" value="<?php echo esc_attr(mdx_get_option('mdx_post_money'))?>" class="regular-text">
<button type="button" id="insert-media-button" class="button" style="margin-top:5px;display:block"><?php _e('选择图片', 'mdx');?></button>
<p class="description"><?php _e('你可以上传或指定你的媒体库中的图片作为赞赏二维码。当此空不为空时将在文章底部显示赞赏按钮。', 'mdx');?></p>
<img id="img1" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
</td>
</tr>
<tr>
<th scope="row"><?php _e('阅读进度展示', 'mdx');?></th>
<td>
<?php $mdx_v_read_pro=mdx_get_option('mdx_read_pro');?>
    <fieldset>
    <label><input type="radio" name="mdx_read_pro" value="true" <?php if($mdx_v_read_pro=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_read_pro" value="false" <?php if($mdx_v_read_pro=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，会在文章/单独页面展示阅读进度。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('转移设备时记录阅读进度', 'mdx');?></th>
<td>
<?php $mdx_v_auto_scroll=mdx_get_option('mdx_auto_scroll');?>
    <fieldset>
    <label><input type="radio" name="mdx_auto_scroll" value="true" <?php if($mdx_v_auto_scroll=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_auto_scroll" value="false" <?php if($mdx_v_auto_scroll=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，文章中通过二维码转移到其他设备阅读时会自动记录阅读进度并滚动。建议在网页加载速度较快时启用。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('文章目录', 'mdx');?></th>
<td>
<?php $mdx_v_toc=mdx_get_option('mdx_toc');?>
    <fieldset>
    <label><input type="radio" name="mdx_toc" value="true" <?php if($mdx_v_toc=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_toc" value="false" <?php if($mdx_v_toc=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，侧边栏会显示文章目录。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('页面加载进度条', 'mdx');?></th>
<td>
<?php $mdx_v_load_pro=mdx_get_option('mdx_load_pro');?>
    <fieldset>
    <label><input type="radio" name="mdx_load_pro" value="true" <?php if($mdx_v_load_pro=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_load_pro" value="false" <?php if($mdx_v_load_pro=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，文章/单独页面加载时会在页面顶部显示加载进度条（仅动画，非真实进度），页面加载完成后消失。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_post_list_1"><?php _e('文章列表详细信息 - 位置1', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_list_1=mdx_get_option('mdx_post_list_1');?>
<?php
$mdx_i18n_settings_1 = __('浏览量', 'mdx');
$mdx_i18n_settings_2 = __('发表时间', 'mdx');
$mdx_i18n_settings_3 = __('评论数', 'mdx');
$mdx_i18n_settings_4 = __('空', 'mdx');
?>
<select name="mdx_post_list_1" id="mdx_post_list_1">
    <option value="view" <?php if($mdx_v_post_list_1=='view'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_1;?></option>
    <option value="time" <?php if($mdx_v_post_list_1=='time'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_2;?></option>
    <option value="comments" <?php if($mdx_v_post_list_1=='comments'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_3;?></option>
    <option value="blank" <?php if($mdx_v_post_list_1=='blank'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_4;?></option>
</select>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_post_list_2"><?php _e('文章列表详细信息 - 位置2', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_list_2=mdx_get_option('mdx_post_list_2');?>
<select name="mdx_post_list_2" id="mdx_post_list_2">
    <option value="view" <?php if($mdx_v_post_list_2=='view'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_1;?></option>
    <option value="time" <?php if($mdx_v_post_list_2=='time'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_2;?></option>
    <option value="comments" <?php if($mdx_v_post_list_2=='comments'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_3;?></option>
    <option value="blank" <?php if($mdx_v_post_list_2=='blank'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_4;?></option>
</select>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_post_list_3"><?php _e('文章列表详细信息 - 位置3', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_list_3=mdx_get_option('mdx_post_list_3');?>
<select name="mdx_post_list_3" id="mdx_post_list_3">
    <option value="view" <?php if($mdx_v_post_list_3=='view'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_1;?></option>
    <option value="time" <?php if($mdx_v_post_list_3=='time'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_2;?></option>
    <option value="comments" <?php if($mdx_v_post_list_3=='comments'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_3;?></option>
    <option value="blank" <?php if($mdx_v_post_list_3=='blank'){?>selected="selected"<?php }?>><?php echo $mdx_i18n_settings_4;?></option>
</select>
<p class="description"><?php _e('详细信息显示在文章列表每篇文章的底部。在此指定你希望展示的信息。', 'mdx');?></p>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_post_edit_time"><?php _e('文章时间信息', 'mdx');?></label></th>
<td>
<?php $mdx_v_post_edit_time=mdx_get_option('mdx_post_edit_time');?>
<select name="mdx_post_edit_time" id="mdx_post_edit_time">
    <option value="post" <?php if($mdx_v_post_edit_time=='post'){?>selected="selected"<?php }?>><?php _e('发布时间', 'mdx');?></option>
    <option value="edit" <?php if($mdx_v_post_edit_time=='edit'){?>selected="selected"<?php }?>><?php _e('最后编辑时间', 'mdx');?></option>
</select>
<p class="description"><?php _e('选择 <code>发布时间</code>，文章底部信息栏会显示文章发布时间。<br>选择 <code>最后编辑时间</code>，文章底部信息栏会显示文章最后编辑时间。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('文末作者信息栏', 'mdx');?></th>
<td>
<?php $mdx_v_author_card=mdx_get_option('mdx_author_card');?>
    <fieldset>
    <label><input type="radio" name="mdx_author_card" value="true" <?php if($mdx_v_author_card=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_author_card" value="false" <?php if($mdx_v_author_card=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_lazy_load_mode"><?php _e('LazyLoad 模式', 'mdx');?></label></th>
<td>
<?php $mdx_v_lazy_load_mode=mdx_get_option('mdx_lazy_load_mode');?>
<select name="mdx_lazy_load_mode" id="mdx_lazy_load_mode">
    <option value="speed" <?php if($mdx_v_lazy_load_mode=='speed'){?>selected="selected"<?php }?>><?php _e('速度优先', 'mdx');?></option>
    <option value="seo1" <?php if($mdx_v_lazy_load_mode=='seo1'){?>selected="selected"<?php }?>><?php _e('SEO优先（轻度）', 'mdx');?></option>
    <option value="seo2" <?php if($mdx_v_lazy_load_mode=='seo2'){?>selected="selected"<?php }?>><?php _e('SEO优先（重度）', 'mdx');?></option>
</select>
<p class="description"><?php _e('LazyLoad 即图片会在即将滚动到屏幕内时才开始加载的技术（可能会影响 SEO）。此设置会影响图片加载模式。<br>速度优先：几乎所有图片都会使用 LazyLoad<br>SEO优先（轻度）：除文章内使用的图片外几乎所有图片都会使用 LazyLoad<br>SEO优先（重度）：文章内使用的图片和文章列表使用的图片不会使用 LazyLoad，但仍有少量装饰性图片会使用', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_lazyload_fallback"><?php _e('兼容性 Lazyload', 'mdx');?></label></th>
<td>
<?php $mdx_v_lazyload_fallback=mdx_get_option('mdx_lazyload_fallback');?>
<fieldset>
    <label><input type="radio" name="mdx_lazyload_fallback" value="true" <?php if($mdx_v_lazyload_fallback=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_lazyload_fallback" value="false" <?php if($mdx_v_lazyload_fallback=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('尝试以兼容性更好的方式加载图片，<strong>但会导致一些增强特性不可用。</strong><br>如果你发现文章内图片的 Lazyload 加载出现问题且希望保留文章内图片的 Lazyload，可以尝试打开此选项。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_enhanced_ajax"><?php _e('增强的文章列表加载方式', 'mdx');?></label></th>
<td>
<?php $mdx_v_enhanced_ajax=mdx_get_option('mdx_enhanced_ajax');?>
<fieldset>
    <label><input type="radio" name="mdx_enhanced_ajax" value="true" <?php if($mdx_v_enhanced_ajax=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_enhanced_ajax" value="false" <?php if($mdx_v_enhanced_ajax=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('启用此选项以加快文章列表的加载速度，并使浏览器在后退到文章列表时尽可能地保持滚动位置。<br>受浏览器限制，在拥有大量文章时此功能效果可能会受限。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('使用 Preload 技术加速页面加载', 'mdx');?></th>
<td>
<?php $mdx_v_speed_pre=mdx_get_option('mdx_speed_pre');?>
    <fieldset>
    <label><input type="radio" name="mdx_speed_pre" value="true" <?php if($mdx_v_speed_pre=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_speed_pre" value="false" <?php if($mdx_v_speed_pre=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，可使用 Preload 预加载技术加速页面加载。请确保你<strong>没有</strong>对主题 Javascript 脚本和字体文件使用和页面不同的域名加载。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_share_area"><?php _e('分享到的服务商', 'mdx');?></label></th>
<td>
<?php $mdx_v_share_area=mdx_get_option('mdx_share_area');?>
<select name="mdx_share_area" id="mdx_share_area">
    <option value="all" <?php if($mdx_v_share_area=='all'){?>selected="selected"<?php }?>><?php _e('所有服务商', 'mdx');?></option>
    <option value="china" <?php if($mdx_v_share_area=='china'){?>selected="selected"<?php }?>><?php _e('只有中国国内服务商', 'mdx');?></option>
    <option value="oversea" <?php if($mdx_v_share_area=='oversea'){?>selected="selected"<?php }?>><?php _e('只有国际服务商', 'mdx');?></option>
</select>
<p class="description"><?php _e('指定你想提供给访问者的分享服务商。<br>“只有中国国内服务商”提供：微博、微信、QQ、QQ 空间 的分享<br>“只有国际服务商”提供：Telegrame、Twitter、Facebook 的分享<br>无论如何，“生成分享图”始终启用。', 'mdx');?></p>
</td>
</tr>
<tr>
<th scope="row"><?php _e('点击顶部栏返回顶部', 'mdx');?></th>
<td>
<?php $mdx_v_tap_to_top=mdx_get_option('mdx_tap_to_top');?>
    <fieldset>
    <label><input type="radio" name="mdx_tap_to_top" value="true" <?php if($mdx_v_tap_to_top=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_tap_to_top" value="false" <?php if($mdx_v_tap_to_top=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，点击顶部栏可以返回页面顶部。此设置影响所有页面。</strong>', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('首页推荐文章', 'mdx');?></th>
<td>
<?php $mdx_v_hot_posts=mdx_get_option('mdx_hot_posts');?>
    <fieldset>
    <label><input type="radio" class="mdx_apsp2" name="mdx_hot_posts" value="true" <?php if($mdx_v_hot_posts=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" class="mdx_apsp2" name="mdx_hot_posts" value="false" <?php if($mdx_v_hot_posts=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，首页会展示推荐文章，请在下方进行设置。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_hot_posts_num"><?php _e('首页推荐文章数量', 'mdx');?></label></th>
<td><input name="mdx_hot_posts_num" type="text" id="mdx_hot_posts_num" value="<?php echo esc_attr(mdx_get_option('mdx_hot_posts_num'))?>" class="regular-text mdx_apspc2">
<p class="description"><?php _e('在此设定首页推荐文章篇数。请输入整数。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><label for="mdx_hot_posts_cat"><?php _e('首页推荐文章分类名', 'mdx');?></label></th>
<td><input name="mdx_hot_posts_cat" type="text" id="mdx_hot_posts_cat" value="<?php echo esc_attr(mdx_get_option('mdx_hot_posts_cat'))?>" class="regular-text mdx_apspc2">
<p class="description"><?php _e('首页推荐文章从特定分类获取文章。在此设定首页推荐文章的分类名。当分类不存在时，将显示最新文章。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><label for="mdx_hot_posts_text"><?php _e('首页推荐文章模块标题', 'mdx');?></label></th>
<td><input name="mdx_hot_posts_text" type="text" id="mdx_hot_posts_text" value="<?php echo esc_attr(mdx_get_option('mdx_hot_posts_text'))?>" class="regular-text mdx_apspc2">
<p class="description"><?php _e('在此设定首页推荐文章模块标题。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><label for="mdx_all_posts_text"><?php _e('首页最新文章模块标题', 'mdx');?></label></th>
<td><input name="mdx_all_posts_text" type="text" id="mdx_all_posts_text" value="<?php echo esc_attr(mdx_get_option('mdx_all_posts_text'))?>" class="regular-text mdx_apspc2">
<p class="description"><?php _e('在此设定首页最新文章模块标题。只有开启了“首页推荐文章”功能时此空才会生效。', 'mdx');?></p></td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('文末推荐文章', 'mdx');?></th>
<td>
<?php $mdx_v_you_may_like=mdx_get_option('mdx_you_may_like');?>
    <fieldset>
    <label><input type="radio" class="mdx_apsp" name="mdx_you_may_like" value="true" <?php if($mdx_v_you_may_like=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" class="mdx_apsp" name="mdx_you_may_like" value="false" <?php if($mdx_v_you_may_like=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，文章末会展示最多5篇相似文章。', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('文末推荐文章计算方式', 'mdx');?></th>
<td>
<?php $mdx_v_you_may_like_way=mdx_get_option('mdx_you_may_like_way');?>
    <fieldset>
    <label><input type="radio" class="mdx_apspc" name="mdx_you_may_like_way" value="tag" <?php if($mdx_v_you_may_like_way=='tag'){?>checked="checked"<?php }?>> <?php _e('相同标签', 'mdx')?></label><br>
    <label><input type="radio" class="mdx_apspc" name="mdx_you_may_like_way" value="category" <?php if($mdx_v_you_may_like_way=='category'){?>checked="checked"<?php }?>> <?php _e('相同分类', 'mdx')?></label><br>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><label for="mdx_you_may_like_text"><?php _e('文末推荐文章模块标题', 'mdx');?></label></th>
<td><input name="mdx_you_may_like_text" type="text" id="mdx_you_may_like_text" value="<?php echo esc_attr(mdx_get_option('mdx_you_may_like_text'))?>" class="regular-text mdx_apspc">
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><?php _e('实时搜索', 'mdx');?></th>
<td>
<?php $mdx_v_real_search=mdx_get_option('mdx_real_search');?>
    <fieldset>
    <label><input type="radio" name="mdx_real_search" value="true" <?php if($mdx_v_real_search=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_real_search" value="false" <?php if($mdx_v_real_search=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，进行搜索时会随用户输入实时反馈搜索结果。<strong>需要 WordPress REST API 支持。此 API 默认开启，请确保你没有将其关闭。</strong>', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e('评论无限加载', 'mdx');?></th>
<td>
<?php $mdx_v_comment_ajax=mdx_get_option('mdx_comment_ajax');?>
    <fieldset>
    <label><input type="radio" name="mdx_comment_ajax" value="true" <?php if($mdx_v_comment_ajax=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_comment_ajax" value="false" <?php if($mdx_v_comment_ajax=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，文章评论加载时将使用无限加载，关闭则使用分页加载。无论如何，评论均为 AJAX 加载。</strong>', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
    <th scope="row"><label for="mdx_ad"><?php _e('广告代码', 'mdx');?></label></th>
    <td><textarea name="mdx_ad" id="mdx_ad" rows="7" cols="50"><?php echo mdx_get_option('mdx_ad')?></textarea>
    <p class="description"><?php _e('在这里填写广告代码，MDx 会自行决定广告应出现在何处。此空留空则不会显示广告。<br>如果要在文章内插入广告，在这里填写广告代码后，你可以在文章中使用 <code>[mdx_ad][/mdx_ad]</code> 短代码。<br>如果你计划使用 Google AdSense 自动广告，请将其填写在“页头脚本”选项处。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('对已登录的用户禁用广告', 'mdx');?></th>
<td>
<?php $mdx_v_logged_in_ad=mdx_get_option('mdx_logged_in_ad');?>
    <fieldset>
    <label><input type="radio" name="mdx_logged_in_ad" value="true" <?php if($mdx_v_logged_in_ad=='true'){?>checked="checked"<?php }?>> <?php _e('禁用广告', 'mdx');?></label><br>
    <label><input type="radio" name="mdx_logged_in_ad" value="false" <?php if($mdx_v_logged_in_ad=='false'){?>checked="checked"<?php }?>> <?php _e('不禁用广告', 'mdx');?></label><br>
    </fieldset>
</td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_seo_key"><?php _e('SEO 关键词', 'mdx');?></label></th>
<td><input name="mdx_seo_key" type="text" id="mdx_seo_key" value="<?php echo esc_attr(mdx_get_option('mdx_seo_key'))?>" class="regular-text">
<p class="description" id="mdx_footer"><?php _e('用半角逗号分割关键词，数量在5个以内最佳。留空代表不开启此功能。', 'mdx');?></p></td>
</tr>
<tr>
<th scope="row"><?php _e('自动生成网页描述', 'mdx');?></th>
<td>
<?php $mdx_v_auto_des=mdx_get_option('mdx_auto_des');?>
    <fieldset>
    <label><input type="radio" name="mdx_auto_des" value="true" <?php if($mdx_v_auto_des=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
    <label><input type="radio" name="mdx_auto_des" value="false" <?php if($mdx_v_auto_des=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
    <p class="description"><?php _e('开启后，会自动生成 SEO 网页描述。<strong>对首页无效，请在下方输入首页描述。</strong>', 'mdx');?></p>
    </fieldset>
</td>
</tr>
<tr>
    <th scope="row"><label for="mdx_seo_des"><?php _e('SEO 描述', 'mdx');?></label></th>
    <td><textarea name="mdx_seo_des" id="mdx_seo_des" rows="7" cols="50"><?php echo esc_attr(mdx_get_option('mdx_seo_des'))?></textarea>
    <p class="description"><?php _e('在这里编辑网页描述。如开启自动生成网页描述功能，则此空仅对首页有效，其他页面会自动生成网页描述。此空留空则表示关闭全局 SEO 描述功能。', 'mdx');?></p></td>
</tr>
<tr><td> </td></tr>
<tr>
    <th scope="row"><label for="mdx_head_js"><?php _e('页头脚本', 'mdx');?></label></th>
    <td><textarea name="mdx_head_js" id="mdx_head_js" rows="7" cols="50"><?php echo mdx_get_option('mdx_head_js')?></textarea>
    <p class="description"><?php _e('在这里插入脚本，会被插入至所有页面头部。', 'mdx');?></p></td>
</tr>
<tr>
    <th scope="row"><label for="mdx_footer_js"><?php _e('页尾脚本', 'mdx');?></label></th>
    <td><textarea name="mdx_footer_js" id="mdx_footer_js" rows="7" cols="50"><?php echo mdx_get_option('mdx_footer_js')?></textarea>
    <p class="description"><?php _e('在这里插入脚本，会被插入至所有页面最后。', 'mdx');?></p></td>
</tr>
<tr><td> </td></tr>
<tr>
<th scope="row"><label for="mdx_icp_num"><?php _e('ICP 备案号', 'mdx');?></label></th>
<td><input name="mdx_icp_num" type="text" id="mdx_icp_num" value="<?php echo esc_attr(mdx_get_option('mdx_icp_num'))?>" class="regular-text">
<p class="description"><?php _e('在这里填写的 ICP 备案号会显示在页脚并自动链接到 <i>中华人民共和国工业和信息化部</i> 网站，留空则不显示。如果你的服务器在中国大陆境内，这个选项可能会很有用。', 'mdx');?></p></td>
</tr>
</table><?php submit_button(); ?></form></div>
