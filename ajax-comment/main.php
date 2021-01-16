<?php
define('AC_VERSION','2.0.0');

if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	wp_die('请升级到 4.4 以上版本');
}

if(!function_exists('fa_ajax_comment_err')) :
    function fa_ajax_comment_err($a) {
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $a;
        exit;
    }
endif;

if(!function_exists('fa_ajax_comment_callback')) :
    function fa_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if ( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( ! empty( $data ) ) {
            	fa_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        setcookie("mdx_recently_commented", "true", time()+900);
        $GLOBALS['comment'] = $comment;
        ?>
        <li class="mdui-list-item">
    <div class="mdui-list-item-avatar"><?php echo get_avatar($comment, $size = '80')?></div>
    <div class="mdui-list-item-content outbu" id="comment-82">
    <div class="mdui-list-item-title"><?php echo get_comment_author_link();?></div>
    <div class="mdui-list-item-text mdui-typo"><?php comment_text();?>
    </div><span class="mdx-reply-time"><?php _e('刚刚','mdx');?></span></div></li><li class="mdui-divider-inset mdui-m-y-0"></li>
        <?php die();
    }
endif;

add_action('wp_ajax_nopriv_ajax_comment', 'fa_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'fa_ajax_comment_callback');