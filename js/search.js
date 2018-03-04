var nowType = '';
var oldType = '';
var timeChecker;
$('body').prepend('<div class="OutOfsearchBox"><div class="searchBoxFill"></div></div>');
$(".seainput").focus(function(){
    timeChecker = window.setInterval('checkType()',300);
    if(sessionStorage.getItem('rts_wra') == 'false'){
        mdui.snackbar({
            message: snackMuti,
            timeout: 3000,
            position: 'top',
        });
    }
});
$(".seainput").blur(function(){
    window.clearInterval(timeChecker);
});
function checkType(){
    if(sessionStorage.getItem('rts_wra') != 'false'){
        nowType = $(".seainput").val();
        if((nowType != '' && oldType == '') || (oldType != '' && nowType != oldType && nowType != '')){
            if(!sessionStorage.getItem("rtsk_"+nowType)){
                $.get('/wp-json/wp/v2/posts?search='+nowType+'&pre_page=10&context=embed',function(data,status){
                    if(status=='success'){
                        setSessionSto(nowType, JSON.stringify(data));
                        readRes(data, false);
                    }else{
                        mdui.snackbar({
                            message: snackMuti,
                            timeout: 3000,
                            position: 'top',
                        });
                        sessionStorage.setItem('rts_wra', 'false');
                    }
                });
            }else{
                readRes(sessionStorage.getItem("rtsk_"+nowType), true)
            }
            oldType = nowType;
        }else if(nowType == ''){
            if(mdx_offline_mode){
                $('.OutOfsearchBox').html('<div class="searchBoxFill"></div><div class="underRes">'+tipMutiOff+'</div>');
            }else{
                $('.OutOfsearchBox').html('<div class="searchBoxFill"></div>');
            }
            oldType = nowType;
        }
    }
}
function setSessionSto(nowType, data){
    if(!sessionStorage.getItem("rtsk_"+nowType)){
        if(sessionStorage.length >= 100){
            sessionStorage.removeItem(sessionStorage.key(0));
            sessionStorage.setItem("rtsk_"+nowType, data);
        }else{
            sessionStorage.setItem("rtsk_"+nowType, data);
        }
    }
}
function readRes(data, ifSession){
    var data2 = data;
    if(ifSession){
        data2 = JSON.parse(data);
    }
    $('.OutOfsearchBox').html('<div class="searchBoxFill"></div>');
    if(data2.length > 0){
        for(i in data2){
            var postTitleInApi = data2[i].title.rendered;
            var postTimeInApi = data2[i].date;
            var postUrlInApi = data2[i].link;
            var postDesInApi = data2[i].excerpt.rendered;
            var nowBoxValue =  $('.OutOfsearchBox').html();
            $('.OutOfsearchBox').html(nowBoxValue+'<article class="searchCard mdui-shadow-2 mdui-typo"><a href="'+postUrlInApi+'"><h1>'+postTitleInApi+'</h1></a><p>'+postDesInApi.replace(' [&hellip;]', '&hellip;')+'</p><div class="mdui-divider underline"></div><span class="info">&nbsp;&nbsp;<i class="mdui-icon material-icons info-icon">&#xe192;</i> '+postTimeInApi.substring(0,10)+'</span><a class="mdui-btn mdui-ripple mdui-ripple-white coun-read" href="'+postUrlInApi+'">'+moreMuti+'</a></article>');
        }
    }
    if(data2.length == 10){
        var nowBoxValue10 =  $('.OutOfsearchBox').html();
        $('.OutOfsearchBox').html(nowBoxValue10+'<div class="underRes">'+tipMuti+'</div>');
    }
}