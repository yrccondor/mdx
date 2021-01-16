<div class="mdui-card postDiv mdui-center mdui-hoverable post-item">
    <div class="mdui-card-actions">
        <a href="<?php the_permalink();?>" class="mdui-text-color-theme ainList"><h1><?php the_title();?></h1></a>
        <?php if(mdx_get_option("mdx_echo_post_sum")=="true"){ ?><p class="ct1-p mdui-text-color-black cont2"><?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{$summ = mdx_get_post_excerpt($post, 250);if($summ !== ""){echo $summ;}else{_e("这篇文章没有摘要");}}?></p><?php }?>
        <div class="mdui-divider underline"></div>
        <?php
        $mdx_more_1 = mdx_get_option("mdx_post_list_1");
        $mdx_more_2 = mdx_get_option("mdx_post_list_2");
        $mdx_more_3 = mdx_get_option("mdx_post_list_3");
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
        if($mdx_more_3=='view'){
            $mdx_icon_3 = '&#xe417;';
        }else if($mdx_more_3=='time'){
            $mdx_icon_3 = '&#xe192;';
        }else if($mdx_more_3=='comments'){
            $mdx_icon_3 = '&#xe0cb;';
        }
        ?>
        <span class="info">&nbsp;&nbsp;
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_1!='blank'){echo $mdx_icon_1;}?></i> <?php if($mdx_more_1=='view'){get_post_views($post->ID);}else if($mdx_more_1=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_1=='time'){the_time('Y-m-d');}?><?php if($mdx_more_1!='blank'){echo "&nbsp;&nbsp;";}?>
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_2!='blank'){echo $mdx_icon_2;}?></i> <?php if($mdx_more_2=='view'){get_post_views($post->ID);}else if($mdx_more_2=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_2=='time'){the_time('Y-m-d');}?><?php if($mdx_more_2!='blank'){echo "&nbsp;&nbsp;";}?>
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_3!='blank'){echo $mdx_icon_3;}?></i> <?php if($mdx_more_3=='view'){get_post_views($post->ID);}else if($mdx_more_3=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_3=='time'){the_time('Y-m-d');}?>
        </span>
        <a class="mdui-btn mdui-ripple mdui-ripple-white coun-read mdui-text-color-theme-accent" href="<?php the_permalink();?>"><?php echo mdx_get_option("mdx_readmore");?></a>
    </div>
</div>
