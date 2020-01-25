jQuery(document).ready(function(){
    var whichButton=0;
    var mdx_val = jQuery('.mdx_stbs').val();
    if(mdx_val=='false'){
        jQuery('select.mdx_stbsip').attr("disabled","disabled");
    }
    jQuery('#insert-media-button').click(function(){
        //文本域id
        whichButton=0;
        targetfield = jQuery(this).prev('#mdx_index_img');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });
    window.send_to_editor = function(html){
        if(whichButton==0){
            imgurl = jQuery('img','<div>'+html+'</div>').attr('src');
            jQuery('#mdx_post_money').val(imgurl);
            tb_remove();
        }
    }
    if(jQuery("#mdx_index_img").val()!=''){
        var img1=jQuery("#mdx_index_img").val();
        jQuery('#img1').attr('src',img1);
    }
    setInterval("img1()",500);
    var mdx_val = jQuery('input.mdx_apsp2:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_apspc2').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_apspc2').attr("disabled","disabled");
    }
});
jQuery(".mdx_stbs").change(function(){
    var mdx_val = jQuery('.mdx_stbs').val();
    if(mdx_val!=='false'){
        jQuery('select.mdx_stbsip').removeAttr("disabled");
    }else if(mdx_val==='false'){
        jQuery('select.mdx_stbsip').attr("disabled","disabled");
    }
});
jQuery(".mdx_apsp").click(function(){
    var mdx_val = jQuery('input.mdx_apsp:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_apspc').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_apspc').attr("disabled","disabled");
    }
});
jQuery(".mdx_apsp2").click(function(){
    var mdx_val = jQuery('input.mdx_apsp2:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_apspc2').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_apspc2').attr("disabled","disabled");
    }
});
function img1(){
    var img1=jQuery("#mdx_post_money").val();
    if(img1.substring(0,4) != 'http'){
        img1 = '';
    }
    jQuery('#img1').attr('src',img1);
}