<?php
    if(post_password_required()){
        return;
    }
?>

<?php if(comments_open()):?>
<?php if(get_option('comment_registration') && !$user_ID):?>
<p class="mdx-comment-login-needed mdui-typo"><?php printf(__('你需要先 <a href="%s">登录</a> 才能发表评论。','mdx'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
<?php else:
if(function_exists('alu_get_wpsmiliestrans') && (mdx_get_option('mdx_comment_emj')=="true")){
            $mdx_alu = '<div class="mdx-emj">'.alu_get_wpsmiliestrans().'</div>';
            $mdx_emj_cla = ' mdx-emj-inp';
            $mdx_emj_ele = '<i class="mdui-icon material-icons mdx-emj-cli">&#xe420;</i>';
        }else{
            $mdx_alu = '';
            $mdx_emj_cla = '';
            $mdx_emj_ele = '';
        }?>
<?php
$submit_text = mdx_get_option('mdx_submit_comment');
$defaults = array(
        'comment_notes_before'=>'',
        'label_submit'=>isset($submit_text) ? esc_attr($submit_text) : __('发射', 'mdx'),
        'comment_notes_after'=>'',
        'id_form'=>'commentform',
        'cancel_reply_link'=>__('取消回复', 'mdx'),
        'comment_field'=>'<div class="mdx-comment-main-input mdui-textfield mdui-textfield-floating-label'.$mdx_emj_cla.'"><i class="mdui-icon material-icons">textsms</i><label class="mdui-textfield-label">'.__('说点什么...','mdx').'</label><textarea class="mdui-textfield-input" name="comment" id="comment"></textarea></div>'.$mdx_emj_ele.$mdx_alu,
        'fields'=>apply_filters('comment_form_default_fields', array(
                'author'=>'<div class="mdui-textfield mdui-textfield-floating-label disfir disfirleft"><i class="mdui-icon material-icons">account_circle</i><label class="mdui-textfield-label">'.__('昵称','mdx').'</label><input class="mdui-textfield-input" type="text" id="author" name="author" value="'.esc_attr($comment_author).'" '.($req?"required":'').'><div class="mdui-textfield-error" role="alert">'.__('昵称不能为空', 'mdx').'</div></div>',

                'email'=>'<div class="mdui-textfield mdui-textfield-floating-label disfir disfirright"><i class="mdui-icon material-icons">email</i><label class="mdui-textfield-label">'.__('邮箱','mdx').'</label><input class="mdui-textfield-input" type="email" id="email" name="email" value="'.esc_attr($comment_author_email).'" '.($req?"required":'').'><div class="mdui-textfield-error" role="alert">'.__('请按格式填写邮箱', 'mdx').'</div></div>',

                'url'=>'<div class="mdui-textfield mdui-textfield-floating-label commurl"><i class="mdui-icon material-icons">&#xe157;</i><label class="mdui-textfield-label">'.__('网站（如果有）http(s)://','mdx').'</label><input class="mdui-textfield-input" type="url" id="url" name="url" value="'.esc_attr($comment_author_url).'"></div>',
        )));
        comment_form($defaults);
        
endif;?>

<?php if(comments_open()):?>
<div class="comms mdui-center" id="comments">
<?php if(have_comments()){?>
<ul class="mdui-list ajax-comments">
<?php wp_list_comments('type=comment&callback=mdx_comment_format'); ?>    
</ul>
<?php }?>
<?php if(have_comments()){?>
<nav id="comments-navi">
    <?php paginate_comments_links('prev_text=<i class="mdui-icon material-icons">navigate_before</i>&next_text=<i class="mdui-icon material-icons">navigate_next</i>');?>
</nav>
<?php }?>
<div class="mdx-comments-loading"><div class="mdui-valign"><div><div class="mdui-spinner"></div></div></div></div>
</div>
<?php endif;?>
<?php endif;?>