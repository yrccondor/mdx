<form action="/" method="GET" role="search">
    <div class="mdui-textfield">
        <input class="mdui-textfield-input" type="text" name="s" id="mdx-search-widget" value="<?php the_search_query();?>" placeholder="<?php echo htmlspecialchars(__('搜索什么...','mdx'));?>">
    </div>
    <input type="submit" class="mdui-btn mdui-btn-block mdui-color-theme-accent mdui-ripple" value="<?php echo htmlspecialchars(__('搜索','mdx'));?>">
</form>