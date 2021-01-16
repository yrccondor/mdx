<?php
/*
Template Name: 类文章页
*/
global $pageType;
$pageType = 3;
?>
<?php get_header(); ?>
<?php mdx_get_option('mdx_widget') === "true" ? $mdx_widget = true : $mdx_widget = false;
$mdx_share_area=mdx_get_option('mdx_share_area');$mdx_index_img=mdx_get_option('mdx_index_img');$mdx_side_img=mdx_get_option('mdx_side_img');if($mdx_side_img==''){$mdx_side_img=$mdx_index_img;};?>
    <?php $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');?>
    <?php $post_style=mdx_get_option('mdx_post_style');?>
    <body class="<?php echo (is_admin_bar_showing() ? "has-admin-bar" : "") ?> post-like mdui-theme-primary-<?php $main_color = mdx_get_option('mdx_styles');if($main_color === "white"){echo "grey mdx-theme-white";}else{echo $main_color;}?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if($post_style=="0"){echo " body-grey";}else if($post_style=="2"){echo " body-grey1";}else if($post_style=="3"){echo " mdx-post-style-3";}if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php }if(mdx_get_option('mdx_reduce_motion')=="true"){?> mdx-reduce-motion<?php } ?>">
    <?php if(mdx_get_option("mdx_night_style")!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
        <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    var haveChromeColor=(document.getElementsByName('theme-color').length>0);function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else if(mdx_get_option("mdx_auto_night_style")=="system"){?>
      var haveChromeColor=document.getElementsByName('theme-color').length>0;if(!sessionStorage.getItem('ns_night-styles')){var handleColorChange=function handleColorChange(mql){if(sessionStorage.getItem('ns_night-styles')){return;}if(mql.matches){document.getElementsByTagName('body')[0].classList.add("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}else{document.getElementsByTagName('body')[0].classList.remove("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content",document.getElementsByName('mdx-main-color')[0].getAttribute("content"));}}};var mql=window.matchMedia("(prefers-color-scheme: dark)");mql.addListener(handleColorChange);handleColorChange(mql);}else{if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}}
    <?php }else{?>var haveChromeColor=(document.getElementsByName('theme-color').length>0);if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}}<?php }?></script>
    <?php }?>
    <div class="fullScreen sea-close"></div>
    <?php if(mdx_get_option('mdx_load_pro')=='true'){?>
    <div class="mdui-progress mdui-color-white">
        <div class="mdui-progress-indeterminate"></div>
    </div>
    <?php }?>
    <div class="mdui-drawer mdui-color-white mdui-drawer-close mdui-drawer-full-height" id="left-drawer">
    <?php if(mdx_get_option('mdx_side_info')=='true'){;?>
    <div class="sideImg mdui-color-theme">
      <div class="mdx-side-lazyload lazyload" data-bg="<?php echo $mdx_side_img;?>"></div>
      <?php if(mdx_get_option('mdx_night_style')!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){;?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php echo addslashes(__('切换日间/夜间模式','mdx'));?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
      <?php }?>
      <?php if(mdx_get_option('mdx_side_head')!=''){;?>
      <div class="side-info-head mdui-shadow-3 lazyload" data-bg="<?php echo mdx_get_option('mdx_side_head');?>"></div>
      <?php }?>
      <div class="side-info-more"><?php echo mdx_get_option('mdx_side_name');?><br><span class="side-info-oth"><?php echo mdx_get_option('mdx_side_more');?></span></div>
    </div>
    <?php }else{?>
        <div class="mdx-side-title">
        <a href="<?php bloginfo('url');?>"><span><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></span></a>
        <?php if(mdx_get_option('mdx_night_style')!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
        <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php echo addslashes(__('切换日间/夜间模式','mdx'));?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
        <?php }?>
       </div>
    <?php }?>
    <nav role="navigation"><?php wp_nav_menu(array('theme_location'=>'mdx_menu','menu'=>'mdx_menu','depth'=>2,'container'=>false,'menu_class'=>'mdui-list','menu_id'=>'mdx_menu'));?></nav>
    </div>
    <?php if($post_style !== "2"){?>
    <header role="banner"><div class="titleBarGobal mdui-appbar mdui-shadow-0 <?php if(mdx_get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBarinPost">
        <div class="mdui-toolbar mdui-appbar-fixed">
            <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(mdx_get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
            <a href="<?php bloginfo('url');?>" class="mdui-typo-headline"><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></a>
                <div class="mdui-toolbar-spacer"></div>
                <button class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#qrcode'}" mdui-tooltip="{content: '<?php echo addslashes(__("在其他设备上继续阅读","mdx"))?>'}" id="oth-div"><i class="mdui-icon material-icons">&#xe326;</i></button>
                <div class="mdui-menu" id="qrcode">
                </div>
                <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
            </div>
        </div></header>
    <?php }?>
        <?php get_template_part('includes/searchform')?>

        <?php if($post_style=="0"){if($full_image_url!=false&&$full_image_url[0]!=""){$mdx_image_url=$full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle<?php if($mdx_image_url==""){?> mdx-pni-t0<?php }if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><h1 class="mdui-typo-display-2 mdui-center"><?php the_title();?></h1><?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?><div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></div><?php }?></div>
        <div class="PostTitleFill mdui-color-theme"></div>
        <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain<?php if($mdx_image_url==""){?> mdx-pni-am0<?php }if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title-post<?php }?>">
            <div class="ArtMain0 mdui-center mdui-shadow-12">
            <?php if($mdx_image_url!=""){?>
            <img class="PostMainImg0" alt="<?php the_title(); ?>" src="<?php echo $mdx_image_url;?>"><?php }else{?>
                <div class="mdx-post-no-img-fill"></div>
                <?php }?>
                <article class="<?php $post_classes=get_post_class();foreach($post_classes as $classes){echo $classes." ";}?> mdui-typo" id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(mdx_get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php echo htmlspecialchars(__('赞赏','mdx'));?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php if(mdx_get_option('mdx_say_after')!=''){?>
                    <div class="mdui-card mdx-say-after">
                        <svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="128" height="128"><path d="M512 106.7a405.3 405.3 0 110 810.6 405.3 405.3 0 010-810.6zm0 85.3a320 320 0 100 640 320 320 0 000-640zm42.7 277.3V704h-85.4V469.3h85.4zM512 298.7a47 47 0 110 93.8 47 47 0 010-93.8z"/></svg>
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));
                            echo str_replace('--PostURL--','<a href="'.$mdx_current_url.'">'.$mdx_current_url.'</a>',str_replace('--PostLink--','<a href="'.$mdx_current_url.'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
                        echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
                    }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="#"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php _e('没有标签','mdx');if(mdx_get_option('mdx_post_time_positon') !== 'none' && mdx_get_option('mdx_post_time_positon') !== 'title'){?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span><?php }?>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?><?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}comments_template();?>
            </div>
        <div id="indic"></div>

      <?php }else if($post_style=="1"){if($full_image_url!=false&&$full_image_url[0]!=""){$mdx_image_url = $full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle<?php if($mdx_image_url==""){?> mdx-pni-t<?php }if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><h1 class="mdui-typo-display-2 mdui-center"><?php the_title();?></h1><?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?><div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></div><?php }?></div>
        <div class="PostTitleFill mdui-color-theme"></div>
        <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain<?php if($mdx_image_url==""){?> mdx-pni-am<?php }if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title-post<?php }?>">
            <div class="ArtMain mdui-center mdui-typo">
            <?php if($mdx_image_url!=""){?>
                <img class="PostMainImg mdui-img-rounded mdui-shadow-7" alt="<?php the_title(); ?>" src="<?php echo $mdx_image_url;?>"><?php }?>
                <article <?php post_class();?> id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(mdx_get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php echo htmlspecialchars(__('赞赏','mdx'));?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php if(mdx_get_option('mdx_say_after')!=''){?>
                    <div class="mdui-card mdx-say-after">
                        <svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="128" height="128"><path d="M512 106.7a405.3 405.3 0 110 810.6 405.3 405.3 0 010-810.6zm0 85.3a320 320 0 100 640 320 320 0 000-640zm42.7 277.3V704h-85.4V469.3h85.4zM512 298.7a47 47 0 110 93.8 47 47 0 010-93.8z"/></svg>
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));
                            echo str_replace('--PostURL--','<a href="'.$mdx_current_url.'">'.$mdx_current_url.'</a>',str_replace('--PostLink--','<a href="'.$mdx_current_url.'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
                        echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
                    }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="#"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php _e('没有标签','mdx');if(mdx_get_option('mdx_post_time_positon') !== 'none' && mdx_get_option('mdx_post_time_positon') !== 'title'){?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span><?php }?>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?>
            </div>
            <?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}comments_template();?>
        <div id="indic"></div>
        
      <?php }else if($post_style=="2"){if($full_image_url!=false&&$full_image_url[0]!=""){$mdx_image_url = $full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <?php if($mdx_image_url!=""){?><div class="PostTitleFill2 lazyload" data-bg="<?php echo $mdx_image_url;?>"></div><?php }?>
        <div class="PostTitleFillBack2 mdui-color-theme"></div>
        <header role="banner"><div class="titleBarGobal mdui-appbar mdui-shadow-0 <?php if(mdx_get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBarinPost">
            <div class="mdui-toolbar mdui-appbar-fixed">
                <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(mdx_get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
                <a href="<?php bloginfo('url');?>" class="mdui-typo-headline"><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></a>
                    <div class="mdui-toolbar-spacer"></div>
                    <button class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#qrcode'}" mdui-tooltip="{content: '<?php echo addslashes(__("在其他设备上继续阅读","mdx"))?>'}" id="oth-div"><i class="mdui-icon material-icons">&#xe326;</i></button>
                    <div class="mdui-menu" id="qrcode">
                    </div>
                    <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
                </div>
            </div></header>
        <div class="mdui-text-color-white-text mdui-typo-display-2 mdui-valign PostTitle PostTitle2<?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><h1 class="mdui-typo-display-2 mdui-center"><?php the_title();?></h1><?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?><div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></div><?php }?></div>
        <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain PostMain2">
            <div class="ArtMain0 mdui-center mdui-shadow-12">
                <article class="<?php $post_classes=get_post_class();foreach($post_classes as $classes){echo $classes." ";}?> mdui-typo" id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(mdx_get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php echo htmlspecialchars(__('赞赏','mdx'));?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php if(mdx_get_option('mdx_say_after')!=''){?>
                    <div class="mdui-card mdx-say-after">
                        <svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="128" height="128"><path d="M512 106.7a405.3 405.3 0 110 810.6 405.3 405.3 0 010-810.6zm0 85.3a320 320 0 100 640 320 320 0 000-640zm42.7 277.3V704h-85.4V469.3h85.4zM512 298.7a47 47 0 110 93.8 47 47 0 010-93.8z"/></svg>
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));
                            echo str_replace('--PostURL--','<a href="'.$mdx_current_url.'">'.$mdx_current_url.'</a>',str_replace('--PostLink--','<a href="'.$mdx_current_url.'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
                        echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
                    }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="#"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php _e('没有标签','mdx');if(mdx_get_option('mdx_post_time_positon') !== 'none' && mdx_get_option('mdx_post_time_positon') !== 'title'){?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span><?php }?>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?><?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}comments_template();?>
            </div>
<div id="indic"></div>

<?php }else if($post_style=="3"){if($full_image_url!=false&&$full_image_url[0]!=""){$mdx_image_url = $full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle mdx-clean-style-article-head-background mdx-pni-t<?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?> date-in-title<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><h1 class="mdui-typo-display-2 mdui-center mdx-clean-style-article-title"><?php the_title();?></h1><?php if(mdx_get_option('mdx_post_time_positon') === 'title'){?><div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></div><?php }?></div>
        <div class="PostTitleFill mdui-color-theme mdx-clean-style-article-title-background"></div>
        <div class="mdx-clean-style-article-main <?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain<?php if($mdx_image_url==""){?> mdx-pni-am<?php }?>">
            <div class="ArtMain mdui-center mdui-typo mdx-clean-style-article-content">
                <?php if($mdx_image_url!=""){?>
                <img class="PostMainImg mdx-clean-style-article-hero-image" alt="<?php the_title(); ?>" src="<?php echo $mdx_image_url;?>"><?php }?>
                <article <?php post_class();?> id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(mdx_get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php echo htmlspecialchars(__('赞赏','mdx'));?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php if(mdx_get_option('mdx_say_after')!=''){?>
                    <div class="mdui-card mdx-say-after">
                        <svg class="icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" width="128" height="128"><path d="M512 106.7a405.3 405.3 0 110 810.6 405.3 405.3 0 010-810.6zm0 85.3a320 320 0 100 640 320 320 0 000-640zm42.7 277.3V704h-85.4V469.3h85.4zM512 298.7a47 47 0 110 93.8 47 47 0 010-93.8z"/></svg>
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            global $wp;$mdx_current_url=home_url(add_query_arg(array(),$wp->request));
                            echo str_replace('--PostURL--','<a href="'.$mdx_current_url.'">'.$mdx_current_url.'</a>',str_replace('--PostLink--','<a href="'.$mdx_current_url.'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
                        echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
                    }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="#"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php _e('没有标签','mdx');if(mdx_get_option('mdx_post_time_positon') !== 'none' && mdx_get_option('mdx_post_time_positon') !== 'title'){?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span><?php }?>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?>
            </div><?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}comments_template();?>
<div id="indic"></div>
<?php }?>
<div class="mdx-share-img" id="mdx-share-img"><div class="mdx-si-head mdui-color-theme" <?php if($full_image_url!=false&&$full_image_url[0]!=""){echo 'style="background-image:linear-gradient(to bottom, rgba(0,0,0,0) 45%,rgba(0,0,0,0.7) 100%),url('.$full_image_url[0].');"';}else{if(mdx_get_option("mdx_post_def_img")=="true"){echo 'style="background-image:linear-gradient(to bottom, rgba(0,0,0,0) 45%,rgba(0,0,0,0.7) 100%),url('.get_bloginfo("template_url")."/img/dpic.jpg".'");';}}?>><p><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></p><span><?php the_title();?></span></div><div class="mdx-si-sum"><?php if(!post_password_required()){echo mdx_get_post_excerpt($post, 175);}else{echo "这篇文章受密码保护，前往原文输入密码后才能查看。";}?></div><div class="mdx-si-box"><span><?php _e('扫描二维码继续阅读', 'mdx');?></span><div class="mdx-si-qr" id="mdx-si-qr"></div></div><div class="mdx-si-time"><?php the_time('Y-m-d');?></div></div>
<?php get_footer();?>