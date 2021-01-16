<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
<meta charset="<?php bloginfo('charset');?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=<?php if(mdx_get_option('mdx_allow_scale')=='false'){echo '1, user-scalable=no';}else{echo '5';}?>">
<?php if(mdx_get_option('mdx_speed_pre')=='true' && !is_404()){?>
<?php if(is_home()){$mdx_js_name2='js';}elseif(is_category()||is_archive()||is_search()){$mdx_js_name2='ac';}elseif(is_single()){$mdx_js_name2='post';}elseif(is_page()){$mdx_js_name2='page';}else{$mdx_js_name2='js';}
global $files_root;
?>
<link rel="preload" href="<?php echo $files_root;?>/js/common.js?ver=<?php echo get_option("mdx_version_commit");?>" as="script">
<link rel="preload" href="<?php echo $files_root;?>/js/<?php echo $mdx_js_name2?>.js?ver=<?php echo get_option("mdx_version_commit");?>" as="script">
<link rel="preload" href="<?php echo $files_root;?>/mdui/icons/material-icons/<?php if(mdx_get_option("mdx_md2")=="false"){ ?>MaterialIcons-Regular.woff2<?php }else{ ?>material_2_icon_font.woff2<?php } ?>" as="font" type="font/woff2" crossorigin>
<?php if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?>
<link rel="preload" href="<?php echo $files_root;?>/fonts/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo $files_root;?>/fonts/Montserrat-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
<?php }}?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if(mdx_get_option('mdx_safari')=="true"){?>
<link rel="mask-icon" href="<?php echo mdx_get_option('mdx_svg');?>" color="<?php echo mdx_get_option('mdx_svg_color');?>">
<?php }?>
<?php if(mdx_get_option("mdx_title_med") == "diy"){?>
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
<meta property="og:title" content="<?php global $page, $paged;wp_title('-', true, 'right');
bloginfo('name');$site_description = get_bloginfo('description', 'display');if($site_description && (is_home() || is_front_page())) echo " - $site_description";if($paged >= 2 || $page >= 2) echo ' - '.sprintf(__('第 %s 页'), max($paged, $page));?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?php global $wp;$mdx_current_url=mdx_get_now_url(is_single(), isset($post) ? (int)$post->ID : 0);echo $mdx_current_url;?>">
<?php
$mdx_des=mdx_get_option('mdx_seo_des');
$mdx_s_key=mdx_get_option('mdx_seo_key');
$mdx_a_des=mdx_get_option('mdx_auto_des');?>
<meta property="og:description" content="<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码后才能查看。', 'mdx');}else{echo mdx_get_post_excerpt($post, 100);}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>">
<?php $mdx_index_img=mdx_get_option('mdx_index_img');if(!((!(is_single()||is_page()))&&substr($mdx_index_img,0,6)=="--Bing")){?>
<meta property="og:image" content="<?php if(is_single()||is_page()){$mdx_post_img=wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');if(isset($mdx_post_img[0])){echo $mdx_post_img[0];}else{echo "";}}else{echo $mdx_index_img;}?>">
<?php }?>
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="<?php wp_title('-', true, 'right');
bloginfo('name');if($site_description && (is_home() || is_front_page())) echo " - $site_description";if($paged >= 2 || $page >= 2) echo ' - '.sprintf(__('第 %s 页'), max($paged, $page));?>">
<meta name="twitter:description" content="<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码后才能查看。', 'mdx');}else{echo mdx_get_post_excerpt($post, 100);}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>">
<meta name="twitter:url" content="<?php echo $mdx_current_url;?>">
<?php if(!((!(is_single()||is_page()))&&substr($mdx_index_img,0,6)=="--Bing")){?>
<meta name="twitter:image" content="<?php if(is_single()||is_page()){if($mdx_post_img!==false&&$mdx_post_img[0]!=""){echo $mdx_post_img[0];}else{echo "";}}else{echo  $mdx_index_img;}?>">
<?php }if($mdx_des!=''){if($mdx_a_des=='true'){if(is_single()||is_page()){?>
<meta name="description" content="<?php if(post_password_required()){_e('这篇文章受密码保护，输入密码后才能查看。', 'mdx');}else{mdx_get_post_excerpt($post, 100);}?>">
<?php }else{?>
<meta name="description" content="<?php echo $mdx_des;?>">
<?php }}else{?>
<meta name="description" content="<?php echo $mdx_des;?>">
<?php }}if($mdx_s_key!=''){?>
<meta name="keywords" content="<?php bloginfo('name');echo ','.$mdx_s_key;?>">
<?php }}
if(mdx_get_option('mdx_chrome_color')=='true'){
    $mdx_theme_color = mdx_get_option('mdx_styles_hex');
    if(mdx_get_option('mdx_styles') === "white"){
        $mdx_theme_color = "#ffffff";
    }
if(is_single()){
    $mdx_theme_color_page = get_post_meta($post->ID, "mdx_styles_hex", true);
if($mdx_theme_color_page!='def' && $mdx_theme_color_page!=''){
    $mdx_theme_color = $mdx_theme_color_page;
}
if(get_post_meta($post->ID, "mdx_styles", true) === "white"){
    $mdx_theme_color = "#ffffff";
}}?>
<meta name="theme-color" content="<?php echo $mdx_theme_color;?>">
<meta name="mdx-main-color" content="<?php echo $mdx_theme_color;?>">
<?php }?>
<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
<?php wp_head(); ?><?php echo htmlspecialchars_decode(mdx_get_option('mdx_head_js'));?>
</head>