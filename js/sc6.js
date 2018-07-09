(function(){
    tinymce.create('tinymce.plugins.mdx_github', {
        init : function(ed, url){
            ed.addButton('mdx_github', {
                title : '添加 Github 链接',
                image : url+'/bt_icon/github.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_github author="项目作者" project="项目名"][/mdx_github]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_github', tinymce.plugins.mdx_github);
})();