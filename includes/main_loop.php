<?php
if(mdx_get_option('mdx_lazy_load_mode')=='seo2'){
    get_template_part('template-parts/content-first-'.$style, get_post_format());
}else if($post_num == 4){
    get_template_part('template-parts/content-'.$style, get_post_format());
    if((mdx_get_option('mdx_logged_in_ad')==="false" && !empty(mdx_get_option('mdx_ad'))) || ((mdx_get_option('mdx_logged_in_ad')==="true" && !is_user_logged_in()) && !empty(mdx_get_option('mdx_ad')))){
        $style_class = '';
        if($style==='4'){
            $style_class = " mdx-style-4-ad";
        }
        echo '<div class="mdx-ad-in-list mdui-center'.$style_class.'">'.htmlspecialchars_decode(mdx_get_option('mdx_ad')).'</div>';
    }
}else{
    get_template_part('template-parts/content-'.$style, get_post_format());
}
?>