(function(){
    tinymce.create('tinymce.plugins.mdx_table', {
        init : function(ed, url){
            ed.addButton('mdx_table', {
                title : 'Table',
                image : url+'/bt_icon/table.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_table][/mdx_table]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_table', tinymce.plugins.mdx_table);
})();