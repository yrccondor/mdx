<?php get_header(); ?>
<?php
$mdx_post_show = get_post_meta((int)$post->ID, "mdx_post_show", true);
if($mdx_post_show=='' || $mdx_post_show=="0"){
$mdx_index_img=get_option('mdx_index_img');$mdx_side_img=get_option('mdx_side_img');if($mdx_side_img==''){$mdx_side_img=$mdx_index_img;};?>
    <?php $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');?>
    <?php $mdx_style = get_post_meta((int)$post->ID, "mdx_styles", true);
    if($mdx_style=="" || $mdx_style=="def"){
        $mdx_style = get_option('mdx_styles');
    }
    $mdx_style_act = get_post_meta((int)$post->ID, "mdx_styles_act", true);
    if($mdx_style_act=="" || $mdx_style_act=="def"){
        $mdx_style_act = get_option('mdx_styles_act');
    }
    ?>
    <?php
    $post_style=get_post_meta((int)$post->ID, "mdx_post_style", true);
    if($post_style == '' || $post_style == 'def'){
        $post_style=get_option('mdx_post_style');
    }
    ?>
    <body class="mdui-theme-primary-<?php echo $mdx_style?> mdui-theme-accent-<?php echo $mdx_style_act;if($post_style=="0"){echo " body-grey";}else if($post_style=="2"){echo " body-grey1";}?>">
    <div class="fullScreen sea-close"></div>
    <?php if(get_option('mdx_load_pro')=='true'){?>
    <div class="mdui-progress mdui-color-white">
        <div class="mdui-progress-indeterminate"></div>
    </div>
    <?php }?>
    <div class="mdui-drawer mdui-color-white mdui-drawer-close mdui-drawer-full-height" id="left-drawer">
    <div class="sideImg LazyLoad" data-original="<?php echo $mdx_side_img;?>">
      <?php if(get_option('mdx_night_style')=='true'){;?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php _e("切换日间/夜间模式","mdx");?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
      <?php }?>
      <?php if(get_option('mdx_side_info')=='true'){;?>
      <?php if(get_option('mdx_side_head')!=''){;?>
      <div class="side-info-head mdui-shadow-3" style="background-image:url(<?php echo get_option('mdx_side_head');?>)"></div>
      <?php }?>
      <div class="side-info-more"><?php echo get_option('mdx_side_name');?><br><span class="side-info-oth"><?php echo get_option('mdx_side_more');?></span></div>
      <?php }?>
    </div>
    <nav role="navigation"><?php wp_nav_menu(array('theme_location'=>'mdx_menu','menu'=>'mdx_menu','depth'=>1,'container'=>false,'menu_class'=>'mdui-list','menu_id'=>'mdx_menu'));?></nav>
    </div>
    <header role="banner"><div class="titleBarGobal mdui-appbar mdui-shadow-0 <?php if(get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBarinPost">
            <div class="mdui-toolbar mdui-appbar-fixed<?php if($post_style!="2"){echo " mdui-color-theme";}?>">
            <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
                <a href="<?php bloginfo('url');?>" class="mdui-typo-headline"><?php $mdx_logo=get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}?></a>
                <div class="mdui-toolbar-spacer"></div>
                <button class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#qrcode'}" mdui-tooltip="{content: '<?php _e("在其他设备上继续阅读","mdx");?>'}" id="oth-div"><i class="mdui-icon material-icons">&#xe326;</i></button>
                <div class="mdui-menu" id="qrcode">
                </div>
                <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
            </div>
        </div></header>
        <?php get_template_part('searchform')?>

    <?php if($post_style=="0"){?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <div class="PostTitleFill mdui-color-theme"></div>
        <div class="PostMain">
            <div class="ArtMain0 mdui-center mdui-shadow-12">
                <img class="PostMainImg0" alt="<?php the_title(); ?>" src="<?php if($full_image_url[0]!=""){echo $full_image_url[0];}else{bloginfo("template_url");echo "/img/dpic.jpg";}?>">
                <article class="<?php $post_classes=get_post_class();foreach($post_classes as $classes){echo $classes." ";}?> mdui-typo" id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if(get_option('mdx_say_after')!='' || $mdx_info !=''){?>
                    <div class="mdui-card mdx-say-after">
                        <div class="mdui-card-actions">
                        <?php 
                            if($mdx_info == ''){
                                $mdx_info = get_option('mdx_say_after');
                            }
                        ?>
                        <?php echo $mdx_info;?>
                        </div>
                    </div>
                    <?php }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <li class="mdui-menu-item">
                    <a href="http://service.weibo.com/share/share.php?appkey=&title=<?php the_title(); ?>&url=<?php global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));echo $mdx_current_url;?>&pic=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&searchPic=false&style=simple" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M783.05 155.7c-30.14-6.86-70.57-5.46-121.28 4.12-.7 0-1.4.35-2.1 1.06l-1.07 2.1-1.05 1.06c-7.56 2.02-13.7 6.33-18.55 12.83-4.83 6.5-7.2 13.54-7.2 21 0 10.3 3.42 18.82 10.28 25.67 6.85 6.86 15.12 10.3 24.7 10.3h3.07c.7 0 2.2-.37 4.66-1.07 2.38-.7 5.02-1.23 7.74-1.58 2.73-.36 5.63-1.07 8.8-2.12 3.07-1.06 5.88-2.02 8.26-3.08 2.37-1.05 7.03-1.58 13.88-1.58 6.86 0 15.3.53 25.23 1.58 9.94 1.06 20.92 3.6 32.88 7.65 12.04 4.13 24 9.23 35.94 15.38 11.96 6.15 24 14.77 35.95 25.66 12.04 10.9 22.5 23.55 31.38 37.96 17.84 40.35 21.27 79.37 10.28 117.07 0 .7-.18 1.4-.53 2.1-.35.72-.88 2.4-1.58 5.1-.7 2.73-1.4 5.28-2.1 7.66-.7 2.36-1.4 5.44-2.12 9.22-.7 3.77-1.05 7.03-1.05 9.75 0 6.16 1.67 11.25 5.1 15.38 3.42 4.13 7.73 7.03 12.83 8.7 5.18 1.67 11.16 2.55 18.02 2.55 19.16 0 30.5-11.6 33.92-34.9 8.26-26.7 12.83-52.2 13.9-76.46 1.05-24.25-.7-45.7-5.1-64.16-4.5-18.45-11.17-35.77-20.05-51.85-8.87-16.1-19.16-29.8-30.85-41.05-11.7-11.34-24.7-21.53-39.1-30.85-14.42-9.23-28.3-16.6-41.67-22.06-13.18-5.36-27.07-9.75-41.4-13.18zm17.5 289.4c4.13 0 7.9-1.04 11.33-3.06s6.16-4.66 8.26-7.65c2.02-3.08 3.43-6.34 4.13-9.76.7-.7 1.06-1.67 1.06-3.08 8.26-78.05-19.16-122.52-82.27-133.42-18.54-3.43-35.68-3.78-51.4-1.05-4.85 0-8.9 1.22-12.32 3.6-3.43 2.36-6.33 5.44-8.8 9.22-2.36 3.78-3.6 7.73-3.6 11.78 0 6.85 2.38 12.65 7.22 17.4 4.83 4.75 10.63 7.2 17.5 7.2 53.43-12.3 82.25 4.76 86.3 51.34 1.4 11.6.7 22.58-2.1 32.87 0 6.86 2.36 12.66 7.2 17.4 4.74 4.76 10.63 7.13 17.48 7.22zM435.6 659.67c-4.83 3.42-9.75 4.92-14.94 4.65-5.1-.34-8.7-2.53-10.8-6.67l-2.12-4.13c-.7-1.4-1.05-2.72-1.05-4.13v-4.13c0-2.02.36-3.78 1.06-5.1l2.1-4.13c.7-1.4 1.68-2.36 3.1-3.06l3.06-4.13c5.45-4.13 10.8-5.8 15.9-5.1s8.7 3.44 10.82 8.18c2.02 2.73 2.9 5.8 2.55 9.23-.36 3.44-1.42 6.7-3.1 9.77-1.66 3.16-3.85 6.06-6.58 8.8zm-87.45 73.9c-4.13.72-8.08.9-11.78.54-3.78-.35-7.2-1.05-10.3-2.1-3.07-1.06-6.14-2.3-9.22-3.6-3.07-1.33-5.62-3.27-7.73-5.64-2.1-2.46-3.96-4.83-5.63-7.2-1.67-2.38-3.07-5.1-4.13-8.18s-1.6-6.33-1.6-9.76c0-7.55 2.03-14.85 6.16-22.06 4.13-7.2 9.76-13.35 16.97-18.45 7.2-5.18 15.2-8.08 24.17-8.7 6.15-.7 12.12-.52 18 .53s10.82 2.73 14.96 5.1c4.13 2.37 7.73 5.1 10.8 8.18 3.08 3.08 5.37 6.68 6.7 10.8 1.3 4.15 2 8.54 2.1 13.37 0 7.56-2.2 14.68-6.7 21.54-4.47 6.86-10.44 12.66-18 17.4-7.56 4.76-15.82 7.48-24.8 8.27zm37-194.05c-19.86 2.03-37.7 6.7-53.43 13.9s-28.13 15.38-37 24.6c-8.88 9.23-16.44 19.17-22.68 29.8-6.15 10.64-10.46 21-12.83 31.3-2.38 10.27-3.96 19.68-4.66 28.2-.7 8.53-1.06 15.2-1.06 20.04l1.07 8.18v4.13c0 2.02.7 6.15 2.1 12.3s3.26 11.78 5.63 16.96c2.38 5.2 6.33 10.82 11.78 16.98 5.45 6.15 11.95 11.25 19.5 15.38 45.27 21.88 87.38 28.56 126.5 20.04 39-8.53 70.56-28.22 94.56-59.07 9.58-11.6 15.9-26 18.98-43.15 3.08-17.14 2.37-34.36-2.1-51.86-4.5-17.4-12.14-33.3-23.12-47.72-11-14.4-27.25-25.5-48.78-33.4-21.45-7.82-46.32-10.02-74.45-6.6zm29.9 284.42c-74.02 3.43-136.95-10.98-188.63-43.15-51.76-32.17-77.6-72.86-77.6-122.17 0-48.6 25.66-90.53 77.08-125.77 51.4-35.24 114.43-54.58 189.14-58 74.7-3.43 137.72 8.87 189.14 36.9 51.4 28.04 77.08 66.36 77.08 114.97 0 49.3-26.2 93.6-78.66 132.9-52.4 39.45-114.97 60.8-187.56 64.32zm313.5-319.2c-10.3-2.04-16.97-5.1-20.05-9.24s-3.6-7.83-1.58-11.34l3.08-5.1c.7-.7 1.4-1.67 2.1-3.08s2.12-4.3 4.14-8.7c2.02-4.48 3.6-8.87 4.66-13.36 1.05-4.48 1.93-9.93 2.55-16.43.7-6.5.44-12.66-.53-18.46-.97-5.8-3.08-12.12-6.16-18.97-3.07-6.86-7.38-13-12.83-18.46-9.58-9.58-22.15-15.73-37.53-18.46-15.38-2.7-30.85-2.9-46.23-.5-15.4 2.36-29.98 5.44-43.7 9.2-13.7 3.8-25.04 7.4-33.92 10.82l-13.35 6.16c-6.86 2.02-12.5 3.42-16.97 4.13-4.48.7-7.9.54-10.28-.52-2.37-1.05-4.3-2.02-5.63-3.08-1.3-1.05-1.84-3.42-1.58-7.2.36-3.78.7-7.03 1.06-9.76.35-2.72 1.23-7.03 2.55-12.83 1.4-5.8 2.37-10.45 3.07-13.88 0-8.17-.52-15.9-1.58-23.1-1.05-7.22-3.25-15.22-6.68-24.1-3.44-8.87-8.36-16.08-14.95-21.53-6.5-5.46-14.77-9.94-24.7-13.37-9.93-3.43-22.76-4.48-38.58-3.07-15.73 1.3-33.58 5.45-53.44 12.3-24 8.18-48.34 20.4-73.04 36.4-24.7 16.07-46.06 32.86-64.26 50.26-18.2 17.5-34.8 34.37-49.83 50.8-15.1 16.44-26.7 29.8-34.97 40.08l-11.34 16.44c-22.6 29.44-39.38 58.88-50.37 88.24-10.9 29.35-16.08 51.6-15.38 66.62v21.53c4.13 32.87 14.24 62.32 30.32 88.33 16.08 26.02 35.24 47.02 57.57 63.1 22.32 16.1 48.5 29.8 78.66 41.05 30.15 11.35 59.15 19.53 86.92 24.62 27.78 5.1 57.05 8.7 87.9 10.8 50.7 4.14 103.35.2 157.76-11.77 54.5-11.95 105.2-32.7 152.14-62.13 46.93-29.45 80.06-64.7 99.23-105.74 11.7-24 17.66-46.58 18-67.76.37-21.18-3.24-38.5-10.8-51.85-7.56-13.36-17.3-25.14-29.35-35.42-11.96-10.3-23.3-17.85-33.93-22.6-10.63-4.83-20.04-7.9-28.3-9.22v.17z"/></svg> <?php _e('分享到 微博','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="http://connect.qq.com/widget/shareqq/index.html?site=<?php bloginfo('name');?>&title=<?php the_title();?>&summary=<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 100,"...");}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>&pics=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M877.52 671.695c-5.755-81.48-59.027-149.772-89.82-185.1 4.266-10.264 14.677-69.754-25.503-110.348.073-.975.073-1.95.073-2.877 0-160.085-111.006-275.334-250.27-275.846-139.264.536-250.27 115.76-250.27 275.846 0 .95 0 1.926.073 2.877-40.18 40.594-29.745 100.084-25.503 110.348-30.77 35.328-84.04 103.62-89.82 185.125-1.048 21.43 2.195 52.638 12.362 66.51 12.434 16.92 46.543-3.412 70.924-57.44 6.778 25.04 22.43 63.268 57.88 111.762-59.318 13.897-76.214 73.947-56.27 106.788 14.067 23.113 46.274 42.13 101.79 42.13 98.767 0 142.384-27.233 161.865-46.226 3.95-4.145 9.68-6.12 16.97-6.144 7.29 0 13.02 2 16.97 6.144 19.48 18.993 63.097 46.226 161.84 46.226 55.54 0 87.723-19.017 101.79-42.154 19.968-32.817 3.048-92.867-56.222-106.764 35.425-48.518 51.102-86.723 57.88-111.763 24.38 54.052 58.466 74.36 70.9 57.44 10.19-13.896 13.41-45.104 12.36-66.51z"/></svg> <?php _e('分享到 QQ','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $mdx_current_url;?>&title=<?php the_title();?>&content=utf-8" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M957.434 412.258c-8.28-23.668-309.126-44.82-309.126-44.82s-111.286-279.42-138.2-279.42c-26.91 0-138.253 279.42-138.253 279.42s-299.562 21.04-309.128 44.82C53.16 436.032 286.42 629.773 286.42 629.773s-68.876 294.215-52.817 307.105c16.11 12.894 276.45-145.01 276.45-145.01s258.38 163.378 276.51 145.01c13.314-13.506-22.437-178.836-41.796-262.453-.615-2.677-101.05 11.167-212.39 11.89-98.863.67-209.145-6.03-209.145-6.03l257.43-191.17s-80.01-14.57-140.77-20.037c-86.838-7.815-162.927-7.648-153.472-10.045 15.05-3.798 120.573-13.678 223.688-10.05 94.113 3.35 187.212 20.04 187.212 20.04L439.892 652.156s56.227 8.653 102.894 10.44c88.903 3.404 197.392.948 197.17 0-3.303-14.008-6.21-32.823-6.21-32.823s231.97-193.85 223.688-217.515zm0 0"/></svg> <?php _e('分享到 QQ空间','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://telegram.me/share/url?url=<?php echo $mdx_current_url;?>&text=<?php the_title();?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M417.28 795.733l11.947-180.48L756.907 320c14.506-13.227-2.987-19.627-22.187-8.107L330.24 567.467 155.307 512c-37.547-10.667-37.974-36.693 8.533-55.467l681.387-262.826c31.146-14.08 61.013 7.68 49.066 55.466L778.24 795.733c-8.107 38.827-31.573 48.214-64 30.294L537.6 695.467l-84.907 82.346c-9.813 9.814-17.92 17.92-35.413 17.92z"/></svg> <?php _e('分享到 Telegram','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://plus.google.com/share?url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M332.8 467.2v102.4h185.6c-25.6 76.8-96 134.4-185.6 134.4-108.8 0-192-83.2-192-192s83.2-192 192-192c51.2 0 102.4 19.2 134.4 57.6l76.8-76.8c-57.6-51.2-128-89.6-211.2-89.6C166.4 211.2 32 345.6 32 512s134.4 300.8 300.8 300.8S633.6 678.4 633.6 512c0-12.8 0-32-6.4-44.8H332.8z"/><path d="M992 473.6H883.2V371.2h-70.4v102.4H710.4v76.8h102.4v102.4h70.4V550.4H992z"/></svg> <?php _e('分享到 Google+','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M567.893 988.587V537.643h151.382L741.888 361.9H567.893V249.684c0-50.858 14.123-85.546 87.083-85.546h93.056V6.87C731.947 4.78 676.736 0 612.437 0 478.293 0 386.432 81.92 386.432 232.32V361.9H234.667v175.743h151.765v450.944h181.46z"/></svg> <?php _e('分享到 Facebook','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://twitter.com/intent/tweet?text=<?php the_title();?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M962.267 233.18q-38.253 56.027-92.598 95.45.584 7.973.584 23.992 0 74.313-21.724 148.26t-65.975 141.97-105.398 120.32T529.7 846.63t-184.54 31.157q-154.842 0-283.427-82.87 19.968 2.267 44.544 2.267 128.585 0 229.156-78.848-59.977-1.17-107.447-36.864t-65.17-91.136q18.87 2.853 34.89 2.853 24.575 0 48.566-6.292-64-13.165-105.984-63.707T98.304 405.798v-2.268q38.84 21.723 83.456 23.405-37.742-25.16-59.977-65.682t-22.31-87.99q0-50.324 25.162-93.112 69.12 85.14 168.302 136.266t212.26 56.832q-4.534-21.723-4.534-42.277 0-76.58 53.98-130.56t130.56-53.978q80.018 0 134.875 58.295 62.317-11.996 117.175-44.544-21.14 65.682-81.116 101.742 53.175-5.706 106.277-28.6z"/></svg> <?php _e('分享到 Twitter','mdx');?></a>
                </li>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?><?php comments_template();?>
            </div>
<?php get_template_part('toggleposts')?>
        <div id="indic"></div>

      <?php }else if($post_style=="1"){?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <div class="PostTitleFill mdui-color-theme"></div>
        <div class="PostMain">
            <div class="ArtMain mdui-center mdui-typo">
                <img class="PostMainImg mdui-img-rounded mdui-shadow-7" alt="<?php the_title(); ?>" src="<?php if($full_image_url[0]!=""){echo $full_image_url[0];}else{bloginfo("template_url");echo "/img/dpic.jpg";}?>">
                <article <?php post_class();?> id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if(get_option('mdx_say_after')!='' || $mdx_info !=''){?>
                    <div class="mdui-card mdx-say-after">
                        <div class="mdui-card-actions">
                        <?php 
                            if($mdx_info == ''){
                                $mdx_info = get_option('mdx_say_after');
                            }
                        ?>
                        <?php echo $mdx_info;?>
                        </div>
                    </div>
                    <?php }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <li class="mdui-menu-item">
                    <a href="http://service.weibo.com/share/share.php?appkey=&title=<?php the_title(); ?>&url=<?php global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));echo $mdx_current_url;?>&pic=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&searchPic=false&style=simple" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M783.05 155.7c-30.14-6.86-70.57-5.46-121.28 4.12-.7 0-1.4.35-2.1 1.06l-1.07 2.1-1.05 1.06c-7.56 2.02-13.7 6.33-18.55 12.83-4.83 6.5-7.2 13.54-7.2 21 0 10.3 3.42 18.82 10.28 25.67 6.85 6.86 15.12 10.3 24.7 10.3h3.07c.7 0 2.2-.37 4.66-1.07 2.38-.7 5.02-1.23 7.74-1.58 2.73-.36 5.63-1.07 8.8-2.12 3.07-1.06 5.88-2.02 8.26-3.08 2.37-1.05 7.03-1.58 13.88-1.58 6.86 0 15.3.53 25.23 1.58 9.94 1.06 20.92 3.6 32.88 7.65 12.04 4.13 24 9.23 35.94 15.38 11.96 6.15 24 14.77 35.95 25.66 12.04 10.9 22.5 23.55 31.38 37.96 17.84 40.35 21.27 79.37 10.28 117.07 0 .7-.18 1.4-.53 2.1-.35.72-.88 2.4-1.58 5.1-.7 2.73-1.4 5.28-2.1 7.66-.7 2.36-1.4 5.44-2.12 9.22-.7 3.77-1.05 7.03-1.05 9.75 0 6.16 1.67 11.25 5.1 15.38 3.42 4.13 7.73 7.03 12.83 8.7 5.18 1.67 11.16 2.55 18.02 2.55 19.16 0 30.5-11.6 33.92-34.9 8.26-26.7 12.83-52.2 13.9-76.46 1.05-24.25-.7-45.7-5.1-64.16-4.5-18.45-11.17-35.77-20.05-51.85-8.87-16.1-19.16-29.8-30.85-41.05-11.7-11.34-24.7-21.53-39.1-30.85-14.42-9.23-28.3-16.6-41.67-22.06-13.18-5.36-27.07-9.75-41.4-13.18zm17.5 289.4c4.13 0 7.9-1.04 11.33-3.06s6.16-4.66 8.26-7.65c2.02-3.08 3.43-6.34 4.13-9.76.7-.7 1.06-1.67 1.06-3.08 8.26-78.05-19.16-122.52-82.27-133.42-18.54-3.43-35.68-3.78-51.4-1.05-4.85 0-8.9 1.22-12.32 3.6-3.43 2.36-6.33 5.44-8.8 9.22-2.36 3.78-3.6 7.73-3.6 11.78 0 6.85 2.38 12.65 7.22 17.4 4.83 4.75 10.63 7.2 17.5 7.2 53.43-12.3 82.25 4.76 86.3 51.34 1.4 11.6.7 22.58-2.1 32.87 0 6.86 2.36 12.66 7.2 17.4 4.74 4.76 10.63 7.13 17.48 7.22zM435.6 659.67c-4.83 3.42-9.75 4.92-14.94 4.65-5.1-.34-8.7-2.53-10.8-6.67l-2.12-4.13c-.7-1.4-1.05-2.72-1.05-4.13v-4.13c0-2.02.36-3.78 1.06-5.1l2.1-4.13c.7-1.4 1.68-2.36 3.1-3.06l3.06-4.13c5.45-4.13 10.8-5.8 15.9-5.1s8.7 3.44 10.82 8.18c2.02 2.73 2.9 5.8 2.55 9.23-.36 3.44-1.42 6.7-3.1 9.77-1.66 3.16-3.85 6.06-6.58 8.8zm-87.45 73.9c-4.13.72-8.08.9-11.78.54-3.78-.35-7.2-1.05-10.3-2.1-3.07-1.06-6.14-2.3-9.22-3.6-3.07-1.33-5.62-3.27-7.73-5.64-2.1-2.46-3.96-4.83-5.63-7.2-1.67-2.38-3.07-5.1-4.13-8.18s-1.6-6.33-1.6-9.76c0-7.55 2.03-14.85 6.16-22.06 4.13-7.2 9.76-13.35 16.97-18.45 7.2-5.18 15.2-8.08 24.17-8.7 6.15-.7 12.12-.52 18 .53s10.82 2.73 14.96 5.1c4.13 2.37 7.73 5.1 10.8 8.18 3.08 3.08 5.37 6.68 6.7 10.8 1.3 4.15 2 8.54 2.1 13.37 0 7.56-2.2 14.68-6.7 21.54-4.47 6.86-10.44 12.66-18 17.4-7.56 4.76-15.82 7.48-24.8 8.27zm37-194.05c-19.86 2.03-37.7 6.7-53.43 13.9s-28.13 15.38-37 24.6c-8.88 9.23-16.44 19.17-22.68 29.8-6.15 10.64-10.46 21-12.83 31.3-2.38 10.27-3.96 19.68-4.66 28.2-.7 8.53-1.06 15.2-1.06 20.04l1.07 8.18v4.13c0 2.02.7 6.15 2.1 12.3s3.26 11.78 5.63 16.96c2.38 5.2 6.33 10.82 11.78 16.98 5.45 6.15 11.95 11.25 19.5 15.38 45.27 21.88 87.38 28.56 126.5 20.04 39-8.53 70.56-28.22 94.56-59.07 9.58-11.6 15.9-26 18.98-43.15 3.08-17.14 2.37-34.36-2.1-51.86-4.5-17.4-12.14-33.3-23.12-47.72-11-14.4-27.25-25.5-48.78-33.4-21.45-7.82-46.32-10.02-74.45-6.6zm29.9 284.42c-74.02 3.43-136.95-10.98-188.63-43.15-51.76-32.17-77.6-72.86-77.6-122.17 0-48.6 25.66-90.53 77.08-125.77 51.4-35.24 114.43-54.58 189.14-58 74.7-3.43 137.72 8.87 189.14 36.9 51.4 28.04 77.08 66.36 77.08 114.97 0 49.3-26.2 93.6-78.66 132.9-52.4 39.45-114.97 60.8-187.56 64.32zm313.5-319.2c-10.3-2.04-16.97-5.1-20.05-9.24s-3.6-7.83-1.58-11.34l3.08-5.1c.7-.7 1.4-1.67 2.1-3.08s2.12-4.3 4.14-8.7c2.02-4.48 3.6-8.87 4.66-13.36 1.05-4.48 1.93-9.93 2.55-16.43.7-6.5.44-12.66-.53-18.46-.97-5.8-3.08-12.12-6.16-18.97-3.07-6.86-7.38-13-12.83-18.46-9.58-9.58-22.15-15.73-37.53-18.46-15.38-2.7-30.85-2.9-46.23-.5-15.4 2.36-29.98 5.44-43.7 9.2-13.7 3.8-25.04 7.4-33.92 10.82l-13.35 6.16c-6.86 2.02-12.5 3.42-16.97 4.13-4.48.7-7.9.54-10.28-.52-2.37-1.05-4.3-2.02-5.63-3.08-1.3-1.05-1.84-3.42-1.58-7.2.36-3.78.7-7.03 1.06-9.76.35-2.72 1.23-7.03 2.55-12.83 1.4-5.8 2.37-10.45 3.07-13.88 0-8.17-.52-15.9-1.58-23.1-1.05-7.22-3.25-15.22-6.68-24.1-3.44-8.87-8.36-16.08-14.95-21.53-6.5-5.46-14.77-9.94-24.7-13.37-9.93-3.43-22.76-4.48-38.58-3.07-15.73 1.3-33.58 5.45-53.44 12.3-24 8.18-48.34 20.4-73.04 36.4-24.7 16.07-46.06 32.86-64.26 50.26-18.2 17.5-34.8 34.37-49.83 50.8-15.1 16.44-26.7 29.8-34.97 40.08l-11.34 16.44c-22.6 29.44-39.38 58.88-50.37 88.24-10.9 29.35-16.08 51.6-15.38 66.62v21.53c4.13 32.87 14.24 62.32 30.32 88.33 16.08 26.02 35.24 47.02 57.57 63.1 22.32 16.1 48.5 29.8 78.66 41.05 30.15 11.35 59.15 19.53 86.92 24.62 27.78 5.1 57.05 8.7 87.9 10.8 50.7 4.14 103.35.2 157.76-11.77 54.5-11.95 105.2-32.7 152.14-62.13 46.93-29.45 80.06-64.7 99.23-105.74 11.7-24 17.66-46.58 18-67.76.37-21.18-3.24-38.5-10.8-51.85-7.56-13.36-17.3-25.14-29.35-35.42-11.96-10.3-23.3-17.85-33.93-22.6-10.63-4.83-20.04-7.9-28.3-9.22v.17z"/></svg> <?php _e('分享到 微博','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="http://connect.qq.com/widget/shareqq/index.html?site=<?php bloginfo('name');?>&title=<?php the_title();?>&summary=<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 100,"...");}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>&pics=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M877.52 671.695c-5.755-81.48-59.027-149.772-89.82-185.1 4.266-10.264 14.677-69.754-25.503-110.348.073-.975.073-1.95.073-2.877 0-160.085-111.006-275.334-250.27-275.846-139.264.536-250.27 115.76-250.27 275.846 0 .95 0 1.926.073 2.877-40.18 40.594-29.745 100.084-25.503 110.348-30.77 35.328-84.04 103.62-89.82 185.125-1.048 21.43 2.195 52.638 12.362 66.51 12.434 16.92 46.543-3.412 70.924-57.44 6.778 25.04 22.43 63.268 57.88 111.762-59.318 13.897-76.214 73.947-56.27 106.788 14.067 23.113 46.274 42.13 101.79 42.13 98.767 0 142.384-27.233 161.865-46.226 3.95-4.145 9.68-6.12 16.97-6.144 7.29 0 13.02 2 16.97 6.144 19.48 18.993 63.097 46.226 161.84 46.226 55.54 0 87.723-19.017 101.79-42.154 19.968-32.817 3.048-92.867-56.222-106.764 35.425-48.518 51.102-86.723 57.88-111.763 24.38 54.052 58.466 74.36 70.9 57.44 10.19-13.896 13.41-45.104 12.36-66.51z"/></svg> <?php _e('分享到 QQ','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $mdx_current_url;?>&title=<?php the_title();?>&content=utf-8" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M957.434 412.258c-8.28-23.668-309.126-44.82-309.126-44.82s-111.286-279.42-138.2-279.42c-26.91 0-138.253 279.42-138.253 279.42s-299.562 21.04-309.128 44.82C53.16 436.032 286.42 629.773 286.42 629.773s-68.876 294.215-52.817 307.105c16.11 12.894 276.45-145.01 276.45-145.01s258.38 163.378 276.51 145.01c13.314-13.506-22.437-178.836-41.796-262.453-.615-2.677-101.05 11.167-212.39 11.89-98.863.67-209.145-6.03-209.145-6.03l257.43-191.17s-80.01-14.57-140.77-20.037c-86.838-7.815-162.927-7.648-153.472-10.045 15.05-3.798 120.573-13.678 223.688-10.05 94.113 3.35 187.212 20.04 187.212 20.04L439.892 652.156s56.227 8.653 102.894 10.44c88.903 3.404 197.392.948 197.17 0-3.303-14.008-6.21-32.823-6.21-32.823s231.97-193.85 223.688-217.515zm0 0"/></svg> <?php _e('分享到 QQ空间','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://telegram.me/share/url?url=<?php echo $mdx_current_url;?>&text=<?php the_title();?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M417.28 795.733l11.947-180.48L756.907 320c14.506-13.227-2.987-19.627-22.187-8.107L330.24 567.467 155.307 512c-37.547-10.667-37.974-36.693 8.533-55.467l681.387-262.826c31.146-14.08 61.013 7.68 49.066 55.466L778.24 795.733c-8.107 38.827-31.573 48.214-64 30.294L537.6 695.467l-84.907 82.346c-9.813 9.814-17.92 17.92-35.413 17.92z"/></svg> <?php _e('分享到 Telegram','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://plus.google.com/share?url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M332.8 467.2v102.4h185.6c-25.6 76.8-96 134.4-185.6 134.4-108.8 0-192-83.2-192-192s83.2-192 192-192c51.2 0 102.4 19.2 134.4 57.6l76.8-76.8c-57.6-51.2-128-89.6-211.2-89.6C166.4 211.2 32 345.6 32 512s134.4 300.8 300.8 300.8S633.6 678.4 633.6 512c0-12.8 0-32-6.4-44.8H332.8z"/><path d="M992 473.6H883.2V371.2h-70.4v102.4H710.4v76.8h102.4v102.4h70.4V550.4H992z"/></svg> <?php _e('分享到 Google+','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M567.893 988.587V537.643h151.382L741.888 361.9H567.893V249.684c0-50.858 14.123-85.546 87.083-85.546h93.056V6.87C731.947 4.78 676.736 0 612.437 0 478.293 0 386.432 81.92 386.432 232.32V361.9H234.667v175.743h151.765v450.944h181.46z"/></svg> <?php _e('分享到 Facebook','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://twitter.com/intent/tweet?text=<?php the_title();?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M962.267 233.18q-38.253 56.027-92.598 95.45.584 7.973.584 23.992 0 74.313-21.724 148.26t-65.975 141.97-105.398 120.32T529.7 846.63t-184.54 31.157q-154.842 0-283.427-82.87 19.968 2.267 44.544 2.267 128.585 0 229.156-78.848-59.977-1.17-107.447-36.864t-65.17-91.136q18.87 2.853 34.89 2.853 24.575 0 48.566-6.292-64-13.165-105.984-63.707T98.304 405.798v-2.268q38.84 21.723 83.456 23.405-37.742-25.16-59.977-65.682t-22.31-87.99q0-50.324 25.162-93.112 69.12 85.14 168.302 136.266t212.26 56.832q-4.534-21.723-4.534-42.277 0-76.58 53.98-130.56t130.56-53.978q80.018 0 134.875 58.295 62.317-11.996 117.175-44.544-21.14 65.682-81.116 101.742 53.175-5.706 106.277-28.6z"/></svg> <?php _e('分享到 Twitter','mdx');?></a>
                </li>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?>
            </div>
<?php comments_template();?>
<?php get_template_part('toggleposts')?>
        <div id="indic"></div>
        
      <?php }else if($post_style=="2"){?>
        <div class="mdui-text-color-white-text mdui-typo-display-2 mdui-valign PostTitle PostTitle2" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <div class="PostTitleFill2 LazyLoad" data-original="<?php if($full_image_url[0]!=""){echo $full_image_url[0];}else{bloginfo("template_url");echo "/img/dpic.jpg";}?>"></div>
        <div class="PostTitleFillBack2 mdui-color-theme"></div>
        <div class="PostMain PostMain2">
            <div class="ArtMain0 mdui-center mdui-shadow-12">
                <article class="<?php $post_classes=get_post_class();foreach($post_classes as $classes){echo $classes." ";}?> mdui-typo" id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if(get_option('mdx_say_after')!='' || $mdx_info !=''){?>
                <div class="mdui-card mdx-say-after">
                    <div class="mdui-card-actions">
                    <?php 
                        if($mdx_info == ''){
                            $mdx_info = get_option('mdx_say_after');
                        }
                    ?>
                    <?php echo $mdx_info;?>
                    </div>
                </div>
                <?php }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <li class="mdui-menu-item">
                    <a href="http://service.weibo.com/share/share.php?appkey=&title=<?php the_title(); ?>&url=<?php global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));echo $mdx_current_url;?>&pic=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&searchPic=false&style=simple" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M783.05 155.7c-30.14-6.86-70.57-5.46-121.28 4.12-.7 0-1.4.35-2.1 1.06l-1.07 2.1-1.05 1.06c-7.56 2.02-13.7 6.33-18.55 12.83-4.83 6.5-7.2 13.54-7.2 21 0 10.3 3.42 18.82 10.28 25.67 6.85 6.86 15.12 10.3 24.7 10.3h3.07c.7 0 2.2-.37 4.66-1.07 2.38-.7 5.02-1.23 7.74-1.58 2.73-.36 5.63-1.07 8.8-2.12 3.07-1.06 5.88-2.02 8.26-3.08 2.37-1.05 7.03-1.58 13.88-1.58 6.86 0 15.3.53 25.23 1.58 9.94 1.06 20.92 3.6 32.88 7.65 12.04 4.13 24 9.23 35.94 15.38 11.96 6.15 24 14.77 35.95 25.66 12.04 10.9 22.5 23.55 31.38 37.96 17.84 40.35 21.27 79.37 10.28 117.07 0 .7-.18 1.4-.53 2.1-.35.72-.88 2.4-1.58 5.1-.7 2.73-1.4 5.28-2.1 7.66-.7 2.36-1.4 5.44-2.12 9.22-.7 3.77-1.05 7.03-1.05 9.75 0 6.16 1.67 11.25 5.1 15.38 3.42 4.13 7.73 7.03 12.83 8.7 5.18 1.67 11.16 2.55 18.02 2.55 19.16 0 30.5-11.6 33.92-34.9 8.26-26.7 12.83-52.2 13.9-76.46 1.05-24.25-.7-45.7-5.1-64.16-4.5-18.45-11.17-35.77-20.05-51.85-8.87-16.1-19.16-29.8-30.85-41.05-11.7-11.34-24.7-21.53-39.1-30.85-14.42-9.23-28.3-16.6-41.67-22.06-13.18-5.36-27.07-9.75-41.4-13.18zm17.5 289.4c4.13 0 7.9-1.04 11.33-3.06s6.16-4.66 8.26-7.65c2.02-3.08 3.43-6.34 4.13-9.76.7-.7 1.06-1.67 1.06-3.08 8.26-78.05-19.16-122.52-82.27-133.42-18.54-3.43-35.68-3.78-51.4-1.05-4.85 0-8.9 1.22-12.32 3.6-3.43 2.36-6.33 5.44-8.8 9.22-2.36 3.78-3.6 7.73-3.6 11.78 0 6.85 2.38 12.65 7.22 17.4 4.83 4.75 10.63 7.2 17.5 7.2 53.43-12.3 82.25 4.76 86.3 51.34 1.4 11.6.7 22.58-2.1 32.87 0 6.86 2.36 12.66 7.2 17.4 4.74 4.76 10.63 7.13 17.48 7.22zM435.6 659.67c-4.83 3.42-9.75 4.92-14.94 4.65-5.1-.34-8.7-2.53-10.8-6.67l-2.12-4.13c-.7-1.4-1.05-2.72-1.05-4.13v-4.13c0-2.02.36-3.78 1.06-5.1l2.1-4.13c.7-1.4 1.68-2.36 3.1-3.06l3.06-4.13c5.45-4.13 10.8-5.8 15.9-5.1s8.7 3.44 10.82 8.18c2.02 2.73 2.9 5.8 2.55 9.23-.36 3.44-1.42 6.7-3.1 9.77-1.66 3.16-3.85 6.06-6.58 8.8zm-87.45 73.9c-4.13.72-8.08.9-11.78.54-3.78-.35-7.2-1.05-10.3-2.1-3.07-1.06-6.14-2.3-9.22-3.6-3.07-1.33-5.62-3.27-7.73-5.64-2.1-2.46-3.96-4.83-5.63-7.2-1.67-2.38-3.07-5.1-4.13-8.18s-1.6-6.33-1.6-9.76c0-7.55 2.03-14.85 6.16-22.06 4.13-7.2 9.76-13.35 16.97-18.45 7.2-5.18 15.2-8.08 24.17-8.7 6.15-.7 12.12-.52 18 .53s10.82 2.73 14.96 5.1c4.13 2.37 7.73 5.1 10.8 8.18 3.08 3.08 5.37 6.68 6.7 10.8 1.3 4.15 2 8.54 2.1 13.37 0 7.56-2.2 14.68-6.7 21.54-4.47 6.86-10.44 12.66-18 17.4-7.56 4.76-15.82 7.48-24.8 8.27zm37-194.05c-19.86 2.03-37.7 6.7-53.43 13.9s-28.13 15.38-37 24.6c-8.88 9.23-16.44 19.17-22.68 29.8-6.15 10.64-10.46 21-12.83 31.3-2.38 10.27-3.96 19.68-4.66 28.2-.7 8.53-1.06 15.2-1.06 20.04l1.07 8.18v4.13c0 2.02.7 6.15 2.1 12.3s3.26 11.78 5.63 16.96c2.38 5.2 6.33 10.82 11.78 16.98 5.45 6.15 11.95 11.25 19.5 15.38 45.27 21.88 87.38 28.56 126.5 20.04 39-8.53 70.56-28.22 94.56-59.07 9.58-11.6 15.9-26 18.98-43.15 3.08-17.14 2.37-34.36-2.1-51.86-4.5-17.4-12.14-33.3-23.12-47.72-11-14.4-27.25-25.5-48.78-33.4-21.45-7.82-46.32-10.02-74.45-6.6zm29.9 284.42c-74.02 3.43-136.95-10.98-188.63-43.15-51.76-32.17-77.6-72.86-77.6-122.17 0-48.6 25.66-90.53 77.08-125.77 51.4-35.24 114.43-54.58 189.14-58 74.7-3.43 137.72 8.87 189.14 36.9 51.4 28.04 77.08 66.36 77.08 114.97 0 49.3-26.2 93.6-78.66 132.9-52.4 39.45-114.97 60.8-187.56 64.32zm313.5-319.2c-10.3-2.04-16.97-5.1-20.05-9.24s-3.6-7.83-1.58-11.34l3.08-5.1c.7-.7 1.4-1.67 2.1-3.08s2.12-4.3 4.14-8.7c2.02-4.48 3.6-8.87 4.66-13.36 1.05-4.48 1.93-9.93 2.55-16.43.7-6.5.44-12.66-.53-18.46-.97-5.8-3.08-12.12-6.16-18.97-3.07-6.86-7.38-13-12.83-18.46-9.58-9.58-22.15-15.73-37.53-18.46-15.38-2.7-30.85-2.9-46.23-.5-15.4 2.36-29.98 5.44-43.7 9.2-13.7 3.8-25.04 7.4-33.92 10.82l-13.35 6.16c-6.86 2.02-12.5 3.42-16.97 4.13-4.48.7-7.9.54-10.28-.52-2.37-1.05-4.3-2.02-5.63-3.08-1.3-1.05-1.84-3.42-1.58-7.2.36-3.78.7-7.03 1.06-9.76.35-2.72 1.23-7.03 2.55-12.83 1.4-5.8 2.37-10.45 3.07-13.88 0-8.17-.52-15.9-1.58-23.1-1.05-7.22-3.25-15.22-6.68-24.1-3.44-8.87-8.36-16.08-14.95-21.53-6.5-5.46-14.77-9.94-24.7-13.37-9.93-3.43-22.76-4.48-38.58-3.07-15.73 1.3-33.58 5.45-53.44 12.3-24 8.18-48.34 20.4-73.04 36.4-24.7 16.07-46.06 32.86-64.26 50.26-18.2 17.5-34.8 34.37-49.83 50.8-15.1 16.44-26.7 29.8-34.97 40.08l-11.34 16.44c-22.6 29.44-39.38 58.88-50.37 88.24-10.9 29.35-16.08 51.6-15.38 66.62v21.53c4.13 32.87 14.24 62.32 30.32 88.33 16.08 26.02 35.24 47.02 57.57 63.1 22.32 16.1 48.5 29.8 78.66 41.05 30.15 11.35 59.15 19.53 86.92 24.62 27.78 5.1 57.05 8.7 87.9 10.8 50.7 4.14 103.35.2 157.76-11.77 54.5-11.95 105.2-32.7 152.14-62.13 46.93-29.45 80.06-64.7 99.23-105.74 11.7-24 17.66-46.58 18-67.76.37-21.18-3.24-38.5-10.8-51.85-7.56-13.36-17.3-25.14-29.35-35.42-11.96-10.3-23.3-17.85-33.93-22.6-10.63-4.83-20.04-7.9-28.3-9.22v.17z"/></svg> <?php _e('分享到 微博','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="http://connect.qq.com/widget/shareqq/index.html?site=<?php bloginfo('name');?>&title=<?php the_title();?>&summary=<?php if(is_single()||is_page()){if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 100,"...");}}else if($mdx_des!=''){echo $mdx_des;}else{bloginfo('description', 'display');}?>&pics=<?php if($full_image_url[0]!=""){echo $full_image_url[0];}?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M877.52 671.695c-5.755-81.48-59.027-149.772-89.82-185.1 4.266-10.264 14.677-69.754-25.503-110.348.073-.975.073-1.95.073-2.877 0-160.085-111.006-275.334-250.27-275.846-139.264.536-250.27 115.76-250.27 275.846 0 .95 0 1.926.073 2.877-40.18 40.594-29.745 100.084-25.503 110.348-30.77 35.328-84.04 103.62-89.82 185.125-1.048 21.43 2.195 52.638 12.362 66.51 12.434 16.92 46.543-3.412 70.924-57.44 6.778 25.04 22.43 63.268 57.88 111.762-59.318 13.897-76.214 73.947-56.27 106.788 14.067 23.113 46.274 42.13 101.79 42.13 98.767 0 142.384-27.233 161.865-46.226 3.95-4.145 9.68-6.12 16.97-6.144 7.29 0 13.02 2 16.97 6.144 19.48 18.993 63.097 46.226 161.84 46.226 55.54 0 87.723-19.017 101.79-42.154 19.968-32.817 3.048-92.867-56.222-106.764 35.425-48.518 51.102-86.723 57.88-111.763 24.38 54.052 58.466 74.36 70.9 57.44 10.19-13.896 13.41-45.104 12.36-66.51z"/></svg> <?php _e('分享到 QQ','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo $mdx_current_url;?>&title=<?php the_title();?>&content=utf-8" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M957.434 412.258c-8.28-23.668-309.126-44.82-309.126-44.82s-111.286-279.42-138.2-279.42c-26.91 0-138.253 279.42-138.253 279.42s-299.562 21.04-309.128 44.82C53.16 436.032 286.42 629.773 286.42 629.773s-68.876 294.215-52.817 307.105c16.11 12.894 276.45-145.01 276.45-145.01s258.38 163.378 276.51 145.01c13.314-13.506-22.437-178.836-41.796-262.453-.615-2.677-101.05 11.167-212.39 11.89-98.863.67-209.145-6.03-209.145-6.03l257.43-191.17s-80.01-14.57-140.77-20.037c-86.838-7.815-162.927-7.648-153.472-10.045 15.05-3.798 120.573-13.678 223.688-10.05 94.113 3.35 187.212 20.04 187.212 20.04L439.892 652.156s56.227 8.653 102.894 10.44c88.903 3.404 197.392.948 197.17 0-3.303-14.008-6.21-32.823-6.21-32.823s231.97-193.85 223.688-217.515zm0 0"/></svg> <?php _e('分享到 QQ空间','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://telegram.me/share/url?url=<?php echo $mdx_current_url;?>&text=<?php the_title();?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M417.28 795.733l11.947-180.48L756.907 320c14.506-13.227-2.987-19.627-22.187-8.107L330.24 567.467 155.307 512c-37.547-10.667-37.974-36.693 8.533-55.467l681.387-262.826c31.146-14.08 61.013 7.68 49.066 55.466L778.24 795.733c-8.107 38.827-31.573 48.214-64 30.294L537.6 695.467l-84.907 82.346c-9.813 9.814-17.92 17.92-35.413 17.92z"/></svg> <?php _e('分享到 Telegram','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://plus.google.com/share?url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M332.8 467.2v102.4h185.6c-25.6 76.8-96 134.4-185.6 134.4-108.8 0-192-83.2-192-192s83.2-192 192-192c51.2 0 102.4 19.2 134.4 57.6l76.8-76.8c-57.6-51.2-128-89.6-211.2-89.6C166.4 211.2 32 345.6 32 512s134.4 300.8 300.8 300.8S633.6 678.4 633.6 512c0-12.8 0-32-6.4-44.8H332.8z"/><path d="M992 473.6H883.2V371.2h-70.4v102.4H710.4v76.8h102.4v102.4h70.4V550.4H992z"/></svg> <?php _e('分享到 Google+','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M567.893 988.587V537.643h151.382L741.888 361.9H567.893V249.684c0-50.858 14.123-85.546 87.083-85.546h93.056V6.87C731.947 4.78 676.736 0 612.437 0 478.293 0 386.432 81.92 386.432 232.32V361.9H234.667v175.743h151.765v450.944h181.46z"/></svg> <?php _e('分享到 Facebook','mdx');?></a>
                </li>
                <li class="mdui-menu-item">
                    <a href="https://twitter.com/intent/tweet?text=<?php the_title();?>&url=<?php echo $mdx_current_url;?>" class="mdui-ripple" target="_blank"><svg class="mdx-share-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="25" height="25"><path d="M962.267 233.18q-38.253 56.027-92.598 95.45.584 7.973.584 23.992 0 74.313-21.724 148.26t-65.975 141.97-105.398 120.32T529.7 846.63t-184.54 31.157q-154.842 0-283.427-82.87 19.968 2.267 44.544 2.267 128.585 0 229.156-78.848-59.977-1.17-107.447-36.864t-65.17-91.136q18.87 2.853 34.89 2.853 24.575 0 48.566-6.292-64-13.165-105.984-63.707T98.304 405.798v-2.268q38.84 21.723 83.456 23.405-37.742-25.16-59.977-65.682t-22.31-87.99q0-50.324 25.162-93.112 69.12 85.14 168.302 136.266t212.26 56.832q-4.534-21.723-4.534-42.277 0-76.58 53.98-130.56t130.56-53.978q80.018 0 134.875 58.295 62.317-11.996 117.175-44.544-21.14 65.682-81.116 101.742 53.175-5.706 106.277-28.6z"/></svg> <?php _e('分享到 Twitter','mdx');?></a>
                </li>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?><?php comments_template();?>
            </div>
<?php get_template_part('toggleposts')?>
        <div id="indic"></div>
      <?php }?>
      <div class="mdx-share-img" id="mdx-share-img"><div class="mdx-si-head" style="background-image:url(<?php if($full_image_url[0]!=""){echo $full_image_url[0];}else{echo get_bloginfo('template_url').'/img/dpic.jpg';}?>)"><p><?php $mdx_logo=get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}?></p><span><?php the_title();?></span></div><div class="mdx-si-sum"><?php echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 175,"...");?></div><div class="mdx-si-box"><span>扫描二维码继续阅读</span><div class="mdx-si-qr" id="mdx-si-qr"></div></div><div class="mdx-si-time"><?php the_time('Y-m-d');?></div></div>
      <?php get_footer();
}elseif ($mdx_post_show=='1') {
?>
    <body class="mdui-theme-primary-<?php echo get_option('mdx_styles');?> mdui-theme-accent-<?php echo get_option('mdx_styles_act');?>">
    <div class="mdui-color-theme mdui-typo-display-4 mdui-valign mdx-background-404">
        <span>404<span class="mdui-typo-headline"><?php _e('尴尬的是，这个页面貌似旅游去了','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple">去首页</a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple">返回上一页</a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/nsc.js"></script>
    <script>
    $(function(){
        if(sessionStorage.getItem('ns_night-styles')=='true'){
            $("body").toggleClass("mdui-theme-layout-dark");
            $("meta[name='theme-color']").attr('content',"#212121");
        }
    })
    </script>
</body>
</html>
<?php }elseif ($mdx_post_show=='2') {
?>
    <body class="mdui-theme-primary-<?php echo get_option('mdx_styles');?> mdui-theme-accent-<?php echo get_option('mdx_styles_act');?>">
    <div class="mdui-color-theme mdui-typo-display-4 mdui-valign mdx-background-404">
        <span><?php _e('诶呀...','mdx');?><span class="mdui-typo-headline"><?php _e('因相关法律法规，此文章暂时不予显示','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple">去首页</a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple">返回上一页</a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/nsc.js"></script>
    <script>
    $(function(){
        if(sessionStorage.getItem('ns_night-styles')=='true'){
            $("body").toggleClass("mdui-theme-layout-dark");
            $("meta[name='theme-color']").attr('content',"#212121");
        }
    })
    </script>
</body>
</html>
<?php }
?>