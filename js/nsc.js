function time_range(beginTime,endTime){var strb=beginTime.split(":");if(strb.length!=2){return false}var stre=endTime.split(":");if(stre.length!=2){return false}var b=new Date();var e=new Date();var n=new Date();b.setHours(strb[0]);b.setMinutes(strb[1]);e.setHours(stre[0]);e.setMinutes(stre[1]);if(n.getTime()-b.getTime()>0&&n.getTime()-e.getTime()<0){return true}else{return false}};
if((time_range ("00:00", "05:30")||time_range ("22:30", "23:59"))&&(!sessionStorage.getItem('ns_night-styles'))){
    $("body").addClass("mdui-theme-layout-dark");
    sessionStorage.setItem('ns_night-styles', 'true');
}else if((!(time_range ("00:00", "05:30")||time_range ("22:30", "23:59")))&&(!sessionStorage.getItem('ns_night-styles'))){
    sessionStorage.setItem('ns_night-styles', 'false');
}