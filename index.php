<?php flush();?>
<?php get_header();?>
<?php $mdx_index_img=get_option('mdx_index_img');
if(substr($mdx_index_img,0,6)=="--Bing"){
  $mdx_img_bing = substr($mdx_index_img,22,2);
  if(substr($mdx_img_bing,1,1)==")"){
    $mdx_img_bing = substr($mdx_img_bing,0,1);
  }
  $str=file_get_contents('https://cn.bing.com/HPImageArchive.aspx?n=1&idx='.$mdx_img_bing);
     if(preg_match("/<url>(.+?)<\/url>/ies",$str,$matches)){
         $mdx_index_img='https://cn.bing.com'.str_replace('1366x768','1920x1080',$matches[1]);
     }
}
$mdx_side_img=get_option('mdx_side_img');if($mdx_side_img==''){$mdx_side_img=$mdx_index_img;};?>
  <body class="mdui-theme-primary-<?php echo get_option('mdx_styles');?> mdui-theme-accent-<?php echo get_option('mdx_styles_act');?>">
    <div class="fullScreen sea-close"></div>
    <div class="mdui-drawer mdui-color-white mdui-drawer-close mdui-drawer-full-height" id="left-drawer">
      <div class="sideImg LazyLoad" data-original="<?php echo $mdx_side_img;?>">
      <?php if(get_option('mdx_night_style')=='true'){;?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple nightVision mdui-text-color-white mdui-valign mdui-text-center" mdui-tooltip="{content: '<?php _e('切换日间/夜间模式','mdx');?>'}" id="tgns" mdui-drawer-close="{target: '#left-drawer'}"><i class="mdui-icon material-icons">&#xe3a9;</i></button>
      <?php }?>
      <?php if(get_option('mdx_side_info')=='true'){;?>
      <?php if(get_option('mdx_side_head')!=''){;?>
      <div class="side-info-head mdui-shadow-3" style="background-image:url(<?php echo get_option('mdx_side_head');?>"></div>
      <?php }?>
      <div class="side-info-more"><?php echo get_option('mdx_side_name');?><br><span class="side-info-oth"><?php echo get_option('mdx_side_more');?></span></div>
      <?php }?>
      </div>
    <nav role="navigation"><?php wp_nav_menu(array('theme_location'=>'mdx_menu','menu'=>'mdx_menu','depth'=>1,'container'=>false,'menu_class'=>'mdui-list','menu_id'=>'mdx_menu'));?></nav>
    </div>
    <header role="banner"><div class="titleBarGobal mdui-appbar mdui-shadow-0 <?php if(get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBar">
      <div class="mdui-toolbar mdui-toolbar-self mdui-appbar-fixed topBarAni">
        <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
        <span class="mdui-typo-headline"><?php $mdx_logo=get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}?></span>
        <div class="mdui-toolbar-spacer"></div>
        <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
      </div>
    </div></header>
    <?php get_template_part('searchform')?>
    <div class="theFirstPageBackGround mdui-color-theme"></div>
    <div class="theFirstPage LazyLoad" data-original="<?php echo $mdx_index_img;?>"></div>
    <div class="theFirstPageSay mdui-valign mdui-typo mdui-text-color-white-text"><h1 class="mdui-center"><?php echo esc_attr(get_option('mdx_index_say'))?></h1></div>
    <div class="main">
    <?php if(get_option('mdx_notice')!=""){?>
      <div class="mdxNotice mdui-center mdui-color-theme"><i class="mdui-icon material-icons">&#xe7f7;</i>&nbsp;&nbsp;<?php echo esc_attr(get_option('mdx_notice'))?></div>
    <?php }?>
      <main class="postList mdui-center" id="postlist">
      <?php
      $style=get_option('mdx_default_style');
      $post_num=0;
      while(have_posts()):the_post();$post_num++;
        if($post_num == 1){
        get_template_part('template-parts/content-first-'.$style, get_post_format());
        }else{
          get_template_part('template-parts/content-'.$style, get_post_format());
        }
      endwhile;?></main><div class="nextpage mdui-center"><?php next_posts_link(__('加载更多'));?>
      </div>
<?php get_footer();?>