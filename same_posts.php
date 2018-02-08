<div class="mdx-same-posts">
<h3><?php echo get_option('mdx_you_may_like_text');?></h3>
<div>
<ul class="mdx-posts-may-related">
<?php global $post, $wpdb;
$post_tags = wp_get_post_tags($post->ID);
if ($post_tags) {
    $tag_list = '';
    foreach ($post_tags as $tag) {
        $tag_list .= $tag->term_id.',';
    }
    $tag_list = substr($tag_list, 0, strlen($tag_list)-1);
    $related_posts = $wpdb->get_results("
        SELECT DISTINCT ID, post_title
        FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
        WHERE {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
        AND ID = object_id
        AND taxonomy = 'post_tag'
        AND post_status = 'publish'
        AND post_type = 'post'
        AND term_id IN (" . $tag_list . ")
        AND ID != '" . $post->ID . "'
        ORDER BY RAND()
        LIMIT 7");
    if($related_posts){foreach ($related_posts as $related_post){?>
    <a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><li class="mdui-card mdui-color-theme" style="background-image:url('<?php $mdx_img = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID))[0];echo $mdx_img;?>')"><span<?php if($mdx_img!=""){?> class="mdx-same-posts-img"<?php }?>><?php echo $related_post->post_title; ?></span><i class="mdui-icon material-icons" title="<?php _e("前往阅读","mdx");?>">&#xe5c8;</i></li></a>
<?php }}
    else{
      echo '<li>暂无相关文章</li>';
    }}
else{
  echo '<li>暂无相关文章</li>';
}
?>
</ul>
</div></div>