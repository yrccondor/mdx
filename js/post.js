//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var whetherChangeToTop = 0;
var blogName = $('div.mdui-toolbar > a.mdui-typo-headline').html();
var postTitle = $('div.PostTitle').text();
var blogUrl = $('div.mdui-toolbar > a.mdui-typo-headline').attr("href");
var now_color = $("meta[name='theme-color']").attr('content');
var url_hash = window.location.href;
var ticking = false;
if($('.PostMain2').length > 0){
    var postStyle2 = true;
}else{
    var postStyle2 = false;
}
window.onscroll=function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
function scrollDiff(){
	var howFar = document.documentElement.scrollTop || document.body.scrollTop;
    if(howFar > 20 & whetherChange == 0 && !postStyle2){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $("div.mdui-toolbar.mdui-appbar-fixed").toggleClass("mdui-color-theme");
        whetherChange = 1;
    }
    if(howFar <= 20 & whetherChange == 1 && !postStyle2){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $("div.mdui-toolbar.mdui-appbar-fixed").toggleClass("mdui-color-theme");
        whetherChange = 0;
    }
    if(howFar > 200 & whetherChangeToTop == 0 && !postStyle2){
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(postTitle);
        $("div.mdui-toolbar > a.mdui-typo-headline").removeAttr("href");
        $("#indic").fadeIn(200);
        whetherChangeToTop = 1;
    }
    if(howFar <= 200 & whetherChangeToTop == 1 && !postStyle2){
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(blogName);
        $("div.mdui-toolbar > a.mdui-typo-headline").attr("href",blogUrl);
        $("#indic").hide();
        whetherChangeToTop = 0;
    }

    if(postStyle2){
        if(howFar > ($(window).height()*0.4-64) &&  whetherChangeToTop == 0){
            $(".mdui-toolbar").toggleClass("mdui-color-theme");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            $("#titleBarinPost").toggleClass("mdui-shadow-2");
            $("div.mdui-toolbar > a.mdui-typo-headline").html(postTitle);
            $("div.mdui-toolbar > a.mdui-typo-headline").removeAttr("href");
            $("#indic").fadeIn(200);
            whetherChangeToTop = 1;
        }else if(howFar <= ($(window).height()*0.4-64) &&  whetherChangeToTop == 1){
            $(".mdui-toolbar").toggleClass("mdui-color-theme");
            $(".scrollToTop").toggleClass("mdui-fab-hide");
            $("#titleBarinPost").toggleClass("mdui-shadow-2");
            $("div.mdui-toolbar > a.mdui-typo-headline").html(blogName);
            $("div.mdui-toolbar > a.mdui-typo-headline").attr("href",blogUrl);
            $("#indic").hide();
            whetherChangeToTop = 0;
        }
    }

    if($(".ArtMain").length > 0){
        var postHight = $(".ArtMain").height() + $(".ArtMain").offset().top - document.documentElement.clientHeight;
    }else{
        var postHight = $("article.mdui-typo").height() + $("article.mdui-typo").offset().top - document.documentElement.clientHeight;
    }
    var nowPro = howFar/postHight*100;
    if(nowPro < 100){
        ind.value(nowPro);
    }else if(nowPro >=100){
        ind.value(100);
    }
    ticking = false;
};

window.onload=function() {
    $('body > .mdui-progress').fadeOut(200);
    if(ifscr == 1){
        var oldpro = parseFloat(GetQueryString("_pro"));
        if($(".ArtMain").length > 0){
            var postHight3 = $(".ArtMain").height() + $(".ArtMain").offset().top - document.documentElement.clientHeight;
        }else{
            var postHight3 = $("article.mdui-typo").height() + $("article.mdui-typo").offset().top - document.documentElement.clientHeight;
        }
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
        $("body").addClass("mdui-theme-layout-dark");
        $("meta[name='theme-color']").attr('content',"#212121");
    }

    if($('#comments > ul').length == 0){
        $('.ArtMain0 #respond').css('border-radius','0 0 7px 7px');
        $('.ArtMain0 .mdx-comment-login-needed').css('border-radius','0 0 7px 7px');
    }
    
        //ImgBox
        if(mdx_imgBox==1){
        $('article a > img').each(function(){
            var imgUrlEach = $(this).attr('src');
            if(imgUrlEach=='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAMAAAAoyzS7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFsbGxAAAA/JhxRAAAAAxJREFUeNpiYAAIMAAAAgABT21Z4QAAAABJRU5ErkJggg=='){
                imgUrlEach = $(this).attr('data-original');
            }
            if(imgUrlEach == $(this).parent("a").attr('href')){
                $(this).addClass("mdx-img-in-post");
                $(this).unwrap();
            }else{
                $(this).parent("a").addClass("mdx-img-in-post-with-link");
            }
        });
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
            $("meta[name='theme-color']").attr('content',"#212121");
            $('#imgInBox').on('load', function(){
                $('div.mdx-loading-img').remove();
            })
        })
        $('body').on('click','#close-img-box',function(){
            $('#img-box').css({'opacity':'0','pointer-events':'none'});
            if(sessionStorage.getItem('ns_night-styles')!="true"){
                $("meta[name='theme-color']").attr('content',now_color);
            }else{
                $("meta[name='theme-color']").attr('content',"#212121");
            }
            window.setTimeout("afterCloseImgBox()",200);
        })
    }

        //评论优化
        $('.disfir').hide();
        $('.commurl').hide();
        $("div#comments ul li p").addClass('mdui-typo');
        $('.comment-reply-link').addClass("mdui-btn");
        $('.comment-reply-link').css("opacity","0");
        $('.comment-reply-login').addClass("mdui-btn");
        $('.comment-reply-login').css("opacity","0");
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

var now_url = '';

$("#oth-div").click(function(){
    var howFar2 = document.documentElement.scrollTop || document.body.scrollTop;
    if($(".ArtMain").length > 0){
        var postHight2 = $(".ArtMain").height() + $(".ArtMain").offset().top - document.documentElement.clientHeight;
    }else{
        var postHight2 = $("article.mdui-typo").height() + $("article.mdui-typo").offset().top - document.documentElement.clientHeight;
    }
    var nowPro2 = howFar2/postHight2;
    if(nowPro2 > 1){
        nowPro2 = 1;
    }
    now_url = window.location.href.replace(window.location.search, "")+'?_pro='+nowPro2;
    $('#qrcode').html("");
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: now_url,
        width: 150,
        height: 150,
        correctLevel : QRCode.CorrectLevel.M
    });
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
    $("li.LazyLoadSamePost").lazyload({
        effect : "fadeIn",
        threshold : 200,
        container: $("#mdx-sp-out-c")
    });
});

//Share img
$(function(){
var qrcode = new QRCode(document.getElementById("mdx-si-qr"), {
    text: window.location.href,
    width: 70,
    height: 70,
    correctLevel : QRCode.CorrectLevel.L,
    colorLight: '#f5f5f5'
});

var mdx_post_time = $('.mdx-si-time').html().split("-");
$('.mdx-si-time').html(mdx_post_time[2]+'<br><span class="mdx-si-time-2">'+mdx_post_time[0]+'/'+mdx_post_time[1]+'</span>');
})
function convertCanvasToImage(canvas) {
    var image = new Image();
    var canvasData = canvas.toDataURL("image/png");
    sessionStorage.setItem('si_'+url_hash, canvasData);
    image.src = canvasData;
    document.getElementById('img-box').appendChild(image);
}

function mdx_show_img(){
    $('div.mdui-drawer').before('<div id="img-box" class="mdui-valign"><button class="mdui-btn mdui-btn-icon mdui-ripple mdui-text-color-white mdui-valign mdui-text-center" id="close-img-box"><i class="mdui-icon material-icons">&#xe5cd;</i></button><div class="mdx-si-tip"><p>'+mdx_si_i18n+'</p></div></div><div class="mdui-valign mdx-loading-img"><div class="mdui-center"><div class="mdui-spinner"></div></div></div>');
    mdui.updateSpinners();
    $('#img-box').css({'opacity':'1','pointer-events':'auto'});
    $("meta[name='theme-color']").attr('content',"#212121");
    $('#mdx-share-img').show();
        if(!sessionStorage.getItem('si_'+url_hash)){
        html2canvas(document.getElementById("mdx-share-img"),{allowTaint: true}).then(function(canvas){
            convertCanvasToImage(canvas);
            $('#img-box > img').addClass('imgInBox');
            $('#img-box > img').addClass('mdui-center');
            $('#img-box > img').attr('id','imgInBox');
            $('#imgInBox').css('opacity','1');
            var w = 430;
            var h = 700;
            var wincli = document.body.clientWidth/$(window).height();
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
            $('.mdx-si-tip').addClass('mdx-si-tip-showed');
            $('#mdx-share-img').hide();
            $('div.mdx-loading-img').remove();
        });
        }else{
            var image = new Image();
            image.src = sessionStorage.getItem('si_'+url_hash);
            document.getElementById('img-box').appendChild(image);
            $('#img-box > img').addClass('imgInBox');
            $('#img-box > img').addClass('mdui-center');
            $('#img-box > img').attr('id','imgInBox');
            $('#imgInBox').css('opacity','1');
            var w = 430;
            var h = 700;
            var wincli = document.body.clientWidth/$(window).height();
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
            $('.mdx-si-tip').addClass('mdx-si-tip-showed');
            $('#mdx-share-img').hide();
            $('div.mdx-loading-img').remove();
        }
}
$('body').on('click','#close-img-box',function(){
    $('#img-box').css({'opacity':'0','pointer-events':'none'});
    if(sessionStorage.getItem('ns_night-styles')!="true"){
        $("meta[name='theme-color']").attr('content',now_color);
    }else{
        $("meta[name='theme-color']").attr('content',"#212121");
    }
    window.setTimeout("afterCloseImgBox()",200);
})

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
            $('.comment-reply-login').addClass("mdui-btn");
            $('.comment-reply-login').css("opacity","0");
        }
    });
});

//tap tp top
$('.mdui-typo-headline').click(function(){
    if(mdx_tapToTop==1){
        $("body,html").animate({scrollTop:0},500);
    }
})