<div class="mdui-card staDiv postDiv mdui-center mdui-shadow-0 post-item">
    <div class="mdui-card-media outofSta">
        <div class="backGround"><i class="mdui-icon material-icons">&#xe0b7;</i> <?php _e('状态', 'mdx');?></div>
        <div class="staTime mdui-text-right"><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></div>
        <article class="sayInSta mdui-valign">
        <span class="mdui-typo"><?php echo strip_shortcodes(apply_filters('the_content', $post->post_content));?></span>
        </article>
    </div>
</div>