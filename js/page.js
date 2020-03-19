//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChangeToTop = 0;
var blogName = $('div.mdui-toolbar > a.mdui-typo-headline').html();
var postTitle = $('div.mdui-text-color-white-text.mdui-typo-display-1.PostTitlePage').text();
var blogUrl = $('div.mdui-toolbar > a.mdui-typo-headline').attr("href");
var metaColor = document.querySelector("meta[name='theme-color']");
var colorEnabled = false;
var nowColor = '';
var imgRaw;
if(metaColor){
    nowColor = document.querySelector("meta[name='mdx-main-color']").getAttribute('content');
    colorEnabled = true;
}
var ticking = false;
var barHight = $(".PostTitlePage").height() - $(".titleBarGobal").height() - 2;
var totalHight = $(".PostTitlePage").height()*.5 - 20;
var winheight = $(window).height();
var winwidth = $(window).width();
var ifOffline = typeof offlineMode === "undefined" ? false : offlineMode;
window.onscroll=function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
window.onresize = function(){
    barHight = $(".PostTitlePage").height() - $(".titleBarGobal").height() - 2;
    totalHight = $(".PostTitlePage").height()*.5 - 20;
    winheight = $(window).height();
    winwidth = $(window).width();
}
function scrollDiff(){
    var howFar = document.documentElement.scrollTop || document.body.scrollTop;
    if(howFar > barHight & whetherChangeToTop == 0){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $(".toolbar-page").toggleClass("mdui-color-theme");
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(postTitle).removeAttr("href");
        whetherChangeToTop = 1;
    }
    if(howFar <= barHight & whetherChangeToTop == 1){
        $("#titleBarinPost").toggleClass("mdui-shadow-2");
        $(".toolbar-page").toggleClass("mdui-color-theme");
        $(".scrollToTop").toggleClass("mdui-fab-hide");
        $("div.mdui-toolbar > a.mdui-typo-headline").html(blogName).attr("href",blogUrl);
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
    if(document.getElementsByClassName("PostTitleFillPage").length){
        document.getElementsByClassName("PostTitleFillPage")[0].style.setProperty('opacity', opacityHeight, 'important');
    }
    ticking = false;
};

window.onload=function() {
    init_wp_block();
    scrollDiff();
    $('body > .mdui-progress').fadeOut(200);
    document.querySelectorAll('.wp-block-mdx-fold').forEach(item => {
        item.setAttribute('mdui-panel', '');
    });
    mdui.JQ(".wp-block-mdx-fold").mutation();
    if(ifscr == 1){
        var oldpro = parseFloat(GetQueryString("_pro"));
        var postHight3 = $(".ArtMain").height() + $(".ArtMain").offset().top - document.documentElement.clientHeight;
        var scro = postHight3*oldpro;
        if(scro>200){
          $("body,html").animate({scrollTop:scro},700);
          snbar();
        }
    }
    setTimeout("mdx_shortcode()",1000);
    let indexBgDom = document.getElementsByClassName('PostTitleFillPage');
    if(indexBgDom.length > 0){
        setTimeout(() => {
            indexBgDom[0].classList.add("mdx-anmi-loaded");
            indexBgDom[0].style.setProperty('transition', 'opacity 0s', 'important');
        }, 500);
    }
}

function init_wp_block() {
    if($("*[class*='wp-block-']").length > 0){
        $(".wp-block-button").css("margin-bottom", "1.2em").removeClass("wp-block-button");
        $("a.wp-block-button__link").removeClass("wp-block-button__link").addClass("mdui-btn mdui-color-theme-accent mdui-ripple");
        $("a.wp-block-file__button").removeClass("wp-block-file__button").addClass("mdui-btn mdui-color-theme-accent mdui-ripple");
        $(".wp-block-file").prepend('<i class="mdui-icon material-icons">&#xe24d;</i>');
        $(".wp-block-pullquote").removeClass("wp-block-pullquote");
        $(".wp-block-table").removeClass("wp-block-table has-subtle-pale-blue-background-color has-background is-style-stripes has-fixed-layout is-style-regular has-subtle-pale-green-background-color has-subtle-pale-pink-background-color has-subtle-light-gray-background-color").addClass("mdui-table mdx-dny-table mdui-table-hoverable").wrap('<div class="mdui-table-fluid"></div>');
        mdui.JQ(".mdx-dny-table").mutation();
    }
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
                    if(data.homepage !== "" && data.homepage !== null){
                        githubHomepage = ' <a href="'+data.homepage+'" ref="nofollow" target="_blank">'+data.homepage+"</a>";
                    }
                    if(data.description !== null){
                        githubHomepage = '<br>'+data.description+githubHomepage;
                    }
                    var dataStars = data.stargazers_count;
                    if(dataStars >= 1000){
                        dataStars = Math.round((dataStars/1000)*Math.pow(10, 1))/Math.pow(10, 1)+'k';
                    }
                    document.getElementById("mdx-github-"+data.full_name).innerHTML='<div class="mdx-github-main"><a href="https://github.com/" ref="nofollow" target="_blank" class="gh-link" title="GitHub"><svg class="icon mdx-github-icon" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg"><defs><style/></defs><path d="M950.93 512q0 143.43-83.75 257.97T650.9 928.55q-15.43 2.85-22.6-4.02t-7.17-17.12V786.87q0-55.44-29.7-81.11 32.55-3.44 58.6-10.32t53.68-22.3T750 635.1t30.28-59.98 11.7-86.01q0-69.12-45.13-117.7 21.14-52-4.53-116.58-16.02-5.12-46.3 6.29t-52.6 25.16l-21.72 13.68Q568.54 285.1 512 285.1t-109.71 14.85q-9.15-6.3-24.29-15.43t-47.69-22.02-49.15-7.68q-25.16 64.58-4.02 116.59Q232 419.99 232 489.1q0 48.56 11.7 85.72t30 59.98 46 38.25 53.68 22.3 58.6 10.32q-22.83 20.56-28.02 58.88-12 5.7-25.75 8.56t-32.55 2.85-37.45-12.29T276.48 728q-10.83-18.28-27.72-29.7t-28.3-13.67l-11.42-1.69q-12 0-16.6 2.56t-2.85 6.59 5.12 7.97 7.46 6.88l4.02 2.85q12.58 5.7 24.87 21.72t18 29.11l5.7 13.17q7.46 21.72 25.16 35.1T318.17 826t39.72 4.03 31.74-1.98l13.17-2.27q0 21.73.29 50.84t.3 30.86q0 10.32-7.47 17.12t-22.82 4.02Q240.57 884.6 156.82 770.05T73.07 512.07q0-119.44 58.88-220.3t159.74-159.75T512 73.14t220.3 58.88 159.75 159.75 58.88 220.3z" fill="#fff"/></svg> <span>GitHub</span></a><br><a href="https://github.com/'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'" ref="nofollow" target="_blank" class="repo-link"><span>'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/</span>"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'</a>'+githubHomepage+'<br><br>★ '+dataStars+'<a href="https://github.com/'+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithuba+"/"+document.getElementById("mdx-github-"+data.full_name).dataset.mdxgithubp+'" ref="nofollow" target="_blank" class="repo-link mdx-github-arrow"><i class="mdui-icon material-icons" title="'+mdx_github_i18n_1+'">&#xe5c8;</i></a></div>';
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
                    var img = "";
                    if(data.match(reg4)){
                        img = data.match(reg4)[1];
                    }
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
document.getElementsByClassName("scrollToTop")[0].addEventListener("click", function(){
    $("body,html").animate({scrollTop:0},500);
}, false);

//Night Styles
var nsButton = document.getElementById("tgns");
if(nsButton){
    document.getElementById("tgns").addEventListener("click", function(){
        if(!document.getElementsByTagName("body")[0].classList.contains("mdui-theme-layout-dark")){
            sessionStorage.setItem('ns_night-styles', 'true');
            if(colorEnabled){
                metaColor.setAttribute('content',"#212121");
            }
        }else{
            sessionStorage.setItem('ns_night-styles', 'false');
            if(colorEnabled){
                metaColor.setAttribute('content',nowColor);
            }
        }
        document.getElementsByTagName("body")[0].classList.toggle("mdui-theme-layout-dark");
    }, false);
}

var lazyloadImg = document.querySelectorAll("article > *:not(figure) figure:not(.wp-block-image) img, article > figure:not(.wp-block-image) > img");
if(lazyloadImg.length){
    for(e of lazyloadImg){
        e.addEventListener('lazyloaded', function(e){
            setTimeout(() => {
                var prevDom;
                if(e.target.previousSibling){
                    prevDom = e.target.previousSibling;
                }else{
                    prevDom = e.target.parentNode.previousSibling;
                    e.target.parentNode.classList.add("mdx-img-loaded-no-anim");
                }
                prevDom.previousSibling.remove();
                prevDom.remove();
                e.target.classList.add("mdx-img-loaded-no-anim");
            }, 300);
        })
    }
};
var lazyloadImg2 = document.querySelectorAll("article > figure.wp-block-image img");
if(lazyloadImg2.length){
    for(e of lazyloadImg2){
        e.addEventListener('lazyloaded', function(e){
            var prevDom;
            if(e.target.previousSibling){
                prevDom = e.target.previousSibling;
            }else{
                prevDom = e.target.parentNode.previousSibling;
                e.target.parentNode.classList.add("mdx-img-loaded-no-anim");
            }
            prevDom.previousSibling.remove();
            prevDom.remove();
            e.target.classList.add("mdx-img-loaded-no-anim");
        })
    }
};

$(function(){
    if(mdx_comment_ajax && $('#comments-navi>a.prev').attr('href')){
        $('#comments-navi').html('<button class="mdx-more-comments mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" data-comment-url="'+$('#comments-navi>a.prev').attr('href')+'"><i class="mdui-icon material-icons">keyboard_arrow_down</i></button>');
    }

    if(ifOffline){
        $('#respond').html(tipMutiOffRes);
    }

    $('article a > figure > img.lazyload, article > figure > img.lazyload, article a > figure > img.lazyloaded, article > figure > img.lazyloaded, article a > figure > img.lazyloading, article > figure > img.lazyloading').each(function(){
        if(this.classList.contains("aligncenter")){
            this.parentNode.classList.add("aligncenter");
        }else if(this.classList.contains("alignright")){
            this.parentNode.classList.add("alignright");
            let insertDOM = document.createElement("div");
            insertDOM.classList.add("mdx-clear-float");
            this.parentNode.parentNode.insertBefore(insertDOM, this.parentNode.nextSibling);
        }else if(this.classList.contains("alignleft")){
            this.parentNode.classList.add("alignleft");
        }
    });
    
        //ImgBox
        if(mdx_imgBox==1){
            $('article a > img').each(function(){
                var imgUrlEach = $(this).attr('src');
                if(imgUrlEach=='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' || imgUrlEach=='data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw=='){
                    imgUrlEach = $(this).attr('data-src').split("?")[0];
                }
                var imgHref = $(this).parent("a").attr('href').split('.')
                imgHref.pop();
                var imgHrefa = imgHref.join('.') + '-';
                if(imgUrlEach.indexOf(imgHrefa) != -1 || imgUrlEach == $(this).parent("a").attr('href') || imgUrlEach == $(this).parent("a").attr('href')+"-towebp"){
                    $(this).addClass("mdx-img-in-post");
                    $(this).unwrap();
                }else{
                    $(this).parent("a").addClass("mdx-img-in-post-with-link");
                }
            });
            $('article a > figure > img.lazyload, article a > figure > img.lazyloaded, article a > figure > img.lazyloading').each(function(){
                var imgUrlEach = $(this).attr('src');
                if(imgUrlEach=='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' || imgUrlEach=='data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw=='){
                    imgUrlEach = $(this).attr('data-src').split("?")[0];
                }
                var imgHref = $(this).parent("figure").parent("a").attr('href').split('.')
                imgHref.pop();
                var imgHrefa = imgHref.join('.') + '-';
                if(imgUrlEach.indexOf(imgHrefa) != -1 || imgUrlEach == $(this).parent("figure").parent("a").attr('href') || imgUrlEach == $(this).parent("figure").parent("a").attr('href')+"-towebp"){
                    $(this).addClass("mdx-img-in-post");
                    $(this).parent("figure").unwrap();
                }else{
                    $(this).wrap('<a class="mdx-img-in-post-with-link" href="'+$(this).parent("figure").parent("a").attr('href')+'"></a>');
                    $(this).parent("a").parent("figure").unwrap();
                }
            });
        $('img.mdx-img-in-post').click(function(){
            var toTopDes = $(this)[0].getBoundingClientRect().top, toLeftDes = $(this)[0].getBoundingClientRect().left;
            var imgUrl = $(this).attr('src');
            if(imgUrl=='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' || imgUrl=='data:image/gif;base64,R0lGODlhAgABAIAAALGxsQAAACH5BAAAAAAALAAAAAACAAEAAAICBAoAOw=='){
                imgUrl = $(this).attr('data-original');
            }
            imgRaw = $(this);
            imgRaw.css({"opacity":"0"});
            $('div.mdui-drawer').before('<div id="img-box" class="mdui-valign"></div><div class="mdx-img-viewer"></div><div class="mdui-valign mdx-loading-img"><div class="mdui-center"><div class="mdui-spinner"></div></div></div>');
            mdui.updateSpinners();
            $('.mdx-img-viewer').append("<img src=\""+$(this).attr("src")+"\" style=\"top:"+toTopDes+"px;left:"+toLeftDes+"px;width:"+$(this).width()+"px;height:"+$(this).height()+"px;\" data-raww=\""+$(this).width()+"\" data-rawh=\""+$(this).height()+"\" data-post=\""+toTopDes+"\" data-posl=\""+toLeftDes+"\">");
            $('#img-box').css({"display": "flex", "opacity": "1"});
            getImageWidth(imgUrl,function(w,h,img){
                $('.mdx-img-viewer').show();
                var imgWdh = w/h,windowWdh = winwidth/winheight;
                if(imgWdh>windowWdh){
                    if($(img)[0].naturalWidth>=winwidth){
                        $('.mdx-img-viewer img').animate({'width':winwidth+'px','height':winwidth/imgWdh+'px','top':(winheight-(winwidth/imgWdh))/2+'px','left':'0'},200,function(){$(this).css('transition','all .2s')});
                    }else{
                        $('.mdx-img-viewer img').animate({'width':$(img)[0].naturalWidth+'px','height':$(img)[0].naturalHeight+'px','top':(winheight-($(img)[0].naturalHeight))/2+'px','left':(winwidth-($(img)[0].naturalWidth))/2+'px'},200,function(){$(this).css('transition','all .2s')});
                    }
                }else{
                    if($(img)[0].naturalHeight>=winheight){
                        $('.mdx-img-viewer img').animate({'width':winheight*imgWdh+'px','height':winheight+'px','top':'0','left':(winwidth-(winheight*imgWdh))/2+'px'},200,function(){$(this).css('transition','all .2s')});
                    }else{
                        $('.mdx-img-viewer img').animate({'width':$(img)[0].naturalWidth+'px','height':$(img)[0].naturalHeight+'px','top':(winheight-($(img)[0].naturalHeight))/2+'px','left':(winwidth-($(img)[0].naturalWidth))/2+'px'},200,function(){$(this).css('transition','all .2s')});
                    }
                }
            })
            function getImageWidth(url,callback){
                var img = new Image();
                img.src = url;
                if(img.complete){
                    callback(img.width, img.height, img);
                    $('div.mdx-loading-img').remove();
                }else{
                    $('.mdx-img-viwer').hide();
                    img.onload = function(){
                        callback(img.width, img.height, img);
                        $('div.mdx-loading-img').remove();
                    }
                }
            }
            if(colorEnabled){
                metaColor.setAttribute('content',"#212121");
            }
            $('.mdx-img-viwer').on('load', function(){
                $('div.mdx-loading-img').remove();
            })
        })
        $('body').on('click','.mdx-img-viewer',function(){
            $('#img-box').css({'opacity':'0','pointer-events':'none'});
            $('.mdx-img-viewer img').css({'width':$('.mdx-img-viewer img').attr("data-raww")+"px",'height':$('.mdx-img-viewer img').attr("data-rawh")+"px",'top':$('.mdx-img-viewer img').attr("data-post")+"px",'left':$('.mdx-img-viewer img').attr("data-posl")+"px"});
            if(colorEnabled){
                if(sessionStorage.getItem('ns_night-styles')!="true"){
                    metaColor.setAttribute('content',nowColor);
                }else{
                    metaColor.setAttribute('content',"#212121");
                }
            }
            window.setTimeout("afterCloseImgBox()",200);
        })
    }
    $('article a > img:not(.lazyload):not(.lazyloaded):not(.lazyloading)').each(function(){
        $(this).parent("a").addClass("mdx-nonlazy-link");
    });
    $('article img.alignright:not(.lazyload):not(.lazyloaded):not(.lazyloading)').each(function(){
            let insertDOM = document.createElement("div");
            insertDOM.classList.add("mdx-clear-float");
            this.parentNode.insertBefore(insertDOM, this.nextSibling);
    });

        //评论优化
        $('.disfir, .commurl').hide();
        $("div#comments ul li p").addClass('mdui-typo');
        $('.comment-reply-link').addClass("mdui-btn").css("opacity","0");
        $('.comment-reply-login').addClass("mdui-btn").css("opacity","0");
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

        if(document.getElementsByTagName("body")[0].classList.contains("mdx-reduce-motion")){
            var mrm = window.matchMedia("(prefers-reduced-motion: reduce)");
            mrm.addListener(handleMotionChange);
            handleMotionChange(mrm);
        }
    })
    
function handleMotionChange(mrm){
    if(sessionStorage.getItem("mrm_enable") === "user"){
        document.getElementsByTagName("body")[0].classList.remove("mdx-reduce-motion");
        return;
    }
    if(mrm.matches && document.getElementsByTagName("body")[0].classList.contains("mdx-reduce-motion")){
        if(!sessionStorage.getItem("mrm_enable")){
            mdui.snackbar({
                message: reduce_motion_i18n_1,
                buttonText: reduce_motion_i18n_2,
                timeout: 7000,
                onButtonClick: function(){
                    sessionStorage.setItem("mrm_enable", "user");
                    document.getElementsByTagName("body")[0].classList.remove("mdx-reduce-motion");
                },
                position: 'top',
            });
            sessionStorage.setItem("mrm_enable", "sys");
            document.getElementsByTagName("body")[0].classList.add("mdx-reduce-motion");
        }
    }else{
        if(sessionStorage.getItem("mrm_enable")){
            mdui.snackbar({
                message: reduce_motion_i18n_3,
                timeout: 5000,
                position: 'top',
            });
        }
        sessionStorage.removeItem("mrm_enable");
    }
}

function afterCloseImgBox(){
    imgRaw.css({"opacity":"1"});
    $('div#img-box').remove();
    $('.mdx-loading-img').remove();
    $(".mdx-img-viewer").remove();
}

$('#comment').focus(function(){
    $('.disfir').fadeIn(200);
    $('a.moreInComm').css({"opacity":"1","pointer-events":"auto"});
})


//Search
document.getElementsByClassName("seai")[0].addEventListener("click", function(){
    let searchBarDOM = document.getElementById("SearchBar");
    searchBarDOM.style.display = "block";
    $(".OutOfsearchBox").fadeIn(300);
    searchBarDOM.classList.add("mdui-color-theme");
    $(".fullScreen").fadeIn(300);
    $("#SearchBar > *").animate({opacity:'1'},200);
    document.getElementsByClassName("outOfSearch")[0].style.width = '75%';
    document.getElementsByClassName("seainput")[0].focus();
    document.getElementsByTagName("body")[0].classList.toggle('mdx-search-lock');
    if(ifOffline){
        let searchBoxDOM = document.getElementsByClassName('OutOfsearchBox')[0];
        searchBoxDOM.innerHTML = '<div class="searchBoxFill"></div><div class="underRes">'+tipMutiOff+'</div>';
        searchBoxDOM.style.pointerEvents = 'auto';
        document.getElementsByClassName("seainput")[0].setAttribute('disabled','disabled');
    }
}, false);
for(let ele of document.getElementsByClassName("sea-close")){
    ele.addEventListener("click", closeSearch, false);
}
function closeSearch(){
    document.getElementsByClassName("seainput")[0].blur();
    $("#SearchBar > *").animate({opacity:'0'},200);
    $(".fullScreen").fadeOut(300);
    $(".OutOfsearchBox").fadeOut(300);
    document.getElementsByClassName("outOfSearch")[0].style.width = '30%';
    window.setTimeout("hideBar()",300);
    document.getElementById("SearchBar").classList.remove("mdui-color-theme");
    setTimeout(() => {
        let bodyDOM = document.getElementsByTagName("body")[0];
        if(bodyDOM.classList.contains('mdx-search-lock')){
            bodyDOM.classList.toggle('mdx-search-lock');
        }
        document.getElementsByClassName("outOfSearch")[0].removeAttribute("style");
    }, 300);
};

function hideBar(){
    document.getElementById("SearchBar").style.display = "none";
}

function hideBar(){
    document.getElementById("SearchBar").style.display = "none";
}
 
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
                $("div#comments ul li p").addClass('mdui-typo');
                $('.comment-reply-link').addClass("mdui-btn").css("opacity","0");
                $('.comment-reply-login').addClass("mdui-btn").css("opacity","0");
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
                $("div#comments ul li p").addClass('mdui-typo');
                $('.comment-reply-link').addClass("mdui-btn").css("opacity","0");
                $('.comment-reply-login').addClass("mdui-btn").css("opacity","0");
            }
        });
    });
    }

//tap tp top
document.getElementsByClassName("mdui-typo-headline")[0].addEventListener("click", function(){
    if(mdx_tapToTop==1){
        $("body,html").animate({scrollTop:0},500);
    }
})

//init menu
$(function(){
    var mdxHaveChild = 0;
    var mdxIsC = 0;
    for(let ele of document.querySelectorAll('#mdx_menu > li')){
        if(ele.classList.contains('menu-item-has-children')){
            ele.classList.add('mdui-collapse-item');
            ele.classList.remove('mdui-list-item');
            ele.innerHTML = '<div class="mdui-collapse-item-header mdui-list-item mdui-ripple"><div class="mdui-list-item-content"><a class="mdx-sub-menu-a" href="'+ele.getElementsByTagName("a")[0].getAttribute('href')+'">'+ele.getElementsByTagName("a")[0].innerHTML+'</a></div><i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></div><ul class="mdui-collapse-item-body mdui-list mdui-list-dense">'+ele.getElementsByTagName("ul")[0].innerHTML+'</ul>';
            mdxHaveChild = 1;
            for(let ul of ele.getElementsByTagName("ul")){
                for(let li of ul.getElementsByTagName("li")){
                    if(li.classList.contains('current-menu-item')){
                        mdxIsC = 1;
                    }
                }
            }
            if(mdxIsC){
                ele.classList.remove('current-menu-item', 'current_page_item');
                ele.classList.add('mdui-collapse-item-open');
            }
            mdxIsC = 0;
        }
        if(mdxHaveChild){
            let menuDOM = document.getElementById('mdx_menu');
            menuDOM.classList.add('mdui-collapse');
            menuDOM.setAttribute('mdui-collapse','');
        }
    }
    new mdui.Collapse("#mdx_menu");

    //cookie
    var ifDisplay = typeof displayCookie === "undefined" ? true : displayCookie;
    var cookieEle = document.getElementById("mdx-cookie-notice");
    if(ifDisplay && cookieEle && !localStorage.getItem("mdx_cookie")){
        cookieEle.classList.add("mdx-cookie-notice-show");
        cookieEle.getElementsByTagName("button")[0].addEventListener('click', agreeCookie, false);
    }

    function agreeCookie(){
        localStorage.setItem("mdx_cookie" ,"true");
        document.getElementById("mdx-cookie-notice").style.bottom = "-400px";
        setTimeout(() => {
            document.getElementById("mdx-cookie-notice").classList.remove("mdx-cookie-notice-show");
        }, 400);
    }

    var cfcc = document.getElementsByClassName('comment-form-cookies-consent');
    if(cfcc.length > 0){
        $('#wp-comment-cookies-consent').after('<i class="mdui-checkbox-icon"></i>');
        cfcc[0].innerHTML = '<label class="mdui-checkbox">' + cfcc[0].innerHTML + '</label>';
    }
})