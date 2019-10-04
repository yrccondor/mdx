$(function() {
    addToc(getTitleListHtml());
    scrollToc(true);
})

let tocShown = false;
let titleArr = [];
let firstClick = false;

function getTitleListHtml() {
    let titleList = $("article > h1, article > h2, article > h3");
    if(titleList.length <= 1){
        return false;
    }
    let finalHtml = '<div class="mdui-list" id="mdx-toc">';
    let counter = 0;
    for(title of titleList){
        $(title).attr('id',"mdx-toc-" + counter);
        titleArr.push("#mdx-toc-" + counter);
        if($(title)[0].tagName ==="H1"){
            finalHtml += '<a href="#mdx-toc-'+counter+'" class="mdui-list-item mdui-ripple mdx-toc-item" id="mdx-toc-'+counter+'-item">'+$(title).text()+'</a>';
        }else if($(title)[0].tagName ==="H2"){
            finalHtml += '<a href="#mdx-toc-'+counter+'" class="mdui-list-item mdui-ripple mdx-toc-item mdx-toc-item-h2" id="mdx-toc-'+counter+'-item">'+$(title).text()+'</a>';
        }else if($(title)[0].tagName ==="H3"){
            finalHtml += '<a href="#mdx-toc-'+counter+'" class="mdui-list-item mdui-ripple mdx-toc-item mdx-toc-item-h3" id="mdx-toc-'+counter+'-item">'+$(title).text()+'</a>';
        }
        counter++;
    }
    return finalHtml+'</div>';
}

function addToc(titleList) {
    if(!titleList){
        return;
    }
    $("#mdx_menu").after(titleList);
    $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
    $("#left-drawer nav").before('<div class="mdui-tab mdui-tab-full-width" id="mdx-toc-select"><a href="#" id="mdx-toc-menu" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe241;</i><label>'+mdx_toc_i18n_1+'</label></a><a href="#" id="mdx-toc-toc" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe86d;</i><label>'+mdx_toc_i18n_2+'</label></a></div>');
    let mdx_toc = new mdui.Tab("#mdx-toc-select", {});
    mdx_toc.next();
    $("#mdx-toc").css("transform", "translateX(0)");
    $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
}

$("#menu").click(function() {
    if(!firstClick){
        tocShown = true;
        firstClick = false;
    }
})

$('#left-drawer').on('click', '#mdx-toc-menu', function(e){
    e.preventDefault();
    tocShown = false;
    $("#mdx_menu").css("transform", "translateX(0)");
    $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
})

$('#left-drawer').on('click', '#mdx-toc-toc', function(e){
    e.preventDefault();
    tocShown = true;
    scrollToc();
    $("#mdx-toc").css("transform", "translateX(0)");
    $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
})

$(window).on("resize", function() {
    if(tocShown){
        $("#mdx-toc").css("transform", "translateX(0)");
        $("#mdx_menu").css("transform", "translateX(-"+$("#mdx_menu").width()+"px)");
    }else{
        $("#mdx_menu").css("transform", "translateX(0)");
        $("#mdx-toc").css("transform", "translateX("+$("#mdx-toc").width()+"px)");
    }
})

$('#left-drawer').on('click', '.mdx-toc-item', function(e) {
    e.preventDefault();
    $("body,html").animate({scrollTop:($("#mdx-toc-"+$(this).attr("id").split("-")[2]).offset().top - 75)},500);
})

let tickingToc = false;
$(window).on("scroll", function(){
    if(!tickingToc) {
        requestAnimationFrame(scrollToc);
        tickingToc = true;
    }
})
function scrollToc(firstCall = false){
    if(tocShown || firstCall){
        let howFar = document.documentElement.scrollTop || document.body.scrollTop;
        $(".mdx-toc-item").removeClass("mdx-toc-read").removeClass("mdui-list-item-active");
        let counter = 0;
        if(howFar >= $("article").offset().top + $("article").height() - 80){
            $(".mdx-toc-item").addClass("mdx-toc-read")
        }else{
            for(let i = 1; i < titleArr.length; i++){
                if(howFar >= $(titleArr[i]).offset().top - 80){
                    $(titleArr[i-1]+"-item").addClass("mdx-toc-read");
                    counter++;
                }else{
                    break;
                }
            }
            if(howFar > $("article").offset().top - 140){
                $(titleArr[counter]+"-item").addClass("mdui-list-item-active");
            }
        }
        
    }
    tickingToc = false;
};