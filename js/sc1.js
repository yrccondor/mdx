(function(){
    tinymce.create('tinymce.plugins.mdx_fold', {
        init : function(ed, url){
            ed.addButton('mdx_fold', {
                title : 'Folder',
                image : url+'/bt_icon/fold.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_fold title="Your title here..."][/mdx_fold]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_fold', tinymce.plugins.mdx_fold);

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

    tinymce.create('tinymce.plugins.mdx_ad', {
        init : function(ed, url){
            ed.addButton('mdx_ad', {
                title : 'AD',
                image : url+'/bt_icon/ad.png',
                onclick : function(){
                    ed.selection.setContent('[mdx_ad][/mdx_ad]');
                }
            });
        },
        createControl:function(n, cm){
            return null;
        },
    });
    tinymce.PluginManager.add('mdx_ad', tinymce.plugins.mdx_ad);
})();