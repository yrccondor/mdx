(function(){
    tinymce.create('tinymce.plugins.mdx_warning', {
        init : function(ed, url){
            ed.addButton('mdx_warning', {
                title : 'Worning',
                image : url+'/bt_icon/warning.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_warning title="Your title here..."][/mdx_warning]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_warning', tinymce.plugins.mdx_warning);
})();