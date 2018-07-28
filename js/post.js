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

window.onload=function(){
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
  setTimeout("mdx_shortcode()",1000);
}
function mdx_shortcode(){
    if($(".mdx-github-cot").length>0){
        for(var i=0;i<document.getElementsByClassName("mdx-github-cot").length;i++){
            document.getElementsByClassName("mdx-github-cot")[i].id = "mdx-github-"+document.getElementsByClassName("mdx-github-cot")[i].dataset.mdxgithuba+"/"+document.getElementsByClassName("mdx-github-cot")[i].dataset.mdxgithubp;
            var apiurl = "https://api.github.com/repos/"+document.getElementsByClassName("mdx-github-cot")[i].dataset.mdxgithuba+"/"+document.getElementsByClassName("mdx-github-cot")[i].dataset.mdxgithubp;
            $.ajaxSetup({
                timeout: 15000
            })
            $.ajax({
                url: apiurl, 
                type: 'get',
                success: function(data){
                    var githubHomepage = "";
                    if(data.homepage !== ""){
                        githubHomepage = ' <a href="'+data.homepage+'" ref="nofollow" target="_blank">'+data.homepage+"</a>";
                    }
                    var dataStars = data.stargazers_count;
                    if(dataStars >= 1000){
                        dataStars = Math.round((dataStars/1000)*Math.pow(10, 1))/Math.pow(10, 1)+'k';
                    }
                    document.getElementById("mdx-github-"+data.full_name).innerHTML='<div class="mdx-github-main"><a href="https://github.com/" ref="nofollow" target="_blank" class="gh-link" title="Github"><svg class="icon mdx-github-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><defs><style/></defs><path d="M950.93 512q0 143.43-83.75 257.97T650.9 928.55q-15.43 2.85-22.6-4.02t-7.17-17.12V786.87q0-55.44-29.7-81.11 32.55-3.44 58.6-10.32t53.68-22.3T750 635.1t30.28-59.98 11.7-86.01q0-69.12-45.13-117.7 21.14-52-4.53-116.58-16.02-5.12-46.3 6.29t-52.6 25.16l-21.72 13.68Q568.54 285.1 512 285.1t-109.71 14.85q-9.15-6.3-24.29-15.43t-47.69-22.02-49.15-7.68q-25.16 64.58-4.02 116.59Q232 419.99 232 489.1q0 48.56 11.7 85.72t30 59.98 46 38.25 53.68 22.3 58.6 10.32q-22.83 20.56-28.02 58.88-12 5.7-25.75 8.56t-32.55 2.85-37.45-12.29T276.48 728q-10.83-18.28-27.72-29.7t-28.3-13.67l-11.42-1.69q-12 0-16.6 2.56t-2.85 6.59 5.12 7.97 7.46 6.88l4.02 2.85q12.58 5.7 24.87 21.72t18 29.11l5.7 13.17q7.46 21.72 25.16 35.1T318.17 826t39.72 4.03 31.74-1.98l13.17-2.27q0 21.73.29 50.84t.3 30.86q0 10.32-7.47 17.12t-22.82 4.02Q240.57 884.6 156.82 770.05T73.07 512.07q0-119.44 58.88-220.3t159.74-159.75T512 73.14t220.3 58.88 159.75 159.75 58.88 220.3z" fill="#fff"/></svg> <span>Github</span></a><br><a href="https://github.com/'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'" ref="nofollow" target="_blank" class="repo-link"><span>'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/</span>"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'</a><br>'+data.description+githubHomepage+'<br><br>★ '+dataStars+'<a href="https://github.com/'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'" ref="nofollow" target="_blank" class="repo-link mdx-github-arrow"><i class="mdui-icon material-icons" title="'+mdx_github_i18n_1+'">&#xe5c8;</i></a></div>';
                }, 
                error: (function(x){
                    return function(){
                        document.getElementsByClassName("mdx-github-cot")[x].getElementsByClassName("mdx-github-wait-out")[0].innerHTML=mdx_github_i18n_2+" <a rel=\"nofollow\" target=\"_blank\" href=\"https://github.com/"+document.getElementsByClassName("mdx-github-cot")[x].dataset.mdxgithuba+"/"+document.getElementsByClassName("mdx-github-cot")[x].dataset.mdxgithubp+"\">https://github.com/"+document.getElementsByClassName("mdx-github-cot")[x].dataset.mdxgithuba+"/"+document.getElementsByClassName("mdx-github-cot")[x].dataset.mdxgithubp+"</a>";
                    }
                })(i)
            })
        }
    }
    if($(".mdx-post-cot").length>0){
        for(var i=0;i<document.getElementsByClassName("mdx-post-cot").length;i++){
            document.getElementsByClassName("mdx-post-cot")[i].id = "mdx-post-"+document.getElementsByClassName("mdx-post-cot")[i].dataset.mdxposturl;
            $.ajaxSetup({
                timeout: 15000
            })
            $.ajax({
                url: document.getElementsByClassName("mdx-post-cot")[i].dataset.mdxposturl, 
                type: 'get',
                success: function(data){
                    var reg = new RegExp('property="og:title" content="(.*?)"');
                    var title = data.match(reg)[1];
                    var reg2 = new RegExp('property="og:url" content="(.*?)"');
                    var url = data.match(reg2)[1];
                    var reg3 = new RegExp('class="mdx-si-sum">(.*?)<');
                    var reg5 = new RegExp('property="og:description" content="(.*?)"');
                    var desc = "";
                    if(data.match(reg3)){
                        desc = data.match(reg3)[1];
                    }else{
                        desc = data.match(reg5)[1];
                    }
                    if(desc === ''){
                        desc = mdx_post_i18n_1;
                    }
                    var reg4 = new RegExp('property="og:image" content="(.*?)"');
                    var img = data.match(reg4)[1];
                    var imgDiv = "";
                    if(!document.getElementById("mdx-post-"+url)){
                        if(url.substr(url.length-1) === "/"){
                            url = url.substr(0,url.length-1);
                        }else{
                            url += "/";
                        }
                    }
                    if(img !== ""){
                        imgDiv = '<div class="mdx-post-card-img" style="background-image:url('+img+');"></div>'
                        document.getElementById("mdx-post-"+url).style.border = "0 solid #dadada";
                    }
                    document.getElementById("mdx-post-"+url).innerHTML='<div class="mdx-post-main"><a href="'+url+'" ref="nofollow" target="_blank" class="post-link">'+title+'</a><br>'+desc+'<br><br><a href="'+url+'" ref="nofollow" target="_blank" class="arrow-link mdx-github-arrow"><i class="mdui-icon material-icons" title="'+mdx_post_i18n_2+'">&#xe5c8;</i></a></div>'+imgDiv;
                }, 
                error: (function(x){
                    return function(){
                        document.getElementsByClassName("mdx-post-cot")[x].getElementsByClassName("mdx-github-wait-out")[0].innerHTML=mdx_post_i18n_3+" <a rel=\"nofollow\" target=\"_blank\" href=\""+document.getElementsByClassName("mdx-post-cot")[x].dataset.mdxposturl+"\">"+document.getElementsByClassName("mdx-post-cot")[x].dataset.mdxposturl+"</a>";
                    }
                })(i)
            })
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
    if(mdx_comment_ajax && $('#comments-navi>a.prev').attr('href')){
        $('#comments-navi').html('<button class="mdx-more-comments mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" data-comment-url="'+$('#comments-navi>a.prev').attr('href')+'"><i class="mdui-icon material-icons">keyboard_arrow_down</i></button>');
    }
    if(sessionStorage.getItem('ns_night-styles')=='true'){
        $("body").addClass("mdui-theme-layout-dark");
        $("meta[name='theme-color']").attr('content',"#212121");
    }

    if($('#comments > ul').length == 0){
        $('.ArtMain0 #respond').css('border-radius','0 0 7px 7px');
        $('.ArtMain0 .mdx-comment-login-needed').css('border-radius','0 0 7px 7px');
    }

    if(mdx_offline_mode){
        $('#respond').html(tipMutiOffRes);
    }
    
        //ImgBox
        if(mdx_imgBox==1){
        $('article a > img').each(function(){
            var imgUrlEach = $(this).attr('src');
            if(imgUrlEach=='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAMAAAAoyzS7AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAAZQTFRFsbGxAAAA/JhxRAAAAAxJREFUeNpiYAAIMAAAAgABT21Z4QAAAABJRU5ErkJggg=='){
                imgUrlEach = $(this).attr('data-original');
            }
            var imgHref = $(this).parent("a").attr('href').split('.')
            imgHref.pop();
            var imgHrefa = imgHref.join('.') + '-';
            if(imgUrlEach.indexOf(imgHrefa) != -1 || imgUrlEach == $(this).parent("a").attr('href')){
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
    scrollDiff();
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
if(!mdx_comment_ajax){
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
}else{
$('#comments').on('click', '#comments-navi > button', function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('data-comment-url'),
        beforeSend: function(){
            $('#comments-navi').remove();
            $('.mdx-comments-loading').fadeIn(200);
        },
        dataType: "html",
        success: function(out){
            result = $(out).find('ul.mdui-list.ajax-comments').html();
            nextUrl = $(out).find('#comments-navi>a.prev').attr('href');
            if(nextUrl){
                nextlink = $(out).find('#comments-navi').html('<button class="mdx-more-comments mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" data-comment-url="'+$(out).find('#comments-navi>a.prev').attr('href')+'"><i class="mdui-icon material-icons">keyboard_arrow_down</i></button>');
            }else{
                nextlink = $(out).find('#comments-navi').html('<button class="mdui-btn" disabled>'+nomorecomment+'</button>');
            }
            $('.mdx-comments-loading').hide();
            $('ul.mdui-list.ajax-comments').after(nextlink);
            $('ul.mdui-list.ajax-comments').html($('ul.mdui-list.ajax-comments').html()+result);
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
    var inst = new mdui.Collapse("#mdx_menu");
})