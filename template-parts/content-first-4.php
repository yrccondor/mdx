<?php $Imagesurl = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())) ? mdx_get_option("mdx_post_list_img_prefix").wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())).mdx_get_option("mdx_post_list_img_suffix") : ""; //三元表达式有益于身心健康
if (mdx_get_option("mdx_post_def_img") == "false" && $Imagesurl == "") { ?>
    <article class="mdui-grid-tile indexgaid mdui-shadow-3 mdui-color-theme post-item">
        <?php if (mdx_get_option('mdx_post_list_click_area') === "pic"){ ?>
        <a href="<?php the_permalink(); ?>">
            <?php } ?>
            <div class="mdui-grid-tile-actions mdui-grid-tile-actions-gradient">
                <div class="mdui-grid-tile-text">
                    <?php if (mdx_get_option('mdx_post_list_click_area') === "title"){ ?>
                    <a href="<?php the_permalink(); ?>" class="gaid-a"><?php } ?>
                        <div class="mdui-grid-tile-title"><?php the_title(); ?></div><?php if (mdx_get_option('mdx_post_list_click_area') === "title"){ ?>
                    </a><?php } ?>
                </div>
            </div>
            <?php if (mdx_get_option('mdx_post_list_click_area') === "pic"){ ?>
        </a>
    <?php } ?>
    </article>
<?php } else {
    if ($Imagesurl == "") {
        $Imagesurl = mdx_get_post_default_url();
    } ?>
    <article class="mdui-grid-tile indexgaid mdui-shadow-3 post-item">
        <?php if (mdx_get_option('mdx_post_list_click_area') === "pic"){ ?>
        <a href="<?php the_permalink(); ?>">
            <?php } ?>
            <div class="divimg" style="background-image:url('<?php echo "$Imagesurl" ?>')"></div>
            <div class="mdui-grid-tile-actions mdui-grid-tile-actions-gradient">
                <div class="mdui-grid-tile-text">
                    <?php if (mdx_get_option('mdx_post_list_click_area') === "title"){ ?>
                    <a href="<?php the_permalink(); ?>" class="gaid-a"><?php } ?>
                        <div class="mdui-grid-tile-title"><?php the_title(); ?></div><?php if (mdx_get_option('mdx_post_list_click_area') === "title"){ ?>
                    </a><?php } ?>
                </div>
            </div>
            <?php if (mdx_get_option('mdx_post_list_click_area') === "pic"){ ?>
        </a>
    <?php } ?>
    </article>
<?php } ?>