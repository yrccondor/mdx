//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChangeToTop = 0;
var blogName = $('div.mdui-toolbar > a.mdui-typo-headline').html();
var postTitle = $('div.mdui-text-color-white-text.mdui-typo-display-1.PostTitlePage').text();
var blogUrl = $('div.mdui-toolbar > a.mdui-typo-headline').attr("href");
var now_color = $("meta[name='theme-color']").attr('content');
window.onscroll=function(){
    scrollDiff();
}
function scrollDiff(){
    var howFar = document.documentElement.scrollTop || document.body.scrollTop;
    var barHight = $(".PostTitlePage").height() - $(".titleBarGobal").height() - 2;
    var totalHight = $(".PostTitlePage").height()*.5 - 20;
    if(howFar > barHight & whetherChangeToTop == 0){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $(".toolbar-page").toggleClass("mdui-color-theme");
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(postTitle);
        $("div.mdui-toolbar > a.mdui-typo-headline").removeAttr("href");
        whetherChangeToTop = 1;
    }
    if(howFar <= barHight & whetherChangeToTop == 1){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $(".toolbar-page").toggleClass("mdui-color-theme");
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(blogName);
        $("div.mdui-toolbar > a.mdui-typo-headline").attr("href",blogUrl);
        whetherChangeToTop = 0;
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
    $(".PostTitleFillPage").css('opacity',opacityHeight);
};

window.onload=function() {
    $('body > .mdui-progress').fadeOut(200);
    if(ifscr == 1){
        var oldpro = parseFloat(GetQueryString("_pro"));
        var postHight3 = $(".ArtMain").height() + $(".ArtMain").offset().top - document.documentElement.clientHeight;
        var scro = postHight3*oldpro;
        if(scro>200){
          $("body,html").animate({scrollTop:scro},700);
          snbar();
        }
  }
}
function GetQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return unescape(r[2]); return null;
}
//Scroll To the Top
$(".scrollToTop,.backToTop").click(function(){
    $("body,html").animate({scrollTop:0},500);
});

//Night Styles
$("#tgns").click(function(){
    $("body").toggleClass("mdui-theme-layout-dark");
    if(!sessionStorage.getItem('ns_night-styles') || sessionStorage.getItem('ns_night-styles')=='false'){
        sessionStorage.setItem('ns_night-styles', 'true');
        $("meta[name='theme-color']").attr('content',"#212121");
    }else{
        sessionStorage.setItem('ns_night-styles', 'false');
        $("meta[name='theme-color']").attr('content',now_color);
    }
});

$(function(){
    if(sessionStorage.getItem('ns_night-styles')=='true'){
        $("body").toggleClass("mdui-theme-layout-dark");
        $("meta[name='theme-color']").attr('content',"#212121");
    }

    if($('#comments > ul').length == 0){
        $('#respond').css('border-radius','0 0 7px 7px')
    }

    scrollDiff();
    
        //ImgBox
        if(mdx_imgBox==1){
        $('article a > img').addClass("mdx-img-in-post");
        $('article a > img').unwrap();
        $('img.mdx-img-in-post').click(function(){
            var imgUrl = $(this).attr('src');
            if(imgUrl=='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAMAAAAoyzS7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFsbGxAAAA/JhxRAAAAAxJREFUeNpiYAAIMAAAAgABT21Z4QAAAABJRU5ErkJggg=='){
                imgUrl = $(this).attr('data-original');
            }
            $('div.mdui-drawer').before('<div id="img-box" class="mdui-valign"><img class="imgInBox mdui-center" id="imgInBox"><button class="mdui-btn mdui-btn-icon mdui-ripple mdui-text-color-white mdui-valign mdui-text-center" id="close-img-box"><i class="mdui-icon material-icons">&#xe5cd;</i></button></div><div class="mdui-valign mdx-loading-img"><div class="mdui-center"><div class="mdui-spinner"></div></div></div>');
            mdui.updateSpinners();
            $('#imgInBox').attr('src',imgUrl);
            var nowWidth = $('#imgInBox').width();
            var nowHeight = $('#imgInBox').height();
            var wincli = document.body.clientWidth/$(window).height();
            getImageWidth(imgUrl,function(w,h){
                $('#imgInBox').css('opacity','1');
                var piccli = w/h;
                if(wincli <= piccli){
                    $('#imgInBox').css({'width':'100%','height':'auto'});
                }else{
                    $('#imgInBox').css({'height':'100%','width':'auto'});
                }
                if((document.body.clientWidth > w) && ($(window).height() > h)){
                    $('#imgInBox').css('width',w);
                    $('#imgInBox').css('height',h);
                }
            })
            function getImageWidth(url,callback){
                var img = new Image();
                img.src = url;
                if(img.complete){
                    callback(img.width, img.height);
                    $('div.mdx-loading-img').remove();
                }else{
                    $('#imgInBox').css('opacity','0');
                    img.onload = function(){
                    callback(img.width, img.height);
                    }
                    }
            }
            $('#img-box').css({'opacity':'1','pointer-events':'auto'});
            $('#imgInBox').on('load',function(){
                $('div.mdx-loading-img').remove();
            })
        })
        $('body').on('click','#close-img-box',function(){
            $('#img-box').css({'opacity':'0','pointer-events':'none'});
            window.setTimeout("afterCloseImgBox()",200);
        })
    }

        //评论优化
        $('.disfir').hide();
        $('.commurl').hide();
        $("div#comments ul li p").addClass('mdui-typo');
        $('.comment-reply-link').addClass("mdui-btn");
        $('.comment-reply-link').css("opacity","0");
        $('p.form-submit').prepend('<a mdui-tooltip="{content: '+moreinput+', position: '+"'top'"+'}" class="mdui-btn mdui-btn-icon mdui-ripple moreInComm"><i class="mdui-icon material-icons">&#xe313;</i></a>');
        var ifOpenComm = 0;
        $('a.moreInComm').click(function(){
            if(ifOpenComm == 0){
                $('.commurl').fadeIn(200);
                $('a.moreInComm').css({"transform":"rotate(180deg)","-ms-transform":"rotate(180deg)","-moz-transform":"rotate(180deg)","-webkit-transform":"rotate(180deg)","-o-transform":"rotate(180deg)"});
                ifOpenComm = 1;
            }else{
                $('.commurl').hide();
                $('a.moreInComm').css({"transform":"rotate(0deg)","-ms-transform":"rotate(0deg)","-moz-transform":"rotate(0deg)","-webkit-transform":"rotate(0deg)","-o-transform":"rotate(0deg)"});
                ifOpenComm = 0;
            }
        })

        //密码优化
        var inputId = $('form.post-password-form p > label > input').attr('id');
        var inputValue = $('form.post-password-form p > input').attr('value');
        $('form.post-password-form p').eq(1).html('<div class="mdui-textfield mdui-textfield-floating-label inpass"><label class="mdui-textfield-label">密码</label><input class="mdui-textfield-input" type="password" name="post_password" id="'+inputId+'"></div>');
})

function afterCloseImgBox(){
    $('#img-box').remove();
    $('.mdx-loading-img').remove();
}

$('#comment').focus(function(){
    $('.disfir').fadeIn(200);
    $('a.moreInComm').css({"opacity":"1","pointer-events":"auto"});
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
        threshold : 300,
      });
    $("img.LazyLoadPost").lazyload({
        effect : "fadeIn",
        threshold : 200,
    });
 });
 
// 评论分页
$('#comments').on('click', '#comments-navi > a', function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        beforeSend: function(){
            $('#comments-navi').remove();
            $('ul.mdui-list.ajax-comments').remove();
            $('.mdx-comments-loading').fadeIn(200);
            $("body,html").animate({scrollTop: $('#reply-title').offset().top - 65}, 500 );
        },
        dataType: "html",
        success: function(out){
            result = $(out).find('ul.mdui-list.ajax-comments');
            nextlink = $(out).find('#comments-navi');
            $('.mdx-comments-loading').hide();
            $('#comments').prepend(result);
            $('ul.mdui-list.ajax-comments').after(nextlink);
            $("img.LazyLoadPost.avatar").lazyload({
                effect : "fadeIn",
                threshold : 200,
            });
            $("div#comments ul li p").addClass('mdui-typo');
            $('.comment-reply-link').addClass("mdui-btn");
            $('.comment-reply-link').css("opacity","0");
        }
    });
});