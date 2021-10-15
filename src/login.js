import ele from './tools/ele.js';

__webpack_public_path__ = window.mdxPublicPath;

window.addEventListener('DOMContentLoaded', () => {
    ele("#loginform, #login_error, .message, #lostpasswordform, #registerform", (e) => { e.classList.add("mdui-card") });
    ele("#user_login").classList.add("mdui-textfield-input");
    if (ele("#loginform", null, "array").length > 0) {
        ele("#loginform").getElementsByTagName("p")[0].classList.add("mdui-textfield");
        for (let e of ele("#loginform").getElementsByTagName("p")[0].getElementsByTagName("label")) {
            e.classList.add("mdui-textfield-label");
        }
    }
    if (ele("#lostpasswordform", null, "array").length > 0) {
        ele("#lostpasswordform").getElementsByTagName("p")[0].classList.add("mdui-textfield");
        for (let e of ele("#lostpasswordform").getElementsByTagName("p")[0].getElementsByTagName("label")) {
            e.classList.add("mdui-textfield-label");
        }
    }
    if (ele("#registerform", null, "array").length > 0) {
        ele("#registerform").getElementsByTagName("p")[0].classList.add("mdui-textfield");
        for (let e of ele("#registerform").getElementsByTagName("p")[0].getElementsByTagName("label")) {
            e.classList.add("mdui-textfield-label");
        }
        ele("#registerform").getElementsByTagName("p")[1].classList.add("mdui-textfield");
        for (let e of ele("#registerform").getElementsByTagName("p")[1].querySelectorAll("input#user_email")) {
            e.classList.add("mdui-textfield-input");
        }
        for (let e of ele("#registerform").getElementsByTagName("p")[1].getElementsByTagName("label")) {
            e.classList.add("mdui-textfield-label");
        }
    }
    ele("#user_pass, #authcode", (e) => { e.classList.add("mdui-textfield-input") });
    if (ele("form[name='loginform']", null, "array").length > 0) {
        for (let e of ele("form[name='loginform']").getElementsByClassName("user-pass-wrap")) {
            e.appendChild(ele("#user_pass"));
            e.classList.add("mdui-textfield");
            for (let el of e.getElementsByTagName("label")) {
                el.classList.add("mdui-textfield-label")
            }
        }
    }
    if (ele("form[name='loginform'] #rememberme", null, "array").length > 0) {
        ele("form[name='loginform'] #rememberme").insertAdjacentHTML('afterend', '<i class="mdui-checkbox-icon"></i>');
    }
    if (ele(".forgetmenot", null, "array").length > 0) {
        ele(".mdui-checkbox-icon").insertAdjacentHTML('afterend', `<span>${ele(".forgetmenot").getElementsByTagName("label")[0].innerText}</span>`);
    }
    ele(".forgetmenot", (e) => {
        e.removeChild(e.getElementsByTagName("label")[0]);
        e.insertAdjacentHTML('afterend', `<label class="mdui-checkbox">${ele(".forgetmenot").innerHTML}</label>`);
        e.parentNode.removeChild(e);
    })
    ele(".mdui-checkbox", (e) => { e.classList.add("forgetmenot") });
    ele("#wp-submit, #submit", (e) => { e.classList.add("mdui-btn", "mdui-btn-raised") });
    mdui.mutation();
})