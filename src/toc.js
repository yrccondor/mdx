let showPreview = mdx_show_preview.preview === 'true' ? true : false;
let tocShown = false;
let titleArr = [];
let firstClick = false;
let isToc = true;
let previewShown = false;
let mdx_toc = undefined;
let isInited = false;

$(function() {
    let tocHTML = getTitleListHtml();
    addToc(tocHTML[0]);
    if(isToc){
        if(showPreview){
            $('.PostMain').append(`<div id="mdx-toc-preview" mdui-drawer="${document.getElementById('menu').getAttribute('mdui-drawer')}">${tocHTML[1]}</div>`);
            mdui.mutation();
        }
        isInited = true;
        scrollToc(true);
    }
})

function getTitleListHtml(minLevel = 1, maxLevel = 6) {
    const titleList = document.querySelectorAll(
        [...Array(maxLevel).keys()].map((l) => `article > h${l + 1}`).join(',')
    );
    if (titleList.length <= 1) {
        isToc = false;
        return false;
    }
  
    const finalNode = document.createElement('div');
    finalNode.classList.add('mdui-list');
    finalNode.id = 'mdx-toc';
    finalNode.style.transform = 'translateX(0)';
  
    let finalPreview = "";
  
    let counter = 0;
    let titles = [...Array(maxLevel)].map(() => 0);
    for (const title of titleList) {
        title.dataset.mdxtoc = 'mdx-toc-' + counter;
        titleArr.push('mdx-toc-' + counter);
  
        const level = Number($(title)[0].tagName[1]);
        titles[level - 1]++;
        titles.forEach((_, i) =>
            i >= level ? (titles[i] = 0) : titles[i] === 0 && (titles[i] = 1)
        );
  
        const titleNode = document.createElement('a');
        titleNode.id = `mdx-toc-${counter}-item`;
        titleNode.title = title.textContent;
        titleNode.classList.add('mdui-list-item', 'mdui-ripple', 'mdx-toc-item');
  
        if (level > 1) {
            titleNode.classList.add(`mdx-toc-item-h${level}`);
        }
  
        const titleNodeSpan = document.createElement('span');
        titleNodeSpan.textContent = titles
            .filter((_, i) => i + 1 >= minLevel && i < level)
            .join('.');
  
        const tilteNodeContent = document.createElement('div');
        tilteNodeContent.textContent = title.textContent;
  
        titleNode.appendChild(titleNodeSpan);
        titleNode.appendChild(tilteNodeContent);
        finalNode.appendChild(titleNode);
  
        finalPreview += `<div class="mdx-toc-preview-h${level} mdx-toc-preview-item mdui-color-theme" id="mdx-toc-${counter}-preview"></div>`;
        counter++;
    }
    return [finalNode, finalPreview];
}
  
function addToc(titleList) {
    if (!titleList) {
        return;
    }
  
    const menu = document.querySelector('#mdx_menu');
    menu.parentNode.append(titleList);
  
    $('#left-drawer nav').before(
        `<div class="mdui-tab mdui-tab-full-width" id="mdx-toc-select"><a href="#" id="mdx-toc-menu" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe241;</i><label>${mdx_toc_i18n_1}</label></a><a href="#" id="mdx-toc-toc" class="mdui-ripple"><i class="mdui-icon material-icons">&#xe86d;</i><label>${mdx_toc_i18n_2}</label></a></div>`
    );
    mdx_toc = new mdui.Tab('#mdx-toc-select', {});
    mdx_toc.next();
  
    menu.style.transform = `translateX(-${menu.clientWidth}px)`;
}

document.getElementById('menu').addEventListener('click', function() {
    if(!firstClick){
        scrollToc(false);
        tocShown = true;
        firstClick = true;
    }
}, false)

$('.PostMain').on('click', '#mdx-toc-preview', function(){
    if($('#mdx-toc').css('transform') !== 'translateX(0)' && showPreview){
        mdx_toc.next();
        $('#mdx-toc').css('transform', 'translateX(0)');
        $('#mdx_menu').css('transform', `translateX(-${$('#mdx_menu').width()}px)`);
        if(!firstClick){
            scrollToc(false);
            tocShown = true;
            firstClick = true;
        }else{
            scrollToc(true);
            tocShown = true;
            firstClick = false;
        }
    }
})

$('#left-drawer').on('click', '#mdx-toc-menu', function(e){
    e.preventDefault();
    tocShown = false;
    $('#mdx_menu').css('transform', 'translateX(0)');
    $('#mdx-toc').css('transform', `translateX(${$('#mdx-toc').width()}px)`);
})

$('#left-drawer').on('click', '#mdx-toc-toc', function(e){
    e.preventDefault();
    tocShown = true;
    scrollToc(false);
    $('#mdx-toc').css('transform', 'translateX(0)');
    $('#mdx_menu').css('transform', `translateX(-${$('#mdx_menu').width()}px)`);
})

$(window).on('resize', function() {
    if(isToc){
        if(tocShown || !firstClick){
            $('#mdx-toc').css('transform', 'translateX(0)');
            $('#mdx_menu').css('transform', `translateX(-${$('#mdx_menu').width()}px)`);
        }else{
            $('#mdx_menu').css('transform', 'translateX(0)');
            $('#mdx-toc').css('transform', `translateX(${$('#mdx-toc').width()}px)`);
        }
    }
})

$('#left-drawer').on('click', '.mdx-toc-item', function(e) {
    e.preventDefault();
    $('body,html').animate({scrollTop:($(`article *[data-mdxtoc="mdx-toc-${$(this).attr('id').split('-')[2]}"]`).offset().top - 75)},500);
})

let tickingToc = false;
$(window).on('scroll', function(){
    if(isToc && isInited){
        if(!tickingToc) {
            requestAnimationFrame(function(){
                scrollToc(true);
            });
            tickingToc = true;
        }
    }
    
})
function scrollToc(firstCall){
    if(!isInited){
        return;
    }
    if(tocShown || firstCall){
        let howFar = document.documentElement.scrollTop || document.body.scrollTop;
        $('.mdx-toc-item').removeClass('mdx-toc-read').removeClass('mdui-list-item-active');
        $('#mdx-toc-preview > *').removeClass('mdx-toc-preview-item-active');
        let counter = 0;
        if(howFar >= $('article').offset().top + $('article').height() - 80){
            $('.mdx-toc-item').addClass('mdx-toc-read');
            if(previewShown && showPreview){
                document.getElementById('mdx-toc-preview').classList.remove('mdx-toc-preview-show');
                previewShown = false;
            }
        }else{
            for(let i = 1; i < titleArr.length; i++){
                if(howFar >= $(`article *[data-mdxtoc="${titleArr[i]}"]`).offset().top - 80){
                    document.getElementById(`${titleArr[i-1]}-item`).classList.add('mdx-toc-read');
                    counter++;
                }else{
                    break;
                }
            }
            if(howFar > $('article').offset().top - 140){
                if(!previewShown && showPreview){
                    document.getElementById('mdx-toc-preview').classList.add('mdx-toc-preview-show');
                    previewShown = true;
                }
                let item = $(`#${titleArr[counter]}-item`);
                item.addClass('mdui-list-item-active');
                $(`#${titleArr[counter]}-preview`).addClass('mdx-toc-preview-item-active');
                if(showPreview){
                    $('#mdx-toc-preview').css('transform', `translateY(-${((counter+1)*20-4)}px)`);
                }
                if(item.length > 0){
                    let topDist = item[0].getBoundingClientRect().top;
                    if(topDist + 48 > window.innerHeight && tocShown){
                        $('#left-drawer').clearQueue().animate({scrollTop:document.getElementById('left-drawer').scrollTop + (topDist + 48 - window.innerHeight) + 8}, 200);
                    }else if(topDist < 8 && tocShown){
                        $('#left-drawer').clearQueue().animate({scrollTop:document.getElementById('left-drawer').scrollTop + topDist - 8}, 200);
                    }
                }
            }else{
                if(previewShown && showPreview){
                    document.getElementById('mdx-toc-preview').classList.remove('mdx-toc-preview-show');
                    previewShown = false;
                }
            }
        }
        
    }
    tickingToc = false;
};