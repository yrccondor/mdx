<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php if(get_option('mdx_speed_pre')=='true' && !is_404()){?>
<?php if(is_home()){$mdx_js_name2='js';}elseif(is_category()||is_archive()||is_search()){$mdx_js_name2='ac';}elseif(is_single()||$pageType=='page-postlike.php'){$mdx_js_name2='post';}elseif(is_page()||$pageType!='page-postlike.php'){$mdx_js_name2='page';}elseif(is_page()&&$pageType=='page-postlike.php'){$mdx_js_name2='post';}else{$mdx_js_name2='js';}?>
<link rel="preload" href="<?php echo get_bloginfo('template_url');?>/js/<?php echo $mdx_js_name2?>.js" as="script">
<link rel="preload" href="<?php echo get_bloginfo('template_url');?>/mdui/icons/material-icons/MaterialIcons-Regular.woff2" as="font" type="font/woff2" crossorigin>
<?php }?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if(get_option('mdx_safari')=="true"){?>
<link rel="mask-icon" href="<?php echo get_option('mdx_svg');?>" color="<?php echo get_option('mdx_svg_color');?>">
<?php }?>
<?php if(get_option("mdx_title_med") == "diy"){?>
<title itemprop="name"><?php global $page, $paged;wp_title('-', true, 'right');
bloginfo('name');$site_description = get_bloginfo('description', 'display');
if($site_description && (is_home() || is_front_page())) echo " - $site_description";if($paged >= 2 || $page >= 2) echo ' - '.sprintf(__('第 %s 页'), max($paged, $page));?>
</title>
<?php }?>
<?php if(is_single() || is_page()){
    if(function_exists('get_query_var')){
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if(!empty($cpage) || !empty($commentPage)){
        echo '<meta name="robots" content="noindex, nofollow">';}}?>
<?php if(!is_404()){?>
<meta property="og:title" content="<?php wp_title('-', true, 'right');
bloginfo('name');if($site_description && (is_home() || is_front_page())) echo " - $site_description";if($paged >= 2 || $page >= 2) echo ' - '.sprintf(__('第 %s 页'), max($paged, $page));?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));echo $mdx_current_url;?>">
<?php
$mdx_des=get_option('mdx_seo_des');
$mdx_s_key=get_option('mdx_seo_key');
$mdx_a_des=get_option('mdx_auto_des');?>
<meta property="og:description" content="<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mdx_get_post_excerpt($post, 100);}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>">
<meta property="og:image" content="<?php if(is_single()||is_page()){$mdx_post_img=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');if($mdx_post_img[0]!=""){echo $mdx_post_img[0];}else{echo get_option('mdx_index_img');}}else{echo get_option('mdx_index_img');}?>">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php wp_title('-', true, 'right');
bloginfo('name');if($site_description && (is_home() || is_front_page())) echo " - $site_description";if($paged >= 2 || $page >= 2) echo ' - '.sprintf(__('第 %s 页'), max($paged, $page));?>">
<meta name="twitter:description" content="<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mdx_get_post_excerpt($post, 100);}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>">
<meta name="twitter:url" content="<?php echo $mdx_current_url;?>">
<meta name="twitter:image" content="<?php if(is_single()||is_page()){if($mdx_post_img[0]!=""){echo $mdx_post_img[0];}else{echo get_option('mdx_index_img');}}else{echo get_option('mdx_index_img');}?>">
<?php
if($mdx_des!=''){if($mdx_a_des=='true'){if(is_single()||is_page()){?>
<meta name="description" content="<?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{mdx_get_post_excerpt($post, 100);}?>">
<?php }else{?>
<meta name="description" content="<?php echo $mdx_des;?>">
<?php }}else{?>
<meta name="description" content="<?php echo $mdx_des;?>">
<?php }}if($mdx_s_key!=''){?>
<meta name="keywords" content="<?php bloginfo('name');echo ','.$mdx_s_key;?>">
<?php }}
if(get_option('mdx_chrome_color')=='true'){
    $mdx_theme_color = get_option('mdx_styles_hex');
if(is_single()){
    $mdx_theme_color_page = get_post_meta($post->ID, "mdx_styles_hex", true);
if($mdx_theme_color_page!='def' && $mdx_theme_color_page!=''){
    $mdx_theme_color = $mdx_theme_color_page;
}}?>
<meta name="theme-color" content="<?php echo $mdx_theme_color;?>">
<?php }?>
<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
<?php wp_head(); ?><?php echo htmlspecialchars_decode(get_option('mdx_head_js'));?>
</head>