(function(){
    tinymce.create('tinymce.plugins.mdx_post', {
        init : function(ed, url){
            ed.addButton('mdx_post', {
                title : '添加文章链接',
                image : url+'/bt_icon/post.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_post]输入同一域名下使用 MDx 主题的页面链接[/mdx_post]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_post', tinymce.plugins.mdx_post);
})();