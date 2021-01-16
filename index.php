<?php flush();?>
<?php get_header();?>
<?php $mdx_index_show=mdx_get_option('mdx_index_show');$mdx_index_img=mdx_get_option('mdx_index_img');
if(substr($mdx_index_img,0,6)=="--Bing"){
  $mdx_img_bing = substr($mdx_index_img,22,2);
  if(substr($mdx_img_bing,1,1)==")"){
    $mdx_img_bing = substr($mdx_img_bing,0,1);
  }
  $str=file_get_contents('https://cn.bing.com/HPImageArchive.aspx?n=1&idx='.$mdx_img_bing);
     if(preg_match("/<url>(.+?)<\/url>/is",$str,$matches)){
         $mdx_index_img='https://cn.bing.com'.str_replace('1366x768','1920x1080',$matches[1]);
     }
}
$mdx_side_img=mdx_get_option('mdx_side_img');if($mdx_side_img==''){$mdx_side_img=$mdx_index_img;};
$ignore_sticky = false;
$ignore_sticky_2 = false;
if(mdx_get_option('mdx_index_head_style') === "slide"){
    $sticky_id_slide = get_option('sticky_posts');
    $mdx_posts_slide = array();
    if(mdx_get_option('mdx_index_head_style') === "slide" && mdx_get_option('mdx_index_slide_posts_get') === "sticky" && count($sticky_id_slide) > 0){
        $ignore_sticky = true;
    }
    if((mdx_get_option('mdx_index_head_style') === "slide" && mdx_get_option('mdx_index_slide_posts_get') !== "sticky") || $ignore_sticky){
        global $post;
        if(mdx_get_option('mdx_index_slide_posts_get') === "sticky"){
            $mdx_posts_slide = get_posts(array('numberposts'=>(int)mdx_get_option('mdx_index_slide_posts_num'),'post__in' =>$sticky_id_slide));
        }else{
            $mdx_posts_slide = get_posts('numberposts='.mdx_get_option('mdx_index_slide_posts_num').'&category='.get_cat_ID(mdx_get_option('mdx_index_slide_posts_cat')));
        }
    }
}?>
  <body class="<?php echo (is_admin_bar_showing() ? "has-admin-bar" : "") ?> mdui-theme-primary-<?php $main_color = mdx_get_option('mdx_styles');if($main_color === "white"){echo "grey mdx-theme-white mdx-index-white";}else{echo $main_color;}?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if($mdx_index_show=="1"){?> mdx-first-simple<?php }else if($mdx_index_show=="2"){?> mdx-first-tworows<?php }else if($mdx_index_show=="3"){?> mdx-index-morden<?php }else if($mdx_index_show=="4"){?> mdx-index-void<?php }if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php }if(mdx_get_option('mdx_reduce_motion')=="true"){?> mdx-reduce-motion<?php }if(mdx_get_option('mdx_index_head_style') === "slide" && (count($mdx_posts_slide) > 0 || mdx_get_option('mdx_index_slide_posts_get') !== "sticky")){?> index-slide-toolbar<?php }if(mdx_get_option("mdx_post_list_width") === "wide"){?> mdx-wide-post-list<?php } ?>">
    <?php if(mdx_get_option("mdx_night_style")!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
    <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    var haveChromeColor=(document.getElementsByName('theme-color').length>0);function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else if(mdx_get_option("mdx_auto_night_style")=="system"){?>
      var haveChromeColor=document.getElementsByName('theme-color').length>0;if(!sessionStorage.getItem('ns_night-styles')){var handleColorChange=function handleColorChange(mql){if(sessionStorage.getItem('ns_night-styles')){return;}if(mql.matches){document.getElementsByTagName('body')[0].classList.add("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}else{document.getElementsByTagName('body')[0].classList.remove("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content",document.getElementsByName('mdx-main-color')[0].getAttribute("content"));}}};var mql=window.matchMedia("(prefers-color-scheme: dark)");mql.addListener(handleColorChange);handleColorChange(mql);}else{if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}}
    <?php }else{?>var haveChromeColor=(document.getElementsByName('theme-color').length>0);if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}}<?php }?></script>
    <?php }?>
    <div class="fullScreen sea-close"></div>
    <div class="mdui-drawer mdui-color-white mdui-drawer-close mdui-drawer-full-height" id="left-drawer">
      <?php if(mdx_get_option('mdx_side_info')=='true'){;?>
      <div class="sideImg mdui-color-theme">
      <div class="mdx-side-lazyload lazyload" data-bg="<?php echo $mdx_side_img;?>"></div>
      <?php if(mdx_get_option('mdx_night_style')!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
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
    <header role="banner"><div class="titleBarGobal mdx-sh-ani mdui-appbar-fixed mdui-appbar mdui-shadow-0 <?php if(mdx_get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBar">
      <div class="mdui-toolbar mdui-toolbar-self topBarAni">
        <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(mdx_get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
        <span class="mdui-typo-headline"><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></span>
        <div class="mdui-toolbar-spacer"></div>
        <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
      </div>
    </div></header>
    <?php get_template_part('includes/searchform')?>
    <div class="theFirstPageBackGround mdui-color-theme"></div>
    <?php if($mdx_index_show=="0" || $mdx_index_show=="2" || $mdx_index_show=="3"){?><div class="theFirstPage lazyload" data-bg="<?php echo $mdx_index_img;?>"></div><?php }if(mdx_get_option('mdx_index_img_bg') === "true"){ ?>
    <div class="mdx-index-img-bg mdui-color-theme"></div>
    <?php }
    if(mdx_get_option('mdx_index_head_style') !== "slide"){ ?>
    <div class="theFirstPageSay mdui-valign mdui-typo mdui-text-color-white-text">
        <h<?php if(mdx_get_option('mdx_index_say_size')!==""){echo mdx_get_option('mdx_index_say_size');}else{echo '1';}?> class="mdui-center" id="theFirstPageSayContent"><?php echo esc_attr(mdx_get_option('mdx_index_say'))?></h<?php if(mdx_get_option('mdx_index_say_size')!==""){echo mdx_get_option('mdx_index_say_size');}else{echo '1';}?>>
        <div class="mdx-tworows-title">
            <div>
                <span class="mdui-text-color-theme"><?php
                    $mdx_logo_way = mdx_get_option('mdx_logo_way');
                    if($mdx_logo_way === "2"){
                        $mdx_logo = mdx_get_option('mdx_logo');
                        if($mdx_logo !== ""){
                            echo '<img class="mdx-logo" src="'.$mdx_logo.'">';
                        }else{
                            bloginfo('name');
                        }
                    }elseif($mdx_logo_way === "1"){
                        bloginfo('name');
                    }elseif($mdx_logo_way === "3"){
                        $mdx_logo_text = mdx_get_option('mdx_logo_text');
                        if($mdx_logo_text !== ""){
                            echo $mdx_logo_text;
                        }else{
                            bloginfo('name');
                        }
                    }
                ?></span>
                <hr>
                <?php echo esc_attr(mdx_get_option('mdx_index_say'))?>
            </div>
        </div>
    </div>
    <?php }else{
    if(count($mdx_posts_slide) > 0 || mdx_get_option('mdx_index_slide_posts_get') !== "sticky"){?>
    <div class="theFirstPageSay mdui-typo mdx-swiper swiper-container slide-style-<?php echo mdx_get_option('mdx_index_slide_posts_style');?>">
        <div class="swiper-wrapper">
            <?php foreach($mdx_posts_slide as $post_item){?><div class="swiper-item swiper-slide">
                <?php if(mdx_get_option("mdx_index_slide_posts_style") === "1"){?>
                <div class="mdx-slide-bg<?php $mdx_img_slide = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID),'large');
                    if($mdx_img_slide !== false){
                        $mdx_img_slide = $mdx_img_slide[0];
                    }else{
                        $mdx_img_slide = "";
                    }
                    if($mdx_img_slide !== ""){
                        ?> mdx-bg-lazyload lazyload" data-bg="<?php echo $mdx_img_slide.'"';
                    }else{
                        if(mdx_get_option("mdx_post_def_img") === "true"){
                            ?> mdx-bg-lazyload lazyload" data-bg="<?php echo get_template_directory_uri().'/img/dpic.jpg"';
                        }else{
                            ?>"<?php
                        }
                    }?>></div>
                <section class="mdx-slide-content">
                    <h1><?php echo $post_item->post_title; ?></h1>
                    <div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php echo get_the_time('Y-m-d', $post_item);}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php echo get_the_modified_time('Y-m-d', $post_item);}?></div>
                    <a class="mdui-btn mdui-ripple" href="<?php echo get_permalink($post_item->ID); ?>"><?php _e("前往阅读", "mdx");?> <i class="mdui-icon material-icons">&#xe5c8;</i></a>
                </section>
                <?php }elseif(mdx_get_option("mdx_index_slide_posts_style") === "2"){?>
                <div class="mdx-slide-bg<?php $mdx_img_slide = wp_get_attachment_image_src(get_post_thumbnail_id($post_item->ID),'large');
                    if($mdx_img_slide !== false){
                        $mdx_img_slide = $mdx_img_slide[0];
                    }else{
                        $mdx_img_slide = "";
                    }
                    if($mdx_img_slide !== ""){
                        ?> mdx-bg-lazyload lazyload" data-bg="<?php echo $mdx_img_slide.'"';
                    }else{
                        if(mdx_get_option("mdx_post_def_img") === "true"){
                            ?> mdx-bg-lazyload lazyload" data-bg="<?php echo get_template_directory_uri().'/img/dpic.jpg"';
                        }else{
                            ?>"<?php
                        }
                    }?>></div>
                <section class="mdx-slide-content">
                    <div class="slide-wrap">
                        <div class="slide-part">
                            <h1><?php echo $post_item->post_title; ?></h1>
                            <div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php echo get_the_time('Y-m-d', $post_item);}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php echo get_the_modified_time('Y-m-d', $post_item);}?></div>
                            <?php if(mdx_get_option("mdx_echo_post_sum")=="true"){ ?><p><?php if(post_password_required($post_item)){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{$summ_slider = mdx_get_post_excerpt($post_item, 180);if($summ_slider !== ""){echo $summ_slider;}else{_e("这篇文章没有摘要");}}?></p><?php }?>
                        </div>
                        <a class="mdui-btn mdui-ripple" href="<?php echo get_permalink($post_item->ID); ?>"><i class="mdui-icon material-icons">&#xe5c8;</i></a>
                    </div>
                </section>
                <?php }else{?>
                <section class="mdx-slide-content">
                    <div class="slide-wrap">
                        <div class="slide-part">
                            <h1><?php echo $post_item->post_title; ?></h1>
                            <div class="time-in-post-title" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php echo get_the_time('Y-m-d', $post_item);}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php echo get_the_modified_time('Y-m-d', $post_item);}?></div>
                        </div>
                        <a class="mdui-btn mdui-ripple" href="<?php echo get_permalink($post_item->ID); ?>"><i class="mdui-icon material-icons">&#xe5c8;</i></a>
                    </div>
                </section>
            <?php }?></div><?php }?>
        </div>
        <?php if($mdx_index_show === "4"){?>
        <div class="swiper-bottom-void"></div>
        <?php } ?>
    </div>
    <?php }elseif($mdx_index_show === "1" || $mdx_index_show === "4"){?>
        <div class="theFirstPage lazyload" data-bg="<?php echo $mdx_index_img;?>">
            <?php if($mdx_index_show === "4"){?>
            <div class="swiper-bottom-void"></div>
            <?php } ?>
        </div>
    <?php }}
    if($mdx_index_show=="2"){?>
    <div class="mdui-valign" id="mdx-search-anim">
        <i class="mdui-icon material-icons seaicon">&#xe8b6;</i> <?php _e('搜索什么...', 'mdx');?>
    </div>
    <?php }?>
    <div class="main">
    <?php if($mdx_index_show=="2"){?>
    <div class="mdx-tworow-search mdui-valign" role="button">
        <i class="mdui-icon material-icons seaicon">&#xe8b6;</i> <?php _e('搜索什么...', 'mdx');?>
    </div>
    <?php }if(mdx_get_option('mdx_notice')!=""){?>
    <div class="mdxNotice mdui-center<?php if($mdx_index_show=="0" || $mdx_index_show=="2" || $mdx_index_show=="3"){?> mdx-notice-default<?php }if($mdx_index_show=="1"){?> mdui-shadow-2<?php }?>"><i class="mdui-icon material-icons">&#xe7f7;</i><p class="mdui-typo"><?php echo htmlspecialchars_decode(mdx_get_option('mdx_notice'));?></p></div>
    <?php }
    if(mdx_get_option('mdx_hot_posts')==="true" && mdx_get_option('mdx_hot_posts_get')==="sticky" && count($sticky_id) > 0){
        $ignore_sticky_2 = true;
    }
    if((mdx_get_option('mdx_hot_posts') === "true" && mdx_get_option('mdx_hot_posts_get') !== "sticky") || $ignore_sticky_2){
        global $post;
        if(mdx_get_option('mdx_hot_posts_get') === "sticky"){
            $mdx_posts = get_posts(array('numberposts'=>(int)mdx_get_option('mdx_hot_posts_num') > 0 ? (int)mdx_get_option('mdx_hot_posts_num') : 1,'post__in' =>$sticky_id_slide));
        }else{
            $mdx_posts = get_posts('numberposts='.strval((int)mdx_get_option('mdx_hot_posts_num') > 0 ? (int)mdx_get_option('mdx_hot_posts_num') : 1).'&category='.get_cat_ID(mdx_get_option('mdx_hot_posts_cat')));
        }?><div class="mdx-hot-posts mdui-center<?php if($mdx_index_show=="1"){?> mdui-shadow-2<?php }?>">
            <?php if(count($mdx_posts) > 0){?>
            <?php if(mdx_get_option('mdx_hot_posts_text') !== ''){ ?><h3><?php echo mdx_get_option('mdx_hot_posts_text');?><i class="mdui-icon material-icons mdui-text-color-theme-accent">&#xe5c8;</i></h3><?php } ?>
            <div class="mdx-hp-h3-fill"></div>
            <div id="mdx-sp-out-c">
                <div class="mdx-hp-g-l"></div>
                <div class="mdx-hp-g-r"></div>
                <div class="mdx-posts-may-related mdx-ul">
                    <?php foreach($mdx_posts as $related_post):?><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><div class="mdx-li mdui-card mdui-color-theme mdui-hoverable">
                        <div class="lazyload mdx-hot-posts-lazyload"<?php $mdx_img = wp_get_attachment_image_src(get_post_thumbnail_id($related_post->ID),'large');
                        if($mdx_img !== false){
                            $mdx_img = $mdx_img[0];
                        }else{
                            $mdx_img = "";
                        }
                        if($mdx_img !== ""){
                            ?> data-bg="<?php echo $mdx_img.'"';
                        }else{
                            if(mdx_get_option("mdx_post_def_img") === "true"){
                                ?> data-bg="<?php echo get_template_directory_uri().'/img/dpic.jpg"';
                            }
                        }?>></div>
                        <span<?php if($mdx_img !== "" || mdx_get_option("mdx_post_def_img") === "true"){?> class="mdx-same-posts-img"<?php }?>><?php echo $related_post->post_title; ?></span>
                        <i class="mdui-icon material-icons<?php if($mdx_img !== "" || mdx_get_option("mdx_post_def_img") === "true"){?> mdx-same-posts-img<?php }?>" title="<?php echo htmlspecialchars(__("前往阅读","mdx"));?>">&#xe5c8;</i>
                        <div class="mdx-sp-fill<?php if($mdx_img === "" && mdx_get_option("mdx_post_def_img") === "false"){?> mdx-hot-posts-have-img<?php }?>"></div>
                    </div></a><?php endforeach;?>
                </div>
            </div>
        <?php }?>
        </div>
        <?php if(mdx_get_option('mdx_all_posts_text') !== ''){ ?><h3 class="mdx-all-posts"><?php echo mdx_get_option('mdx_all_posts_text');?><i class="mdui-icon material-icons mdui-text-color-theme-accent">&#xe5c8;</i></h3><?php } ?>
    <?php }?>
    <main class="postList mdui-center" id="postlist">
    <?php
        $style=mdx_get_option('mdx_default_style');
        $post_num=0;
        if($ignore_sticky || $ignore_sticky_2){
            $args = array(
                'ignore_sticky_posts' => 1,
                'showposts' => get_option('posts_per_page'),
                'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1
            );
            $the_query = new WP_Query($args);
            if($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post();
                $post_num++;
                if(get_post_meta((int)$post->ID, "mdx_post_show", true) === '3' && !$user_ID){
                    continue;
                }
                require('includes/main_loop.php');
            endwhile;
            endif;
        }else{
            while(have_posts()):the_post();
                $post_num++;
                if(get_post_meta((int)$post->ID, "mdx_post_show", true) === '3' && !$user_ID){
                    continue;
                }
                require('includes/main_loop.php');
            endwhile;
        }
        if($post_num >= 8){
            if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
                $style_class = '';
                if($style==='4'){
                    $style_class = " mdx-style-4-ad";
                }
                echo '<div class="mdx-ad-in-list mdui-center'.$style_class.'">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
            }
        }?></main><div class="nextpage mdui-center"><?php next_posts_link(__('加载更多', 'mdx'));?>
      </div>
<?php get_footer();?>
