<?php
//激活功能
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('image','link','status','video','audio'));
register_nav_menus(array('mdx_menu'=>__('抽屉菜单','mdx')));

//更新时初始化新功能
$mdx_version_base = get_option('mdx_version');
if($mdx_version_base=="1.7.1" || $mdx_version_base=="1.7.0"){
	require_once('admin_init_ver.php');
}else if($mdx_version_base=="1.5" || $mdx_version_base=="1.5.1"){
	require_once('admin_init_ver.php');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
}else if($mdx_version_base=="1.3" || $mdx_version_base=="1.4"){
	require_once('admin_init_ver.php');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
}else if($mdx_version_base=="1.4.1"){
	require_once('admin_init_ver.php');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
}else if($mdx_version_base!="1.7.2"){
	require_once('admin_init_ver.php');
	update_option('mdx_img_box', 'true');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
	update_option("mdx_readmore", __('去围观', 'mdx'));
	update_option("mdx_post_money", '');
	update_option("mdx_lazy_load_mode", 'speed');
}

//后台菜单添加
if(is_admin()){
    include_once('admin_functions.php');
}

//主题升级
require_once(get_template_directory().'/theme-update-checker.php');
$mdx_update_checker = new ThemeUpdateChecker(
    'mdx',
    'https://update.dlij.site/mdx/info.json'
);

//多语言支持
function mdx_multilang(){
    load_theme_textdomain('mdx', get_template_directory().'/languages');
}
add_action('after_setup_theme', 'mdx_multilang');

//自定义菜单样式
function mdx_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'mdx_menu') {
       $classes[] = 'mdui-list-item mdui-ripple';
    }
    return $classes;
}
add_filter('nav_menu_css_class','mdx_menu_classes',1,3);

//激活链接功能
add_filter('pre_option_link_manager_enabled','__return_true');

//载入css & js
function mdx_css(){
	wp_register_style('mdx_mdui_css', get_template_directory_uri().'/mdui/css/mdui.min.css', '', '', 'all');
	wp_register_style('mdx_style_css', get_template_directory_uri().'/style.css', '', '', 'all'); 
	wp_enqueue_style('mdx_mdui_css');
	wp_enqueue_style('mdx_style_css');
}
add_action('wp_enqueue_scripts', 'mdx_css');
function mdx_js(){
	wp_register_script('mdx_jquery', get_template_directory_uri().'/js/jquery.min.js', false, '', true);
	wp_register_script('mdx_mdui_js', get_template_directory_uri().'/mdui/js/mdui.min.js', false, '', true);
	wp_register_script('mdx_sl_js', get_template_directory_uri().'/js/smooth-lazyload.js', false, '', true);
	wp_enqueue_script('mdx_jquery');
	wp_enqueue_script('mdx_mdui_js');
	if(get_option("mdx_auto_night_style")=="true"){
		wp_register_script('mdx_ns_js', get_template_directory_uri().'/js/nsc.js', false, '', true);
		wp_enqueue_script('mdx_ns_js');
	}
	if(get_option("mdx_real_search")=="true"){
		wp_register_script('mdx_rs_js', get_template_directory_uri().'/js/search.js', false, '', true);
		wp_enqueue_script('mdx_rs_js');
	}
	if(is_home()){
		wp_register_script('mdx_ajax_js', get_template_directory_uri().'/js/ajax.js', false, '', true);
		wp_enqueue_script('mdx_ajax_js');
	}else if(is_category()||is_archive()||is_search()){
		wp_register_script('mdx_ajax_js', get_template_directory_uri().'/js/ajax_other.js', false, '', true);
		wp_enqueue_script('mdx_ajax_js');
	}
	if(is_single() || is_page()){
		wp_register_script('mdx_qr_js', get_template_directory_uri().'/js/qr.js', false, '', true);
		wp_register_script('mdx_ra_js', get_template_directory_uri().'/js/ra.js', false, '', true);
		wp_register_script('mdx_h2c_js', get_template_directory_uri().'/js/h2c.js', false, '', true);
		wp_enqueue_script('mdx_qr_js');
		wp_enqueue_script('mdx_ra_js');
		wp_enqueue_script('mdx_h2c_js');
	}
	wp_enqueue_script('mdx_sl_js');
}
add_action('wp_enqueue_scripts', 'mdx_js');

//Ajax评论
require('ajax-comment/main.php');

//页面浏览量
function get_post_views($post_id){
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }
    echo number_format_i18n($count);
}
function set_post_views(){
    global $post;   
    $post_id = $post -> ID;
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if (is_single() || is_page()) {
        if ($count==''){
            delete_post_meta($post_id, $count_key);
            add_post_meta($post_id, $count_key, '0');
        } else {
            update_post_meta($post_id, $count_key, $count + 1);
        }
    }
}
add_action('get_header', 'set_post_views');

// 同时删除head和feed中的WP版本号
function mdx_remove_wp_version(){
  return '';
}
add_filter('the_generator', 'mdx_remove_wp_version');

// 隐藏js/css附加的WP版本号
function mdx_remove_wp_version_strings($src){
  global $wp_version;
  parse_str(parse_url($src, PHP_URL_QUERY), $query);
  if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
    // 用WP版本号 + 37.45来替代js/css附加的版本号
    $src = str_replace($wp_version, $wp_version + 37.45, $src);
  }
  return $src;
}
add_filter('script_loader_src', 'mdx_remove_wp_version_strings');
add_filter('style_loader_src', 'mdx_remove_wp_version_strings');

//搜索结果排除页面
function mdx_search_filter_page($query){
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','mdx_search_filter_page');

//添加特色图片提示
function mdx_add_featured_image_instruction($content){
	return $content .= '<p>'.__('你目前启用的主题将特色图片作为页面设计的重要元素，如没有手动添加特色图片，将会使用默认图片。', 'mdx').'</p>';
}
add_filter('admin_post_thumbnail_html', 'mdx_add_featured_image_instruction');

//评论回调
function mdx_comment_format($comment, $args, $depth){
$GLOBALS['comment'] = $comment;?>
    <li class="mdui-list-item" id="li-comment-<?php comment_ID(); ?>">
    <div class="mdui-list-item-avatar"><?php if(function_exists('get_avatar') && get_option('show_avatars')){echo get_avatar($comment, 80);}?></div>
    <div class="mdui-list-item-content outbu" id="comment-<?php comment_ID();?>">
    <div class="mdui-list-item-title"><?php echo get_comment_author_link();?><?php if(user_can($comment->user_id, 1)){echo '<span class="mdx-admin">'.__('博主','mdx').'</span>';}?></div>
    <div class="mdui-list-item-text mdui-typo">
    <?php comment_text();?>
    </div><span class="mdx-reply-time"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')).__('前','mdx');?></span><?php comment_reply_link(array_merge($args,array('reply_text'=>'回复','depth'=>$depth,'max_depth'=>$args['max_depth'])))?></div></li><li class="mdui-divider-inset mdui-m-y-0"></li><li>
<?php }

//回复的评论加@
function comment_add_at( $comment_text, $comment=''){
    if( $comment->comment_parent > 0){
	$comment_text='<a rel="nofollow" class="comment_at" href="#comment-'.$comment->comment_parent.'">@'.get_comment_author($comment->comment_parent).'：</a> '.$comment_text;
    }
	return $comment_text;
    }
add_filter('comment_text', 'comment_add_at', 10, 2);

//PostLazyLoad
function mdx_lazyload_image($content){
    if(is_feed()){
        return $content;
    }
    $content = preg_replace_callback('#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', 'mdx_process_image', $content);
    return $content;
}
function mdx_process_image( $matches ) {
    $placeholder_image = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAMAAAAoyzS7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFsbGxAAAA/JhxRAAAAAxJREFUeNpiYAAIMAAAAgABT21Z4QAAAABJRU5ErkJggg==';
    $old_attributes_str = $matches[2];
    $img = wp_kses_hair($old_attributes_str, wp_allowed_protocols());
    if (empty($img['src'])){
        return $matches[0];
    }
    $html = '<img width="'.$img['width']['value'].'" height="'.$img['height']['value'].'" class="'.$img['class']['value'].' LazyLoadPost" title="'.get_the_title().'" src="'.$placeholder_image.'" data-original="'.$img['src']['value'].'" alt="'.$img['src']['value'].'" data-original-srcset="'.$img['srcset']['value'].'" sizes="'.$img['sizes']['value'].'">';
    return $html;
}
if(!is_admin() && get_option('mdx_lazy_load_mode')=='speed'){
    add_filter('the_content','mdx_lazyload_image', 99);
    add_filter('get_avatar','mdx_lazyload_image', 11);
}

//面包屑
function mdx_breadcrumbs() {
	$delimiter = ' » '; // 分隔符
	$before = '<span class="current">'; // 在当前链接前插入
	$after = '</span>'; // 在当前链接后插入
	if(!is_home() && !is_front_page() || is_paged()){
		echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs">';
		global $post;
		$homeLink = home_url();
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . __( '首页' , 'mdx' ) . '</a> ' . $delimiter . ' ';
		if ( is_category()){
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day()){
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month()){
			echo '<a itemprop="breadcrumb" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year()){
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment()){
			if ( get_post_type() != 'post'){
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif(!is_single() && !is_page() && get_post_type()!= 'post'){
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment()){
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo '<a itemprop="breadcrumb" href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif (is_search()){
			echo $before ;
			printf( __( '搜索结果： %s', 'mdx' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) {
			echo $before ;
			printf( __( '标签存档 %s', 'mdx' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( '作者存档 %s', 'mdx' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404()){
			echo $before;
			_e( '什么也没找到', 'mdx' );
			echo  $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( 第 %s 页 )', 'mdx'), get_query_var('paged') );
		}
	}
}

//shortcodes & buttons
function mdx_shortcode_hide($atts, $content = null){
	extract(shortcode_atts(array("title" => __('被折叠内容','mdx'),'open' => 'false'), $atts));
	$mdx_open = '';
	if($open=='true'){
		$mdx_open = ' mdui-panel-item-open';
	}
    return '<div class="mdui-panel mdui-panel-gapless" mdui-panel>
	<div class="mdui-panel-item'.$mdx_open.'">
	  <div class="mdui-panel-item-header">
		<div class="mdui-panel-item-title">'.$title.'</div>
		<i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
	  </div>
	  <div class="mdui-panel-item-body">
		<p>'.$content.'</p>
	  </div>
	</div>
  </div>';
}
add_shortcode("mdx_fold", "mdx_shortcode_hide");

function mdx_shortcode_warning($atts, $content = null){
    extract(shortcode_atts(array("title" => __('警告','mdx')), $atts));
    return '<blockquote class="mdx-warning"><p><i class="mdui-icon material-icons">&#xe002;</i> '.$title.'<br><strong>'.$content.'</strong></p></blockquote>';
}
add_shortcode("mdx_warning", "mdx_shortcode_warning");

function mdx_shortcode_table($atts, $content = ''){
    extract( shortcode_atts(array(
		'header' => 'false',
		'hover' => 'true'
    ), $atts));
	$output = '';
	$output2 = '';
	$trs = explode("\n&#8212;&#8211;", $content);
	$mdx_table_i = 0;
    foreach($trs as $tr){
		if($mdx_table_i == 0 && $header == 'true'){
        	$tr = trim($tr);
        	if($tr){
            	$tds = explode("<br />", $tr);
            	$output2 .= '<tr>';
            	foreach($tds as $td){
                	$td = trim($td);
                	if($td){
                    	$output2 .= '<th>'.$td.'</th>';
                	}
            	}
            	$output2 .= '</tr>';
			}
		}else{
        	$tr = trim($tr);
        	if($tr){
            	$tds = explode("<br />", $tr);
            	$output .= '<tr>';
            	foreach($tds as $td){
                	$td = trim($td);
                	if($td){
                    	$output .= '<td>'.$td.'</td>';
                	}
            	}
            	$output .= '</tr>';
			}
		}
		$mdx_table_i++;
	}
	$hoverable = '';
	if($hover == 'true'){
		$hoverable = ' mdui-table-hoverable';
	}
	if($header == 'true'){
		$output2 = '<thead>'.$output2.'</thead>';
	}
    $output = '<div class="mdui-table-fluid'.$hoverable.'"><table class="mdui-table">'.$output2.'<tbody>'.$output.'</tbody></table></div>';
    return $output;
}
add_shortcode('mdx_table', 'mdx_shortcode_table');

function mdx_shortcode_progress($atts, $content = '0'){
    return '<div class="mdui-progress">
	<div class="mdui-progress-determinate" style="width: '.$content.'%;"></div>
  </div>';
}
add_shortcode("mdx_progress", "mdx_shortcode_progress");

function mdx_add_button_fold(){
	if(!current_user_can('edit_posts') && !current_user_can('edit_pages')){
		return;
	}
	if(get_user_option('rich_editing') == 'true'){
		add_filter('mce_external_plugins', 'mdx_add_plugin');
		add_filter('mce_buttons', 'mdx_register_button');
	}
}
add_action('init', 'mdx_add_button_fold');
function mdx_register_button($buttons){
	array_push($buttons, "|", "mdx_fold");
	array_push($buttons, "", "mdx_warning");
	array_push($buttons, "", "mdx_table");
	array_push($buttons, "", "mdx_progress");
	return $buttons;
}
function mdx_add_plugin($plugin_array){
	$plugin_array['mdx_fold'] = get_bloginfo('template_url').'/js/sc1.js';
	$plugin_array['mdx_warning'] = get_bloginfo('template_url').'/js/sc2.js';
	$plugin_array['mdx_table'] = get_bloginfo('template_url').'/js/sc3.js';
	$plugin_array['mdx_progress'] = get_bloginfo('template_url').'/js/sc4.js';
	return $plugin_array;
}

//Add Metaboxes
function mdx_post_metaboxes_2() {
    global $post;
		$meta_box_value = get_post_meta($post->ID, 'informations_value', true);
		if($meta_box_value==''){
			$meta_box_value = '-----Nothing-----';
		}
		//$meta_box_value = $post->ID;
        echo'<input type="hidden" name="informations_noncename" id="informations_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__) ).'">';
        echo '<textarea rows="7" style="width:100%" name="informations_value">'.$meta_box_value.'</textarea>
		<p class="description">在这里为这篇文章设置单独的文末信息。若希望跟随全局设置请输入<code>-----Nothing-----</code>。无论如何，请不要留空</p>';
}
function mdx_post_metaboxes_1() {
    global $post;
        $meta_box_value = get_post_meta($post->ID, 'settings_value', true);
		echo'<input type="hidden" name="settings_noncename" id="settings_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__) ).'">';
		?>
		<h4><?php _e('文章主题颜色','mdx');?></h4>
		<?php $mdx_v_styles=get_post_meta($post->ID, "mdx_styles", true);?>
        <select name="mdx_styles" id="mdx_styles">
		<option value="def" <?php if($mdx_v_styles=='def' || $mdx_v_styles==''){?>selected="selected"<?php }?>><?php _e('跟随全局设置','mdx');?></option>
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
	<p class="description"><?php _e('在这里为这篇文章设置单独的主题颜色。', 'mdx');?></p>
	<br>
	<h4><?php _e('文章强调色','mdx');?></h4>
	<?php $mdx_v_styles_act=get_post_meta($post->ID, "mdx_styles_act", true);?>
	<select name="mdx_styles_act" id="mdx_styles_act">
	<option value="def" <?php if($mdx_v_styles_act=='def' || $mdx_v_styles_act==''){?>selected="selected"<?php }?>><?php _e('跟随全局设置','mdx');?></option>
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
	<p class="description"><?php _e('在这里为这篇文章设置单独的强调色。', 'mdx');?></p>
	<br>
	<h4><?php _e('文章样式','mdx');?></h4>
	<?php $mdx_v_post_style=get_post_meta($post->ID, "mdx_post_style", true);?>
	<select name="mdx_post_style" id="mdx_post_style">
	<option value="def" <?php if($mdx_v_post_styles=='def' || $mdx_v_post_styles==''){?>selected="selected"<?php }?>><?php _e('跟随全局设置','mdx');?></option>
	<option value="0" <?php if($mdx_v_post_style=='0'){?>selected="selected"<?php }?>><?php _e('标准', 'mdx');?></option>
	<option value="1" <?php if($mdx_v_post_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
	<option value="2" <?php if($mdx_v_post_style=='2'){?>selected="selected"<?php }?>><?php _e('通透', 'mdx');?></option>
	</select>
	<p class="description"><?php _e('在这里为这篇文章设置单独的样式。', 'mdx');?></p>
	<br>
	<h4><?php _e('文章展示模式','mdx');?></h4>
	<?php $mdx_v_post_show=get_post_meta($post->ID, "mdx_post_show", true);?>
	<select name="mdx_post_show" id="mdx_post_show">
	<option value="0" <?php if($mdx_v_post_show=='0' || $mdx_v_post_show==''){?>selected="selected"<?php }?>><?php _e('正常显示', 'mdx');?></option>
	<option value="1" <?php if($mdx_v_post_show=='1'){?>selected="selected"<?php }?>><?php _e('404模式', 'mdx');?></option>
	<option value="2" <?php if($mdx_v_post_show=='2'){?>selected="selected"<?php }?>><?php _e('隐藏模式', 'mdx');?></option>
	</select>
	<p class="description"><?php _e('在这里为这篇文章设置展示模式。<br>404模式：当访客进入此文章时，会显示404页面<br>隐藏模式：当访客进入此文章时，会显示“因相关法律法规，此文章暂时不予显示”<br>但无论哪种模式，这篇文章都可以在首页找到或是被搜索到，且不会发送 HTTP 404头。', 'mdx');?></p>
	</fieldset>
	<?php
}
function create_meta_box(){
	add_meta_box('mdx_post_metaboxes_1', '文章设置', 'mdx_post_metaboxes_1', 'post', 'side', 'low');
	add_meta_box('mdx_post_metaboxes_2', '文末信息', 'mdx_post_metaboxes_2', 'post', 'normal', 'low');
}
add_action('admin_menu', 'create_meta_box');

function mdx_save_postdata_1($post_id){
    global $post;
        if(!wp_verify_nonce($_POST['informations_noncename'], plugin_basename(__FILE__))) {
            return $post->ID;
        }
        if('page' == $_POST['post_type']){
            if(!current_user_can('edit_page', $post_id))
                return $post->ID;
        }
        else{
            if(!current_user_can('edit_post', $post_id))
                return $post->ID;
        }
        $data = $_POST["informations_value"];
        if(get_post_meta((int)$post->ID, "informations_value") == ""){
            add_post_meta((int)$post->ID, "informations_value", (string)$data, true);
		}else{
            update_post_meta((int)$post->ID, "informations_value", (string)$data);
		}
			$data1 = $_POST["mdx_styles"];
			if(get_post_meta((int)$post->ID, "mdx_styles") == ""){
				add_post_meta((int)$post->ID, "mdx_styles", (string)$data1, true);
			}elseif($data != get_post_meta($post->ID, "mdx_styles", true)){
				update_post_meta((int)$post->ID, "mdx_styles", (string)$data1);
			}
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
				'def'=>'def',
			);
			if(get_post_meta((int)$post->ID, "mdx_styles_hex") == ""){
				add_post_meta((int)$post->ID, "mdx_styles_hex", $mdx_color_arr[(string)$data1], true);
			}elseif($data != get_post_meta($post->ID, "mdx_styles_hex", true)){
				update_post_meta((int)$post->ID, "mdx_styles_hex", $mdx_color_arr[(string)$data1]);
			}
			$data2 = $_POST["mdx_styles_act"];
			if(get_post_meta((int)$post->ID, "mdx_styles_act") == ""){
				add_post_meta((int)$post->ID, "mdx_styles_act", (string)$data2, true);
			}elseif($data != get_post_meta($post->ID, "mdx_styles_act", true)){
				update_post_meta((int)$post->ID, "mdx_styles_act", (string)$data2);
			}
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
				'def'=>'def',
			);
			if(get_post_meta((int)$post->ID, "mdx_styles_act_hex") == ""){
				add_post_meta((int)$post->ID, "mdx_styles_act_hex", $mdx_act_arr[(string)$data2], true);
			}elseif($data != get_post_meta($post->ID, "mdx_styles_act_hex", true)){
				update_post_meta((int)$post->ID, "mdx_styles_act_hex", $mdx_act_arr[(string)$data2]);
			}
			$data3 = $_POST["mdx_post_style"];
			if(get_post_meta((int)$post->ID, "mdx_post_style") == ""){
				add_post_meta((int)$post->ID, "mdx_post_style", (string)$data3, true);
			}elseif($data != get_post_meta($post->ID, "mdx_post_style", true)){
				update_post_meta((int)$post->ID, "mdx_post_style", (string)$data3);
			}
			$data4 = $_POST['mdx_post_show'];
			if(get_post_meta((int)$post->ID, "mdx_post_show") == ""){
				add_post_meta((int)$post->ID, "mdx_post_show", (string)$data4, true);
			}elseif($data != get_post_meta($post->ID, "mdx_post_show", true)){
				update_post_meta((int)$post->ID, "mdx_post_show", (string)$data4);
			}
}
add_action('save_post', 'mdx_save_postdata_1');
?>