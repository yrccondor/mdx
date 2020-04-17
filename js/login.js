$(function(){
    $("#loginform, #login_error, .message, #lostpasswordform, #registerform").addClass("mdui-card");
    $("#user_login").addClass("mdui-textfield-input");
    $($("#loginform").children("p")[0]).addClass("mdui-textfield");
    $($("#loginform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#lostpasswordform").children("p")[0]).addClass("mdui-textfield");
    $($("#lostpasswordform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#registerform").children("p")[0]).addClass("mdui-textfield");
    $($("#registerform").children("p")[0]).children("label").addClass("mdui-textfield-label");
    $($("#registerform").children("p")[1]).addClass("mdui-textfield");
    $($("#registerform").children("p")[1]).children("input#user_email").addClass("mdui-textfield-input");
    $($("#registerform").children("p")[1]).children("label").addClass("mdui-textfield-label");
    $("#user_pass").addClass("mdui-textfield-input");
    $("#loginform").children(".user-pass-wrap").append($("#user_pass"));
    $("#loginform").children(".user-pass-wrap").addClass("mdui-textfield");
    $("#loginform").children(".user-pass-wrap").children("label").addClass("mdui-textfield-label");
    $("#rememberme").after('<i class="mdui-checkbox-icon"></i>');
    $($(".mdui-checkbox-icon")[0]).after('<span>'+$(".forgetmenot").children("label").text()+'</span>');
    $(".forgetmenot").children("label").remove();
    $(".forgetmenot").after('<label class="mdui-checkbox">'+$(".forgetmenot").html()+"</label>");
    $(".forgetmenot").remove();
    $(".mdui-checkbox").addClass("forgetmenot");
    $("#wp-submit").addClass("mdui-btn mdui-btn-raised");
    mdui.mutation();
})