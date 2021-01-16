<div class="mdui-grid-tile mdui-card staDivgaid mdui-center mdui-shadow-0 post-item">
    <div class="mdui-card-media outofStaGaid">
        <div class="staTime mdui-text-right sta-4"><i class="mdui-icon material-icons info-icon">&#xe192;</i> <?php the_time('Y-m-d');?></div>
        <div class="backGround"><i class="mdui-icon material-icons">&#xe0b7;</i> <?php _e('状态', 'mdx');?></div>
        <article class="sayInStaGaid mdui-valign art-4">
        <span class="span-4 mdui-typo"><?php echo strip_shortcodes(apply_filters('the_content', $post->post_content));?></span>
        </article>
    </div>
</div>