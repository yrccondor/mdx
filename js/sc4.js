(function(){
    tinymce.create('tinymce.plugins.mdx_progress', {
        init : function(ed, url){
            ed.addButton('mdx_progress', {
                title : '添加进度指示器',
                image : url+'/bt_icon/progress.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_progress]用0-100的数值来表示你的进度，支持小数[/mdx_progress]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_progress', tinymce.plugins.mdx_progress);
})();