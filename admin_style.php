<?php
settings_errors();
$trueon=__('开启', 'mdx');
$falseoff=__('关闭', 'mdx');

//Some errors happend. I can't use WordPress Setting API. It said "Error: options page not found.", so I used another way to save the values.
wp_enqueue_script('media-upload');
wp_enqueue_script('my-upload', get_bloginfo('template_url' ).'/js/admin_upload.js');
wp_enqueue_media();
wp_enqueue_script('thickbox');
wp_enqueue_style('thickbox');
wp_enqueue_style('wp-color-picker');
wp_enqueue_script('wp-color-picker');
?>
<div class="wrap"><h1><?php _e('MDx 主题 - 样式', 'mdx');?></h1>
<?php
if((isset($_POST['mdx_ref']) && $_POST['mdx_ref'] == 'true') && check_admin_referer('mdx_options_update')){
    $mdx_color_arr=array(
        'red'=>'#f44336',
        'pink'=>'#e91e63',
        'purple'=>'#9c27b0',
        'deep-purple'=>'#673ab7',
        'indigo'=>'#3f51b5',
        'blue'=>'#2196f3',
        'light-blue'=>'#03a9f4',
        'cyan'=>'#00bcd4',
        'teal'=>'#009688',
        'green'=>'#4caf50',
        'light-green'=>'#8bc34a',
        'lime'=>'#cddc39',
        'yellow'=>'#ffeb3b',
        'amber'=>'#ffc107',
        'orange'=>'#ff9800',
        'deep-orange'=>'#ff5722',
        'brown'=>'#795548',
        'grey'=>'#9e9e9e',
        'blue-grey'=>'#607d8b',
        'white'=>'#9e9e9e',
    );
    $mdx_act_arr=array(
        'red'=>'#ff5252',
        'pink'=>'#ff4081',
        'purple'=>'#e040fb',
        'deep-purple'=>'#7c4dff',
        'indigo'=>'#536dfe',
        'blue'=>'#448aff',
        'light-blue'=>'#40c4ff',
        'cyan'=>'#18ffff',
        'teal'=>'#64ffda',
        'green'=>'#69f0ae',
        'light-green'=>'#b2ff59',
        'lime'=>'#eeff41',
        'yellow'=>'#ffff00',
        'amber'=>'#ffd740',
        'orange'=>'#ffab40',
        'deep-orange'=>'#ff6e40',
    );
    mdx_update_option('mdx_styles', sanitize_text_field($_POST['mdx_styles']));
    mdx_update_option('mdx_styles_hex', $mdx_color_arr[sanitize_text_field($_POST['mdx_styles'])]);
    mdx_update_option('mdx_styles_act', sanitize_text_field($_POST['mdx_styles_act']));
    mdx_update_option('mdx_act_hex', $mdx_act_arr[sanitize_text_field($_POST['mdx_styles_act'])]);
    mdx_update_option('mdx_styles_dark', sanitize_text_field($_POST['mdx_styles_dark']));
    if($_POST['mdx_styles_dark'] !== "disable"){
        mdx_update_option('mdx_night_style', 'false');
        mdx_update_option('mdx_auto_night_style', 'false');
    }
    mdx_update_option('mdx_md2', $_POST['mdx_md2']);
    $md2_font = sanitize_text_field($_POST['mdx_md2_font']);
    if(isset($md2_font)){
        mdx_update_option('mdx_md2_font', $md2_font);
    }else{
        mdx_update_option('mdx_md2_font', 'false');
    }
    mdx_update_option('mdx_login_md', sanitize_text_field($_POST['mdx_login_md']));
    mdx_update_option('mdx_chrome_color', sanitize_text_field($_POST['mdx_chrome_color']));
    mdx_update_option('mdx_title_bar', sanitize_text_field($_POST['mdx_title_bar']));
    mdx_update_option('mdx_tap_to_top', sanitize_text_field($_POST['mdx_tap_to_top']));
    mdx_update_option('mdx_default_style', sanitize_text_field($_POST['mdx_default_style']));
    mdx_update_option('mdx_index_show', sanitize_text_field($_POST['mdx_index_show']));
    mdx_update_option('mdx_post_style', sanitize_text_field($_POST['mdx_post_style']));
    mdx_update_option('mdx_post_time_positon', sanitize_text_field($_POST['mdx_post_time_positon']));
    mdx_update_option('mdx_post_nav_style', sanitize_text_field($_POST['mdx_post_nav_style']));
    mdx_update_option('mdx_post_list_width', sanitize_text_field($_POST['mdx_post_list_width']));
    mdx_update_option('mdx_echo_post_sum', sanitize_text_field($_POST['mdx_echo_post_sum']));
    mdx_update_option('mdx_post_list_img_height', sanitize_text_field($_POST['mdx_post_list_img_height']));
    mdx_update_option('mdx_post_def_img', sanitize_text_field($_POST['mdx_post_def_img']));
    mdx_update_option('mdx_gravatar_actived', sanitize_text_field($_POST['mdx_gravatar_actived']));
    mdx_update_option('mdx_link_rand_order', sanitize_text_field($_POST['mdx_link_rand_order']));
    mdx_update_option('mdx_title_med', sanitize_text_field($_POST['mdx_title_med']));
    mdx_update_option('mdx_index_head_style', sanitize_text_field($_POST['mdx_index_head_style']));
    mdx_update_option('mdx_index_slide_posts_style', sanitize_text_field($_POST['mdx_index_slide_posts_style']));
    mdx_update_option('mdx_index_slide_posts_num', sanitize_text_field($_POST['mdx_index_slide_posts_num']));
    mdx_update_option('mdx_index_slide_posts_get', sanitize_text_field($_POST['mdx_index_slide_posts_get']));
    mdx_update_option('mdx_index_slide_posts_cat', sanitize_text_field($_POST['mdx_index_slide_posts_cat']));
    mdx_update_option('mdx_index_img', sanitize_text_field($_POST['mdx_index_img']));
    mdx_update_option('mdx_index_img_bg', sanitize_text_field($_POST['mdx_index_img_bg']));
    mdx_update_option('mdx_side_img', esc_url_raw($_POST['mdx_side_img']));
    mdx_update_option('mdx_side_info', sanitize_text_field($_POST['mdx_side_info']));
    mdx_update_option('mdx_side_head', esc_url_raw($_POST['mdx_side_head']));
    mdx_update_option('mdx_side_name', htmlentities(stripslashes($_POST['mdx_side_name'])));
    mdx_update_option('mdx_side_more', htmlentities(stripslashes($_POST['mdx_side_more'])));
    mdx_update_option('mdx_index_say', htmlentities(stripslashes($_POST['mdx_index_say'])));
    mdx_update_option('mdx_index_say_size', sanitize_text_field($_POST['mdx_index_say_size']));
    mdx_update_option('mdx_say_after', htmlentities(stripslashes($_POST['mdx_say_after'])));
    mdx_update_option('mdx_logo_way', sanitize_text_field($_POST['mdx_logo_way']));
    mdx_update_option('mdx_logo', esc_url_raw($_POST['mdx_logo']));
    mdx_update_option('mdx_logo_text', sanitize_text_field($_POST['mdx_logo_text']));
    mdx_update_option('mdx_safari', sanitize_text_field($_POST['mdx_safari']));
    mdx_update_option('mdx_svg', esc_url_raw($_POST['mdx_svg']));
    mdx_update_option('mdx_svg_color', sanitize_text_field($_POST['mdx_svg_color']));
    mdx_update_option('mdx_tags_color', sanitize_text_field($_POST['mdx_tags_color']));
    mdx_update_option('mdx_styles_footer', sanitize_text_field($_POST['mdx_styles_footer']));
    mdx_update_option('mdx_footer_say', htmlentities(stripslashes($_POST['mdx_footer_say'])));
    mdx_update_option('mdx_footer', htmlentities(stripslashes($_POST['mdx_footer'])));
?>
<div class="notice notice-success is-dismissible">
<p><?php _e('设置已保存。', 'mdx'); ?></p>
</div>
<?php
}elseif((isset($_POST['mdx_ref']) && $_POST['mdx_ref'] == 'true') && !(check_admin_referer('mdx_options_update'))){
?>
<div class="notice notice-error is-dismissible">
<p><?php _e('更改未能保存。', 'mdx'); ?></p>
</div>
<?php
}?>
<?php if(get_option('mdx_new_ver') != get_option('mdx_version')){?>
<div class="notice notice-info is-dismissible">
<p><?php _e('MDx 已发布新版本 ', 'mdx');echo get_option('mdx_new_ver');_e('。<a href="./admin.php?page=mdx_about">重新检查</a>', 'mdx');?></p>
</div>
<?php }
if(!defined('ALU_VERSION')){
    define('ALU_VERSION', '1.0.6');
}
if(ALU_VERSION !== '1.0.6'){?>
<div class="notice notice-warning is-dismissible">
<p><?php _e('你似乎正在使用旧版本的 Alu 表情插件。这与 MDx 2.x 不兼容，你需要前往 <a href="https://doc.flyhigher.top/mdx/zh-CN/config/emoji-in-comment/" target="_blank">MDx 文档</a> 下载安装新版插件。', 'mdx');?></p>
</div>
<?php }?>
<nav class="nav-tab-wrapper wp-clearfix" aria-label="Secondary menu"> 
    <a href="#" class="nav-tab nav-tab-active mdx-admin-nav" id="mdx-admin-nav-global"><?php _e('全局', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-index"><?php _e('首页', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-post"><?php _e('文章页', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-post-list"><?php _e('文章列表', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-title-bar"><?php _e('标题栏', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-drawer"><?php _e('抽屉菜单', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-footer"><?php _e('页脚', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-touch-bar-icon"><?php _e('Touch Bar 图标', 'mdx');?></a>
    <a href="#" class="nav-tab mdx-admin-nav" id="mdx-admin-nav-others"><?php _e('杂项', 'mdx');?></a>
</nav>
<form method="post" action="">
<?php
wp_nonce_field('mdx_options_update');
?>
<input type='hidden' name='mdx_ref' value='true'>
<table class="form-table">
<tbody class="mdx-admin-section mdx-admin-section-active" id="mdx-admin-nav-global-section">
    <tr>
    <th scope="row"><label for="mdx_styles"><?php _e('主题颜色', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_styles=mdx_get_option('mdx_styles');?>
    <select name="mdx_styles" id="mdx_styles">
        <option value="red" <?php if($mdx_v_styles=='red'){?>selected="selected"<?php }?>>Red</option>
        <option value="pink" <?php if($mdx_v_styles=='pink'){?>selected="selected"<?php }?>>Pink</option>
        <option value="purple" <?php if($mdx_v_styles=='purple'){?>selected="selected"<?php }?>>Purple</option>
        <option value="deep-purple" <?php if($mdx_v_styles=='deep-purple'){?>selected="selected"<?php }?>>Deep Purple</option>
        <option value="indigo" <?php if($mdx_v_styles=='indigo'){?>selected="selected"<?php }?>>Indigo</option>
        <option value="blue" <?php if($mdx_v_styles=='blue'){?>selected="selected"<?php }?>>Blue</option>
        <option value="light-blue" <?php if($mdx_v_styles=='light-blue'){?>selected="selected"<?php }?>>Light Blue</option>
        <option value="cyan" <?php if($mdx_v_styles=='cyan'){?>selected="selected"<?php }?>>Cyan</option>
        <option value="teal" <?php if($mdx_v_styles=='teal'){?>selected="selected"<?php }?>>Teal</option>
        <option value="green" <?php if($mdx_v_styles=='green'){?>selected="selected"<?php }?>>Green</option>
        <option value="light-green" <?php if($mdx_v_styles=='light-green'){?>selected="selected"<?php }?>>Light Green</option>
        <option value="lime" <?php if($mdx_v_styles=='lime'){?>selected="selected"<?php }?>>Lime</option>
        <option value="yellow" <?php if($mdx_v_styles=='yellow'){?>selected="selected"<?php }?>>Yellow</option>
        <option value="amber" <?php if($mdx_v_styles=='amber'){?>selected="selected"<?php }?>>Amber</option>
        <option value="orange" <?php if($mdx_v_styles=='orange'){?>selected="selected"<?php }?>>Orange</option>
        <option value="deep-orange" <?php if($mdx_v_styles=='deep-orange'){?>selected="selected"<?php }?>>Deep Orange</option>
        <option value="brown" <?php if($mdx_v_styles=='brown'){?>selected="selected"<?php }?>>Brown</option>
        <option value="grey" <?php if($mdx_v_styles=='grey'){?>selected="selected"<?php }?>>Grey</option>
        <option value="blue-grey" <?php if($mdx_v_styles=='blue-grey'){?>selected="selected"<?php }?>>Blue Grey</option>
        <option value="white" <?php if($mdx_v_styles=='white'){?>selected="selected"<?php }?>>White</option>
    </select>
    <p class="description"><span class="mdx-color-preview mdx-theme-color-preview"></span> <?php _e('主题颜色会影响所有页面的主色。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_styles_act"><?php _e('强调颜色', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_styles_act=mdx_get_option('mdx_styles_act');?>
    <select name="mdx_styles_act" id="mdx_styles_act">
        <option value="red" <?php if($mdx_v_styles_act=='red'){?>selected="selected"<?php }?>>Red</option>
        <option value="pink" <?php if($mdx_v_styles_act=='pink'){?>selected="selected"<?php }?>>Pink</option>
        <option value="purple" <?php if($mdx_v_styles_act=='purple'){?>selected="selected"<?php }?>>Purple</option>
        <option value="deep-purple" <?php if($mdx_v_styles_act=='deep-purple'){?>selected="selected"<?php }?>>Deep Purple</option>
        <option value="indigo" <?php if($mdx_v_styles_act=='indigo'){?>selected="selected"<?php }?>>Indigo</option>
        <option value="blue" <?php if($mdx_v_styles_act=='blue'){?>selected="selected"<?php }?>>Blue</option>
        <option value="light-blue" <?php if($mdx_v_styles_act=='light-blue'){?>selected="selected"<?php }?>>Light Blue</option>
        <option value="cyan" <?php if($mdx_v_styles_act=='cyan'){?>selected="selected"<?php }?>>Cyan</option>
        <option value="teal" <?php if($mdx_v_styles_act=='teal'){?>selected="selected"<?php }?>>Teal</option>
        <option value="green" <?php if($mdx_v_styles_act=='green'){?>selected="selected"<?php }?>>Green</option>
        <option value="light-green" <?php if($mdx_v_styles_act=='light-green'){?>selected="selected"<?php }?>>Light Green</option>
        <option value="lime" <?php if($mdx_v_styles_act=='lime'){?>selected="selected"<?php }?>>Lime</option>
        <option value="yellow" <?php if($mdx_v_styles_act=='yellow'){?>selected="selected"<?php }?>>Yellow</option>
        <option value="amber" <?php if($mdx_v_styles_act=='amber'){?>selected="selected"<?php }?>>Amber</option>
        <option value="orange" <?php if($mdx_v_styles_act=='orange'){?>selected="selected"<?php }?>>Orange</option>
        <option value="deep-orange" <?php if($mdx_v_styles_act=='deep-orange'){?>selected="selected"<?php }?>>Deep Orange</option>
    </select>
    <p class="description"><span class="mdx-color-preview mdx-accent-color-preview"></span> <?php _e('强调颜色会影响所有页面的强调色。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_styles_dark"><?php _e('黑暗主题', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_styles_dark=mdx_get_option('mdx_styles_dark');?>
    <select name="mdx_styles_dark" id="mdx_styles_dark">
        <option value="disable" <?php if($mdx_v_styles_dark=='disable'){?>selected="selected"<?php }?>><?php _e('禁用', 'mdx');?></option>
        <option value="dark" <?php if($mdx_v_styles_dark=='dark'){?>selected="selected"<?php }?>><?php _e('启用', 'mdx');?></option>
        <option value="oled" <?php if($mdx_v_styles_dark=='oled'){?>selected="selected"<?php }?>><?php _e('启用 (OLED)', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('如果启用，页面将忽略夜间模式相关设置并强制始终以黑暗主题显示。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('Material Design 2', 'mdx');?></th>
    <td>
    <?php $mdx_v_md2=mdx_get_option('mdx_md2');?>
        <fieldset>
        <label><input type="radio" class="md2" name="mdx_md2" value="true" <?php if($mdx_v_md2=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" class="md2" name="mdx_md2" value="false" <?php if($mdx_v_md2=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，主题将会使用 Material Design 2 风格。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr class="md2_font">
    <th scope="row"><?php _e('Material Design 2 字体', 'mdx');?></th>
    <td>
    <?php $mdx_v_md2_font=mdx_get_option('mdx_md2_font');?>
        <fieldset>
        <label><input type="radio" name="mdx_md2_font" value="true" <?php if($mdx_v_md2_font=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_md2_font" value="false" <?php if($mdx_v_md2_font=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，部分标题文字将会使用 Material Design 2 风格字体显示。<strong>请注意该字体仅包含拉丁字符。</strong>', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('移动 Chrome 标题栏颜色', 'mdx');?></th>
    <td>
    <?php $mdx_v_chrome_color=mdx_get_option('mdx_chrome_color');?>
        <fieldset>
        <label><input type="radio" name="mdx_chrome_color" value="true" <?php if($mdx_v_chrome_color=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_chrome_color" value="false" <?php if($mdx_v_chrome_color=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，移动 Chrome 访问时，其标题栏的背景颜色会随主题颜色变化。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('文章无特色图像时显示默认图像', 'mdx');?></th>
    <td>
    <?php $mdx_v_post_def_img=mdx_get_option('mdx_post_def_img');?>
        <fieldset>
        <label><input type="radio" name="mdx_post_def_img" value="true" <?php if($mdx_v_post_def_img=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_post_def_img" value="false" <?php if($mdx_v_post_def_img=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，文章无特色图像时将显示默认图像，影响文章列表和文章页。若关闭则不显示。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-index-section">
    <tr>
    <th scope="row"><label for="mdx_index_show"><?php _e('首页样式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_index_show=mdx_get_option('mdx_index_show');?>
    <select name="mdx_index_show" id="mdx_index_show">
        <option value="0" <?php if($mdx_v_index_show=='0'){?>selected="selected"<?php }?>><?php _e('默认', 'mdx');?></option>
        <option value="1" <?php if($mdx_v_index_show=='1'){?>selected="selected"<?php }?>><?php _e('简单', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_index_show=='2'){?>selected="selected"<?php }?>><?php _e('两栏', 'mdx');?></option>
        <!-- <option value="3" <?php if($mdx_v_index_show=='3'){?>selected="selected"<?php }?>><?php _e('现代', 'mdx');?></option> -->
        <option value="4" <?php if($mdx_v_index_show=='4'){?>selected="selected"<?php }?>><?php _e('朴素', 'mdx');?></option>
    </select>
    <div class="mdx-svg-preview" id="mdx-index-preview"></div>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('首页图片', 'mdx');?></th>
    <td>
    <input name="mdx_index_img" type="text" id="mdx_index_img" value="<?php echo esc_attr(mdx_get_option('mdx_index_img'))?>" class="regular-text" readonly="readonly" required="required">
    <button type="button" id="insert-media-button" class="button"><?php _e('选择图片', 'mdx');?></button> <button type="button" id="use-bing-api" class="button mdx_stbsip8"><?php _e('使用必应美图', 'mdx');?></button>
    <p class="description"><?php _e('你可以上传或指定你的媒体库中的图片作为首页上方显示的图片。<strong>注意，“简单”和“朴素”首页样式不会显示首页图片。</strong><br>无论你是否使用首页幻灯片，你都需要设定一张首页图片。<br>如使用必应美图，可在括号内指定图片的日期。0为今日图片，-1为明日准备使用的图片，1为昨日的图片，以此类推，最多到前16日。', 'mdx');?></p>
    <img id="img1" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('增加首页图片文字对比度', 'mdx');?></th>
    <td>
    <?php $mdx_v_index_img_bg=mdx_get_option('mdx_index_img_bg');?>
    <fieldset>
        <label><input type="radio" name="mdx_index_img_bg" value="true" <?php if($mdx_v_index_img_bg=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_index_img_bg" value="false" <?php if($mdx_v_index_img_bg=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('在首页图片中含大面积白色导致首页格言无法看清时启用此选项。在部分首页样式下不生效。', 'mdx');?></p>
    </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('首页头部展示内容', 'mdx');?></th>
    <td>
    <?php $mdx_v_index_head_style=mdx_get_option('mdx_index_head_style');?>
    <fieldset>
        <label><input class="mdx-index-head-style-input" type="radio" name="mdx_index_head_style" value="saying" <?php if($mdx_v_index_head_style=='saying'){?>checked="checked"<?php }?>> <?php _e('格言', 'mdx');?></label><br>
        <label><input class="mdx-index-head-style-input" type="radio" name="mdx_index_head_style" value="slide" <?php if($mdx_v_index_head_style=='slide'){?>checked="checked"<?php }?>> <?php _e('幻灯片', 'mdx');?></label><br>
        <p class="description"><?php _e('指定首页头部展示的内容。在下方进行详细设置。', 'mdx');?></p>
    </fieldset>
    </td>
    </tr>
    <tr class="mdx_index_head_style_saying">
    <th scope="row"><?php _e('首页格言', 'mdx');?></th>
    <td>
    <input name="mdx_index_say" type="text" id="mdx_index_say" value="<?php echo esc_attr(mdx_get_option('mdx_index_say'))?>" class="regular-text mdx_index_head_style">
    <p class="description"><?php _e('这句话会展示在首页。', 'mdx');?></p>
    </td>
    </tr>
    <tr class="mdx_index_head_style_saying">
    <th scope="row"><label for="mdx_index_say_size"><?php _e('首页格言字体大小', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_index_say_size=mdx_get_option('mdx_index_say_size');?>
    <select name="mdx_index_say_size" id="mdx_index_say_size">
        <option value="1" <?php if($mdx_v_index_say_size=='1'){?>selected="selected"<?php }?>>H1</option>
        <option value="2" <?php if($mdx_v_index_say_size=='2'){?>selected="selected"<?php }?>>H2</option>
        <option value="3" <?php if($mdx_v_index_say_size=='3'){?>selected="selected"<?php }?>>H3</option>
        <option value="4" <?php if($mdx_v_index_say_size=='4'){?>selected="selected"<?php }?>>H4</option>
        <option value="5" <?php if($mdx_v_index_say_size=='5'){?>selected="selected"<?php }?>>H5</option>
        <option value="6" <?php if($mdx_v_index_say_size=='6'){?>selected="selected"<?php }?>>H6</option>
    </select>
    <p class="description"><?php _e('字体大小由 H1 至 H6 依次变小。在部分首页样式中无效。', 'mdx');?></p>
    </td>
    </tr>
    <tr class="mdx_index_head_style_slide">
    <th scope="row"><label for="mdx_index_slide_posts_style"><?php _e('首页幻灯片样式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_index_slide_posts_style=mdx_get_option('mdx_index_slide_posts_style');?>
    <select name="mdx_index_slide_posts_style" id="mdx_index_slide_posts_style">
        <option value="1" <?php if($mdx_v_index_slide_posts_style=='1'){?>selected="selected"<?php }?>><?php _e('居中', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_index_slide_posts_style=='2'){?>selected="selected"<?php }?>><?php _e('现代', 'mdx');?></option>
        <option value="3" <?php if($mdx_v_index_slide_posts_style=='3'){?>selected="selected"<?php }?>><?php _e('朴素', 'mdx');?></option>
    </select>
    </td>
    </tr>
    <tr class="mdx_index_head_style_slide">
    <th scope="row"><label for="mdx_index_slide_posts_num"><?php _e('首页幻灯片文章数量', 'mdx');?></label></th>
    <td><input name="mdx_index_slide_posts_num" type="text" id="mdx_index_slide_posts_num" value="<?php echo esc_attr(mdx_get_option('mdx_index_slide_posts_num'))?>" class="regular-text">
    <p class="description"><?php _e('在此设定首页幻灯片文章篇数。请输入整数。', 'mdx');?></p></td>
    </tr>
    <tr class="mdx_index_head_style_slide">
    <th scope="row"><?php _e('首页幻灯片文章获取方式', 'mdx');?></th>
    <td>
    <?php $mdx_v_index_slide_posts_get=mdx_get_option('mdx_index_slide_posts_get');?>
        <fieldset>
        <label><input type="radio" class="mdx_index_get" name="mdx_index_slide_posts_get" value="cat" <?php if($mdx_v_index_slide_posts_get=='cat'){?>checked="checked"<?php }?>> <?php _e('某一分类', 'mdx');?></label><br>
        <label><input type="radio" class="mdx_index_get" name="mdx_index_slide_posts_get" value="sticky" <?php if($mdx_v_index_slide_posts_get=='sticky'){?>checked="checked"<?php }?>> <?php _e('置顶文章', 'mdx');?></label><br>
        <p class="description"><?php _e('在此设定首页幻灯片文章的获取方式。<br>若选择置顶文章，当没有置顶文章时，将会显示首页图片，同时文章列表将保持原始顺序而不会被置顶文章打乱。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr class="mdx_index_head_style_slide">
    <th scope="row"><label for="mdx_index_slide_posts_cat"><?php _e('首页幻灯片文章分类名', 'mdx');?></label></th>
    <td><input name="mdx_index_slide_posts_cat" type="text" id="mdx_index_slide_posts_cat" value="<?php echo esc_attr(mdx_get_option('mdx_index_slide_posts_cat'))?>" class="regular-text">
    <p class="description"><?php _e('在此设定首页幻灯片文章的分类名。当分类不存在时，将显示最新文章。', 'mdx');?></p></td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-post-section">
    <tr>
    <th scope="row"><label for="mdx_post_style"><?php _e('文章页样式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_post_style=mdx_get_option('mdx_post_style');?>
    <select name="mdx_post_style" id="mdx_post_style">
        <option value="0" <?php if($mdx_v_post_style=='0'){?>selected="selected"<?php }?>><?php _e('标准', 'mdx');?></option>
        <option value="1" <?php if($mdx_v_post_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_post_style=='2'){?>selected="selected"<?php }?>><?php _e('通透', 'mdx');?></option>
        <option value="3" <?php if($mdx_v_post_style=='3'){?>selected="selected"<?php }?>><?php _e('朴素', 'mdx');?></option>
    </select>
    <div class="mdx-svg-preview" id="mdx-post-preview"></div>
    <p class="description"><?php _e('同时影响文章页、单独页面的样式。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_post_time_positon"><?php _e('文章时间显示位置', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_post_time_positon=mdx_get_option('mdx_post_time_positon');?>
    <select name="mdx_post_time_positon" id="mdx_post_time_positon">
        <option value="title" <?php if($mdx_v_post_time_positon=='title'){?>selected="selected"<?php }?>><?php _e('标题旁', 'mdx');?></option>
        <option value="foot" <?php if($mdx_v_post_time_positon=='foot'){?>selected="selected"<?php }?>><?php _e('文章末尾', 'mdx');?></option>
        <option value="none" <?php if($mdx_v_post_time_positon=='none'){?>selected="selected"<?php }?>><?php _e('不显示', 'mdx');?></option>
    </select>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_post_nav_style"><?php _e('文章导航栏配色方案', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_post_nav_style=mdx_get_option('mdx_post_nav_style');?>
    <select name="mdx_post_nav_style" id="mdx_post_nav_style">
        <option value="0" <?php if($mdx_v_post_nav_style=='0'){?>selected="selected"<?php }?>><?php _e('主题色', 'mdx');?></option>
        <option value="1" <?php if($mdx_v_post_nav_style=='1'){?>selected="selected"<?php }?>><?php _e('低饱和度', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('影响文章末尾文章导航栏区域的配色。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
        <th scope="row"><label for="mdx_say_after"><?php _e('文末信息', 'mdx');?></label></th>
        <td><textarea name="mdx_say_after" id="mdx_say_after" rows="7" cols="50"><?php echo mdx_get_option('mdx_say_after')?></textarea>
        <p class="description"><?php _e('在这里编辑文末信息。文末信息会显示在每篇文章的底部，留空则不会显示。支持 <code>HTML</code> 格式。<code>--PostLink--</code> 会被替换为链接到当前文章的文章标题，<code>--PostURL--</code> 会被替换为链接到当前文章的当前文章 URL（大小写敏感）。', 'mdx');?></p></td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-post-list-section">
    <tr>
    <th scope="row"><label for="mdx_default_style"><?php _e('文章列表样式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_default_style=mdx_get_option('mdx_default_style');?>
    <select name="mdx_default_style" id="mdx_default_style">
        <option value="1" <?php if($mdx_v_default_style=='1'){?>selected="selected"<?php }?>><?php _e('简洁', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_default_style=='2'){?>selected="selected"<?php }?>><?php _e('列表', 'mdx');?></option>
        <option value="3" <?php if($mdx_v_default_style=='3'){?>selected="selected"<?php }?>><?php _e('干净', 'mdx');?></option>
        <option value="4" <?php if($mdx_v_default_style=='4'){?>selected="selected"<?php }?>><?php _e('网格', 'mdx');?></option>
        <option value="5" <?php if($mdx_v_default_style=='5'){?>selected="selected"<?php }?>><?php _e('朴素', 'mdx');?></option>
        <!-- <option value="6" <?php if($mdx_v_default_style=='6'){?>selected="selected"<?php }?>><?php _e('现代', 'mdx');?></option> -->
    </select>
    <div class="mdx-svg-preview" id="mdx-list-preview"></div>
    <p class="description"><?php _e('同时影响首页、搜索结果页、归档页的文章列表样式。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('文章列表宽度', 'mdx');?></th>
    <td>
    <?php $mdx_v_post_list_width=mdx_get_option('mdx_post_list_width');?>
        <fieldset>
        <label><input type="radio" name="mdx_post_list_width" value="normal" <?php if($mdx_v_post_list_width=='normal'){?>checked="checked"<?php }?>> <?php _e('正常', 'mdx');?></label><br>
        <label><input type="radio" name="mdx_post_list_width" value="wide" <?php if($mdx_v_post_list_width=='wide'){?>checked="checked"<?php }?>> <?php _e('较宽', 'mdx');?></label><br>
        </fieldset>
        <p class="description"><?php _e('使用“较宽”，文章列表将会以多列瀑布流显示。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('文章列表显示文章摘要', 'mdx');?></th>
    <td>
    <?php $mdx_v_echo_post_sum=mdx_get_option('mdx_echo_post_sum');?>
        <fieldset>
        <label><input type="radio" name="mdx_echo_post_sum" value="true" <?php if($mdx_v_echo_post_sum=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_echo_post_sum" value="false" <?php if($mdx_v_echo_post_sum=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，文章列表可显示每篇文章的摘要，影响首页和归档页。若关闭则不显示。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_post_list_img_height"><?php _e('文章列表图片高度', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_post_list_img_height=mdx_get_option('mdx_post_list_img_height');?>
    <select name="mdx_post_list_img_height" id="mdx_post_list_img_height">
        <option value="auto" <?php if($mdx_v_post_list_img_height=='auto'){?>selected="selected"<?php }?>><?php _e('自适应', 'mdx');?></option>
        <option value="fixed" <?php if($mdx_v_post_list_img_height=='fixed'){?>selected="selected"<?php }?>><?php _e('固定宽高比', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('选择 <code>自适应</code>，文章特色图像可以完全展示。<br>选择 <code>固定宽高比</code>，文章特色图像可能会只显示部分以保持宽高比，但图像不会被拉伸，适合于图像过宽/过高的情况。', 'mdx');?></p>
    </td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-title-bar-section">
    <tr>
    <th scope="row"><?php _e('自动隐藏标题栏', 'mdx');?></th>
    <td>
    <?php $mdx_v_title_bar=mdx_get_option('mdx_title_bar');?>
        <fieldset>
        <label><input type="radio" name="mdx_title_bar" value="true" <?php if($mdx_v_title_bar=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_title_bar" value="false" <?php if($mdx_v_title_bar=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，页面向下滚动时标题栏会向上隐藏，向上滚动时会出现。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_logo_way"><?php _e('标题栏显示内容', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_logo_way=mdx_get_option('mdx_logo_way');?>
    <select name="mdx_logo_way" id="mdx_logo_way" onchange="mdx_logo_sec(this.options[this.options.selectedIndex].value)">
        <option value="1" <?php if($mdx_v_logo_way=='1'){?>selected="selected"<?php }?>><?php _e('博客名称', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_logo_way=='2'){?>selected="selected"<?php }?>><?php _e('自定义 Logo', 'mdx');?></option>
        <option value="3" <?php if($mdx_v_logo_way=='3'){?>selected="selected"<?php }?>><?php _e('自定义名称', 'mdx');?></option>
    </select>
    </td>
    </tr>
    <tr class="logo_logo">
    <th scope="row"><?php _e('标题栏 Logo', 'mdx');?></th>
    <td>
    <input name="mdx_logo" type="url" id="mdx_logo" value="<?php echo esc_attr(mdx_get_option('mdx_logo'))?>" class="regular-text">
    <button type="button" id="insert-media-button-2" class="button"><?php _e('选择图片', 'mdx');?></button>
    <p class="description"><?php _e('选择一张图片作为网站 Logo。', 'mdx');?></p>
    <img id="img4" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
    </td>
    </tr>
    <tr class="logo_text">
    <th scope="row"><?php _e('标题栏自定义名称', 'mdx');?></th>
    <td>
    <input name="mdx_logo_text" type="text" id="mdx_logo_text" value="<?php echo esc_attr(mdx_get_option('mdx_logo_text'))?>" class="regular-text">
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('点击标题栏返回顶部', 'mdx');?></th>
    <td>
    <?php $mdx_v_tap_to_top=mdx_get_option('mdx_tap_to_top');?>
        <fieldset>
        <label><input type="radio" name="mdx_tap_to_top" value="true" <?php if($mdx_v_tap_to_top=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_tap_to_top" value="false" <?php if($mdx_v_tap_to_top=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，点击标题栏可以返回页面顶部。此设置影响所有页面。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-drawer-section">
    <tr>
    <th scope="row"><?php _e('抽屉菜单顶部展示个人信息', 'mdx');?></th>
    <td>
    <?php $mdx_v_side_info=mdx_get_option('mdx_side_info');?>
        <fieldset>
        <label><input class="mdx_stbs2" type="radio" name="mdx_side_info" value="true" <?php if($mdx_v_side_info=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input class="mdx_stbs2" type="radio" name="mdx_side_info" value="false" <?php if($mdx_v_side_info=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，抽屉顶部会显示头像及名称，请在下方设置。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('抽屉菜单顶部图片', 'mdx');?></th>
    <td>
    <input name="mdx_side_img" type="url" id="mdx_side_img" value="<?php echo esc_attr(mdx_get_option('mdx_side_img'))?>" class="regular-text mdx_stbsip2" readonly="readonly">
    <button type="button" id="insert-media-button-3" class="button mdx_stbsip22"><?php _e('选择图片', 'mdx');?></button>
    <img id="img2" style="width:100%;max-width:300px;height:auto;margin-top:5px;"></img>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('抽屉菜单信息头像', 'mdx');?></th>
    <td>
    <input name="mdx_side_head" type="url" id="mdx_side_head" value="<?php echo esc_attr(mdx_get_option('mdx_side_head'))?>" class="regular-text mdx_stbsip22">
    <button type="button" id="insert-media-button-4" class="button mdx_stbsip1 mdx_stbsip22"><?php _e('选择图片', 'mdx');?></button>
    <p class="description"><?php _e('选择一张图片作为抽屉顶部显示的头像。留空则不显示。', 'mdx');?></p>
    <img id="img3" style="width:100%;max-width:300px;height:auto;margin-top:5px;;margin-top:5px;"></img>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('抽屉菜单信息名称', 'mdx');?></th>
    <td>
    <input name="mdx_side_name" type="text" id="mdx_side_name" value="<?php echo esc_attr(mdx_get_option('mdx_side_name'))?>" class="regular-text mdx_stbsip2" required="required">
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('抽屉菜单详细信息', 'mdx');?></th>
    <td>
    <input name="mdx_side_more" type="text" id="mdx_side_more" value="<?php echo esc_attr(mdx_get_option('mdx_side_more'))?>" class="regular-text mdx_stbsip2" required="required">
    <p class="description"><?php _e('这里的内容会显示在抽屉菜单信息名称的下方。', 'mdx');?></p>
    </td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-footer-section">
    <tr>
    <th scope="row"><label for="mdx_styles_footer"><?php _e('页脚样式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_styles_footer=mdx_get_option('mdx_styles_footer');?>
    <select name="mdx_styles_footer" id="mdx_styles_footer">
        <option value="1" <?php if($mdx_v_styles_footer=='1'){?>selected="selected"<?php }?>><?php _e('传统', 'mdx');?></option>
        <option value="2" <?php if($mdx_v_styles_footer=='2'){?>selected="selected"<?php }?>><?php _e('简单', 'mdx');?></option>
        <option value="3" <?php if($mdx_v_styles_footer=='3'){?>selected="selected"<?php }?>><?php _e('现代', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('在此设定页脚样式。<strong>如果选择“简单”样式，那么页脚格言将不会显示。</strong>', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_footer_say"><?php _e('页脚格言', 'mdx');?></label></th>
    <td><input class="regular-text" name="mdx_footer_say" type="text" id="mdx_footer_say" value="<?php echo esc_attr(mdx_get_option('mdx_footer_say'))?>">
    <button type="button" id="use-api" class="button mdx_stbsip7"><?php _e('使用一言 API（常规）', 'mdx');?></button>
    <button type="button" id="use-api2" class="button mdx_stbsip7"><?php _e('使用一言 API（古诗词）', 'mdx');?></button>
    <button type="button" id="use-api3" class="button mdx_stbsip7"><?php _e('使用一言 API（自定义）', 'mdx');?></button>
    <p class="description" id="mdx_footer"><?php _e('这句话会显示在每个页面的页脚，如果不希望显示，请留空。若调用一言 API，则每次页面刷新后都会显示不同的格言。此 API 来自第三方，请注意安全风险。', 'mdx');?></p>
    <p class="description" id="mdx_custom_api"><?php _e('如使用自定义 API，你需要在括号内填写 API URL 并确保 API 返回 <code>{"text":"句子"}</code> 的 JSON 格式。<a href="https://doc.flyhigher.top/mdx/zh-CN/config/custom_api/" target="_blank">详细信息</a></code>', 'mdx');?></p></td>
    </tr>
    <tr>
        <th scope="row"><label for="mdx_footer"><?php _e('页脚内容', 'mdx');?></label></th>
        <td><textarea name="mdx_footer" id="mdx_footer" rows="7" cols="50"><?php echo mdx_get_option('mdx_footer')?></textarea><br><a class="thickbox button" title="<?php _e('社交网站图标编辑器', 'mdx');?>" href="#TB_inline?height=100%&width=100%&inlineId=social-network-editor" style="margin-top: 5px;"><?php _e('社交网站图标编辑器', 'mdx');?></a>
        <p class="description"><?php _e('在这里编辑页脚内容。支持 <code>HTML</code> 格式。', 'mdx');?></p></td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-touch-bar-icon-section">
    <tr>
    <th scope="row"><?php _e('Safari Touch Bar 图标支持', 'mdx');?></th>
    <td>
    <?php $mdx_v_safari=mdx_get_option('mdx_safari');?>
        <fieldset>
        <label><input class="mdx_stbs" type="radio" name="mdx_safari" value="true" <?php if($mdx_v_safari=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input class="mdx_stbs" type="radio" name="mdx_safari" value="false" <?php if($mdx_v_safari=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        </fieldset>
        <p class="description"><?php _e('开启后会启用对 Safari Touch Bar 图标的支持，请在下方完成相关设置。<a href="https://developer.apple.com/library/content/documentation/AppleApplications/Reference/SafariWebContent/pinnedTabs/pinnedTabs.html" target="_blank">详细了解</a>', 'mdx');?>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_svg"><?php _e('Touch Bar 图标地址', 'mdx');?></label></th>
    <td><input class="mdx_stbsip regular-text mdx_stbsip3" name="mdx_svg" type="text" id="mdx_svg" value="<?php echo esc_attr(mdx_get_option('mdx_svg'))?>" required="required">
    <p class="description" id="mdx_footer"><?php _e('请设置 Touch Bar 图标地址。格式为 SVG，必须为单层，viewbox 属性必须为"0 0 16 16"。', 'mdx');?></p></td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_svg_color"><?php _e('Touch Bar 图标背景颜色', 'mdx');?></label></th>
    <td><input class="mdx_stbsip regular-text mdx_stbsip3" name="mdx_svg_color" type="text" id="mdx_svg_color" value="<?php echo esc_attr(mdx_get_option('mdx_svg_color'))?>" required="required"><br>
    <a id="change-color" class="button mdx_stbsip5" href="javascript:jQuery('#mdx_svg_color').val('<?php echo mdx_get_option('mdx_styles_hex');?>');jQuery('#mdx_svg_color').wpColorPicker('color', '<?php echo mdx_get_option('mdx_styles_hex');?>');"><?php _e('使用当前主题颜色', 'mdx');?></a>
    <p class="description" id="mdx_footer"><?php _e('请设置 Touch Bar 图标背景颜色。16 进制颜色或 RGB 颜色。', 'mdx');?></p></td>
    </tr>
</tbody>

<tbody class="mdx-admin-section" id="mdx-admin-nav-others-section">
    <tr>
    <th scope="row"><?php _e('登录页 Material Design', 'mdx');?></th>
    <td>
    <?php $mdx_v_login_md=mdx_get_option('mdx_login_md');?>
        <fieldset>
        <label><input type="radio" name="mdx_login_md" value="true" <?php if($mdx_v_login_md=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_login_md" value="false" <?php if($mdx_v_login_md=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('将 Material Design 样式应用到登录页。可能与部分插件样式不兼容。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('启用友链 Gravatar 支持', 'mdx');?></th>
    <td>
    <?php $mdx_v_gravatar_actived = mdx_get_option('mdx_gravatar_actived'); ?>
        <fieldset>
        <label><input type="radio" name="mdx_gravatar_actived" value="true" <?php if($mdx_v_gravatar_actived=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_gravatar_actived" value="false" <?php if($mdx_v_gravatar_actived=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，将尝试从备注栏中获取邮箱并将与邮箱对应的 Gravatar 头像作为友情链接图像。关闭则只使用图片链接。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('友情链接随机顺序', 'mdx');?></th>
    <td>
    <?php $mdx_v_link_rand_order = mdx_get_option('mdx_link_rand_order'); ?>
        <fieldset>
        <label><input type="radio" name="mdx_link_rand_order" value="true" <?php if($mdx_v_link_rand_order=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_link_rand_order" value="false" <?php if($mdx_v_link_rand_order=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，友情链接将以随机顺序显示。关闭则使用字典序。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
    <tr>
    <th scope="row"><label for="mdx_title_med"><?php _e('网页标题计算方式', 'mdx');?></label></th>
    <td>
    <?php $mdx_v_title_med=mdx_get_option('mdx_title_med');?>
    <select name="mdx_title_med" id="mdx_title_med">
        <option value="wp" <?php if($mdx_v_title_med=='wp'){?>selected="selected"<?php }?>><?php _e('WordPress 默认', 'mdx');?></option>
        <option value="diy" <?php if($mdx_v_title_med=='diy'){?>selected="selected"<?php }?>><?php _e('MDx 优化', 'mdx');?></option>
    </select>
    <p class="description"><?php _e('选择 <code>WordPress 默认</code>，WordPress 会接管网页标题的内容，此方式兼容大部分 SEO 插件。<br>选择 <code>MDx 优化</code>，MDx 会接管网页标题的内容，此方式在部分情况下更合适，但不兼容 SEO 插件。', 'mdx');?></p>
    </td>
    </tr>
    <tr>
    <th scope="row"><?php _e('多彩标签云', 'mdx');?></th>
    <td>
    <?php $mdx_v_tags_color=mdx_get_option('mdx_tags_color');?>
        <fieldset>
        <label><input type="radio" name="mdx_tags_color" value="true" <?php if($mdx_v_tags_color=='true'){?>checked="checked"<?php }?>> <?php echo $trueon;?></label><br>
        <label><input type="radio" name="mdx_tags_color" value="false" <?php if($mdx_v_tags_color=='false'){?>checked="checked"<?php }?>> <?php echo $falseoff;?></label><br>
        <p class="description"><?php _e('开启后，标签云页面输出的标签会带有随机颜色，反之为同一颜色。', 'mdx');?></p>
        </fieldset>
    </td>
    </tr>
</tbody>
</table>
<div id="social-network-editor" style="display:none;">
<br>
<p class="description"><?php _e('在这里获取受 MDx 样式支持的社交网站图标链接。填写完成之后，你可以将获取到的代码粘贴到包括页脚内容在内的任何地方或是自定义代码内容。未填写的项目将被忽略。', 'mdx');?></p>
<table class="form-table">
<tr>
<th scope="row"><label for="mdx_sn_qq"><?php _e('QQ', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_qq" type="text" id="mdx_sn_qq" value="" placeholder="<?php _e('QQ 号', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('QQ', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_wechat"><?php _e('微信', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_wechat" type="text" id="mdx_sn_wechat" value="" placeholder="<?php _e('微信二维码图片链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('微信', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_weibo"><?php _e('微博', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_weibo" type="text" id="mdx_sn_weibo" value="" placeholder="<?php _e('微博链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('微博', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_zhihu"><?php _e('知乎', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_zhihu" type="text" id="mdx_sn_zhihu" value="" placeholder="<?php _e('知乎链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('知乎', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_bilibili"><?php _e('哔哩哔哩', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_bilibili" type="text" id="mdx_sn_bilibili" value="" placeholder="<?php _e('哔哩哔哩链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('哔哩哔哩', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_neteasemusic"><?php _e('网易云音乐', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_neteasemusic" type="text" id="mdx_sn_neteasemusic" value="" placeholder="<?php _e('网易云音乐链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('网易云音乐', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_coolapk"><?php _e('酷安', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_coolapk" type="text" id="mdx_sn_coolapk" value="" placeholder="<?php _e('酷安链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('酷安', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_douban"><?php _e('豆瓣', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_douban" type="text" id="mdx_sn_douban" value="" placeholder="<?php _e('豆瓣链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('豆瓣', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_github"><?php _e('GitHub', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_github" type="text" id="mdx_sn_github" value="" placeholder="<?php _e('GitHub 用户名', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('GitHub', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_facebook"><?php _e('Facebook', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_facebook" type="text" id="mdx_sn_facebook" value="" placeholder="<?php _e('Fackbook 链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Facebook', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_twitter"><?php _e('Twitter', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_twitter" type="text" id="mdx_sn_twitter" value="" placeholder="<?php _e('Twitter 用户名', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Twitter', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_telegram"><?php _e('Telegram', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_telegram" type="text" id="mdx_sn_telegram" value="" placeholder="<?php _e('Telegram 用户名', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Telegram', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_steam"><?php _e('Steam', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_steam" type="text" id="mdx_sn_steam" value="" placeholder="<?php _e('Steam 用户名', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Steam', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_whatsapp"><?php _e('WhatsApp', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_whatsapp" type="text" id="mdx_sn_whatsapp" value="" placeholder="<?php _e('WhatsApp 链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('WhatsApp', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_instagram"><?php _e('Instagram', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_instagram" type="text" id="mdx_sn_instagram" value="" placeholder="<?php _e('Instagram 链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Instagram', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_dribbble"><?php _e('Dribbble', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_dribbble" type="text" id="mdx_sn_dribbble" value="" placeholder="<?php _e('Dribbble 链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Dribbble', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_behance"><?php _e('Behance', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_behance" type="text" id="mdx_sn_behance" value="" placeholder="<?php _e('Behance 链接', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('Behance', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_tel"><?php _e('电话', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_tel" type="text" id="mdx_sn_tel" value="" placeholder="<?php _e('电话号码', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('电话', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_email"><?php _e('邮箱', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_email" type="text" id="mdx_sn_email" value="" placeholder="<?php _e('邮箱地址', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('邮箱', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_personalpage"><?php _e('个人主页', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_personalpage" type="text" id="mdx_sn_personalpage" value="" placeholder="<?php _e('个人主页地址', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('个人主页', 'mdx');?>"></td>
</tr>
<tr>
<th scope="row"><label for="mdx_sn_rss"><?php _e('RSS', 'mdx');?></label></th>
<td><input class="regular-text" name="mdx_sn_rss" type="text" id="mdx_sn_rss" value="" placeholder="<?php _e('RSS 地址', 'mdx');?>" oninput="input_onchange()" data-alt="<?php _e('RSS', 'mdx');?>"></td>
</tr>
<tr>
    <th scope="row"><label for="mdx_sn_result"><?php _e('生成结果', 'mdx');?></label></th>
    <td><textarea name="mdx_sn_result" id="mdx_sn_result" rows="10" cols="53" readonly></textarea></td>
</tr>
</table>
<script>
function input_onchange(ele){
    var html_str = "";
    for(ele of jQuery("#TB_ajaxContent .regular-text")){
        if(jQuery(ele).val() !== ""){
            if(jQuery(ele).attr("id") === "mdx_sn_qq"){
                html_str += '<!-- qq -->\n<i class="mdx-sn-icon mdx_sn_qq" mdui-tooltip="{content: \''+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_wechat"){
                html_str += '<!-- wechat -->\n<span style="--background:url('+jQuery(ele).val()+')" class="mdx-sn-wechat-qr"><i class="mdx-sn-icon mdx_sn_wechat" title="'+jQuery(ele)[0].dataset.alt+'"> </i></span>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_tel"){
                html_str += '<!-- tel -->\n<a href="tel:'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_tel" mdui-tooltip="{content: \''+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_github"){
                html_str += '<!-- github -->\n<a href="https://github.com/'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_github" mdui-tooltip="{content: \'@'+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_twitter"){
                html_str += '<!-- twitter -->\n<a href="https://twitter.com/'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_twitter" mdui-tooltip="{content: \'@'+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_telegram"){
                html_str += '<!-- telegram -->\n<a href="https://t.me/'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_telegram" mdui-tooltip="{content: \'@'+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_steam"){
                html_str += '<!-- steam -->\n<a href="https://steamcommunity.com/id/'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_steam" mdui-tooltip="{content: \''+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else if(jQuery(ele).attr("id") === "mdx_sn_email"){
                html_str += '<!-- email -->\n<a href="mailto:'+jQuery(ele).val()+'"><i class="mdx-sn-icon mdx_sn_email" mdui-tooltip="{content: \''+jQuery(ele).val()+'\', position: \'top\'}" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }else{
                html_str += '<!-- '+jQuery(ele).attr("id").split("_").pop()+' -->\n<a href="'+jQuery(ele).val()+'"><i class="mdx-sn-icon '+jQuery(ele).attr("id")+'" title="'+jQuery(ele)[0].dataset.alt+'"> </i></a>\n';
            }
        }
    }
    jQuery("#mdx_sn_result").text(html_str);
}
</script>
</div><?php submit_button(); ?></form></div>