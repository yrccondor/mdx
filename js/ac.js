//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var whetherChangeToTop = 0;
var blogName = $('div.mdui-toolbar > a.mdui-typo-headline').html();
var blogUrl = $('div.mdui-toolbar > a.mdui-typo-headline').attr("href");
var metaColor = $("meta[name='theme-color']");
var colorEnabled = false;
var now_color = '';
if(metaColor.length != 0){
    now_color = $("meta[name='mdx-main-color']").attr('content');
    colorEnabled = true;
}
var ticking = false;
window.onscroll=function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
function scrollDiff(){
	var howFar = document.documentElement.scrollTop || document.body.scrollTop;
    if(howFar > 10 & whetherChange == 0){
        $("#titleBar").toggleClass("mdui-shadow-2");
        whetherChange = 1;
    }
    if(howFar <= 10 & whetherChange == 1){
        $("#titleBar").toggleClass("mdui-shadow-2");
        whetherChange = 0;
    }
    if(howFar > 170 & whetherChangeToTop == 0){
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(acPageTitle);
        $("div.mdui-toolbar > a.mdui-typo-headline").removeAttr("href");
        whetherChangeToTop = 1;
    }
    if(howFar <= 170 & whetherChangeToTop == 1){
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(blogName);
        $("div.mdui-toolbar > a.mdui-typo-headline").attr("href",blogUrl);
        whetherChangeToTop = 0;
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

//LazyLoad.init
$(function() {
    $("div.LazyLoad").lazyload({
        effect : "fadeIn",
        threshold : 500,
      });
      $(".LazyLoadListImg").lazyload({
        threshold : 100,
      });

      scrollDiff();
 });

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
            $(this).addClass('mdui-collapse-item').removeClass('mdui-list-item');
            $(this).html('<div class="mdui-collapse-item-header mdui-list-item mdui-ripple"><div class="mdui-list-item-content"><a class="mdx-sub-menu-a" href="'+$(this).children("a").attr('href')+'">'+$(this).children("a").html()+'</a></div><i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></div><ul class="mdui-collapse-item-body mdui-list mdui-list-dense">'+$(this).children("ul").html()+'</ul>');
             mdx_haveChild = 1;
            $(this).children("ul").children("li").each(function(){
                if($(this).hasClass('current-menu-item')){
                    mdx_is_c = 1;
                }
            })
            if(mdx_is_c){
                $(this).removeClass('current-menu-item current_page_item').addClass('mdui-collapse-item-open');
            }
            mdx_is_c = 0;
        }
        if(mdx_haveChild){
            $('#mdx_menu').addClass('mdui-collapse').attr('mdui-collapse','');
        }
    })
    new mdui.Collapse("#mdx_menu");
})