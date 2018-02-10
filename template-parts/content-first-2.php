<div class="mdui-card postDiv mdui-center mdui-hoverable">
    <div class="mdui-card-actions">
        <a href="<?php the_permalink();?>" class="mdui-text-color-theme-accent ainList"><h1><?php the_title();?></h1></a>
        <?php if(get_option("mdx_echo_post_sum")=="true"){ ?><p class="ct1-p mdui-text-color-black cont2"><?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_content))), 0, 250,"...");}?><p><?php }?>
        <div class="mdui-divider underline"></div>
        <?php
        $mdx_more_1 = get_option("mdx_post_list_1");
        $mdx_more_2 = get_option("mdx_post_list_2");
        if($mdx_more_1=='view'){
            $mdx_icon_1 = '&#xe417;';
        }else if($mdx_more_1=='time'){
            $mdx_icon_1 = '&#xe192;';
        }else if($mdx_more_1=='comments'){
            $mdx_icon_1 = '&#xe0cb;';
        }
        if($mdx_more_2=='view'){
            $mdx_icon_2 = '&#xe417;';
        }else if($mdx_more_2=='time'){
            $mdx_icon_2 = '&#xe192;';
        }else if($mdx_more_2=='comments'){
            $mdx_icon_2 = '&#xe0cb;';
        }
        ?>
        <span class="info">&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon"><?php echo $mdx_icon_1;?></i> <?php if($mdx_more_1=='view'){get_post_views($post->ID);}else if($mdx_more_1=='comments'){comments_popup_link('0', '0', '%');}else if($mdx_more_1=='time'){the_time('Y-m-d');}?>&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon"><?php echo $mdx_icon_2;?></i> <?php if($mdx_more_2=='view'){get_post_views($post->ID);}else if($mdx_more_2=='comments'){comments_popup_link('0', '0', '%');}else if($mdx_more_2=='time'){the_time('Y-m-d');}?></span>
        <a class="mdui-btn mdui-ripple mdui-ripple-white coun-read mdui-text-color-theme-accent" href="<?php the_permalink();?>"><?php echo get_option("mdx_readmore");?></a>
    </div>
</div>