<?php get_header(); ?>
<body class="<?php echo (is_admin_bar_showing() ? "has-admin-bar" : "") ?>  mdui-theme-primary-<?php $main_color = mdx_get_option('mdx_styles');if($main_color === "white"){echo "grey mdx-theme-white";}else{echo $main_color;}?> mdui-theme-accent-<?php echo mdx_get_option('mdx_styles_act');if(mdx_get_option('mdx_styles_dark')!=='disable'){?> mdui-theme-layout-dark mdx-always-dark<?php }if(mdx_get_option('mdx_md2')=="true" && mdx_get_option('mdx_md2_font')=="true"){?> mdx-md2-font<?php }if(mdx_get_option('mdx_reduce_motion')=="true"){?> mdx-reduce-motion<?php } ?>">
<?php if(mdx_get_option("mdx_night_style")==="true" && mdx_get_option('mdx_styles_dark')=='disable'){?>
    <script><?php
    if(mdx_get_option("mdx_auto_night_style")=="true"){?>
    var haveChromeColor=(document.getElementsByName('theme-color').length>0);function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}}var inrange=false;if(time_range("00:00","05:30")||time_range("22:30","23:59")){inrange=true}if((inrange&&(!sessionStorage.getItem('ns_night-styles')))||sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}sessionStorage.setItem('ns_night-styles','true')}else if((!inrange)&&(!sessionStorage.getItem('ns_night-styles'))){sessionStorage.setItem('ns_night-styles','false')}
    <?php }else if(mdx_get_option("mdx_auto_night_style")=="system"){?>
      var haveChromeColor=document.getElementsByName('theme-color').length>0;if(!sessionStorage.getItem('ns_night-styles')){var handleColorChange=function handleColorChange(mql){if(sessionStorage.getItem('ns_night-styles')){return;}if(mql.matches){document.getElementsByTagName('body')[0].classList.add("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}else{document.getElementsByTagName('body')[0].classList.remove("mdui-theme-layout-dark");if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content",document.getElementsByName('mdx-main-color')[0].getAttribute("content"));}}};var mql=window.matchMedia("(prefers-color-scheme: dark)");mql.addListener(handleColorChange);handleColorChange(mql);}else{if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121");}}}
    <?php }else{?>var haveChromeColor=(document.getElementsByName('theme-color').length>0);if(sessionStorage.getItem('ns_night-styles')==="true"){document.getElementsByTagName('body')[0].className+=" mdui-theme-layout-dark";if(haveChromeColor){document.getElementsByName('theme-color')[0].setAttribute("content","#212121")}}<?php }?></script>
    <?php }?>
    <div class="mdui-color-theme mdui-typo-display-4 mdui-valign mdx-background-404">
        <span>404<span class="mdui-typo-headline"><?php _e('尴尬的是，这个页面不见了','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('前往首页','mdx');?></a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple"><?php _e('返回上一页','mdx');?></a>
        <div>
    </div>
</body>
</html>