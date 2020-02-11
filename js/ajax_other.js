var urlV;
var page = 1;
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
            ajax_load_ac(urlV);
        });
    }
    if(enhanced_ajax && document.getElementById("postlist").getElementsByTagName("a").length > 0){
        if(!sessionStorage.getItem("mdx_"+window.location.href+"_page_1")){
            sessionStorage.setItem("mdx_"+window.location.href+"_page_1", window.btoa(encodeURIComponent(document.getElementById("postlist").getElementsByTagName("a")[0].href)));
            sessionStorage.setItem("mdx_"+window.location.href+"_loaded_page", 1);
        }else if(sessionStorage.getItem("mdx_"+window.location.href+"_page_1") !== window.btoa(encodeURIComponent(document.getElementById("postlist").getElementsByTagName("a")[0].href))){
            for(let i=1;i<=parseInt(sessionStorage.getItem("mdx_"+window.location.href+"_loaded_page"));i++){
                sessionStorage.removeItem("mdx_"+window.location.href+"_page_"+i);
            }
            sessionStorage.setItem("mdx_"+window.location.href+"_page_1", window.btoa(encodeURIComponent(document.getElementById("postlist").getElementsByTagName("a")[0].href)));
            sessionStorage.setItem("mdx_"+window.location.href+"_loaded_page", 1);
        }else if(parseInt(sessionStorage.getItem("mdx_"+window.location.href+"_loaded_page"))>1){
            for(let i=2;i<=parseInt(sessionStorage.getItem("mdx_"+window.location.href+"_loaded_page"));i++){
                var data = decodeURIComponent(window.atob(sessionStorage.getItem("mdx_"+window.location.href+"_page_"+i)));
                urlV = $(data).find("div.nextpage a").attr("href");
                if(urlV == undefined ){
                    data2 = data.replace('<div class="nextpage mdui-center"></div>',"");
                    $('div.nextpage2').remove();
                }else{
                    data2 = data;
                    $('div.nextpage',data2).remove();
                    $('div.nextpage2').show();
                }
                var getValue = $('#postlist',data2).html();
                $('#postlist').append(getValue);
                page = i;
            }
        }
    }
})

function ajax_load_ac(url) {
    $.ajaxSetup({
        timeout: 15000
    })
    $.get(url,function(data,status){
        if(status=='success'){
            page++;
            urlV = $(data).find("div.nextpage a").attr("href");
            if(enhanced_ajax && parseInt(sessionStorage.getItem("mdx_"+window.location.href+"_loaded_page")) <= 15){
                sessionStorage.setItem("mdx_"+window.location.href+"_page_"+page, window.btoa(encodeURIComponent(data)));
                sessionStorage.setItem("mdx_"+window.location.href+"_loaded_page", page);
            }
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
            $('#postlist').append(getValue);
        }else{
            mdui.snackbar({
                message: ajax_error,
                timeout: 5000,
                position: 'top',
           });
        }
    });
}