(function(){
    tinymce.create('tinymce.plugins.mdx_progress', {
        init : function(ed, url){
            ed.addButton('mdx_progress', {
                title : 'Progress',
                image : url+'/bt_icon/progress.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_progress]Number 0-100 here, float number is supported.[/mdx_progress]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_progress', tinymce.plugins.mdx_progress);
})();