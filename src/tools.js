import 'whatwg-fetch';

const tools = {
    betterFetch: async (url, option = {}) => {
        let response = await fetch(url, option);
        if (response.ok && response.status === 200) {
            if (response.headers.get('Content-Type').indexOf('/json') !== -1) {
                return response.json();
            } else if (response.headers.get('Content-Type').indexOf('image/') !== -1) {
                return response.blob();
            } else {
                return response.text();
            }
        }
    },
    ele: (selector, callback = null) => {
        if (typeof selector === "object") {
            return selector;
        } else if (typeof selector !== "string") {
            return document.createElement("div");
        }

        let elems = null;
        let idSelector = false;
        if (!selector.match(/[ <>:~+^=]/)) {
            if (selector[0] === '#') {
                elems = document.getElementById(selector.slice(1));
                idSelector = true;
            } else if (selector[0] === '.') {
                elems = document.getElementsByClassName(selector.slice(1));
            } else {
                if (!selector.match(/[ .<>:~+^=#]/)) {
                    elems = document.getElementsByTagName(selector);
                } else {
                    elems = document.querySelectorAll(selector);
                }
            }
        } else {
            elems = document.querySelectorAll(selector);
        }

        if (elems === null || elems.length === 0) {
            return document.createElement("div");
        }

        if (callback !== null) {
            if (!idSelector) {
                Array.prototype.map.call(elems, (e) => { callback(e); return e });
            } else {
                callback(elems);
            }
        }

        if (!idSelector) {
            return elems[0];
        } else {
            return elems;
        }
    }
}

export default tools;

export const betterFetch = tools.betterFetch;
export const ele = tools.ele;