<?php
//引用全局变量
global $wp;
global $files_root;
global $page, $paged;
/**
 * @var string TwitterCard分享类型 summary|summary_large_image
 * @see https://developer.twitter.com/en/docs/twitter-for-websites/cards/overview/abouts-cards Developer Document
 * @see https://cards-dev.twitter.com/validator Site for Test
 */
$opt_mdx_share_twitter_card = mdx_get_option("mdx_share_twitter_card");

// 获取当前页面Title
$title = "";
$title .= wp_title('-', true, 'right');
$title .= get_bloginfo('name');
$site_description = get_bloginfo('description', 'display');
if ($site_description && (is_home() || is_front_page())) $title .= " - $site_description";
if ($paged >= 2 || $page >= 2) $title .= ' - ' . sprintf(__('第 %s 页'), max($paged, $page));

// 获取当前页面分享图
$opt_mdx_index_img = mdx_get_option('mdx_index_img');
$coverPicIsBing = (bool)substr($opt_mdx_index_img, 0, 6) == "--Bing";
$index_image = !(!(is_single() || is_page()) && $coverPicIsBing)?((is_single() || is_page())?(wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]??""):$opt_mdx_index_img):mdx_get_option('mdx_side_head');

// 获取当前页面社会分享描述
$social_describe = "";
$mdx_des = mdx_get_option('mdx_seo_des');
if (is_single() || is_page()) {
    if (post_password_required()) {
        $social_describe = translate('这篇文章受密码保护，输入密码后才能查看。', 'mdx');
    } else {
        $social_describe = mdx_get_post_excerpt($post, 100);
    }
} else if ($mdx_des != '') {
    $social_describe = $mdx_des;
} else {
    $social_describe = get_bloginfo('description', 'display');
}

// PS: 判断页面类型的我还能再优化，但实在太懒（划掉）
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=<?php echo (mdx_get_option('mdx_allow_scale') == 'false')?"1, user-scalable=no":"5"; ?>">
    <?php if (mdx_get_option('mdx_speed_pre') == 'true' && !is_404()) {
        if (is_home()) { $mdx_js_name2 = 'js'; } else if (is_category() || is_archive() || is_search()) { $mdx_js_name2 = 'ac'; } else if (is_single()) { $mdx_js_name2 = 'post'; } else if (is_page()) { $mdx_js_name2 = 'page'; } else { $mdx_js_name2 = 'js'; } ?>

        <link rel="preload" href="<?php echo $files_root; ?>/js/common.js?ver=<?php echo get_option("mdx_version_commit"); ?>" as="script">
        <link rel="preload" href="<?php echo $files_root; ?>/js/<?php echo $mdx_js_name2 ?>.js?ver=<?php echo get_option("mdx_version_commit"); ?>" as="script">
        <link rel="preload" href="<?php echo $files_root; ?>/mdui/icons/material-icons/<?php echo (mdx_get_option("mdx_md2") == "false")?"MaterialIcons-Regular.woff2":"material_2_icon_font.woff2" ?>" as="font" type="font/woff2" crossorigin>
        <?php if (mdx_get_option('mdx_md2') == "true" && mdx_get_option('mdx_md2_font') == "true") { ?>
            <link rel="preload" href="<?php echo $files_root; ?>/fonts/Montserrat-Regular.woff2" as="font" type="font/woff2" crossorigin>
            <link rel="preload" href="<?php echo $files_root; ?>/fonts/Montserrat-SemiBold.woff2" as="font" type="font/woff2" crossorigin>
        <?php } ?>
    <?php } ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Theme developed by AxtonYao -->
    <?php if (mdx_get_option('mdx_safari') == "true") { ?>
        <link rel="mask-icon" href="<?php echo mdx_get_option('mdx_svg'); ?>" color="<?php echo mdx_get_option('mdx_svg_color'); ?>">
    <?php } ?>
    <?php if (mdx_get_option("mdx_title_med") == "diy") { ?>
        <title itemprop="name"><?php echo $title; ?></title>
    <?php } ?>
    <?php if (is_single() || is_page()) {
        if (function_exists('get_query_var')) {
            $cpage = intval(get_query_var('cpage'));
            $commentPage = intval(get_query_var('comment-page'));
        }
        if (!empty($cpage) || !empty($commentPage)) {
            echo '<meta name="robots" content="noindex, nofollow">';
        }
    } ?>
    <?php if (!is_404()) { ?>
        <meta property="og:title" content="<?php echo $title; ?>">
        <meta property="og:type" content="article">
        <meta property="og:url" content="<?php
        $mdx_current_url = mdx_get_now_url(is_single(), isset($post) ? (int)$post->ID : 0);
        echo $mdx_current_url; ?>">
        <?php
        $mdx_des = mdx_get_option('mdx_seo_des');
        $mdx_s_key = mdx_get_option('mdx_seo_key');
        $mdx_a_des = mdx_get_option('mdx_auto_des');
        $opt_mdx_share_twitter_username = mdx_get_option('mdx_share_twitter_username');?>
        <meta property="og:description" content="<?php echo $social_describe; ?>">
        <meta property="og:image" content="<?php echo $index_image; ?>">
        <meta name="twitter:card" content="<?php echo (is_single()||is_page())?(($opt_mdx_share_twitter_card=="summary"||$opt_mdx_share_twitter_card=="summary_large_image")?$opt_mdx_share_twitter_card:"summary"):"summary"; ?>">
        <?php if(preg_match("/@?([A-Za-z0-9_]+)/i",$opt_mdx_share_twitter_username,$v_opt_mdx_share_twitter_username)>0){ ?>
            <meta name="twitter:site" content="@<?php echo $v_opt_mdx_share_twitter_username[1]; ?>">
        <?php } ?>
        <meta name="twitter:title" content="<?php echo $title; ?>">
        <meta name="twitter:description" content="<?php echo $social_describe; ?>">
        <meta name="twitter:url" content="<?php echo $mdx_current_url; ?>">
        <meta name="twitter:image" content="<?php echo $index_image; ?>">
        <meta itemprop="name" content="<?php echo $title; ?>">
        <meta itemprop="image" content="<?php echo $index_image; ?>">
        <?php
        if ($mdx_des !== '') {
            if ($mdx_a_des === 'true') {
                if (is_single() || is_page()) {
                    ?>
                    <meta name="description" itemprop="description" content="<?php if (post_password_required()) {
                        _e('这篇文章受密码保护，输入密码后才能查看。', 'mdx');
                    } else {
                        echo mdx_get_post_excerpt($post, 100);
                    } ?>">
                <?php } else {
                    ?>
                    <meta name="description" itemprop="description" content="<?php echo $mdx_des; ?>">
                <?php }
            } else {
                ?>
                <meta name="description" itemprop="description" content="<?php echo $mdx_des; ?>">
            <?php }
        }
        if ($mdx_s_key != '') {
            ?>
            <meta name="keywords" content="<?php bloginfo('name');
            echo ',' . $mdx_s_key; ?>">
        <?php }
    }
    if (mdx_get_option('mdx_chrome_color') == 'true') {
        $mdx_theme_color = mdx_get_option('mdx_styles_hex');
        if (mdx_get_option('mdx_styles') === "white") {
            $mdx_theme_color = "#ffffff";
        }
        if (is_single()) {
            $mdx_theme_color_page = get_post_meta($post->ID, "mdx_styles_hex", true);
            if ($mdx_theme_color_page != 'def' && $mdx_theme_color_page != '') {
                $mdx_theme_color = $mdx_theme_color_page;
            }
            if (get_post_meta($post->ID, "mdx_styles", true) === "white") {
                $mdx_theme_color = "#ffffff";
            }
        } ?>
        <meta name="theme-color" content="<?php echo $mdx_theme_color; ?>">
        <meta name="mdx-main-color" content="<?php echo $mdx_theme_color; ?>">
    <?php } ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <?php echo htmlspecialchars_decode(mdx_get_option('mdx_head_js')); ?>
</head>