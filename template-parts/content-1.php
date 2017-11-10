<?php $Imagesurl = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())) ? wp_get_attachment_url( get_post_thumbnail_id(get_the_ID())):get_template_directory_uri().'/img/dpic.jpg';?>
<div class="mdui-card postDiv mdui-center mdui-hoverable">
    <div class="mdui-card-media">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAMAAAAoyzS7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFsbGxAAAA/JhxRAAAAAxJREFUeNpiYAAIMAAAAgABT21Z4QAAAABJRU5ErkJggg==" data-original="<?php echo "$Imagesurl"?>" alt="<?php echo "$Imagesurl"?>" title="<?php the_title();?>" class="LazyLoadList mdui-color-theme mdui-text-color-theme LazyLoadListImg">
        <div class="mdui-card-media-covered ct1">
            <div class="mdui-card-primary">
                <a href="<?php the_permalink();?>"><div class="mdui-card-primary-title"><?php the_title();?></div></a>
                <div class="mdui-card-primary-subtitle"><?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 120,"...");}?></div>
            </div>
        </div>
    </div>
    <div class="mdui-card-actions">
        <span class="info">&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe417;</i> <?php get_post_views($post->ID);?>&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></span>
        <a class="mdui-btn mdui-ripple mdui-ripple-white coun-read mdui-text-color-theme-accent" href="<?php the_permalink();?>"><?php _e('去围观', 'mdx');?></a>
    </div>
</div>