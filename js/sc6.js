(function(){
    tinymce.create('tinymce.plugins.mdx_github', {
        init : function(ed, url){
            ed.addButton('mdx_github', {
                title : 'Github',
                image : url+'/bt_icon/github.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_github author="Author..." project="Project..."][/mdx_github]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_github', tinymce.plugins.mdx_github);
})();