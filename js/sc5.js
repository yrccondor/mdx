(function(){
    tinymce.create('tinymce.plugins.mdx_post', {
        init : function(ed, url){
            ed.addButton('mdx_post', {
                title : 'Post',
                image : url+'/bt_icon/post.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_post]A post URL under the same domain here...[/mdx_post]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_post', tinymce.plugins.mdx_post);
})();