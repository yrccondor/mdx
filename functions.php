<?php
//激活功能
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('image','link','status','video','audio'));
register_nav_menus(array('mdx_menu'=>__('抽屉菜单','mdx')));

//更新时初始化新功能
$mdx_version_base = get_option('mdx_version');
if($mdx_version_base=="1.3" || $mdx_version_base=="1.4" || $mdx_version_base=="1.4.1"){
	update_option('mdx_version', '1.5.0');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
}else if($mdx_version_base!="1.5.0"){
	update_option('mdx_version', '1.5.0');
	update_option('mdx_img_box', 'true');
	update_option('mdx_comment_emj', 'true');
	update_option('mdx_say_after', '');
	update_option('mdx_post_list_1', 'view');
	update_option('mdx_post_list_2', 'time');
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
	if(is_home()){$mdx_js_name='js';}elseif(is_category()||is_archive()||is_search()){$mdx_js_name='ac';}elseif(is_single()||$pageType=='page-postlike.php'){$mdx_js_name='post';}elseif(is_page()||$pageType!='page-postlike.php'){$mdx_js_name='page';}elseif(is_page()&&$pageType=='page-postlike.php'){$mdx_js_name='post';}else{$mdx_js_name='js';}
	wp_register_script('mdx_main_js', get_template_directory_uri().'/js/'.$mdx_js_name.'.js', false, '', true);
	wp_enqueue_script('mdx_jquery');
	wp_enqueue_script('mdx_mdui_js');
	wp_enqueue_script('mdx_sl_js');
	wp_enqueue_script('mdx_main_js');
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
		wp_register_script('mdx_ra_js', get_template_directory_uri().'/js/ra.js', false, '', true);
		wp_register_script('mdx_qr_js', get_template_directory_uri().'/js/qr.js', false, '', true);
		wp_enqueue_script('mdx_ra_js');
		wp_enqueue_script('mdx_qr_js');
	}
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
    <div class="mdui-list-item-title"><?php echo get_comment_author_link();?></div>
    <div class="mdui-list-item-text">
    <?php comment_text();?>
    </div><?php comment_reply_link(array_merge($args,array('reply_text'=>'回复','depth'=>$depth,'max_depth'=>$args['max_depth'])))?></div></li><li class="mdui-divider-inset mdui-m-y-0"></li><li>
<?php }

//回复的评论加@
function comment_add_at( $comment_text, $comment=''){
    if( $comment->comment_parent > 0){
	$comment_text='<a rel="nofollow" class="comment_at" href="#comment-'.$comment->comment_parent.'">@'.get_comment_author($comment->comment_parent).'：</a> '.$comment_text;
    }
	return $comment_text;
    }
add_filter('comment_text', 'comment_add_at', 10, 2);

//图片评论
function comments_embed_img($comment) {
    $size = auto;
    $comment = preg_replace(array('#(http://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#','#(https://([^\s]*)\.(jpg|gif|png|JPG|GIF|PNG))#'),'<img src="$1" alt="评论图片" style="width:'.$size.'; height:'.$size.'" />', $comment);
    return $comment;
}
add_action('comment_text', 'comments_embed_img', 2);

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
if(!is_admin()){
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
?>