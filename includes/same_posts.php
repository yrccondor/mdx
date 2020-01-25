<?php $mdx_way = mdx_get_option('mdx_you_may_like_way');if($mdx_way=="tag"){
global $post, $wpdb;
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
        LIMIT 5");
    if($related_posts){?><div class="mdx-same-posts"><h3><?php echo mdx_get_option('mdx_you_may_like_text');?></h3><div id="mdx-sp-out-c"><ul class="mdx-posts-may-related"><?php foreach ($related_posts as $related_post){?>
<a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><li class="mdui-card mdui-color-theme LazyLoadSamePost"<?php $mdx_img = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID),'large')[0]; if($mdx_img!=""){?> data-original="<?php echo $mdx_img;}?>"><span<?php if($mdx_img!=""){?> class="mdx-same-posts-img"<?php }?>><?php echo $related_post->post_title; ?></span><i class="mdui-icon material-icons" title="<?php _e("前往阅读","mdx");?>">&#xe5c8;</i><div class="mdx-sp-fill<?php if($mdx_img==""){?> mdx-hot-posts-have-img<?php }?>"><div></li></a>
<?php }?></ul></div></div><?php }}}elseif($mdx_way=="category"){
    global $post, $wpdb;
    $cats = wp_get_post_categories($post->ID);
    if($cats){
      $related = $wpdb->get_results("
      SELECT post_title, ID
      FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
      WHERE {$wpdb->prefix}posts.ID = {$wpdb->prefix}term_relationships.object_id
      AND {$wpdb->prefix}term_taxonomy.taxonomy = 'category'
      AND {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
      AND {$wpdb->prefix}posts.post_status = 'publish'
      AND {$wpdb->prefix}posts.post_type = 'post'
      AND {$wpdb->prefix}term_taxonomy.term_id = '" . $cats[0] . "'
      AND {$wpdb->prefix}posts.ID != '" . $post->ID . "'
      ORDER BY RAND()
      LIMIT 5");
      if($related){?>
      <div class="mdx-same-posts"><h3><?php echo mdx_get_option('mdx_you_may_like_text');?></h3><div id="mdx-sp-out-c"><ul class="mdx-posts-may-related">
      <?php foreach ($related as $related_post){?><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><li class="mdui-card mdui-color-theme LazyLoadSamePost"<?php $mdx_img = wp_get_attachment_image_src( get_post_thumbnail_id( $related_post->ID),'large')[0]; if($mdx_img!=""){?> data-original="<?php echo $mdx_img;}?>"><span<?php if($mdx_img!=""){?> class="mdx-same-posts-img"<?php }?>><?php echo $related_post->post_title; ?></span><i class="mdui-icon material-icons" title="<?php _e("前往阅读","mdx");?>">&#xe5c8;</i><div class="mdx-sp-fill<?php if($mdx_img==""){?> mdx-hot-posts-have-img<?php }?>"><div></li></a><?php }?></ul></div></div><?php }}}?>