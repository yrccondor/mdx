export default (selector, callback = null, returnType = 'single') => {
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
            elems = [...elems];
            Array.prototype.map.call(elems, (e) => { callback(e); return e });
        } else {
            callback(elems);
        }
    }

    if (returnType == 'single') {
        if (!idSelector) {
            return elems[0];
        } else {
            return elems;
        }
    } else {
        if (!idSelector) {
            return elems;
        } else {
            return [elems];
        }
    }

}