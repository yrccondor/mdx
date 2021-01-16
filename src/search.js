import betterFetch from './tools/betterFetch.js';
import ele from './tools/ele.js';

"use strict";
__webpack_public_path__ = window.mdxPublicPath;
let nowType = '';
let oldType = '';
let waitForNetwork = false;
const outSearch = document.createElement('div');
outSearch.classList.add('OutOfsearchBox');
const searchBox = document.createElement('div');
searchBox.classList.add('searchBoxFill');
outSearch.appendChild(searchBox);
ele('body').insertBefore(outSearch, ele('body').firstChild);
let stopId;
let isStoped = false;
let ifOffline = typeof offlineMode === "undefined" ? false : offlineMode;
ele('.seainput').addEventListener('focus', function () {
    if (sessionStorage.getItem('rts_wra') == 'false') {
        mdui.snackbar({
            message: snackMuti,
            timeout: 3000,
            position: 'top',
        });
    }
    isStoped = false;
    window.requestAnimationFrame(checkType);
});
ele('.seainput').addEventListener('blur', function () {
    isStoped = true;
    window.cancelAnimationFrame(stopId);
});
function checkType() {
    if (sessionStorage.getItem('rts_wra') != 'false') {
        nowType = ele(".seainput").value;
        if ((nowType != '' && oldType == '') || (oldType != '' && nowType != oldType && nowType != '')) {
            if (!sessionStorage.getItem("rtsk_" + nowType)) {
                if (!waitForNetwork) {
                    waitForNetwork = true;
                    betterFetch(`/wp-json/wp/v2/posts?search=${nowType}&pre_page=10&context=embed`).then((data) => {
                        setSessionSto(nowType, JSON.stringify(data));
                        readRes(data, false);
                        waitForNetwork = false;
                    }).catch(() => {
                        mdui.snackbar({
                            message: snackMuti,
                            timeout: 3000,
                            position: 'top',
                        });
                        sessionStorage.setItem('rts_wra', 'false');
                        waitForNetwork = false;
                    })
                }
            } else {
                readRes(sessionStorage.getItem("rtsk_" + nowType), true)
            }
            oldType = nowType;
        } else if (nowType == '') {
            if (ifOffline) {
                ele('.OutOfsearchBox').innerHTML = `<div class="searchBoxFill"></div><div class="underRes">${tipMutiOff}</div>`;
            } else {
                ele('.OutOfsearchBox').innerHTML = '<div class="searchBoxFill"></div>';
            }
            oldType = nowType;
        }
    }
    if (isStoped) {
        return;
    } else {
        stopId = window.requestAnimationFrame(checkType);
    }
}
function setSessionSto(nowType, data) {
    if (!sessionStorage.getItem("rtsk_" + nowType)) {
        if (sessionStorage.length >= 100) {
            sessionStorage.removeItem(sessionStorage.key(0));
            sessionStorage.setItem("rtsk_" + nowType, data);
        } else {
            sessionStorage.setItem("rtsk_" + nowType, data);
        }
    }
}
function readRes(data, ifSession) {
    let data2 = data;
    if (ifSession) {
        data2 = JSON.parse(data);
    }
    ele('.OutOfsearchBox').innerHTML = '<div class="searchBoxFill"></div>';
    let inputValue = ele(".seainput").value;
    if (inputValue === "Axton" || inputValue === "axton" || inputValue === "无垠" || inputValue === "flyhigher" || inputValue === "Flyhigher") {
        data2.unshift({ "title": { "rendered": "无垠" }, "date": "Forever", "link": "https://flyhigher.top", "excerpt": { "rendered": "飞翔的天空无限大" } });
    }
    if (data2.length > 0) {
        let finalHTML = '';
        for (let i = 0; i < data2.length; i++) {
            let postTitleInApi = data2[i].title.rendered;
            let postTimeInApi = data2[i].date;
            let postUrlInApi = data2[i].link;
            let postDesInApi = data2[i].excerpt.rendered;
            finalHTML += `<article class="searchCard mdui-shadow-2 mdui-typo"><a href="${postUrlInApi}"><h1>${postTitleInApi}</h1></a><p>${postDesInApi.replace(' [&hellip;]', '&hellip;').replace('<p>', '').replace('</p>', '')}</p><div class="mdui-divider underline"></div><span class="info">&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe192;</i> ${postTimeInApi.substring(0, 10)}</span><a class="mdui-btn mdui-ripple mdui-ripple-white coun-read" href="${postUrlInApi}">${moreMuti}</a></article>`;
        }
        ele('.OutOfsearchBox').innerHTML += finalHTML;
    }
    if (data2.length == 10) {
        ele('.OutOfsearchBox').innerHTML += `<div class="underRes">${tipMuti}</div>`;
    }
}