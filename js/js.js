//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var metaColor = document.querySelector("meta[name='theme-color']");
var colorEnabled = false;
var nowColor = '';
var openFromTwoRows = false;
if(metaColor){
    nowColor = document.querySelector("meta[name='mdx-main-color']").getAttribute('content');
    colorEnabled = true;
}
var ticking = false;
var mdxStyle = 1;
var currentStyle = 'unset';
var barHight;
var totalHight;
var ifOffline = typeof offlineMode === "undefined" ? false : offlineMode;
if(document.getElementsByClassName("theFirstPage").length === 0){
    mdxStyle = 0;
}else{
    barHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight - document.getElementsByClassName("titleBarGobal")[0].offsetHeight - 1;
    totalHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight*.37 - 20;
}
window.onload = function(){
    scrollDiff();
    let indexBgDom = document.getElementsByClassName('theFirstPage');
    if(indexBgDom.length > 0){
        setTimeout(() => {
            indexBgDom[0].classList.add("mdx-anmi-loaded");
            indexBgDom[0].style.setProperty('transition', 'opacity 0s', 'important');
        }, 500);
    }
}
window.onscroll = function(){
    if(!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
}
window.onresize = function(){
    if(mdxStyle){
        barHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight - document.getElementsByClassName("titleBarGobal")[0].offsetHeight - 1;
        totalHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight*.37 - 20;
    }
    toggleHotPostsOverlay();
    displayHotPostsOverlay();
}
function scrollDiff(){
    if(mdxStyle){
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if(howFar > barHight & whetherChange == 0){
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 1;
        }
        if(howFar <= barHight & whetherChange == 1){
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 0;
        }
        if(currentStyle!=='single'){
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
            document.getElementsByClassName("theFirstPage")[0].style.setProperty('opacity', opacityHeight, 'important');
        }
    }else if(!mdxStyle){
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if(howFar > 20 & whetherChange == 0){
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 1;
        }
        if(howFar <= 20 & whetherChange == 1){
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 0;
        }
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

$(function(){
    //hot posts
    toggleHotPostsOverlay();

    if(document.getElementsByTagName("body")[0].classList.contains("mdx-first-tworows")){
        var hsc = window.matchMedia("screen and (orientation:landscape) and (min-width: 750px)");
        hsc.addListener(handleSearchChange);
        handleSearchChange(hsc);
    }

    if(document.getElementsByTagName("body")[0].classList.contains("mdx-reduce-motion")){
        var mrm = window.matchMedia("(prefers-reduced-motion: reduce)");
        mrm.addListener(handleMotionChange);
        handleMotionChange(mrm);
    }

    displayHotPostsOverlay();
})

function handleSearchChange(hsc){
    if(hsc.matches){
        if(currentStyle === 'tworow'){
            closeSearch();
            document.getElementsByClassName("theFirstPage")[0].style.setProperty('opacity', 1, 'important');
        }
        currentStyle = 'single';
    }else{
        if(currentStyle === 'single'){
            closeSearch();
        }
        currentStyle = 'tworow';
    }
}

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

function toggleHotPostsOverlay() {
    if(document.getElementsByClassName("mdx-hp-g-r").length){
        document.getElementsByClassName("mdx-hp-g-r")[0].style.display = "block";
        var mdxChange = 1;
        var mdxChange2 = 1;
        var mdxSpW = (210 + parseInt(getComputedStyle(document.querySelector("a>div.mdx-li.mdui-card"), null).marginRight))*document.querySelectorAll("a>div.mdx-li.mdui-card").length+10;
        var mdxSpWw = 0;
        var mdxSpS = 0;
        var ele = document.getElementById("mdx-sp-out-c");
        ele.onscroll=function(){
            mdxSpWw = ele.offsetWidth;
            mdxSpS = ele.scrollLeft;
            if(mdxSpS>5 && mdxChange){
                $('.mdx-hp-g-l').fadeIn(200);
                mdxChange = 0;
            }
            else if(mdxSpS<=5 && !mdxChange){
                $('.mdx-hp-g-l').fadeOut(200);
                mdxChange = 1;
            }
            if((mdxSpW - mdxSpWw - mdxSpS)<=1 && mdxChange2){
                $('.mdx-hp-g-r').fadeOut(200);
                mdxChange2 = 0;
            }else if((mdxSpW - mdxSpWw - mdxSpS)>1 && !mdxChange2){
                $('.mdx-hp-g-r').fadeIn(200);
                mdxChange2 = 1;
            }
        }
    }
}

function displayHotPostsOverlay(){
    var parentDOM = document.getElementsByClassName("mdx-posts-may-related");
    if(parentDOM.length){
        DOMList = document.getElementsByClassName("mdx-posts-may-related")[0].getElementsByClassName("mdx-li");
        var listWidth = (DOMList[0].offsetWidth + 8) * DOMList.length - 15;
        if(listWidth < parentDOM[0].offsetWidth){
            document.getElementsByClassName("mdx-hp-g-l")[0].style.visibility="hidden";
            document.getElementsByClassName("mdx-hp-g-r")[0].style.visibility="hidden";
        }else{
            document.getElementsByClassName("mdx-hp-g-l")[0].style.visibility="visible";
            document.getElementsByClassName("mdx-hp-g-r")[0].style.visibility="visible";
        }
    }
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
if(document.getElementsByClassName("mdx-tworow-search").length){
    document.getElementsByClassName("mdx-tworow-search")[0].addEventListener("click", function(){
        setTimeout(() => {
            document.getElementsByTagName("body")[0].classList.toggle('mdx-search-lock');
        }, 500);
        mdui.JQ("#mdx-search-anim").css({'width': this.offsetWidth - 12 + 'px', 'top': this.getBoundingClientRect().top + 'px', 'left': this.getBoundingClientRect().left + 'px'});
        document.getElementById("mdx-search-anim").classList.add('mdx-search-anim-show');
        this.style.visibility = 'hidden';
        let searchBarDOM = document.getElementById("SearchBar");
        searchBarDOM.style.display = "block";
        var searchDom = document.getElementsByClassName('outOfSearch');
        mdui.JQ("#mdx-search-anim").css({'width': document.getElementById('searchform').offsetWidth*.75 - 12 + 'px', 'height': searchDom[0].offsetHeight - 10 + 'px', 'top': searchDom[0].getBoundingClientRect().top + 'px', 'left': '7px', 'backgroundColor': 'rgba(255, 255, 255, 0.3)', 'color': 'rgba(255, 255, 255, .3)'});
        setTimeout(() => {
            document.getElementById('searchform').classList.add("mdx-searchform-show");
            document.getElementById("mdx-search-anim").classList.remove('mdx-search-anim-show');
            document.querySelector('a.mdui-btn.mdui-btn-icon.sea-close').style.opacity = 1;
        }, 500);
        document.getElementById("mdx-search-anim").getElementsByTagName("i")[0].style.color = '#fff';
        $(".OutOfsearchBox").fadeIn(500);
        searchBarDOM.classList.add("mdui-color-theme");
        $(".fullScreen").fadeIn(500);
        document.getElementsByClassName("seainput")[0].focus();
        if(ifOffline){
            let searchBoxDOM = document.getElementsByClassName('OutOfsearchBox')[0];
            searchBoxDOM.innerHTML = '<div class="searchBoxFill"></div><div class="underRes">'+tipMutiOff+'</div>';
            searchBoxDOM.style.pointerEvents = 'auto';
            document.getElementsByClassName("seainput")[0].setAttribute('disabled','disabled');
        }
        openFromTwoRows = true;
    }, false);
}
for(let ele of document.getElementsByClassName("sea-close")){
    ele.addEventListener("click", closeSearch, false);
}

function closeSearch(){
    document.getElementsByClassName("seainput")[0].blur();
    if(openFromTwoRows){
        var searchAnimDom = document.getElementsByClassName("mdx-tworow-search")[0];
        var searchAnim = document.getElementById("mdx-search-anim");
        $(".fullScreen").fadeOut(500);
        document.querySelector('a.mdui-btn.mdui-btn-icon.sea-close').removeAttribute('style');
        document.getElementById("searchform").classList.remove("mdx-searchform-show");
        searchAnim.classList.add('mdx-search-anim-show');
        mdui.JQ("#mdx-search-anim").css({'width': searchAnimDom.offsetWidth - 22 + 'px', 'height': '50px', 'top': searchAnimDom.getBoundingClientRect().top + 'px', 'left': searchAnimDom.getBoundingClientRect().left + 'px', 'backgroundColor': window.getComputedStyle(searchAnimDom).backgroundColor, 'color': window.getComputedStyle(searchAnimDom).color});
        searchAnim.getElementsByTagName("i")[0].style.color = window.getComputedStyle(searchAnimDom.getElementsByTagName("i")[0]).color;
        $(".OutOfsearchBox").fadeOut(500);
        window.setTimeout("hideBar()",500);
        document.getElementById("SearchBar").classList.remove("mdui-color-theme");
        setTimeout(() => {
            let bodyDOM = document.getElementsByTagName("body")[0];
            if(bodyDOM.classList.contains('mdx-search-lock')){
                bodyDOM.classList.toggle('mdx-search-lock');
            }
            document.getElementById("mdx-search-anim").classList.remove('mdx-search-anim-show');
            document.getElementsByClassName("mdx-tworow-search")[0].style.visibility = 'visible';
        }, 500);
    }else{
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
    }
    openFromTwoRows = false;
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
})