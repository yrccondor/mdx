<?php flush();?>
<?php get_header();?>
<?php $mdx_index_show=get_option('mdx_index_show');$mdx_index_img=get_option('mdx_index_img');
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
  <body class="mdui-theme-primary-<?php echo get_option('mdx_styles');?> mdui-theme-accent-<?php echo get_option('mdx_styles_act');if($mdx_index_show=="1"){?> mdx-first-simple<?php } ?>">
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
    <nav role="navigation"><?php wp_nav_menu(array('theme_location'=>'mdx_menu','menu'=>'mdx_menu','depth'=>2,'container'=>false,'menu_class'=>'mdui-list','menu_id'=>'mdx_menu'));?></nav>
    </div>
    <header role="banner"><div class="titleBarGobal mdx-sh-ani mdui-appbar-fixed mdui-appbar mdui-shadow-0 <?php if(get_option('mdx_title_bar')=='true'){;?>mdui-appbar-scroll-hide<?php }?> mdui-text-color-white-text" id="titleBar">
      <div class="mdui-toolbar mdui-toolbar-self topBarAni">
        <button class="mdui-btn mdui-btn-icon" id="menu" mdui-drawer="{target:'#left-drawer',overlay:true<?php if(get_option('mdx_open_side')=='true'){;?>,swipe:true<?php }?>}"><i class="mdui-icon material-icons">menu</i></button>
        <span class="mdui-typo-headline"><?php $mdx_logo=get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}?></span>
        <div class="mdui-toolbar-spacer"></div>
        <button class="mdui-btn mdui-btn-icon seai"><i class="mdui-icon material-icons">&#xe8b6;</i></button>
      </div>
    </div></header>
    <?php get_template_part('searchform')?>
    <div class="theFirstPageBackGround mdui-color-theme"></div>
    <?php if($mdx_index_show=="0"){?><div class="theFirstPage LazyLoad" data-original="<?php echo $mdx_index_img;?>"></div><?php } ?>
    <div class="theFirstPageSay mdui-valign mdui-typo mdui-text-color-white-text"><h<?php if(get_option('mdx_index_say_size')!=""){echo get_option('mdx_index_say_size');}else{echo '1';}?> class="mdui-center"><?php echo esc_attr(get_option('mdx_index_say'))?></h1></div>
    <div class="main">
    <?php if(get_option('mdx_notice')!=""){?>
    <div class="mdxNotice mdui-typo mdui-center<?php if($mdx_index_show=="0"){?> mdui-color-theme<?php }if($mdx_index_show=="1"){?> mdui-shadow-2<?php }?>"><i class="mdui-icon material-icons">&#xe7f7;</i>&nbsp;&nbsp;<?php echo htmlspecialchars_decode(get_option('mdx_notice'));?></div>
    <?php }?>
    <?php if(get_option('mdx_hot_posts')=="true"){?>
    <?php global $post;$mdx_posts = get_posts('numberposts='.get_option('mdx_hot_posts_num').'&category='.get_cat_ID(get_option('mdx_hot_posts_cat')));?><div class="mdx-same-posts mdx-hot-posts mdui-center<?php if($mdx_index_show=="1"){?> mdui-shadow-2<?php }?>"><h3><?php echo get_option('mdx_hot_posts_text');?></h3><div class="mdx-hp-h3-fill"></div><div id="mdx-sp-out-c"><div class="mdx-hp-g-l"></div><div class="mdx-hp-g-r"></div><ul class="mdx-posts-may-related"><?php foreach($mdx_posts as $related_post):?><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><li class="mdui-card mdui-color-theme LazyLoadSamePost mdui-hoverable"<?php $mdx_img = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID),'large')[0]; if($mdx_img!=""){?> data-original="<?php echo $mdx_img;}?>"><span<?php if($mdx_img!=""){?> class="mdx-same-posts-img"<?php }?>><?php echo $related_post->post_title; ?></span><i class="mdui-icon material-icons" title="<?php _e("前往阅读","mdx");?>">&#xe5c8;</i><div class="mdx-sp-fill<?php if($mdx_img==""){?> mdx-hot-posts-have-img<?php }?>"><div></li></a><?php endforeach;?></ul></div></div><h3 class="mdx-all-posts"><?php echo get_option('mdx_all_posts_text');?></h3>
    <?php }?>
      <main class="postList mdui-center" id="postlist">
      <?php
      $style=get_option('mdx_default_style');
      $post_num=0;
      while(have_posts()):the_post();$post_num++;
        if($post_num == 1 || get_option('mdx_lazy_load_mode')=='seo2'){
        get_template_part('template-parts/content-first-'.$style, get_post_format());
        }else{
          get_template_part('template-parts/content-'.$style, get_post_format());
        }
      endwhile;?></main><div class="nextpage mdui-center"><?php next_posts_link(__('加载更多'));?>
      </div>
<?php get_footer();?>
