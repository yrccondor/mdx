<?php get_header(); ?>
<?php mdx_get_option('mdx_widget') === "true" ? $mdx_widget = true : $mdx_widget = false;
$mdx_share_area=mdx_get_option('mdx_share_area');
$mdx_post_show = get_post_meta((int)$post->ID, "mdx_post_show", true);
if($mdx_post_show=='' || $mdx_post_show=="0" || (is_user_logged_in() && $mdx_post_show=="3")){
$mdx_index_img=mdx_get_option('mdx_index_img');$mdx_side_img=mdx_get_option('mdx_side_img');if($mdx_side_img==''){$mdx_side_img=$mdx_index_img;};?>
    <?php $full_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');?>
    <?php $mdx_style = get_post_meta((int)$post->ID, "mdx_styles", true);
    if($mdx_style=="" || $mdx_style=="def"){
        $mdx_style = mdx_get_option('mdx_styles');
    }
    $mdx_style_act = get_post_meta((int)$post->ID, "mdx_styles_act", true);
    if($mdx_style_act=="" || $mdx_style_act=="def"){
        $mdx_style_act = mdx_get_option('mdx_styles_act');
    }
    $post_style=get_post_meta((int)$post->ID, "mdx_post_style", true);
    if($post_style == '' || $post_style == 'def'){
        $post_style=mdx_get_option('mdx_post_style');
    }
    ?>
    <body class="mdui-theme-primary-<?php echo $mdx_style?> mdui-theme-accent-<?php echo $mdx_style_act;if($post_style=="0"){echo " body-grey";}else if($post_style=="2"){echo " body-grey1";}if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php }if(mdx_get_option('mdx_reduce_motion')=="true"){?> mdx-reduce-motion<?php } ?>">
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
    <div class="sideImg LazyLoad" data-original="<?php echo $mdx_side_img;?>">
      <?php if(mdx_get_option('mdx_night_style')!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){;?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php _e("切换日间/夜间模式","mdx");?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
      <?php }?>
      <?php if(mdx_get_option('mdx_side_head')!=''){;?>
      <div class="side-info-head mdui-shadow-3" style="background-image:url(<?php echo mdx_get_option('mdx_side_head');?>)"></div>
      <?php }?>
      <div class="side-info-more"><?php echo mdx_get_option('mdx_side_name');?><br><span class="side-info-oth"><?php echo mdx_get_option('mdx_side_more');?></span></div>
    </div>
    <?php }else{?>
        <div class="mdx-side-title">
        <a href="<?php bloginfo('url');?>"><span><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></span></a>
        <?php if(mdx_get_option('mdx_night_style')!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
        <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php _e('切换日间/夜间模式','mdx');?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
        <?php }?>
       </div>
    <?php }?>
    <nav role="navigation"><?php wp_nav_menu(array('theme_location'=>'mdx_menu','menu'=>'mdx_menu','depth'=>2,'container'=>false,'menu_class'=>'mdui-list','menu_id'=>'mdx_menu'));?></nav>
    </div>
    <header role="banner"><div class="titleBarGobal mdui-appbar mdui-shadow-0 <?php if(mdx_get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBarinPost">
            <div class="mdui-toolbar mdui-appbar-fixed">
            <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(mdx_get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
                <a href="<?php bloginfo('url');?>" class="mdui-typo-headline"><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></a>
                <div class="mdui-toolbar-spacer"></div>
                <button class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#qrcode'}" mdui-tooltip="{content: '<?php _e("在其他设备上继续阅读","mdx");?>'}" id="oth-div"><i class="mdui-icon material-icons">&#xe326;</i></button>
                <div class="mdui-menu" id="qrcode">
                </div>
                <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
            </div>
        </div></header>
        <?php get_template_part('includes/searchform')?>

    <?php if($post_style=="0"){if($full_image_url[0]!=""){$mdx_image_url=$full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle<?php if($mdx_image_url==""){?> mdx-pni-t0<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <div class="PostTitleFill mdui-color-theme"></div>
      <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain<?php if($mdx_image_url==""){?> mdx-pni-am0<?php }?>">
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
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if((mdx_get_option('mdx_say_after')!='' || ($mdx_info !='' && $mdx_info !='-----Nothing-----'))){?>
                    <div class="mdui-card mdx-say-after">
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            if($mdx_info == '' || $mdx_info =='-----Nothing-----'){
                                $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            }
                            echo str_replace('--PostURL--','<a href="'.mdx_get_now_url().'">'.mdx_get_now_url().'</a>',str_replace('--PostLink--','<a href="'.mdx_get_now_url().'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
		                echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
	                }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?><?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}if(mdx_get_option('mdx_you_may_like')=="true"){include_once("includes/same_posts.php");}comments_template();?>
            </div>
<?php get_template_part('includes/toggleposts')?>
        <div id="indic"></div>

      <?php }else if($post_style=="1"){if($full_image_url[0]!=""){$mdx_image_url = $full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-color-theme mdui-typo-display-2 mdui-valign PostTitle<?php if($mdx_image_url==""){?> mdx-pni-t<?php }?>" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <div class="PostTitleFill mdui-color-theme"></div>
        <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain<?php if($mdx_image_url==""){?> mdx-pni-am<?php }?>">
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
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if(mdx_get_option('mdx_say_after')!='' || ($mdx_info !='' && $mdx_info !='-----Nothing-----')){?>
                    <div class="mdui-card mdx-say-after">
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            if($mdx_info == '' || $mdx_info =='-----Nothing-----'){
                                $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            }
                            echo str_replace('--PostURL--','<a href="'.mdx_get_now_url().'">'.mdx_get_now_url().'</a>',str_replace('--PostLink--','<a href="'.mdx_get_now_url().'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
		                echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
	                }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?>
            </div>
            <?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}if(mdx_get_option('mdx_you_may_like')=="true"){include_once("includes/same_posts.php");}comments_template();?>
<?php get_template_part('includes/toggleposts')?>
        <div id="indic"></div>
        
      <?php }else if($post_style=="2"){if($full_image_url[0]!=""){$mdx_image_url = $full_image_url[0];}else{if(mdx_get_option("mdx_post_def_img")=="false"){$mdx_image_url="";}else{$mdx_image_url=get_bloginfo("template_url")."/img/dpic.jpg";}}?>
        <div class="mdui-text-color-white-text mdui-typo-display-2 mdui-valign PostTitle PostTitle2" itemprop="name headline" itemtype="http://schema.org/BlogPosting"><span class="mdui-center"><?php the_title();?></span></div>
        <?php if($mdx_image_url!=""){?><div class="PostTitleFill2 LazyLoad" data-original="<?php echo $mdx_image_url;?>"></div><?php }?>
        <div class="PostTitleFillBack2 mdui-color-theme"></div>
        <div class="<?php if($mdx_widget){?>mdx-tools-up-in <?php }?>PostMain PostMain2">
            <div class="ArtMain0 mdui-center mdui-shadow-12">
                <article class="<?php $post_classes=get_post_class();foreach($post_classes as $classes){echo $classes." ";}?> mdui-typo" id="post-<?php the_ID();?>" itemprop="articleBody">
                <?php while(have_posts()):the_post();the_content();?>
                </article>
                <?php if(mdx_get_option('mdx_post_money')!=''){?>
                <div class="mdx-post-money">
                    <button mdui-menu="{target: '#mdx-qrcode-money',align: 'center'}" mdui-tooltip="{content: '<?php _e("赞赏","mdx");?>'}" class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple"><i class="mdui-icon material-icons">&#xe8dc;</i></button>
                    <div class="mdui-menu" id="mdx-qrcode-money">
                        <img alt="<?php _e('赞赏','mdx');?>" src="<?php echo mdx_get_option('mdx_post_money');?>">
                    </div>
                </div>
                <?php }?>
                <?php $mdx_info = get_post_meta((int)$post->ID, "informations_value", true);if(mdx_get_option('mdx_say_after')!='' || ($mdx_info !='' && $mdx_info !='-----Nothing-----')){?>
                    <div class="mdui-card mdx-say-after">
                        <div class="mdui-card-actions mdui-typo">
                        <?php 
                            if($mdx_info == '' || $mdx_info =='-----Nothing-----'){
                                $mdx_info = htmlspecialchars_decode(mdx_get_option('mdx_say_after'));
                            }
                            echo str_replace('--PostURL--','<a href="'.mdx_get_now_url().'">'.mdx_get_now_url().'</a>',str_replace('--PostLink--','<a href="'.mdx_get_now_url().'">'.get_the_title().'</a>',$mdx_info));?>
                        </div>
                    </div>
                    <?php }if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
		                echo '<div class="mdx-ad-after-article">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
	                }?>
                <div class="spanout"><button class="mdui-fab mdui-fab-mini mdui-color-theme-accent mdui-ripple mdx-share" mdui-menu="{target: '#mdxshare'}"><i class="mdui-icon material-icons">&#xe80d;</i></button>
                <ul class="mdui-menu" id="mdxshare">
                <li class="mdui-menu-item mdx-s-img-li"><a href="javascript:mdx_show_img()"><i class="mdui-icon material-icons mdx-share-icon mdui-menu-item-icon">&#xe3f4;</i> <?php _e('生成分享图','mdx');?></a></li>
                <?php if($mdx_share_area=="all" || $mdx_share_area=="china"){include('includes/share_cn.php');}if($mdx_share_area=="all" || $mdx_share_area=="oversea"){include('includes/share_oversea.php');}?>
            </ul>
                <i class="mdui-icon material-icons">&#xe54e;</i> <?php if (get_the_tags()){the_tags('',' ','');}else{_e('没有标签','mdx');}?><span class="mdui-text-color-black-disabled timeInPost" itemprop="datePublished"><?php if(mdx_get_option('mdx_post_edit_time')==="post"){?><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');}else{?><i class="mdui-icon material-icons info-icon">&#xe3c9;</i> <?php the_modified_time('Y-m-d');}?></span>
                <div class="mdui-divider"></div><?php mdx_breadcrumbs();?></div></div><?php endwhile;?>
                <?php if(mdx_get_option('mdx_author_card')=="true"){include_once("includes/author_card.php");}if(mdx_get_option('mdx_you_may_like')=="true"){include_once("includes/same_posts.php");}comments_template();?>
</div>
<?php get_template_part('includes/toggleposts')?>
        <div id="indic"></div>
      <?php }?>
      <div class="mdx-share-img" id="mdx-share-img"><div class="mdx-si-head mdui-color-theme" <?php if($full_image_url[0]!=""){echo 'style="background-image:linear-gradient(to bottom, rgba(0,0,0,0) 45%,rgba(0,0,0,0.7) 100%),url('.$full_image_url[0].');"';}else{if(mdx_get_option("mdx_post_def_img")=="true"){echo 'style="background-image:linear-gradient(to bottom, rgba(0,0,0,0) 45%,rgba(0,0,0,0.7) 100%),url('.get_bloginfo("template_url")."/img/dpic.jpg".'");';}}?>><p><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></p><span><?php the_title();?></span></div><div class="mdx-si-sum"><?php if(!post_password_required()){echo mdx_get_post_excerpt($post, 175);}else{echo "这篇文章受密码保护，前往原文输入密码后才能查看。";}?></div><div class="mdx-si-box"><span><?php _e('扫描二维码继续阅读', 'mdx');?></span><div class="mdx-si-qr" id="mdx-si-qr"></div></div><div class="mdx-si-time"><?php the_time('Y-m-d');?></div></div>
      <?php get_footer();
}elseif ($mdx_post_show=='1') {
?>
    <body class="mdui-theme-primary-<?php echo mdx_get_option('mdx_styles');?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php } ?>"><?php if(mdx_get_option("mdx_night_style")!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
    <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121");sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else{?>if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}<?php }?></script>
    <?php }?>
    <div class="mdui-color-theme mdui-typo-display-4 mdui-valign mdx-background-404">
        <span>404<span class="mdui-typo-headline"><?php _e('尴尬的是，这个页面不见了','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('去首页', 'mdx');?></a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('返回上一页', 'mdx');?></a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
    </script>
</body>
</html>
<?php }elseif ($mdx_post_show=='2') {
?>
    <body class="mdui-theme-primary-<?php echo mdx_get_option('mdx_styles');?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php } ?>"><?php if(mdx_get_option("mdx_night_style")!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
    <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121");sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else{?>if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}<?php }?></script>
    <?php }?>
    <div class="mdui-color-theme mdui-typo-display-3 mdui-valign mdx-background-404">
        <span><?php _e('诶呀...','mdx');?><span class="mdui-typo-headline"><?php _e('根据相关法律法规，此文章暂时不予显示','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('去首页', 'mdx');?></a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('返回上一页', 'mdx');?></a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
</body>
</html>
<?php }elseif ($mdx_post_show=='3' && !is_user_logged_in()) {?>
    <body class="mdui-theme-primary-<?php echo mdx_get_option('mdx_styles');?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php } ?>">
    <?php if(mdx_get_option("mdx_night_style")!=='false' && mdx_get_option('mdx_styles_dark')=='disable'){?>
    <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121");sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else{?>if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}<?php }?></script>
    <?php }?>
    <div class="mdui-color-theme mdui-typo-display-3 mdui-valign mdx-background-404">
        <span><?php _e('诶呀...','mdx');?><span class="mdui-typo-headline"><?php _e('登录后才能查看此文章','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('去首页', 'mdx');?></a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('返回上一页', 'mdx');?></a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
</body>
</html>
<?php }?>