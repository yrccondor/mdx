jQuery(document).ready(function(){
    var mdx_val = jQuery('input.mdx_stbs:checked').val();
    if(mdx_val=='false'){
        jQuery('input.mdx_stbsip').attr("disabled","disabled");
    }
});
jQuery(".mdx_stbs").click(function(){
    var mdx_val = jQuery('input.mdx_stbs:checked').val();
    if(mdx_val=='true'){
        jQuery('input.mdx_stbsip').removeAttr("disabled");
    }else if(mdx_val=='false'){
        jQuery('input.mdx_stbsip').attr("disabled","disabled");
    }
});