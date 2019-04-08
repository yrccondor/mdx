<?php
$mdx_version_base = get_option('mdx_version');
if($mdx_version_base=="1.8.5" || $mdx_version_base=="1.8.3" || $mdx_version_base=="1.8.7"){
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.8.0" || $mdx_version_base=="1.8.1" || $mdx_version_base=="1.8.2"){
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.10"){
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.7" || $mdx_version_base=="1.7.8" || $mdx_version_base=="1.7.9"){
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.5"){
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.4"){
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.3"){
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.2"){
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.7.1" || $mdx_version_base=="1.7.0"){
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.5" || $mdx_version_base=="1.5.1"){
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.3" || $mdx_version_base=="1.4"){
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base=="1.4.1"){
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}else if($mdx_version_base!="1.8.12" && $mdx_version_base!="1.8.11" && $mdx_version_base!="1.8.10" && $mdx_version_base!="1.8.9" && $mdx_version_base!="1.8.8"){
	update_option('mdx_img_box', 'true');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
	update_option('mdx_share_area', 'all');
	update_option('mdx_tap_to_top', 'true');
	update_option('mdx_you_may_like', 'false');
	update_option('mdx_you_may_like_way', 'tag');
	update_option('mdx_you_may_like_text', __('推荐文章', 'mdx'));
	update_option('mdx_echo_post_sum', 'true');
	update_option('mdx_index_show', '0');
	update_option('mdx_hot_posts', 'false');
	update_option('mdx_hot_posts_num', '10');
	update_option('mdx_hot_posts_cat', '');
	update_option('mdx_hot_posts_text', __('推荐文章','mdx'));
	update_option('mdx_all_posts_text', __('最新文章','mdx'));
	update_option('mdx_post_def_img', 'ture');
	update_option('mdx_head_js', '');
	update_option('mdx_footer_js', '');
	update_option('mdx_speed_pre', 'false');
	update_option('mdx_smooth_scroll', 'true');
	update_option('mdx_index_say_size', '1');
	if(get_option('mdx_logo')==''){
		update_option('mdx_logo_way', '1');
	}else{
		update_option('mdx_logo_way', '2');
	}
	update_option('mdx_logo_text', '');
	update_option('mdx_comment_ajax', 'false');
	update_option('mdx_title_med', 'diy');
	update_option('mdx_post_list_img_height', 'auto');
	update_option('mdx_post_edit_time', 'post');
	update_option('mdx_author_card', 'false');
	update_option('mdx_tags_color', 'true');
	include_once("includes/update_database.php");
	mdx_update_option("mdx_allow_scale", "false");
	mdx_update_option("mdx_install", "normal");
	mdx_update_option("mdx_widget", "false");
}
?>