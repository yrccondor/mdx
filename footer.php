<?php mdx_get_option('mdx_widget') === "true" ? $mdx_widget = true : $mdx_widget = false;?>
<button class="mdui-fab mdui-color-theme-accent mdui-fab-fixed mdui-fab-hide scrollToTop mdui-ripple<?php if($mdx_widget){?> mdx-tools-up<?php }?>"><i class="mdui-icon material-icons">&#xe316;</i></button>
<?php if($mdx_widget){?><button class="mdui-fab mdui-color-theme-accent mdui-fab-fixed mdui-ripple" mdui-drawer="{target:'#mdx-right-drawer',overlay:true,swipe:true}"><i class="mdui-icon material-icons">&#xe5c3;</i></button><?php }?>
<?php if(!empty(mdx_get_option("mdx_cookie"))){?><div id="mdx-cookie-notice" class="mdui-shadow-8"><i class="mdui-icon material-icons">&#xe88e;</i><p class="mdui-typo"><?php echo htmlspecialchars_decode(mdx_get_option("mdx_cookie"));?></p><button class="mdui-btn mdui-color-theme mdui-ripple"><?php _e("同意", "mdx");?></button></div><?php }?>
<footer class="foot mdui-text-center<?php if(mdx_get_option("mdx_styles_footer") === "2"){?> mdx-footer-clean<?php }else if(mdx_get_option("mdx_styles_footer") === "3"){?>  mdx-footer-morden<?php }?>">
  <?php if(mdx_get_option("mdx_styles_footer") === "1"){
    if(!empty(mdx_get_option('mdx_footer'))){echo htmlspecialchars_decode(mdx_get_option('mdx_footer'));}if(!empty(mdx_get_option('mdx_footer')) && !empty(mdx_get_option('mdx_icp_num'))){echo "<br>";}if(!empty(mdx_get_option('mdx_icp_num'))){?><a href="http://www.beian.miit.gov.cn/" rel="noopener" target="_blank" class="click"><?php echo mdx_get_option('mdx_icp_num');?></a><?php }?><br>Theme: MDx By <a href="https://flyhigher.top" target="_blank" class="click">AxtonYao</a><?php $mdx_footer_say=mdx_get_option('mdx_footer_say');if($mdx_footer_say!='' && $mdx_footer_say!='--HitokotoAPIActivated--' && $mdx_footer_say!='--HitokotoPoemAPIActivated--'){?><br>&nbsp;<br><?php echo $mdx_footer_say;}else if($mdx_footer_say=='--HitokotoAPIActivated--'){?><br>&nbsp;<br><?php echo '<span id="k-text"></span><script>var xmlHttpReq = new XMLHttpRequest();xmlHttpReq.open("GET", "https://v1.hitokoto.cn/?encode=text", true);xmlHttpReq.send();xmlHttpReq.onreadystatechange = function(){if(xmlHttpReq.readyState === 4 && xmlHttpReq.status === 200){document.getElementById("k-text").innerText = xmlHttpReq.responseText;}else{document.getElementById("k-text").innerText = "Some Thing Went Wrong :-(";}}</script>';}else if($mdx_footer_say=='--HitokotoPoemAPIActivated--'){?><br>&nbsp;<br><?php echo '<span id="k-text"></span><script>var xmlHttpReq = new XMLHttpRequest();xmlHttpReq.open("GET", "https://v1.jinrishici.com/all.txt", true);xmlHttpReq.send();xmlHttpReq.onreadystatechange = function(){if(xmlHttpReq.readyState === 4 && xmlHttpReq.status === 200){document.getElementById("k-text").innerText = xmlHttpReq.responseText;}else{document.getElementById("k-text").innerText = "Some Thing Went Wrong :-(";}}</script>';}
  }else if(mdx_get_option("mdx_styles_footer") === "2"){?>
    <div class="mdx-clean-footer"><?php if(!empty(mdx_get_option('mdx_footer'))){echo htmlspecialchars_decode(mdx_get_option('mdx_footer'));}if(!empty(mdx_get_option('mdx_footer')) && !empty(mdx_get_option('mdx_icp_num'))){echo "<br>";}if(!empty(mdx_get_option('mdx_icp_num'))){?><a href="http://www.beian.miit.gov.cn/" rel="noopener" target="_blank" class="click"><?php echo mdx_get_option('mdx_icp_num');?></a><?php }?><div class="mdx-copyright">Theme: MDx By <a href="https://flyhigher.top" target="_blank" class="click">AxtonYao</a></div></div>
  <?php }else if(mdx_get_option("mdx_styles_footer") === "3"){?>
    <div class="mdx-clean-footer">
      <a href="<?php bloginfo('url');?>" class="mdx-footer-title"><?php $mdx_logo_way=mdx_get_option('mdx_logo_way');if($mdx_logo_way=="2"){$mdx_logo=mdx_get_option('mdx_logo');if($mdx_logo!=""){echo '<img class="mdx-logo" src="'.$mdx_logo.'">';}else{bloginfo('name');}}elseif($mdx_logo_way=="1"){bloginfo('name');}elseif($mdx_logo_way=="3"){$mdx_logo_text=mdx_get_option('mdx_logo_text');if($mdx_logo_text!=""){echo $mdx_logo_text;}else{bloginfo('name');}}?></a>
      <span class="mdx-footer-content"><?php if(!empty(mdx_get_option('mdx_footer'))){echo htmlspecialchars_decode(mdx_get_option('mdx_footer'));}$mdx_footer_say=mdx_get_option('mdx_footer_say');
      if($mdx_footer_say!='' && $mdx_footer_say!='--HitokotoAPIActivated--' && $mdx_footer_say!='--HitokotoPoemAPIActivated--'){?>
        <br><?php echo $mdx_footer_say;?>
      <?php }else if($mdx_footer_say=='--HitokotoAPIActivated--'){?>
        <?php echo '<br><span id="k-text"></span><script>var xmlHttpReq = new XMLHttpRequest();xmlHttpReq.open("GET", "https://v1.hitokoto.cn/?encode=text", true);xmlHttpReq.send();xmlHttpReq.onreadystatechange = function(){if(xmlHttpReq.readyState === 4 && xmlHttpReq.status === 200){document.getElementById("k-text").innerText = xmlHttpReq.responseText;}else{document.getElementById("k-text").innerText = "Some Thing Went Wrong :-(";}}</script>';}else if($mdx_footer_say=='--HitokotoPoemAPIActivated--'){?><?php echo '<br><span id="k-text"></span><script>var xmlHttpReq = new XMLHttpRequest();xmlHttpReq.open("GET", "https://v1.jinrishici.com/all.txt", true);xmlHttpReq.send();xmlHttpReq.onreadystatechange = function(){if(xmlHttpReq.readyState === 4 && xmlHttpReq.status === 200){document.getElementById("k-text").innerText = xmlHttpReq.responseText;}else{document.getElementById("k-text").innerText = "Some Thing Went Wrong :-(";}}</script>';}?></span>
      <hr>
      Theme: MDx By <a href="https://flyhigher.top" target="_blank" class="click">AxtonYao</a><?php if(!empty(mdx_get_option('mdx_icp_num'))){?><div class="mdx-copyright"><a href="http://www.beian.miit.gov.cn/" rel="noopener" target="_blank" class="click"><?php echo mdx_get_option('mdx_icp_num');?></a></div><?php }?>
      </div>
  <?php }?>
</footer>
    </div>
    <?php if($mdx_widget){?><div id="mdx-right-drawer" role="complementary" class="mdui-drawer mdui-drawer-right mdui-drawer-close mdui-drawer-full-height">
    <?php
      if(is_active_sidebar('widget_right')){
        dynamic_sidebar('widget_right');
      }else{
        echo '<div class="mdx-widget-empty mdui-valign"><div><i class="mdui-icon material-icons">&#xe53c;</i><br><br>'.__('没有激活的小工具', 'mdx').'</div></div>';
      }
    ?>
    </div><?php }?>
    <?php $pageType=get_post_meta($wp_query->get_queried_object_id(),'_wp_page_template',true);?>
    <?php wp_footer();?>
    <?php if(mdx_get_option('mdx_real_search')=='true'){?>
    <script>
    var tipMutiOff = '<?php _e('搜索功能暂时不可用。','mdx')?>';
    var tipMutiOffRes = '<?php _e('评论功能暂时不可用。','mdx');?><br><br>';
    var tipMuti = '<?php _e('仅显示匹配的前10条记录，要查看更多请按下回车前往搜索结果页面','mdx');?>';
    var snackMuti = "<?php _e('无法连接到实时搜索服务','mdx');?>";
    var moreMuti = '<?php echo mdx_get_option("mdx_readmore");?>';
    </script>
    <?php }?>
    <?php wp_enqueue_script('comment-reply');?>
    <script>
      var ajax_error = "<?php _e("<strong>加载失败：</strong> 未知错误。","mdx");?>";
      var reduce_motion_i18n_1 = "<?php _e("检测到减弱动画模式，已为你减弱动画效果","mdx");?>";
      var reduce_motion_i18n_2 = "<?php _e("撤销","mdx");?>";
      var reduce_motion_i18n_3 = "<?php _e("减弱动画模式关闭，已启用完整动画效果","mdx");?>";
      var ifscr = 0;
      <?php if(mdx_get_option('mdx_auto_scroll')=='true'){?>
        ifscr = 1;
      <?php }?>
      var mdx_comment_ajax = 0;
      <?php if(mdx_get_option('mdx_comment_ajax')=='true'){?>
        mdx_comment_ajax = 1;
      <?php }?>
      var mdx_imgBox = 0;
      <?php if(mdx_get_option('mdx_img_box')=='true'){?>
        mdx_imgBox = 1;
      <?php }?>
      var mdx_tapToTop = 0;
      <?php if(mdx_get_option('mdx_tap_to_top')=='true'){?>
        mdx_tapToTop = 1;
      <?php }?>
      </script>
    <?php if(is_home()){?>
      <script>
        enhanced_ajax = false;
        <?php if(mdx_get_option('mdx_enhanced_ajax')=='true'){?>
        enhanced_ajax = true;
        <?php }?>
      </script>
    <?php }else if(is_search()){?>
      <script>
        var acPageTitle = '<?php _e('搜索结果：','mdx');the_search_query();?>';
        enhanced_ajax = false;
        <?php if(mdx_get_option('mdx_enhanced_ajax')=='true'){?>
        enhanced_ajax = true;
        <?php }?>
      </script>
    <?php }else if(is_author()){?>
      <script>
       var acPageTitle = '<?php _e('作者归档：'.get_the_author(),'mdx');?>';
       enhanced_ajax = false;
        <?php if(mdx_get_option('mdx_enhanced_ajax')=='true'){?>
        enhanced_ajax = true;
        <?php }?>
      </script>
      <?php } else if(is_category()||is_archive()){?>
      <script>
        var acPageTitle = '<?php _e('文章归档：','mdx');single_cat_title('',true);?>';
        enhanced_ajax = false;
        <?php if(mdx_get_option('mdx_enhanced_ajax')=='true'){?>
        enhanced_ajax = true;
        <?php }?>
      </script>
    <?php }?>
    <?php if(is_single() || (is_page()&&$pageType=='page-postlike.php')){
      if(is_single()){
        $mdx_style_act_hex = get_post_meta((int)$post->ID, "mdx_styles_act_hex", true);
        if($mdx_style_act_hex=="" || $mdx_style_act_hex=="def"){
          $mdx_style_act_hex = mdx_get_option('mdx_act_hex');
        }
      }else{
        $mdx_style_act_hex = mdx_get_option('mdx_act_hex');
      }
      ?>
    <script>
      //Show Read Pro'
      $('#indic').radialIndicator({
        displayNumber: false,
        radius: 27,
        barColor: '#ffffff',
        roundCorner: false,
        barWidth: 3,
        barBgColor: '<?php echo $mdx_style_act_hex;?>',
      });
      var ind = $('#indic').data('radialIndicator');
      </script>
      <?php }if(is_single() || (is_page())){?><script>
      function snbar(){
        mdui.snackbar({
          message: '<?php _e("已自动定位到你此前阅读处","mdx");?>&nbsp;&nbsp;&nbsp;',
          buttonText: '<?php _e("从头阅读","mdx");?>',
          timeout: 10000,
          onButtonClick: function(){
              $("body,html").animate({scrollTop:0},700);
          },
        });
      }
      var moreinput = "'<?php _e("更多选项","mdx");?>'";
      var morecomment = "<?php _e("加载更多评论","mdx");?>";
      var nomorecomment = "<?php _e("没有更多了","mdx");?>";
      var mdx_si_i18n = '<?php _e('长按/右键保存图片','mdx'); ?>';
      var mdx_si_i18n_2 = '<?php _e('关闭','mdx'); ?>';
      var mdx_si_i18n_3 = '<?php _e('使用微信扫描后在微信内分享','mdx'); ?>';
      var mdx_si_i18n_4 = '<?php _e('点按右上角按钮即可分享','mdx'); ?>';
      var mdx_i18n_password = '<?php _e('密码','mdx'); ?>';
      var mdx_github_i18n_1 = '<?php _e('在 GitHub 上查阅','mdx'); ?>';
      var mdx_github_i18n_2 = '<?php _e('获取 GitHub 仓库信息时出现问题<br>尝试直接访问','mdx'); ?>';
      var mdx_post_i18n_1 = '<?php _e('这个页面没有摘要。','mdx'); ?>';
      var mdx_post_i18n_2 = '<?php _e('前往页面','mdx'); ?>';
      var mdx_post_i18n_3 = '<?php _e('获取页面信息时出现问题<br>尝试直接访问','mdx'); ?>';
      var mdx_toc_i18n_1 = '<?php _e('菜单','mdx'); ?>';
      var mdx_toc_i18n_2 = '<?php _e('目录','mdx'); ?>';
      </script>
<?php }?>
<?php if(function_exists('alu_get_wpsmiliestrans') && (mdx_get_option('mdx_comment_emj')=="true") && (is_single() || is_page())){?>
    <script>
     $('.mdx-emj-cli').click(function(){
      $('.mdx-emj').slideToggle(200);
     })
</script>
<?php }?>
<?php if(is_home()){$mdx_js_name='js';}elseif(is_category()||is_archive()||is_search()){$mdx_js_name='ac';}elseif(is_single()||$pageType=='page-postlike.php'){$mdx_js_name='post';}elseif(is_page()||$pageType!='page-postlike.php'){$mdx_js_name='page';}elseif(is_page()&&$pageType=='page-postlike.php'){$mdx_js_name='post';}else{$mdx_js_name='js';}?>
<script type='text/javascript' src='<?php echo get_bloginfo('template_url');?>/js/<?php echo $mdx_js_name?>.js?ver=<?php echo get_option("mdx_version_commit");?>'></script><?php echo htmlspecialchars_decode(mdx_get_option('mdx_footer_js'));?>
<!--Theme Version <?php echo get_option('mdx_version_commit');?>-->
  </body>
</html>
