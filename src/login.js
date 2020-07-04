import ele from './ele.js';

$(function(){
    ele("#loginform, #login_error, .message, #lostpasswordform, #registerform", (e) => {e.classList.add("mdui-card")});
    ele("#user_login").classList.add("mdui-textfield-input");
    $($("#loginform").children("p")[0]).addClass("mdui-textfield");
    $($("#loginform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#lostpasswordform").children("p")[0]).addClass("mdui-textfield");
    $($("#lostpasswordform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#registerform").children("p")[0]).addClass("mdui-textfield");
    $($("#registerform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#registerform").children("p")[1]).addClass("mdui-textfield");
    $($("#registerform").children("p")[1]).children("input#user_email").addClass("mdui-textfield-input");
    $($("#registerform").children("p")[1]).children("label").addClass("mdui-textfield-label");
    ele("#user_pass, #authcode", (e) => {e.classList.add("mdui-textfield-input")});
    $("form[name='loginform']").children(".user-pass-wrap").append($("#user_pass"));
    $("form[name='loginform']").children(".user-pass-wrap").addClass("mdui-textfield");
    $("form[name='loginform']").children(".user-pass-wrap").children("label").addClass("mdui-textfield-label");
    $("form[name='loginform'] #rememberme").after('<i class="mdui-checkbox-icon"></i>');
    $($(".mdui-checkbox-icon")[0]).after('<span>'+$(".forgetmenot").children("label").text()+'</span>');
    $(".forgetmenot").children("label").remove();
    $(".forgetmenot").after('<label class="mdui-checkbox">'+$(".forgetmenot").html()+"</label>");
    $(".forgetmenot").remove();
    ele(".mdui-checkbox", (e) => {e.classList.add("forgetmenot")});
    ele("#wp-submit, #submit", (e) => {e.classList.add("mdui-btn", "mdui-btn-raised")});
    mdui.mutation();
})