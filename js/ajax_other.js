var urlV;
var page = 0;
$(function(){
    var textV = $('div.nextpage a').text();
    if(textV==""){
        $('div.nextpage').remove();
    }else{
        urlV = $('div.nextpage a').attr("href");
        $('#postlist').after('<div class="mdui-hoverable nextpage2">'+textV+'</div>')
        $('div.nextpage').remove();
        $('div.main-in-other').on("click", 'div.nextpage2', function(){
        $('div.nextpage2').hide();
        $('div.nextpage2').after('<div class="mdui-spinner mdx-ajax-loading mdui-center"></div>');
        mdui.updateSpinners();
        $.ajaxSetup({
            timeout: 15000
        })
        $.get(urlV,function(data,status){
            if(status=='success'){
                var nowValue = $('#postlist').html();
                urlV = $(data).find("div.nextpage a").attr("href");
                if(urlV == undefined ){
                    data2 = data.replace('<div class="nextpage mdui-center"></div>',"");
                    $('div.nextpage2').remove();
                }else{
                    data2 = data;
                    $('div.nextpage',data2).remove();
                    $('div.nextpage2').show();
                }
                $('div.mdx-ajax-loading').remove();
                var getValue = $('#postlist',data2).html();
                $('#postlist').html(nowValue+getValue);
                $(".LazyLoadListImg").lazyload({
                    threshold : 100,
                });
            }else{
                mdui.snackbar({
                    message: '<strong>加载失败：</strong> 未知错误。',
                    timeout: 5000,
                    position: 'top',
               });
            }
        });
    });
    }
})