<?php get_header(); ?>
<body class="mdui-theme-primary-<?php echo get_option('mdx_styles');?> mdui-theme-accent-<?php echo get_option('mdx_styles_act');?>">
    <div class="mdui-color-theme mdui-typo-display-4 mdui-valign mdx-background-404">
        <span>404<span class="mdui-typo-headline"><?php _e('尴尬的是，这个页面貌似旅游去了','mdx');?></span></span>
    </div>
    <div class="mdui-valign mdx-main-404">
        <div>
            <a href="<?php bloginfo('url'); ?>" class="mdui-btn mdui-color-theme-accent mdui-ripple">去首页</a>
            <a href="javascript:history.go(-1);" class="mdui-btn mdui-color-theme-accent mdui-ripple">返回上一页</a>
        <div>
    </div>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/js/nsc.js"></script>
    <script>
    $(function(){
        if(sessionStorage.getItem('ns_night-styles')=='true'){
            $("body").toggleClass("mdui-theme-layout-dark");
            $("meta[name='theme-color']").attr('content',"#212121");
        }
    })
    </script>
</body>
</html>