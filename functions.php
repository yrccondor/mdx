<?php
$mdx_all_options = get_option("mdx_all_options");

function mdx_get_option($option_name){
    return $GLOBALS['mdx_all_options'][$option_name];
}

function mdx_update_option($option_name, $option_value){
    $GLOBALS['mdx_all_options'][$option_name] = $option_value;
    update_option('mdx_all_options',$GLOBALS['mdx_all_options']);
    return true;
}

$mdx_now_url = '';
$mdx_flag_subdir = false;
if(stripos(explode('//', home_url())[1], "/") || mdx_get_option('mdx_install') === "sub"){
    $mdx_flag_subdir = true;
}
if(!$mdx_flag_subdir){
    global $wp;
    $mdx_now_url = home_url(add_query_arg(array()));
}else if($mdx_flag_subdir && get_option("permalink_structure") === ""){
    global $wp;
    $mdx_now_url = add_query_arg($wp->query_string, '', home_url($wp->request));
}else if($mdx_flag_subdir && get_option("permalink_structure") !== ""){
    global $wp;
    $current_url = home_url(add_query_arg(array(), $wp->request));
}else{
    global $wp;
    $mdx_now_url = home_url(add_query_arg(array()));
}
function mdx_get_now_url($is_post = false, $post_id = 0){
    if($is_post){
        return get_permalink($post_id);
    }
    return $GLOBALS['mdx_now_url'];
}
//激活功能
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('image','link','status','video','audio'));
register_nav_menus(array('mdx_menu'=>__('抽屉菜单','mdx')));
register_sidebar(
    array(
        'name' => __( '右侧菜单', 'mdx' ),
        'id' => 'widget_right',
        'description' => __( '在每个页面的右侧，默认隐藏，可以通过滑动或按钮调出。', 'mdx' ),
        'before_widget' => '<div class="mdui-card mdx-widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<div class="mdui-card-primary"><div class="mdui-card-primary-title">',
        'after_title' => '</div></div><div class="mdui-card-content mdui-typo">'
    )
);
if(mdx_get_option('mdx_title_med')=="wp"){
    add_theme_support('title-tag');
}

remove_filter('the_title', 'wptexturize');
remove_filter('wp_title', 'wptexturize');
remove_filter('single_post_title', 'wptexturize');

//初始化
if(!get_option('mdx_first_init')){
    //用途仅为统计安装量 mdx_key为发送请求时间戳的md5值 mdx_first_init不会在除此外的任何地方被调用
    if(function_exists('file_get_contents')){
        $opt = array(
            'http'=>array('method'=>"GET",'header'=>"User-Agent: MDxThemeinWordPress\r\n")
        );
        $contexts = stream_context_create($opt);
        $mdx_token = file_get_contents('https://mdxupdate.flyhigher.top/mdx/gettoken/', false, $contexts);
        $mdx_key = file_get_contents('https://mdxupdate.flyhigher.top/mdx/getkey/index.php?hostname='.$_SERVER['HTTP_HOST'].'&token='.md5($mdx_token), false, $contexts);
        update_option('mdx_first_init', 'fun-'.md5($mdx_key));
    }else{
        update_option('mdx_first_init', 'false');
    }
    include_once('includes/admin_init_fn.php');
}

//更新时初始化新功能
require('includes/update.php');

//后台菜单添加
if(is_admin()){
    include_once('admin_functions.php');
}

//主题升级
require 'plugin-update-checker/plugin-update-checker.php';
$mdxUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://update.dlij.site/mdx/info.json',
    __FILE__,
    'mdx'
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

include('includes/cdn_version.php');
$files_root = '';
if(mdx_get_option("mdx_use_cdn") === "custom"){
    $files_root = mdx_get_option("mdx_custom_cdn_root");
}else if(mdx_get_option("mdx_use_cdn") === "jsdelivr"){
    $files_root = 'https://cdn.jsdelivr.net/gh/yrccondor/mdx@'.$cdn_commit_version;
}else{
    $files_root = get_template_directory_uri();
}

//载入css & js
function mdx_css(){
    global $files_root;
    wp_register_style('mdx_mdui_css', $files_root.'/mdui/css/mdui.min.css', '', '', 'all');
    wp_register_style('mdx_style_css', $files_root.'/style.css', '', '', 'all');
    wp_enqueue_style('mdx_mdui_css');
    wp_enqueue_style('mdx_style_css');
    if(mdx_get_option('mdx_styles_dark')==="oled" || mdx_get_option('mdx_night_style')==="oled"){
        wp_register_style('mdx_oled', $files_root.'/css/oled.css', '', '', 'all');
        wp_enqueue_style('mdx_oled');
    }
    if(mdx_get_option("mdx_md2")=="true"){
        wp_register_style('mdx_md2', $files_root.'/css/md2.css', '', '', 'all');
        wp_enqueue_style('mdx_md2');
    }
    if(is_home() && mdx_get_option('mdx_index_head_style') === 'slide'){
        wp_register_style('mdx_flickity_css', $files_root.'/css/flickity.min.css', '', '', 'all');
        wp_enqueue_style('mdx_flickity_css');
    }
}
add_action('wp_enqueue_scripts', 'mdx_css');
function mdx_css_login(){
    global $files_root;
    if(mdx_get_option("mdx_login_md")=="true"){
        wp_register_style('mdx_mdui_css_login', $files_root.'/mdui/css/mdui.min.css', '', '', 'all');
        wp_register_style('mdx_style_css_login', $files_root.'/css/login.css', '', '', 'all');
        wp_enqueue_style('mdx_mdui_css_login');
        wp_enqueue_style('mdx_style_css_login');
        if(mdx_get_option("mdx_md2")=="true"){
            wp_register_style('mdx_md2_login', $files_root.'/css/md2.css', '', '', 'all');
            wp_enqueue_style('mdx_md2_login');
        }
    }
}
if(mdx_get_option("mdx_login_md") === "true"){
    add_action('login_enqueue_scripts', 'mdx_css_login');
}

function mdx_js(){
    global $files_root;
    if(mdx_get_option("mdx_jquery") === "true"){
        wp_register_script('mdx_jquery', $files_root.'/js/jquery.min.js', false, '', true);
        wp_enqueue_script('mdx_jquery');
    }
    wp_register_script('mdx_mdui_js', $files_root.'/mdui/js/mdui.min.js', false, '', true);
    wp_register_script('mdx_common', $files_root.'/js/common.js', false, '', true);
    wp_register_script('mdx_sl_js', $files_root.'/js/lazyload.js', false, '', true);
    wp_enqueue_script('mdx_mdui_js');
    wp_enqueue_script('mdx_common');
    if(mdx_get_option("mdx_real_search")=="true"){
        wp_register_script('mdx_rs_js', $files_root.'/js/search.js', false, '', true);
        wp_enqueue_script('mdx_rs_js');
    }
    if(is_single() || is_page()){
        wp_register_script('mdx_qr_js', $files_root.'/js/qr.js', false, '', true);
        wp_enqueue_script('mdx_qr_js');
        if(mdx_get_option("mdx_toc")=="true" && is_single()){
            wp_register_script('mdx_toc_js', $files_root.'/js/toc.js', false, '', true);
            wp_enqueue_script('mdx_toc_js');
            wp_localize_script('mdx_toc_js', 'mdx_show_preview', array("preview" => mdx_get_option("mdx_toc_preview")));
        }
        if (mdx_get_option("mdx_read_pro") === "true") {
            wp_register_script('mdx_ra_js', $files_root.'/js/ra.js', false, '', true);
            wp_enqueue_script('mdx_ra_js');
        }
    }
    if(is_singular() && comments_open() && get_option('thread_comments')){
        wp_enqueue_script('better-comment', $files_root.'/js/better_comment.js', array(), AC_VERSION , true);
        wp_enqueue_script('ajax-comment', $files_root.'/ajax-comment/app.js', array(), AC_VERSION , true);
        wp_localize_script('ajax-comment', 'ajaxcomment', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'order' => get_option('comment_order'),
            'formpostion' => 'top',
            'i18n_1' => __('发送成功。', 'mdx'),
            'i18n_2' => __('<strong>错误：</strong> 未知错误。', 'mdx'),
        ));
    }
    if(is_home() && mdx_get_option('mdx_index_head_style') === 'slide'){
        wp_register_script('mdx_flickity_js', $files_root.'/js/flickity.min.js', array(), AC_VERSION , true);
        wp_enqueue_script('mdx_flickity_js');
    }
    if((!is_single() && !is_page() && !is_404()) && mdx_get_option('mdx_post_list_width') === 'wide'){
        wp_register_script('mdx_masonry_js', $files_root.'/js/masonry.min.js', array(), AC_VERSION , true);
        wp_enqueue_script('mdx_masonry_js');
    }
    wp_enqueue_script('mdx_sl_js');
}
add_action('wp_enqueue_scripts', 'mdx_js');
function mdx_js_login(){
    global $files_root;
    if(mdx_get_option("mdx_login_md")=="true"){
        wp_register_script('mdx_mdui_js_login', $files_root.'/mdui/js/mdui.min.js', false, '', true);
        wp_register_script('mdx_js_login', $files_root.'/js/login.js', false, '', true);
        wp_enqueue_script('mdx_mdui_js_login');
        wp_enqueue_script('mdx_js_login');
    }
}
if(mdx_get_option("mdx_login_md")=="true"){
    add_action('login_enqueue_scripts', 'mdx_js_login');
}

// 添加古腾堡资源
function mdx_load_blocks(){
  wp_enqueue_script(
    'mdx_block_js',
    get_template_directory_uri() . '/blocks/blocks.build.js',
    ['wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor'],
    true
  );
  wp_set_script_translations('mdx_block_js', 'mdx', get_template_directory().'/blocks/languages/');
}
add_action('enqueue_block_editor_assets', 'mdx_load_blocks');

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
    if(!$post){
        return;
    }
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
    $src = str_replace($wp_version, get_option('mdx_version_commit'), $src);
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

//评论回调
function mdx_comment_format($comment, $args, $depth){
$GLOBALS['comment'] = $comment;?>
    <li class="mdui-list-item" id="li-comment-<?php comment_ID(); ?>">
    <div class="mdui-list-item-avatar"><?php if(function_exists('get_avatar') && get_option('show_avatars')){echo get_avatar($comment, 80);}?></div>
    <div class="mdui-list-item-content outbu" id="comment-<?php comment_ID();?>">
    <div class="mdui-list-item-title"><?php echo get_comment_author_link();?><?php if(user_can($comment->user_id, "update_core")){echo '<span class="mdx-admin">'.__('博主','mdx').'</span>';}?></div>
    <div class="mdui-list-item-text mdui-typo">
    <?php comment_text();?>
    </div><span class="mdx-reply-time"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')).__('前','mdx');?></span><?php comment_reply_link(array_merge($args,array('reply_text'=>'<i class="mdui-icon material-icons">&#xe15e;</i> '.__('回复', 'mdx'),'depth'=>$depth,'max_depth'=>$args['max_depth'])))?></div></li><li class="mdui-divider-inset mdui-m-y-0"></li><li>
<?php }

//回复的评论加@
function comment_add_at( $comment_text, $comment){
    if ($comment->comment_parent > 0) {
        $comment_text='<a rel="nofollow" class="comment_at" href="#comment-'.$comment->comment_parent.'">@'.get_comment_author($comment->comment_parent).'：</a> '.$comment_text;
    }
    return $comment_text;
}
add_filter('comment_text', 'comment_add_at', 10, 2);

//获取链接
function get_link_items(){
    $linkcats = get_terms('link_category');
    if(!empty($linkcats)){
        $result = '';
        foreach($linkcats as $linkcat){            
            $result.='<h3 class="link-title">'.$linkcat->name.'</h3>';
            if($linkcat->description)$result .= '<div class="link-description">'.$linkcat->description.'</div>';
            $result .=  get_the_link_items($linkcat->term_id);
        }
    }else{
        $result = get_the_link_items();
    }
    return $result;
}
// 将在 图像链接 > 备注中的图像 url > 备注中的 Gravatar 邮箱(需设置中开启)中获取链接图像
function get_the_link_items($id = null){
    $mdx_gravatar_actived = mdx_get_option('mdx_gravatar_actived');
    $mdx_link_rand_order = mdx_get_option('mdx_link_rand_order');
    $order_rule = 'category='.$id;
    if ($mdx_link_rand_order == 'true') {
        $order_rule .= 'title_li=&orderby=rand';
    }
    $bookmarks = get_bookmarks($order_rule);
    $output = '';
    if(!empty($bookmarks)){
        $output.='<div class="mdui-container">';
        foreach($bookmarks as $bookmark){
            $lazy_load =  '';
            if(!empty($bookmark->link_image)){
                $lazy_load = ' lazyload" data-bg="'.$bookmark->link_image;
            } else {
                $imglink = $bookmark->link_notes;
                if (substr($imglink, 0, 4) !== 'http' && $mdx_gravatar_actived == 'true'){
                    $imglink = get_avatar_url($imglink, array('size'=>512));
                }
                $lazy_load = ' lazyload" data-bg="'.$imglink;
            }
            $rel = '';
            if(!empty($bookmark->link_rel)){
                $rel = 'rel="'.$bookmark->link_rel.'" ';
            }
            $output.= '<div class="mdui-row mdui-col-xs-6 mdui-col-sm-4 links-co"><div class="links-c mdui-color-theme"></div><a '.$rel.'href="'.$bookmark->link_url.'" title="'.$bookmark->link_name.'" target="'.$bookmark->link_target.'"><div class="mdx-links-bg '.$lazy_load.'"></div></a><div class="mdui-grid-tile-actions links-des"><div class="mdui-grid-tile-text"><div class="mdui-grid-tile-title links-name"><a '.$rel.'href="'.$bookmark->link_url.'" title="'.$bookmark->link_name.'" target="'.$bookmark->link_target.'">'.$bookmark->link_name.'</a></div><div class="mdui-grid-tile-subtitle">'.$bookmark->link_description.'</div></div></div></div>';
        }
        $output .= '</div>';
    }
    return $output;
}

function mdx_blogroll_nofollow() {
    add_action('add_meta_boxes', 'mdx_blogroll_add_meta_box', 1, 1);
    add_filter('pre_link_rel', 'mdx_blogroll_save_meta_box', 10, 1);
}

function mdx_blogroll_add_meta_box() {
    add_meta_box('mdx_blogroll_nofollow_div', __('nofollow'), 'mdx_blogroll_inner_meta_box', 'link', 'side');
}

function mdx_blogroll_inner_meta_box($post) {
    $bookmark = get_bookmark($post->ID, 'ARRAY_A');
    if (strpos($bookmark['link_rel'], 'nofollow') !== FALSE)
        $checked = ' checked="checked"';
    else
        $checked = '';
    ?>
    <input value="1" id="mdx_blogroll_nofollow_checkbox" name="mdx_blogroll_nofollow_checkbox" type="checkbox"<?php echo $checked;?>> <label for="mdx_blogroll_nofollow_checkbox"><?php echo __('添加 <code>nofollow</code> 属性', 'mdx'); ?></label>
    <?php
}

function mdx_blogroll_save_meta_box($link_rel) {
    $rel = trim(str_replace('nofollow', '', $link_rel));
    if ($_POST['mdx_blogroll_nofollow_checkbox'])
        $rel .= ' nofollow';
    return trim($rel);
}
add_action('load-link.php', 'mdx_blogroll_nofollow');
add_action('load-link-add.php', 'mdx_blogroll_nofollow');

//获取摘要
function mdx_get_post_excerpt($post, $excerpt_length=150){
    if(!$post) $post = get_post();

    $post_excerpt = $post->post_excerpt;
    if($post_excerpt == ''){
        $post_content = $post->post_content;
        $post_content = do_shortcode($post_content);
        $post_content = wp_strip_all_tags( $post_content );

        $post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,'…','utf-8');
    }

    $post_excerpt = wp_strip_all_tags( $post_excerpt );
    $post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

    return $post_excerpt;
}

//PostLazyLoad
function mdx_lazyload_image($content){
    if(is_feed()){
        return $content;
    }
    $content = preg_replace_callback('#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', 'mdx_process_image', $content);
    return $content;
}
function mdx_process_image($matches){
    $placeholder_image = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
    $old_attributes_str = $matches[2];
    $img = wp_kses_hair($old_attributes_str, wp_allowed_protocols());
    if (empty($img['src'])){
        return $matches[0];
    }
    isset($img['sizes']) ? $mdx_sizes = ' sizes="'.$img['sizes']['value'].'"' : $mdx_sizes = '';
    isset($img['srcset']) ? $mdx_srcset = ' data-srcset="'.$img['srcset']['value'].'"' : $mdx_srcset = '';
    isset($img['style']) ? $mdx_img_style = ' style="'.$img['style']['value'].'"' : $mdx_img_style = '';
    isset($img['width']) ? $mdx_img_width = ' width="'.$img['width']['value'].'"' : $mdx_img_width = '';
    isset($img['width']) ? $mdx_figure_width = 'max-width:'.$img['width']['value'].'px' : $mdx_figure_width = '';
    isset($img['height']) ? $mdx_img_height = ' height="'.$img['height']['value'].'"' : $mdx_img_height = '';
    (isset($img['height']) && isset($img['width'])) ? $mdx_con_paading = $img['height']['value']/$img['width']['value']*100 : $mdx_con_paading = 50;
    isset($img['class']) ? $mdx_img_class = $img['class']['value'].' ' : $mdx_img_class = '';
    isset($img['alt']) ? $mdx_img_alt = ' alt="'.$img['alt']['value'].'"' : $mdx_img_alt = '';
    $mdx_img_title = ' title="'.get_the_title().'"';
    ($mdx_img_alt=='' || $mdx_img_alt==' alt=""') ? $mdx_img_title = ' title="'.get_the_title().'"' : $mdx_img_title = ' title="'.$img['alt']['value'].'"';
    ($mdx_img_alt=='' || $mdx_img_alt==' alt=""') ? $mdx_img_alt = ' alt="'.$img['src']['value'].'"' : $mdx_img_alt = ' alt="'.$img['alt']['value'].'"';
    if($mdx_img_class === "wp-smiley "){
        return $matches[0];
    }
    if(mdx_get_option("mdx_lazyload_fallback") == "true"){
        $html = '<img'.$mdx_img_width.''.$mdx_img_height.' class="'.$mdx_img_class.'lazyload"'.$mdx_img_style.$mdx_img_title.' src="data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw==" data-src="'.$img['src']['value'].'"'.$mdx_img_alt.$mdx_srcset.''.$mdx_sizes.'>';
    }else{
        $html = '<figure class="mdx-lazyload-container" style="'.$mdx_figure_width.'"><div style="padding-top:'.strval($mdx_con_paading).'%"></div><div class="mdx-img-loading-sp mdui-valign"><div><div class="mdui-spinner"></div></div></div><img'.$mdx_img_width.''.$mdx_img_height.' class="'.$mdx_img_class.'lazyload"'.$mdx_img_style.$mdx_img_title.' src="'.$placeholder_image.'" data-src="'.$img['src']['value'].'"'.$mdx_img_alt.$mdx_srcset.''.$mdx_sizes.'></figure>';
    }
    return $html;
}
function mdx_lazyload_avatar($content){
    if(is_feed()){
        return $content;
    }
    $content = preg_replace_callback('#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', 'mdx_process_avatar', $content);
    return $content;
}
function mdx_process_avatar($matches){
    $placeholder_image = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
    $old_attributes_str = $matches[2];
    $img = wp_kses_hair($old_attributes_str, wp_allowed_protocols());
    if (empty($img['src'])){
        return $matches[0];
    }
    isset($img['sizes']) ? $mdx_sizes = ' sizes="'.$img['sizes']['value'].'"' : $mdx_sizes = '';
    isset($img['srcset']) ? $mdx_srcset = ' data-srcset="'.$img['srcset']['value'].'"' : $mdx_srcset = '';
    isset($img['width']) ? $mdx_img_width = ' width="'.$img['width']['value'].'"' : $mdx_img_width = '';
    isset($img['height']) ? $mdx_img_height = ' height="'.$img['height']['value'].'"' : $mdx_img_height = '';
    isset($img['class']) ? $mdx_img_class = $img['class']['value'].' ' : $mdx_img_class = '';
    isset($img['alt']) ? $mdx_img_alt = ' alt="'.$img['alt']['value'].'"' : $mdx_img_alt = '';
    $html = '<img'.$mdx_img_width.''.$mdx_img_height.' class="'.$mdx_img_class.'lazyload mdx-avatar-lazyload" src="'.$placeholder_image.'" data-src="'.$img['src']['value'].'"'.$mdx_img_alt.$mdx_srcset.''.$mdx_sizes.'>';
    return $html;
}
function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
if(!is_admin() && mdx_get_option('mdx_lazy_load_mode')=='speed'){
    add_filter('the_content','mdx_lazyload_image', 99);
    add_filter('the_content', 'filter_ptags_on_images', 98);
    add_filter('get_avatar','mdx_lazyload_avatar', 11);
}


//面包屑
function mdx_breadcrumbs(){
    $delimiter = '&nbsp;&nbsp;<span class="mdx-spr">•</span>&nbsp;&nbsp;'; // 分隔符
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
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_post($parent_id);
                $breadcrumbs[] = '<a itemprop="breadcrumb" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
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
        <p>'.do_shortcode($content).'</p>
      </div>
    </div>
  </div>';
}
add_shortcode("mdx_fold", "mdx_shortcode_hide");

function mdx_shortcode_warning($atts, $content = null){
    extract(shortcode_atts(array("title" => __('警告','mdx')), $atts));
    return '<blockquote class="mdx-warning"><p><i class="mdui-icon material-icons">&#xe002;</i> '.$title.'<br><strong>'.do_shortcode($content).'</strong></p></blockquote>';
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
            if($tr !== ""){
                $tds = explode("<br />", $tr);
                $output2 .= '<tr>';
                foreach($tds as $td){
                    $td = trim($td);
                    if($td !== ""){
                        $output2 .= '<th>'.$td.'</th>';
                    }
                }
                $output2 .= '</tr>';
            }
        }else{
            $tr = trim($tr);
            if($tr !== ""){
                $tds = explode("<br />", $tr);
                $output .= '<tr>';
                foreach($tds as $td){
                    $td = trim($td);
                    if($td !== ""){
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

function mdx_shortcode_post($atts, $content = ''){
    return '<div class="mdx-post-cot" data-mdxposturl="'.$content.'"><div class="mdx-post-wait-out-c2"><div class="mdx-post-wait-out-c mdui-valign"><div class="mdx-github-wait-out"><div class="mdx-github-wait"><a href="'.$content.'"><div class="mdui-spinner"></div></a></div></div></div></div></div>';
}
add_shortcode("mdx_post", "mdx_shortcode_post");

function mdx_shortcode_github($atts, $content = ''){
    extract( shortcode_atts(array(
        'author' => '',
        'project' => '',
        'gateway' => 'https://api.github.com/'
    ), $atts));
    return '<div class="mdx-github-cot" data-mdxgithuba="'.$author.'" data-mdxgithubp="'.$project.'" data-mdxgithubg="'.$gateway.'"><div class="mdx-github-wait-out-c2"><div class="mdx-github-wait-out-c mdui-valign"><div class="mdx-github-wait-out"><div class="mdx-github-wait"><a href="https://github.com/'.$author.'/'.$project.'"><div class="mdui-spinner"></div></a></div></div></div></div></div>';
}
add_shortcode("mdx_github", "mdx_shortcode_github");

function mdx_shortcode_ad($atts, $content = ''){
    if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
        return '<div class="mdx-ad-in-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
    }else{
        return '';
    }
    
}
add_shortcode("mdx_ad", "mdx_shortcode_ad");

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
    array_push($buttons, "", "mdx_post");
    array_push($buttons, "", "mdx_github");
    array_push($buttons, "", "mdx_ad");
    return $buttons;
}
function mdx_add_plugin($plugin_array){
    $plugin_array['mdx_fold'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_warning'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_table'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_progress'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_post'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_github'] = get_bloginfo('template_url').'/js/sc1.js';
    $plugin_array['mdx_ad'] = get_bloginfo('template_url').'/js/sc1.js';
    return $plugin_array;
}

//Add Metaboxes
function mdx_post_metaboxes_2() {
    global $post;
        $meta_box_value = get_post_meta($post->ID, 'informations_value', true);
        echo '<input type="hidden" name="informations_noncename" id="informations_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__) ).'">';
        echo '<textarea rows="7" style="width:100%" name="informations_value">'.$meta_box_value.'</textarea>'.__('
        <p class="description">在这里为这篇文章设置单独的文末信息。若希望跟随全局设置请留空</p>', 'mdx');
}
function mdx_post_metaboxes_1() {
    global $post;
        $meta_box_value = get_post_meta($post->ID, 'settings_value', true);
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
        <option value="white" <?php if($mdx_v_styles=='white'){?>selected="selected"<?php }?>>White</option>
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
    <option value="def" <?php if($mdx_v_post_style=='def' || $mdx_v_post_style==''){?>selected="selected"<?php }?>><?php _e('跟随全局设置','mdx');?></option>
    <option value="0" <?php if($mdx_v_post_style=='0'){?>selected="selected"<?php }?>><?php _e('标准', 'mdx');?></option>
    <option value="1" <?php if($mdx_v_post_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
    <option value="2" <?php if($mdx_v_post_style=='2'){?>selected="selected"<?php }?>><?php _e('通透', 'mdx');?></option>
    <option value="3" <?php if($mdx_v_post_style=='3'){?>selected="selected"<?php }?>><?php _e('朴素', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('在这里为这篇文章设置单独的样式。', 'mdx');?></p>
    <br>
    <h4><?php _e('文章展示模式','mdx');?></h4>
    <?php $mdx_v_post_show=get_post_meta($post->ID, "mdx_post_show", true);?>
    <select name="mdx_post_show" id="mdx_post_show">
    <option value="0" <?php if($mdx_v_post_show=='0' || $mdx_v_post_show==''){?>selected="selected"<?php }?>><?php _e('正常显示', 'mdx');?></option>
    <option value="1" <?php if($mdx_v_post_show=='1'){?>selected="selected"<?php }?>><?php _e('404模式', 'mdx');?></option>
    <option value="2" <?php if($mdx_v_post_show=='2'){?>selected="selected"<?php }?>><?php _e('隐藏模式', 'mdx');?></option>
    <option value="3" <?php if($mdx_v_post_show=='3'){?>selected="selected"<?php }?>><?php _e('对游客隐藏模式', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('在这里为这篇文章设置展示模式。<br>404 模式：当访客进入此文章时，会显示 404 页面<br>隐藏模式：当访客进入此文章时，会显示“根据相关法律法规，此文章暂时不予显示”<br>对游客隐藏模式：若访问者未登录，则显示“登录后才能查看此文章”<br>若使用前两种模式，这篇文章将可在首页找到或是被搜索到。但无论何种模式都不会发送 HTTP 404 头。', 'mdx');?></p>
    </fieldset>
    <?php
}
function create_meta_box(){
    add_meta_box('mdx_post_metaboxes_1', __('文章设置', 'mdx'), 'mdx_post_metaboxes_1', 'post', 'side', 'low');
    add_meta_box('mdx_post_metaboxes_2', __('文末信息', 'mdx'), 'mdx_post_metaboxes_2', 'post', 'normal', 'low');
}
add_action('admin_menu', 'create_meta_box');

function mdx_save_postdata_1($post_id, $post){
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
        if(!add_post_meta((int)$post_id, "informations_value", (string)$data, true)){ 
            update_post_meta((int)$post_id, "informations_value", (string)$data);
        }
            $data1 = $_POST["mdx_styles"];
            if(!add_post_meta((int)$post_id, "mdx_styles", (string)$data1, true)){ 
                update_post_meta((int)$post_id, "mdx_styles", (string)$data1);
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
                'white'=>'#9e9e9e',
                'def'=>'def',
            );
            if(!add_post_meta((int)$post_id, "mdx_styles_hex", $mdx_color_arr[(string)$data1], true)){ 
                update_post_meta((int)$post_id, "mdx_styles_hex", $mdx_color_arr[(string)$data1]);
            }
            $data2 = $_POST["mdx_styles_act"];
            if(!add_post_meta((int)$post_id, "mdx_styles_act", (string)$data2, true)){ 
                update_post_meta((int)$post_id, "mdx_styles_act", (string)$data2);
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
            if(!add_post_meta((int)$post_id, "mdx_styles_act_hex", $mdx_act_arr[(string)$data2], true)){ 
                update_post_meta((int)$post_id, "mdx_styles_act_hex", $mdx_act_arr[(string)$data2]);
            }
            $data3 = $_POST["mdx_post_style"];
            if(!add_post_meta((int)$post_id, "mdx_post_style", (string)$data3, true)){ 
                update_post_meta((int)$post_id, "mdx_post_style", (string)$data3);
            }
            $data4 = $_POST['mdx_post_show'];
            if(!add_post_meta((int)$post_id, "mdx_post_show", (string)$data4, true)){ 
                update_post_meta((int)$post_id, "mdx_post_show", (string)$data4);
            }
}
add_action('save_post', 'mdx_save_postdata_1', 10, 2);

function mdx_colored_cloud($text) {
    $text = preg_replace_callback('/<a (.+?)>/i','mdx_colored_cloud_call_back', $text);
    return $text;
}
function mdx_colored_cloud_call_back($matches) {
    $text = $matches[1];
    $color = dechex(rand(0,16777215));
    $pattern = '/style=(\'|\")(.*)(\'|\")/i';
    $text = str_replace("style=\"","style=\"color:#{$color};",$text);
    $text = str_replace("style='","style='color:#{$color};",$text);
    return "<a $text>";
}
if(mdx_get_option('mdx_tags_color') === "true"){
    add_filter('wp_tag_cloud', 'mdx_colored_cloud', 1);
}

//Enable basic functions for classic editor
function mdx_add_editor_buttons($buttons) {
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'backcolor';
    $buttons[] = 'underline';
    $buttons[] = 'hr';
    $buttons[] = 'cut';
    $buttons[] = 'copy';
    $buttons[] = 'paste';
    return $buttons;
}
add_filter("mce_buttons_2", "mdx_add_editor_buttons");

?>