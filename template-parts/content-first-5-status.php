<div class="mdx-postlist-simple mdx-postlist-simple-sta post-item">
    <span><i class="mdui-icon material-icons">&#xe0b7;</i> <?php _e('状态', 'mdx');?></span>
    <article class="mdui-typo"><?php echo strip_shortcodes(apply_filters('the_content', $post->post_content));?></article>
    <p>
        <i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?>
    </p>
</div>