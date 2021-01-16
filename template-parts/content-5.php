<?php if(wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()))){$Imagesurl=wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()));}else{$Imagesurl="";}?>
<div class="mdx-postlist-simple post-item<?php if(!(mdx_get_option("mdx_post_def_img")=="true" || $Imagesurl !== "")){?> mdx-postlist-simple-has-no-img<?php }?>">
<?php if(mdx_get_option('mdx_post_list_img_height') === "auto"){if($Imagesurl !== ""){?>
<?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?><a href="<?php the_permalink();?>"><?php }?><img src="data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw==" data-src="<?php echo $Imagesurl;?>" alt="<?php echo $Imagesurl;?>" title="<?php the_title();?>" class="lazyload"><?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?></a><?php }?>
<?php }else if(mdx_get_option("mdx_post_def_img")=="true" && $Imagesurl == ""){ ?>
<?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?><a href="<?php the_permalink();?>"><?php }?><img src="data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw==" data-src="<?php echo get_template_directory_uri().'/img/dpic.jpg'?>" alt="<?php echo get_template_directory_uri().'/img/dpic.jpg'?>" title="<?php the_title();?>" class="lazyload"><?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?></a><?php }?>
    <?php }}else{ ?>
    <?php if($Imagesurl !== ""){?>
    <?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?><a href="<?php the_permalink();?>"><?php }?><div class="mdx-fixed-img mdui-color-theme"><div class="lazyload" data-bg="<?php echo $Imagesurl;?>" title="<?php the_title();?>"></div></div><?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?></a><?php }?>
<?php }else if(mdx_get_option("mdx_post_def_img")=="true" && $Imagesurl == ""){ ?>
    <?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?><a href="<?php the_permalink();?>"><?php }?><div class="mdx-fixed-img mdui-color-theme"><div class="lazyload" data-bg="<?php echo get_template_directory_uri().'/img/dpic.jpg'?>" title="<?php the_title();?>"></div></div><?php if(mdx_get_option('mdx_post_list_click_area') === "pic"){?></a><?php }?>
<?php }}?>
    <div class="card-text">
        <a href="<?php the_permalink();?>" class="mdui-text-color-theme ainList"><h1><?php the_title();?></h1></a>
        <?php if(mdx_get_option("mdx_echo_post_sum")=="true"){ ?><p class="ct1-p mdui-text-color-black cont2"><?php if(post_password_required()){_e('这篇文章受密码保护，输入密码才能看哦', 'mdx');}else{if(mdx_get_option("mdx_post_def_img")=="true" || $Imagesurl !== ""){$summ = mdx_get_post_excerpt($post, 300);}else{$summ = mdx_get_post_excerpt($post, 450);}if($summ !== ""){echo $summ;}else{_e("这篇文章没有摘要");}}?></p><?php }?>
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
        <span class="info">
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_1!='blank'){echo $mdx_icon_1;}?></i> <?php if($mdx_more_1=='view'){get_post_views($post->ID);}else if($mdx_more_1=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_1=='time'){the_time('Y-m-d');}?><?php if($mdx_more_1!='blank'){echo "&nbsp;&nbsp;";}?>
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_2!='blank'){echo $mdx_icon_2;}?></i> <?php if($mdx_more_2=='view'){get_post_views($post->ID);}else if($mdx_more_2=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_2=='time'){the_time('Y-m-d');}?><?php if($mdx_more_2!='blank'){echo "&nbsp;&nbsp;";}?>
            <i class="mdui-icon material-icons info-icon"><?php if($mdx_more_3!='blank'){echo $mdx_icon_3;}?></i> <?php if($mdx_more_3=='view'){get_post_views($post->ID);}else if($mdx_more_3=='comments'){comments_popup_link('0', '1', '%');}else if($mdx_more_3=='time'){the_time('Y-m-d');}?>
        </span>
    </div>
</div>