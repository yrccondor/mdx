<?php
$previous_post = get_previous_post();
$next_post = get_next_post();
if((!empty($previous_post))&&(!empty($next_post))){?>
<div class="page-footer-nav mdui-color-theme<?php if(mdx_get_option("mdx_post_nav_style") === "1"){?> mdx-post-nav-clean<?php }?>">
  <div class="mdui-container">
    <div class="mdui-row">
      <a href="<?php echo esc_url(get_permalink($previous_post->ID));?>" class="mdui-ripple mdui-color-theme mdui-col-xs-2 mdui-col-sm-6 page-footer-nav-left">
        <div class="page-footer-nav-text">
          <i class="mdui-icon material-icons">arrow_back</i>
          <span class="page-footer-nav-direction mdui-hidden-xs-down"><?php _e('上一篇','mdx');?></span>
          <div class="page-footer-nav-chapter mdui-hidden-xs-down"><?php echo esc_html(get_the_title($previous_post->ID));?></div>
        </div>
      </a>
      <a href="<?php echo esc_url(get_permalink($next_post->ID));?>" class="mdui-ripple mdui-color-theme mdui-col-xs-10 mdui-col-sm-6 page-footer-nav-right">
        <div class="page-footer-nav-text">
          <i class="mdui-icon material-icons">arrow_forward</i>
          <span class="page-footer-nav-direction"><?php _e('下一篇','mdx');?></span>
          <div class="page-footer-nav-chapter"><?php echo esc_html(get_the_title($next_post->ID));?></div>
        </div>
      </a>
</div>
  </div>
</div>
<?php }else if((empty($previous_post))&&(!empty($next_post))){?>
<div class="page-footer-nav mdui-color-theme<?php if(mdx_get_option("mdx_post_nav_style") === "1"){?> mdx-post-nav-clean<?php }?>">
  <div class="mdui-container">
    <div class="mdui-row">
    <div class="mdui-col-xs-2 mdui-col-sm-6 page-footer-nav-left"></div>
      <a href="<?php echo esc_url(get_permalink($next_post->ID));?>" class="mdui-ripple mdui-color-theme mdui-col-xs-10 mdui-col-sm-6 page-footer-nav-right">
        <div class="page-footer-nav-text">
          <i class="mdui-icon material-icons">arrow_forward</i>
          <span class="page-footer-nav-direction"><?php _e('下一篇','mdx');?></span>
          <div class="page-footer-nav-chapter"><?php echo esc_html(get_the_title($next_post->ID));?></div>
        </div>
      </a>
</div>
  </div>
</div>
<?php }else if((!empty($previous_post))&&(empty($next_post))){?>
<div class="page-footer-nav mdui-color-theme<?php if(mdx_get_option("mdx_post_nav_style") === "1"){?> mdx-post-nav-clean<?php }?>">
    <div class="mdui-container">
      <div class="mdui-row">
        <a href="<?php echo esc_url(get_permalink($previous_post->ID));?>" class="mdui-ripple mdui-color-theme mdui-col-xs-2 mdui-col-sm-6 page-footer-nav-left mdx-first-box">
          <div class="page-footer-nav-text">
            <i class="mdui-icon material-icons">arrow_back</i>
            <span class="page-footer-nav-direction mdui-hidden-xs-down mdx-first-1"><?php _e('上一篇','mdx');?></span>
            <div class="page-footer-nav-chapter mdui-hidden-xs-down mdx-first-2"><?php echo esc_html(get_the_title($previous_post->ID));?></div>
          </div>
        </a>
  </div>
    </div>
  </div>
<?php }?>