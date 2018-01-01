        <button class="mdui-fab mdui-color-theme-accent mdui-fab-fixed mdui-fab-hide scrollToTop mdui-ripple"><i class="mdui-icon material-icons">&#xe316;</i></button>
      <footer class="foot mdui-text-center"><?php echo get_option('mdx_footer');?><br><a href="http://www.miitbeian.gov.cn" target="_blank" class="click"><?php echo get_option('zh_cn_l10n_icp_num');?></a><br>Theme: MDx By <a href="https://flyhigher.top" target="_blank" class="click">AxtonYao</a><?php $mdx_footer_say=get_option('mdx_footer_say');if($mdx_footer_say!='' && $mdx_footer_say!='--HitokotoAPIActivated--'){?><br>&nbsp;<br><?php echo $mdx_footer_say;}else if($mdx_footer_say=='--HitokotoAPIActivated--'){?><br>&nbsp;<br><?php echo '<script type="text/javascript" src="https://api.lwl12.com/hitokoto/main/get?encode=js&charset=utf-8"></script><script>lwlhitokoto()</script>';}?></footer>
    </div>
    <?php $pageType=get_post_meta($wp_query->get_queried_object_id(),'_wp_page_template',true);?>
    <?php wp_footer();?>
    <?php if(get_option('mdx_real_search')=='true'){?>
    <script>
    var tipMuti = '<?php _e('仅显示匹配的前10条记录，要查看更多请按下回车转到搜索结果页面','mdx');?>';
    var snackMuti = '<?php _e('无法连接到实时搜索服务','mdx');?>';
    var moreMuti = '<?php echo get_option("mdx_readmore");?>';
    </script>
    <?php }?>
    <?php wp_enqueue_script('comment-reply');?>
    <script>
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
      var ifscr = 0;
      var moreinput = "'<?php _e("更多选项","mdx");?>'";
      <?php if(get_option('mdx_auto_scroll')=='true'){?>
        ifscr = 1;
      <?php }?>
      var mdx_imgBox = 0;
      <?php if(get_option('mdx_img_box')=='true'){?>
        mdx_imgBox = 1;
      <?php }?>
      </script>
    <?php if(is_search()){?>
      <script>
        var acPageTitle = '<?php _e('搜索结果：','mdx');the_search_query();?>';
      </script>
    <?php }else if(is_category()||is_archive()){?>
      <script>
        var acPageTitle = '<?php _e('文章归档：','mdx');single_cat_title('',true);?>';
      </script>
    <?php }?>
    <?php if(is_single() || (is_page()&&$pageType=='page-postlike.php')){
      $mdx_style_act = get_post_meta((int)$post->ID, "mdx_styles_act", true);
      if($mdx_style_act=="" || $mdx_style_act=="def"){
          $mdx_style_act = get_option('mdx_styles_act');
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
        barBgColor: '<?php echo $mdx_style_act;?>',
      });
      var ind = $('#indic').data('radialIndicator');
</script>
<?php }?>
<?php if(function_exists('alu_get_wpsmiliestrans') && (get_option('mdx_comment_emj')=="true") && (is_single() || is_page())){?>
    <script>
     $('.mdx-emj-cli').click(function(){
      $('.mdx-emj').slideToggle(200);
     })
</script>
<?php }?>
<?php if(is_home()){$mdx_js_name='js';}elseif(is_category()||is_archive()||is_search()){$mdx_js_name='ac';}elseif(is_single()||$pageType=='page-postlike.php'){$mdx_js_name='post';}elseif(is_page()||$pageType!='page-postlike.php'){$mdx_js_name='page';}elseif(is_page()&&$pageType=='page-postlike.php'){$mdx_js_name='post';}else{$mdx_js_name='js';}?>
<script type='text/javascript' src='<?php echo get_bloginfo('template_url');?>/js/<?php echo $mdx_js_name?>.js'></script>
  </body>
</html>