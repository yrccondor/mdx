jQuery(document).ready(function(){
    var mdx_val = jQuery('.mdx_stbs').val();
    if(mdx_val=='false'){
        jQuery('select.mdx_stbsip').attr("disabled","disabled");
    }
    jQuery('#insert-media-button').click(function(){
        var custom_uploader = wp.media({
            multiple: false,
            library: {
                    type: ['image']
            }
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            jQuery('#mdx_post_money').val(attachment.url);
        }).open();
        return;
    });
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
    var mdx_val_get = jQuery('input.mdx_get:checked').val();
    if(mdx_val_get=='cat'){
        jQuery('#mdx_hot_posts_cat').removeAttr("disabled");
    }else if(mdx_val_get=='sticky'){
        jQuery('#mdx_hot_posts_cat').attr("disabled","disabled");
    }
    var mdx_val_toc = jQuery('input.mdx_toc:checked').val();
    if(mdx_val_toc=='true'){
        jQuery('input.mdx_toc_preview').removeAttr("disabled");
    }else if(mdx_val_toc=='false'){
        jQuery('input.mdx_toc_preview').attr("disabled","disabled");
    }
    var mdx_val_img_box = jQuery('input.mdx_img_box:checked').val();
    if(mdx_val_img_box=='true'){
        jQuery('input.mdx_img_box_alt').removeAttr("disabled");
    }else if(mdx_val_img_box=='false'){
        jQuery('input.mdx_img_box_alt').attr("disabled","disabled");
    }
    var selectVO = document.getElementById('mdx_use_cdn').options[document.getElementById('mdx_use_cdn').options.selectedIndex].value;
    if(selectVO ==='none' || selectVO ==='jsdelivr'){
        jQuery('.cdn_custom').hide();
    }else if(selectVO == 'custom'){
        jQuery('.cdn_custom').show();
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
jQuery(".mdx_get").click(function(){
    var mdx_val = jQuery('input.mdx_get:checked').val();
    if(mdx_val=='cat'){
        jQuery('#mdx_hot_posts_cat').removeAttr("disabled");
    }else if(mdx_val=='sticky'){
        jQuery('#mdx_hot_posts_cat').attr("disabled","disabled");
    }
});
jQuery(".mdx_toc").click(function(){
    var mdx_val = jQuery('input.mdx_toc:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_toc_preview').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_toc_preview').attr("disabled","disabled");
    }
});
jQuery(".mdx_img_box").click(function(){
    var mdx_val = jQuery('input.mdx_img_box:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_img_box_alt').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_img_box_alt').attr("disabled","disabled");
    }
});
function img1(){
    var img1=jQuery("#mdx_post_money").val();
    if(img1.substring(0,4) != 'http'){
        img1 = '';
    }
    jQuery('#img1').attr('src',img1);
}
function mdx_cdn_sec(selectV){
    if(selectV ==='none' || selectV ==='jsdelivr'){
        jQuery('.cdn_custom').hide();
    }else if(selectV == 'custom'){
        jQuery('.cdn_custom').show();
    }
}
jQuery(".mdx-admin-nav").click(function(e){
    e.preventDefault();
    var ele = jQuery(e.target);
    var eleId = ele.attr("id");
    jQuery(".mdx-admin-nav.nav-tab-active").removeClass("nav-tab-active");
    ele.addClass("nav-tab-active");
    jQuery("tbody.mdx-admin-section.mdx-admin-section-active").removeClass("mdx-admin-section-active");
    jQuery("#"+eleId+"-section").addClass("mdx-admin-section-active");
})