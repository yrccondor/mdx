<?php
function mdx_admin_function(){
    add_menu_page(__('MDx 主题', 'mdx'), __('MDx 主题', 'mdx'), 'manage_options', 'mdx_admin','mdx_display_sub_function','dashicons-admin-customizer');
}
function mdx_add_admin(){
    add_submenu_page('mdx_admin', __('MDx 主题 - 样式', 'mdx'), __('样式', 'mdx'), 'manage_options', 'mdx_styles', 'mdx_display_sub_function_one');
    add_submenu_page('mdx_admin', __('MDx 主题 - 功能', 'mdx'), __('功能', 'mdx'), 'manage_options', 'mdx_functions', 'mdx_display_sub_function_two');
    add_submenu_page('mdx_admin', __('MDx 主题 - 关于', 'mdx'), __('关于', 'mdx'), 'manage_options', 'mdx_about', 'mdx_display_sub_function_three');
}
function mdx_display_sub_function(){
    echo '<h1>'.__('MDx 主题', 'mdx').'</h1>';
}
function mdx_display_sub_function_one(){
    wp_register_style('mdx_admin_preview', get_template_directory_uri().'/includes/admin_preview.css');
    wp_enqueue_style('mdx_admin_preview');
    require_once('admin_style.php');
}
function mdx_display_sub_function_two(){
    wp_register_style('mdx_admin_functions', get_template_directory_uri().'/includes/admin_functions.css');
    wp_enqueue_style('mdx_admin_functions');
    require_once('admin_fn.php');
}
function mdx_display_sub_function_three(){
    wp_register_style('mdx_admin', get_template_directory_uri().'/includes/admin.css');
    wp_enqueue_style('mdx_admin');
    if(function_exists('file_get_contents')){
        $opt2 = array(
            'http'=>array('method'=>"GET",'header'=>"User-Agent: MDxThemeinWordPress\r\n")
        );
        $contexts2 = stream_context_create($opt2);
        $lang = empty(get_option("WPLANG")) ? "en_US" : get_option("WPLANG");
        $mdx_data2 = file_get_contents('https://mdxupdate.flyhigher.top/mdx/getnews?lang='.$lang.'&ver='.get_option('mdx_version'), false, $contexts2);
        $mdx_news = '';
        if($mdx_data2 != ''){
            $mdx_news = '<div class="notice notice-info">
            <p>'.__('通知：', 'mdx').$mdx_data2.'</p></div>';
        }
    }else{
        $mdx_news = '';
    }

    if(function_exists('file_get_contents')){
        $opt1 = array(
            'http'=>array('method'=>"GET",'header'=>"User-Agent: MDxThemeinWordPress\r\n")
        );
        $contexts1 = stream_context_create($opt1);
        $mdx_data = json_decode(file_get_contents('https://update.dlij.site/mdx/info.json', false, $contexts1));
        $mdx_now_version = $mdx_data->version;
        update_option('mdx_new_ver',$mdx_now_version);
    }else{
        $mdx_now_version = '版本号获取失败';
    }

    ($mdx_now_version != get_option('mdx_version')) ? $mdx_update_notice = '<p style="font-size:15px;"><strong>'.__('新版本已经发布。去<a href="update-core.php">更新</a>。', 'mdx').'</strong></p>' : $mdx_update_notice = '';

    $mdx_php_content = file_get_contents(get_theme_root()."/mdx/footer.php");
    $mdx_results = strpos($mdx_php_content, 'href="https://flyhigher.top"');
    $mdx_ifedit = '';
    if($mdx_results === false){
        $mdx_ifedit = '<div class="notice notice-error">
        <p>'.__("警告：你可能修改了主题底部的版权信息，请将其重新改正。MDx主题要求你保留版权信息。", "mdx").'</p></div>';
    }

echo '<div class="wrap">
<h1>'.__('MDx 主题 - 关于', 'mdx').'</h1>'.$mdx_ifedit.$mdx_news.'
<p class="mdx-admin-img"><img src="../wp-content/themes/mdx/img/admin.jpg"></p>
<h2 style="font-size:19px;">'.__('感谢使用 MDx 主题', 'mdx').'</h2>
<p style="font-size:15px;">'.__('我是 Axton Yao，这个主题由我开发。我的网站是', 'mdx').' <a href="https://flyhigher.top" target="_blank">flyhigher.top</a>'.__('。', 'mdx').'</p>
<p style="font-size:15px;">'.__('对主题有任何疑问，建议先查阅 ', 'mdx').'<a href="https://doc.flyhigher.top/mdx/" target="_blank">'.__('主题文档', 'mdx').'</a>'.__('。', 'mdx').'</p>
<p style="font-size:15px;">'.__('这个项目的 Github 地址是 ', 'mdx').'<a href="https://github.com/yrccondor/mdx" target="_blank">github.com/yrccondor/mdx</a>'.__('。如果你有兴趣，欢迎为这个项目做出贡献。同时，求 Star。', 'mdx').'</p>
<p style="font-size:15px;">'.__('这个主题的诞生离不开 MDUI，这是一个优秀的前端框架项目，你可以在他们的官方网站上了解更多：', 'mdx').'<a href="https://mdui.org" target="_blank">mdui.org</a>'.__('。', 'mdx').'</p>
<br>
<p style="font-size:17px;"><strong>'.__('感谢以下译者帮助翻译 MDx：', 'mdx').'</strong></p>
<ul style="font-size:15px;margin-left:17px;list-style:disc">
<li><a href="https://github.com/Sn0bzy" target="_blank">Sn0bzy</a> (Türkçe)</li>
<li><a href="https://github.com/yechs" target="_blank">yechs</a> (English)</li>
<li><a href="https://github.com/AngelKitty" target="_blank">AngelKitty</a> (繁體中文)</li>
</ul>
<br>
<p style="font-size:12px;">'.__('当前版本 v', 'mdx').get_option('mdx_version').'</p>
<p style="font-size:12px;">'.__('构建版本 v', 'mdx').get_option('mdx_version_commit').'</p>
<p style="font-size:12px;">'.__('最新版本 v', 'mdx').$mdx_now_version.'</p>'.$mdx_update_notice.'
<br>
<p style="font-size:17px;"><strong>'.__('这款主题献给 Demi Zhou', 'mdx').'</strong></p>
</div>';
}
function remove_submenu() {
    remove_submenu_page('mdx_admin', 'mdx_admin');
}
add_action('admin_menu', 'mdx_admin_function');
add_action('admin_menu', 'mdx_add_admin');
add_action('admin_menu','remove_submenu');

//初始化主题设置，只有第一次激活主题时调用
function mdx_init_theme(){
    if(!get_option('mdx_first_init')){
        //用途仅为统计安装量 mdx_key为发送请求时间戳的md5值 mdx_first_init不会在除此外的任何地方被调用 请保持克制不要恶意访问接口
        if(function_exists('file_get_contents')){
            $opt = array(
                'http'=>array('method'=>"GET",'header'=>"User-Agent: MDxThemeinWordPress\r\n")
            );
            $contexts = stream_context_create($opt);
            $mdx_token = file_get_contents('https://mdxupdate.flyhigher.top/mdx/gettoken/', false, $contexts);
            $mdx_key = file_get_contents('https://mdxupdate.flyhigher.top/mdx/getkey/index.php?hostname='.$_SERVER['HTTP_HOST'].'&token='.md5($mdx_token), false, $contexts);
            update_option('mdx_first_init', md5($mdx_key));
        }else{
            add_action('admin_notices', 'mdx_cant_notice');
            update_option('mdx_first_init', 'false');
        }

        include_once('includes/admin_init_fn.php');
        include_once('includes/admin_init_style.php');
    }
    add_action('admin_notices', 'mdx_custom_admin_notice');
}
add_action('after_switch_theme', 'mdx_init_theme');
function mdx_custom_admin_notice() {?>
       <div class="notice notice-success is-dismissible">
           <p><?php _e('MDx 主题现已激活，你可以前往<a href="admin.php?page=mdx_styles">主题设置页面</a>对主题进行个性化定制。', 'mdx'); ?></p>
       </div>
<?php }
function mdx_cant_notice() {?>
    <div class="notice notice-warning is-dismissible">
        <p><?php _e('由于你的 PHP 配置问题，MDx 未能成功获取密钥，但这不影响你正常使用 MDx 主题。', 'mdx'); ?></p>
    </div>
<?php }
function mdx_php_error() {?>
    <div class="notice notice-error">
        <p><?php _e('你似乎没有启用 <code>mbstring</code> PHP 拓展，这会导致 MDx 无法正常运行。请参阅<a href="https://doc.flyhigher.top/mdx/zh-CN/tech/php-errors/#mb_strimwidth">文档</a>来修复此错误。', 'mdx'); ?></p>
    </div>
<?php }
if(!function_exists("mb_strimwidth")){
    add_action('admin_notices', 'mdx_php_error');
}
?>