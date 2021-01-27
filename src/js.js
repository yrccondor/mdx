import ele from './tools/ele.js';
import fade from './tools/fade.js';
import './ajax.js';
import Opacity from './tools/opacity.js';
import ScrollTo from './tools/scrollTo.js';


import '../style.less';

__webpack_public_path__ = window.mdxPublicPath;

const HTMLScrollTo = new ScrollTo(document.documentElement);
//Toggle TitleBar's Classes and "Scroll To the Top" Bottom's Classes
var whetherChange = 0;
var metaColor = document.querySelector("meta[name='theme-color']");
var colorEnabled = false;
var nowColor = '';
var openFromTwoRows = false;
if (metaColor) {
    nowColor = document.querySelector("meta[name='mdx-main-color']").getAttribute('content');
    colorEnabled = true;
}
var ticking = false;
var mdxStyle = 1;
var currentStyle = 'unset';
var barHight;
var totalHight;
var ifOffline = typeof offlineMode === "undefined" ? false : offlineMode;
if (document.getElementsByClassName("theFirstPage").length === 0) {
    mdxStyle = 0;
} else {
    barHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight - document.getElementsByClassName("titleBarGobal")[0].offsetHeight - 1;
    totalHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight * .37 - 20;
}
window.addEventListener('load', () => {
    scrollDiff();
    let indexBgDom = document.getElementsByClassName('theFirstPage');
    if (indexBgDom.length > 0) {
        setTimeout(() => {
            indexBgDom[0].classList.add("mdx-anmi-loaded");
            indexBgDom[0].style.setProperty('transition', 'opacity 0s', 'important');
        }, 500);
    }
})
window.addEventListener('scroll', () => {
    if (!ticking) {
        requestAnimationFrame(scrollDiff);
        ticking = true;
    }
})
window.addEventListener('resize', () => {
    if (mdxStyle) {
        barHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight - document.getElementsByClassName("titleBarGobal")[0].offsetHeight - 1;
        totalHight = document.getElementsByClassName("theFirstPage")[0].offsetHeight * .37 - 20;
    }
    toggleHotPostsOverlay();
    displayHotPostsOverlay();
})
function scrollDiff() {
    if (mdxStyle) {
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if (howFar > barHight & whetherChange == 0) {
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 1;
        }
        if (howFar <= barHight & whetherChange == 1) {
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 0;
        }
        let opacityHeight = 0;
        if (currentStyle !== 'single') {
            if (howFar <= barHight) {
                opacityHeight = (barHight - howFar) / totalHight;
                if (opacityHeight > 1) {
                    opacityHeight = 1;
                }
            } else if (howFar > barHight) {
                opacityHeight = 0;
            } else {
                opacityHeight = 1;
            }
            document.getElementsByClassName("theFirstPage")[0].style.setProperty('opacity', opacityHeight, 'important');

            const slideDOMStyle1 = document.querySelectorAll('.slide-style-1 .mdx-slide-content');
            if (slideDOMStyle1.length > 0) {
                for (const e of [...slideDOMStyle1]) {
                    e.style.setProperty('background-color', `rgba(var(--mdx-theme-color-with-white-head), ${(1 - opacityHeight) * .4 + .6})`, 'important');
                }
                ele('.swiper-pagination', (e) => {
                    e.style.setProperty('opacity', opacityHeight, 'important');
                })
            } else {
                const slideDOMStyle2 = document.querySelectorAll('.slide-style-2 .mdx-slide-content');
                if (slideDOMStyle2.length > 0) {
                    for (const e of [...slideDOMStyle2]) {
                        e.style.setProperty('background-image', `linear-gradient(65deg, rgba(var(--mdx-theme-color-with-white-head), 1) 30%, rgba(var(--mdx-theme-color-with-white-head), ${(1 - opacityHeight * .9 + .1)}) 80%)`, 'important');
                    }
                    ele('.flickity-page-dots', (e) => {
                        e.style.setProperty('opacity', opacityHeight, 'important');
                    })
                }
            }
        }
    } else if (!mdxStyle) {
        var howFar = document.documentElement.scrollTop || document.body.scrollTop;
        if (howFar > 20 & whetherChange == 0) {
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 1;
        }
        if (howFar <= 20 & whetherChange == 1) {
            document.getElementsByClassName("mdui-toolbar-self")[0].classList.toggle("mdui-color-theme");
            document.getElementById("titleBar").classList.toggle("mdui-shadow-2");
            document.getElementsByClassName("scrollToTop")[0].classList.toggle("mdui-fab-hide");
            whetherChange = 0;
        }
    }
    ticking = false;
};

//Scroll To the Top
document.getElementsByClassName("scrollToTop")[0].addEventListener("click", function () {
    HTMLScrollTo.to(0, 500);
}, false);

//Night Styles
var nsButton = document.getElementById("tgns");
if (nsButton) {
    document.getElementById("tgns").addEventListener("click", function () {
        if (!document.getElementsByTagName("body")[0].classList.contains("mdui-theme-layout-dark")) {
            sessionStorage.setItem('ns_night-styles', 'true');
            if (colorEnabled) {
                metaColor.setAttribute('content', "#212121");
            }
        } else {
            sessionStorage.setItem('ns_night-styles', 'false');
            if (colorEnabled) {
                metaColor.setAttribute('content', nowColor);
            }
        }
        document.getElementsByTagName("body")[0].classList.toggle("mdui-theme-layout-dark");
    }, false);
}

window.addEventListener('DOMContentLoaded', () => {
    //hot posts
    toggleHotPostsOverlay();

    if (document.getElementsByTagName("body")[0].classList.contains("mdx-first-tworows")) {
        var hsc = window.matchMedia("screen and (orientation:landscape) and (min-width: 750px)");
        hsc.addEventListener('change', handleSearchChange);
        handleSearchChange(hsc);
    }

    if (document.getElementsByTagName("body")[0].classList.contains("mdx-reduce-motion")) {
        var mrm = window.matchMedia("(prefers-reduced-motion: reduce)");
        mrm.addEventListener('change', handleMotionChange);
        handleMotionChange(mrm);
    }

    displayHotPostsOverlay();

    const sliderDOM = document.getElementsByClassName('mdx-swiper');
    if (sliderDOM.length > 0) {
        new Flickity('.swiper-wrapper', {
            accessibility: true,
            autoPlay: 5000,
            cellAlign: 'center',
            cellSelector: '.swiper-item',
            draggable: '>1',
            dragThreshold: 3,
            lazyLoad: false,
            percentPosition: true,
            prevNextButtons: false,
            pageDots: true,
            resize: true,
            setGallerySize: false,
            watchCSS: false,
            wrapAround: true
          });
    }

    if (document.body.classList.contains('mdx-wide-post-list')) {
        const postList = document.getElementById('postlist');
        if (postList.getElementsByClassName('post-item').length > 0) {
            let gutter = 30;
            if (postList.getElementsByClassName('indexgaid').length > 0) {
                gutter = 20;
            }
            window.mdxMasonry = new Masonry(postList, {
                itemSelector: '.post-item',
                columnWidth: '.post-item',
                gutter,
                stagger: 10,
                percentPosition: true
            });
            document.getElementById('postlist').addEventListener('lazyloaded', (e) => {
                if (e.target.matches('#postlist > .post-item img')) {
                    window.mdxMasonry.layout()
                }
            })
            ele('#postlist img:not([data-src])', (el) => {
                el.addEventListener('load', () => {
                    window.mdxMasonry.layout();
                })
                el.addEventListener('error', () => {
                    window.mdxMasonry.layout();
                })
            })
        }
    }
})

function handleSearchChange(hsc) {
    if (hsc.matches) {
        if (currentStyle === 'tworow') {
            closeSearch();
            document.getElementsByClassName("theFirstPage")[0].style.setProperty('opacity', 1, 'important');
        }
        currentStyle = 'single';
    } else {
        if (currentStyle === 'single') {
            closeSearch();
        }
        currentStyle = 'tworow';
    }
}

function handleMotionChange(mrm) {
    if (sessionStorage.getItem("mrm_enable") === "user") {
        document.getElementsByTagName("body")[0].classList.remove("mdx-reduce-motion");
        return;
    }
    if (mrm.matches && document.getElementsByTagName("body")[0].classList.contains("mdx-reduce-motion")) {
        if (!sessionStorage.getItem("mrm_enable")) {
            mdui.snackbar({
                message: reduce_motion_i18n_1,
                buttonText: reduce_motion_i18n_2,
                timeout: 7000,
                onButtonClick: function () {
                    sessionStorage.setItem("mrm_enable", "user");
                    document.getElementsByTagName("body")[0].classList.remove("mdx-reduce-motion");
                },
                position: 'top',
            });
            sessionStorage.setItem("mrm_enable", "sys");
            document.getElementsByTagName("body")[0].classList.add("mdx-reduce-motion");
        }
    } else {
        if (sessionStorage.getItem("mrm_enable")) {
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
    if (document.getElementsByClassName("mdx-hp-g-r").length) {
        document.getElementsByClassName("mdx-hp-g-r")[0].style.display = "block";
        var mdxChange = 1;
        var mdxChange2 = 1;
        var mdxSpW = (210 + parseInt(getComputedStyle(document.querySelector("a>div.mdx-li.mdui-card"), null).marginRight)) * document.querySelectorAll("a>div.mdx-li.mdui-card").length + 10;
        var mdxSpWw = 0;
        var mdxSpS = 0;
        var elem = document.getElementById("mdx-sp-out-c");
        elem.onscroll = function () {
            mdxSpWw = elem.offsetWidth;
            mdxSpS = elem.scrollLeft;
            if (mdxSpS > 5 && mdxChange) {
                fade(ele('.mdx-hp-g-l', null, 'array'), 'in', 200);
                mdxChange = 0;
            }
            else if (mdxSpS <= 5 && !mdxChange) {
                fade(ele('.mdx-hp-g-l', null, 'array'), 'out', 200);
                mdxChange = 1;
            }
            if ((mdxSpW - mdxSpWw - mdxSpS) <= 1 && mdxChange2) {
                fade(ele('.mdx-hp-g-r', null, 'array'), 'out', 200);
                mdxChange2 = 0;
            } else if ((mdxSpW - mdxSpWw - mdxSpS) > 1 && !mdxChange2) {
                fade(ele('.mdx-hp-g-r', null, 'array'), 'in', 200);
                mdxChange2 = 1;
            }
        }
    }
}

function displayHotPostsOverlay() {
    var parentDOM = document.getElementsByClassName("mdx-posts-may-related");
    if (parentDOM.length) {
        let DOMList = document.getElementsByClassName("mdx-posts-may-related")[0].getElementsByClassName("mdx-li");
        var listWidth = (DOMList[0].offsetWidth + 8) * DOMList.length - 15;
        if (listWidth < parentDOM[0].offsetWidth) {
            document.getElementsByClassName("mdx-hp-g-l")[0].style.visibility = "hidden";
            document.getElementsByClassName("mdx-hp-g-r")[0].style.visibility = "hidden";
        } else {
            document.getElementsByClassName("mdx-hp-g-l")[0].style.visibility = "visible";
            document.getElementsByClassName("mdx-hp-g-r")[0].style.visibility = "visible";
        }
    }
}

//Search
document.getElementsByClassName("seai")[0].addEventListener("click", function () {
    let searchBarDOM = document.getElementById("SearchBar");
    searchBarDOM.style.display = "block";
    fade(ele('.OutOfsearchBox', null, 'array'), 'in', 300);
    fade(ele('.fullScreen', null, 'array'), 'in', 300);
    ele("#SearchBar > *", (e) => new Opacity(e, 1, 200));
    setTimeout(() => {
        document.getElementsByClassName("outOfSearch")[0].style.width = '75%';
        searchBarDOM.classList.add("mdui-color-theme");
    }, 0);
    document.getElementsByClassName("seainput")[0].focus();
    document.getElementsByTagName("body")[0].classList.toggle('mdx-search-lock');
    if (ifOffline) {
        let searchBoxDOM = document.getElementsByClassName('OutOfsearchBox')[0];
        searchBoxDOM.innerHTML = '<div class="searchBoxFill"></div><div class="underRes">' + tipMutiOff + '</div>';
        searchBoxDOM.style.pointerEvents = 'auto';
        document.getElementsByClassName("seainput")[0].setAttribute('disabled', 'disabled');
    }
}, false);
if (document.getElementsByClassName("mdx-tworow-search").length) {
    document.getElementsByClassName("mdx-tworow-search")[0].addEventListener("click", function () {
        setTimeout(() => {
            document.getElementsByTagName("body")[0].classList.toggle('mdx-search-lock');
        }, 500);
        ele("#mdx-search-anim", (e) => {
            e.style.width = this.offsetWidth - 12 + 'px';
            e.style.top = this.getBoundingClientRect().top + 'px';
            e.style.left = this.getBoundingClientRect().left + 'px';
        })
        document.getElementById("mdx-search-anim").classList.add('mdx-search-anim-show');
        this.style.visibility = 'hidden';
        let searchBarDOM = document.getElementById("SearchBar");
        searchBarDOM.style.display = "block";
        var searchDom = document.getElementsByClassName('outOfSearch');
        if (document.getElementsByClassName("mdx-theme-white").length) {
            ele("#mdx-search-anim", (e) => {
                e.style.width = document.getElementById('searchform').offsetWidth * .75 - 12 + 'px';
                e.style.height = searchDom[0].offsetHeight - 10 + 'px';
                e.style.top = searchDom[0].getBoundingClientRect().top + 'px';
                e.style.left = '7px';
                e.style.backgroundColor = 'rgba(152, 152, 152, 0.3)';
                e.style.color = 'rgba(255, 255, 255, .3)';
            })
        } else {
            ele("#mdx-search-anim", (e) => {
                e.style.width = document.getElementById('searchform').offsetWidth * .75 - 12 + 'px';
                e.style.height = searchDom[0].offsetHeight - 10 + 'px';
                e.style.top = searchDom[0].getBoundingClientRect().top + 'px';
                e.style.left = '7px';
                e.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
                e.style.color = 'rgba(255, 255, 255, .3)';
            })
        }
        setTimeout(() => {
            document.getElementById('searchform').classList.add("mdx-searchform-show");
            document.getElementById("mdx-search-anim").classList.remove('mdx-search-anim-show');
            document.querySelector('a.mdui-btn.mdui-btn-icon.sea-close').style.opacity = 1;
        }, 500);
        document.getElementById("mdx-search-anim").getElementsByTagName("i")[0].style.color = '#fff';
        fade(ele('.OutOfsearchBox', null, 'array'), 'in', 500);
        searchBarDOM.classList.add("mdui-color-theme");
        fade(ele('.fullScreen', null, 'array'), 'in', 500);
        document.getElementsByClassName("seainput")[0].focus();
        if (ifOffline) {
            let searchBoxDOM = document.getElementsByClassName('OutOfsearchBox')[0];
            searchBoxDOM.innerHTML = '<div class="searchBoxFill"></div><div class="underRes">' + tipMutiOff + '</div>';
            searchBoxDOM.style.pointerEvents = 'auto';
            document.getElementsByClassName("seainput")[0].setAttribute('disabled', 'disabled');
        }
        openFromTwoRows = true;
    }, false);
}
for (let elem of document.getElementsByClassName("sea-close")) {
    elem.addEventListener("click", closeSearch, false);
}

function closeSearch() {
    document.getElementsByClassName("seainput")[0].blur();
    if (openFromTwoRows) {
        var searchAnimDom = document.getElementsByClassName("mdx-tworow-search")[0];
        var searchAnim = document.getElementById("mdx-search-anim");
        fade(ele('.fullScreen', null, 'array'), 'out', 500);
        document.querySelector('a.mdui-btn.mdui-btn-icon.sea-close').removeAttribute('style');
        document.getElementById("searchform").classList.remove("mdx-searchform-show");
        searchAnim.classList.add('mdx-search-anim-show');
        ele("#mdx-search-anim", (e) => {
            e.style.width = searchAnimDom.offsetWidth - 22 + 'px';
            e.style.height = '50px';
            e.style.top = searchAnimDom.getBoundingClientRect().top + 'px';
            e.style.left = searchAnimDom.getBoundingClientRect().left + 'px';
            e.style.backgroundColor = window.getComputedStyle(searchAnimDom).backgroundColor;
            e.style.color = window.getComputedStyle(searchAnimDom).color;
        })
        searchAnim.getElementsByTagName("i")[0].style.color = window.getComputedStyle(searchAnimDom.getElementsByTagName("i")[0]).color;
        fade(ele('.OutOfsearchBox', null, 'array'), 'out', 500);
        window.setTimeout(hideBar, 500);
        document.getElementById("SearchBar").classList.remove("mdui-color-theme");
        setTimeout(() => {
            let bodyDOM = document.getElementsByTagName("body")[0];
            if (bodyDOM.classList.contains('mdx-search-lock')) {
                bodyDOM.classList.toggle('mdx-search-lock');
            }
            document.getElementById("mdx-search-anim").classList.remove('mdx-search-anim-show');
            document.getElementsByClassName("mdx-tworow-search")[0].style.visibility = 'visible';
        }, 500);
    } else {
        ele("#SearchBar > *", (e) => new Opacity(e, 0, 200));
        fade(ele('.fullScreen', null, 'array'), 'out', 300);
        fade(ele('.OutOfsearchBox', null, 'array'), 'out', 300);
        document.getElementsByClassName("outOfSearch")[0].style.width = '30%';
        window.setTimeout(hideBar, 300);
        document.getElementById("SearchBar").classList.remove("mdui-color-theme");
        setTimeout(() => {
            let bodyDOM = document.getElementsByTagName("body")[0];
            if (bodyDOM.classList.contains('mdx-search-lock')) {
                bodyDOM.classList.toggle('mdx-search-lock');
            }
            document.getElementsByClassName("outOfSearch")[0].removeAttribute("style");
        }, 300);
    }
    openFromTwoRows = false;
};

function hideBar() {
    document.getElementById("SearchBar").style.display = "none";
}

//tap tp top
document.getElementsByClassName("mdui-typo-headline")[0].addEventListener("click", function () {
    if (mdx_tapToTop == 1) {
        HTMLScrollTo.to(0, 500);
    }
})

//init menu
window.addEventListener('DOMContentLoaded', () => {
    var mdxHaveChild = 0;
    var mdxIsC = 0;
    for (let elem of document.querySelectorAll('#mdx_menu > li')) {
        if (elem.classList.contains('menu-item-has-children')) {
            elem.classList.add('mdui-collapse-item');
            elem.classList.remove('mdui-list-item');
            elem.innerHTML = `<div class="mdui-collapse-item-header mdui-list-item mdui-ripple"><div class="mdui-list-item-content"><a class="mdx-sub-menu-a" href="${elem.getElementsByTagName("a")[0].getAttribute('href')}">${elem.getElementsByTagName("a")[0].innerHTML}</a></div><i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i></div><ul class="mdui-collapse-item-body mdui-list mdui-list-dense">${elem.getElementsByTagName("ul")[0].innerHTML}</ul>`;
            mdxHaveChild = 1;
            for (let ul of elem.getElementsByTagName("ul")) {
                for (let li of ul.getElementsByTagName("li")) {
                    if (li.classList.contains('current-menu-item')) {
                        mdxIsC = 1;
                    }
                }
            }
            if (mdxIsC) {
                elem.classList.remove('current-menu-item', 'current_page_item');
                elem.classList.add('mdui-collapse-item-open');
            }
            mdxIsC = 0;
        }
        if (mdxHaveChild) {
            let menuDOM = document.getElementById('mdx_menu');
            menuDOM.classList.add('mdui-collapse');
            menuDOM.setAttribute('mdui-collapse', '');
        }
    }
    new mdui.Collapse("#mdx_menu");

    //cookie
    var ifDisplay = typeof displayCookie === "undefined" ? true : displayCookie;
    var flagName = typeof cookieFlagName === "undefined" ? "mdx_cookie" : cookieFlagName;
    var cookieEle = document.getElementById("mdx-cookie-notice");
    if (ifDisplay && cookieEle && !localStorage.getItem(flagName)) {
        cookieEle.classList.add("mdx-cookie-notice-show");
        cookieEle.getElementsByTagName("button")[0].addEventListener('click', agreeCookie, false);
    }

    function agreeCookie() {
        localStorage.setItem(flagName, "true");
        document.getElementById("mdx-cookie-notice").style.bottom = "-400px";
        setTimeout(() => {
            document.getElementById("mdx-cookie-notice").classList.remove("mdx-cookie-notice-show");
        }, 400);
    }
})