//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var whetherChangeToTop = 0;
var blogName = document.querySelector('div.mdui-toolbar > a.mdui-typo-headline').innerHTML;
var blogUrl = document.querySelector('div.mdui-toolbar > a.mdui-typo-headline').getAttribute("href");
var metaColor = document.querySelector("meta[name='theme-color']");
var colorEnabled = false;
var nowColor = '';
if(metaColor){
    nowColor = document.querySelector("meta[name='mdx-main-color']").getAttribute('content');
    colorEnabled = true;
}
var ifOffline = typeof offlineMode === "undefined" ? false : offlineMode;
var ticking = false;
window.onscroll=function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
function scrollDiff(){
    var howFar = document.documentElement.scrollTop || document.body.scrollTop;
    var hedlineDOM = document.querySelector("div.mdui-toolbar > a.mdui-typo-headline");
    if(howFar > 10 && whetherChange == 0){
        document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
        whetherChange = 1;
    }
    if(howFar <= 10 && whetherChange == 1){
        document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
        whetherChange = 0;
    }
    if(howFar > 170 && whetherChangeToTop == 0){
        document.querySelector(".scrollToTop").classList.toggle("mdui-fab-hide");
        hedlineDOM.innerHTML = acPageTitle;
        hedlineDOM.removeAttribute("href");
        whetherChangeToTop = 1;
    }
    if(howFar <= 170 && whetherChangeToTop == 1){
        document.querySelector(".scrollToTop").classList.toggle("mdui-fab-hide");
        hedlineDOM.innerHTML = blogName;
        hedlineDOM.setAttribute("href",blogUrl);
        whetherChangeToTop = 0;
    }
    ticking = false;
};
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

 //tap tp top
 document.getElementsByClassName("mdui-typo-headline")[0].addEventListener("click", function(){
    if(mdx_tapToTop==1){
        $("body,html").animate({scrollTop:0},500);
    }
})

//init menu
$(function(){
    scrollDiff();
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