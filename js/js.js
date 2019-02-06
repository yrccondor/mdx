//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var metaColor = $("meta[name='theme-color']");
var colorEnabled = false;
var now_color = '';
if(metaColor.length != 0){
    now_color = $("meta[name='mdx-main-color']").attr('content');
    colorEnabled = true;
}
var ticking = false;
var mdx_style = 1;
var barHight = $(".theFirstPage").height() - $(".titleBarGobal").height() - 1;
var totalHight = $(".theFirstPage").height()*.37 - 20;
if($(".theFirstPage").length == 0){
    mdx_style = 0;
}
window.onscroll=function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
window.onresize=function(){
    barHight = $(".theFirstPage").height() - $(".titleBarGobal").height() - 1;
    totalHight = $(".theFirstPage").height()*.37 - 20;
}
function scrollDiff(){
    if(mdx_style){
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if(howFar > barHight & whetherChange == 0){
            $(".mdui-toolbar-self").toggleClass("mdui-color-theme");
            $("#titleBar").toggleClass("mdui-shadow-2");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            whetherChange = 1;
        }
        if(howFar <= barHight & whetherChange == 1){
            $(".mdui-toolbar-self").toggleClass("mdui-color-theme");
            $("#titleBar").toggleClass("mdui-shadow-2");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            whetherChange = 0;
        }
        if(howFar <= barHight){
            opacityHeight = (barHight - howFar)/totalHight;
            if(opacityHeight > 1){
                opacityHeight = 1;
            }
        }else if(howFar > barHight){
            opacityHeight = 0;
        }else{
            opacityHeight = 1;
        }
        $(".theFirstPage").css('opacity',opacityHeight);
    }else if(!mdx_style){
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if(howFar > 20 & whetherChange == 0){
            $(".mdui-toolbar-self").toggleClass("mdui-color-theme");
            $("#titleBar").toggleClass("mdui-shadow-2");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            whetherChange = 1;
        }
        if(howFar <= 20 & whetherChange == 1){
            $(".mdui-toolbar-self").toggleClass("mdui-color-theme");
            $("#titleBar").toggleClass("mdui-shadow-2");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            whetherChange = 0;
        }
    }
    ticking = false;
};

//Scroll To the Top
$(".scrollToTop").click(function(){
    $("body,html").animate({scrollTop:0},500);
});

//Night Styles
$("#tgns").click(function(){
    $("body").toggleClass("mdui-theme-layout-dark");
    if(!sessionStorage.getItem('ns_night-styles') || sessionStorage.getItem('ns_night-styles')=='false'){
        sessionStorage.setItem('ns_night-styles', 'true');
        if(colorEnabled){
            metaColor.attr('content',"#212121");
        }
    }else{
        sessionStorage.setItem('ns_night-styles', 'false');
        if(colorEnabled){
            metaColor.attr('content',now_color);
        }
    }
});
$(function(){
    //hot posts
    if($(".mdx-hot-posts").length!=0){
        $('.mdx-hp-g-r').show();
        var mdx_change = 1;
        var mdx_change2 = 1;
        var mdx_sp_w = 215*$("a>div.mdx-li.mdui-card").length+10;
        var mdx_sp_ww = 0;
        var mdx_sp_s = 0;
        var ele = document.getElementById("mdx-sp-out-c");
        ele.onscroll=function(){
            mdx_sp_ww = $('#mdx-sp-out-c').width();
            mdx_sp_s = ele.scrollLeft;
            if(mdx_sp_s>5 && mdx_change){
                $('.mdx-hp-g-l').fadeIn(200);
                mdx_change = 0;
            }
            else if(mdx_sp_s<=5 && !mdx_change){
                $('.mdx-hp-g-l').fadeOut(200);
                mdx_change = 1;
            }
            if((mdx_sp_w - mdx_sp_ww - mdx_sp_s)<=5 && mdx_change2){
                $('.mdx-hp-g-r').fadeOut(200);
                mdx_change2 = 0;
            }else if((mdx_sp_w - mdx_sp_ww - mdx_sp_s)>5 && !mdx_change2){
                $('.mdx-hp-g-r').fadeIn(200);
                mdx_change2 = 1;
            }
        }
    }

    //Lazyload
    $("div.LazyLoad").lazyload({
        effect : "fadeIn",
        threshold : 700,
    });
    $(".LazyLoadListImg").lazyload({
        threshold : 300,
    });
    $("img.LazyLoadPost").lazyload({
        effect : "fadeIn",
        threshold : 400,
    });
    $(".LazyLoadSamePost").lazyload({
        effect : "fadeIn",
        threshold : 400,
        container: $("#mdx-sp-out-c")
    });

    scrollDiff();
})

//Search
$(".seai").click(function(){
    $("#SearchBar").show();
    $(".OutOfsearchBox").fadeIn(300);
    $("#SearchBar").addClass("mdui-color-theme");
    $(".fullScreen").fadeIn(300);
    $("#SearchBar > *").animate({opacity:'1'},200);
    $(".outOfSearch").css('width','75%');
    $(".seainput").focus();
    $('body').toggleClass('mdx-search-lock');
    if(mdx_offline_mode){
        $('.OutOfsearchBox').html('<div class="searchBoxFill"></div><div class="underRes">'+tipMutiOff+'</div>');
        $('.OutOfsearchBox').css('pointer-events','auto');
        $(".seainput").attr('disabled','disabled');
    }
});
$(".sea-close").click(function(){
    $(".seainput").blur();
    $("#SearchBar > *").animate({opacity:'0'},200);
    $(".fullScreen").fadeOut(300);
    $(".OutOfsearchBox").fadeOut(300);
    $(".outOfSearch").css('width','30%');
    window.setTimeout("hideBar()",300);
    $("#SearchBar").removeClass("mdui-color-theme");
    $('body').toggleClass('mdx-search-lock');
});

function hideBar(){
    $("#SearchBar").hide();
}

 //tap tp top
 $('.mdui-typo-headline').click(function(){
     if(mdx_tapToTop==1){
         $("body,html").animate({scrollTop:0},500);
     }
 })

//init menu
$(function(){
    var mdx_haveChild = 0;
    var mdx_is_c = 0;
    $('#mdx_menu > li').each(function(){
        if($(this).hasClass('menu-item-has-children')){
            $(this).addClass('mdui-collapse-item');
            $(this).removeClass('mdui-list-item');
            $(this).html('<div class="mdui-collapse-item-header mdui-list-item mdui-ripple"><div class="mdui-list-item-content"><a class="mdx-sub-menu-a" href="'+$(this).children("a").attr('href')+'">'+$(this).children("a").html()+'</a></div><i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></div><ul class="mdui-collapse-item-body mdui-list mdui-list-dense">'+$(this).children("ul").html()+'</ul>');
             mdx_haveChild = 1;
            $(this).children("ul").children("li").each(function(){
                if($(this).hasClass('current-menu-item')){
                    mdx_is_c = 1;
                }
            })
            if(mdx_is_c){
                $(this).removeClass('current-menu-item');
                $(this).removeClass('current_page_item');
                $(this).addClass('mdui-collapse-item-open');
            }
            mdx_is_c = 0;
        }
        if(mdx_haveChild){
            $('#mdx_menu').addClass('mdui-collapse');
            $('#mdx_menu').attr('mdui-collapse','');
        }
    })
    new mdui.Collapse("#mdx_menu");
})