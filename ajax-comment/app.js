jQuery(document).ready(function(jQuery) {
	var __cancel = jQuery('#cancel-comment-reply-link'),
		__cancel_text = __cancel.text(),
		__list = 'ajax-comments';//your comment wrapprer
	jQuery(document).on("submit", "#commentform", function() {
		$('#submit').attr('disabled','disabled');
		jQuery.ajax({
			url: ajaxcomment.ajax_url,
			timeout : 15000,
			data: jQuery(this).serialize() + "&action=ajax_comment",
			type: jQuery(this).attr('method'),
			error: function(request) {
				var t = faAjax;
				t.createButterbar(request.responseText);
				$('#submit').removeAttr('disabled');
				if(request.responseText){
					mdui.snackbar({
                 		message: request.responseText,
          				timeout: 5000,
						position: 'top',
					});
				}else{
					mdui.snackbar({
						message: '<strong>错误：</strong> 未知错误。',
						timeout: 5000,
					    position: 'top',
				   });
				}
			},
			success: function(data) {
				jQuery('textarea').each(function() {
					this.value = ''
				});
				mdui.snackbar({
                 	message: '发射成功！',
					timeout: 5000,
					position: 'top',
				});
				var t = faAjax,
					cancel = t.I('cancel-comment-reply-link'),
					temp = t.I('wp-temp-form-div'),
					respond = t.I(t.respondId),
					post = t.I('comment_post_ID').value,
					parent = t.I('comment_parent').value;
				if (parent != '0') {
					jQuery('#respond').parent('li.mdui-list-item').after('<li><li class="mdui-divider-inset mdui-m-y-0"></li><ul class="children">' + data + '</ul></li>');
					jQuery('ul.children').next('li').remove();
				} else if (!jQuery('.' + __list ).length) {
					if (ajaxcomment.formpostion == 'bottom') {
						jQuery('#respond').before('<ul class="' + __list + '">' + data + '</ul>');
					} else {
						jQuery('#respond').after('<ul class="' + __list + '">' + data + '</ul>');
					}

				} else {
					if (ajaxcomment.order == 'asc') {
						jQuery('.' + __list ).append(data); // your comments wrapper
					} else {
						jQuery('.' + __list ).prepend(data); // your comments wrapper
					}
				}
				cancel.style.display = 'none';
				cancel.onclick = null;
				t.I('comment_parent').value = '0';
				if (temp && respond) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
			}
		});
		return false;
	});
	faAjax = {
		I: function(e) {
			return document.getElementById(e);
		},
		clearButterbar: function(e) {
			if (jQuery(".butterBar").length > 0) {
				jQuery(".butterBar").remove();
			}
		},
		createButterbar: function(message) {
			var t = this;
			t.clearButterbar();
			jQuery("body").append('<div class="butterBar butterBar--center"><p class="butterBar-message">' + message + '</p></div>');
			setTimeout("jQuery('.butterBar').remove()", 3000);
		}
	};
});