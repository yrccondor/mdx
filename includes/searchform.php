<div class="titleBarGobal mdui-appbar mdui-shadow-0 mdui-text-color-white-text" id="SearchBar">
<form class="mdui-toolbar mdui-appbar-fixed" role="search" method="get" id="searchform" action="<?php echo home_url('/');?>">
<div class="outOfSearch mdui-valign">
  <label for="s"><i class="mdui-icon material-icons seaicon">&#xe8b6;</i></label>
  <input class="seainput" type="text" name="s" id="s" autocomplete="off" placeholder="<?php echo htmlspecialchars(__('搜索什么...','mdx'));?>" value="<?php the_search_query();?>">
</div>
<div class="mdui-toolbar-spacer"></div>
<a class="mdui-btn mdui-btn-icon sea-close"><i class="mdui-icon material-icons">&#xe5cd;</i></a>
</form>
</div>