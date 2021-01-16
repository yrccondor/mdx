window.addEventListener('DOMContentLoaded', () => {
    var __list = 'ajax-comments';
    function getNext(dom){
        return dom.nextElementSibling;
    }
    document.getElementById('commentform').addEventListener('submit', function(e){
        e.preventDefault();
        document.getElementById('submit').setAttribute('disabled','disabled');
        var xmlHttpReq = new XMLHttpRequest();
        xmlHttpReq.open("POST", ajaxcomment.ajax_url, true);
        xmlHttpReq.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlHttpReq.send(new URLSearchParams(Array.from(new FormData(document.getElementById('commentform')))).toString() + "&action=ajax_comment");
        xmlHttpReq.onreadystatechange = function(){
            if(xmlHttpReq.readyState === 4 && xmlHttpReq.status === 200){
                for(var el of document.getElementsByTagName('textarea')){
                    el.value = ''
                }
                document.getElementById('submit').removeAttribute('disabled');
                mdui.snackbar({
                    message: ajaxcomment.i18n_1,
                    timeout: 5000,
                    position: 'top',
                });
                var t = faAjax,
                    cancel = t.I('cancel-comment-reply-link'),
                    temp = t.I('wp-temp-form-div'),
                    respond = t.I('respond'),
                    parent = t.I('comment_parent').value;
                if (parent != '0') {
                    document.getElementById('respond').closest('li.mdui-list-item').insertAdjacentHTML('afterend', `<li><li class="mdui-divider-inset mdui-m-y-0"></li><ul class="children">${xmlHttpReq.responseText}</ul></li>`);
                    for(var li of document.querySelectorAll('ul.children+ li.mdui-divider-inset.mdui-m-y-0')){
                        li.parentNode.removeChild(li);
                    }
                } else if (document.getElementsByClassName(__list ).length < 1) {
                    if (ajaxcomment.formpostion == 'bottom') {
                        document.getElementById('respond').insertAdjacentHTML('beforebegin', `<div class="comms mdui-center" id="comments"><ul class="mdui-list ${__list}">${xmlHttpReq.responseText}</ul></div>`);
                    } else {
                        document.getElementById('respond').insertAdjacentHTML('afterend', `<div class="comms mdui-center" id="comments"><ul class="mdui-list ${__list}">${xmlHttpReq.responseText}</ul></div>`);
                    }
                } else {
                    if (ajaxcomment.order == 'asc') {
                        document.getElementsByClassName(__list)[0].insertAdjacentHTML('beforeend', xmlHttpReq.responseText);
                    } else {
                        document.getElementsByClassName(__list)[0].insertAdjacentHTML('afterbegin', xmlHttpReq.responseText);
                    }
                }
                cancel.style.display = 'none';
                cancel.onclick = null;
                t.I('comment_parent').value = '0';
                if (temp && respond) {
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp)
                }
            }else if(xmlHttpReq.readyState === 4){
                var t = faAjax;
                document.getElementById('submit').removeAttribute('disabled');
                if(xmlHttpReq.responseText){
                    mdui.snackbar({
                        message: xmlHttpReq.responseText,
                        timeout: 5000,
                        position: 'top',
                    });
                }else{
                    mdui.snackbar({
                        message: ajaxcomment.i18n_2,
                        timeout: 5000,
                        position: 'top',
                   });
                }
            }
        }
        return false;
    });
    faAjax = {
        I: function(e) {
            return document.getElementById(e);
        }
    };
});