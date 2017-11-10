<div class="mdui-card postDiv mdui-center mdui-hoverable">
    <div class="mdui-card-actions">
        <a href="<?php the_permalink();?>" class="mdui-text-color-theme-accent ainList"><h1><?php the_title();?></h1></a>
        <p class="ct1-p mdui-text-color-black cont2"><?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 250,"...");}?><p>
        <div class="mdui-divider underline"></div>
        <span class="info">&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe417;</i> <?php get_post_views($post->ID);?>&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></span>
        <a class="mdui-btn mdui-ripple mdui-ripple-white coun-read mdui-text-color-theme-accent" href="<?php the_permalink();?>"><?php _e('去围观', 'mdx');?></a>
    </div>
</div>