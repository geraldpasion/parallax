function update_publickey(e, t, n) {
	jQuery("#up_requestType").val(t);
	jQuery("#up_userEmail").val(n.userEmail);
	jQuery("#up_temToken").val(n.temToken);
	jQuery("#up_status").val(n.status);
	jQuery("#up_publicKey").val(n.publicKey);
	jQuery("#up_dropifi_login").submit()
}
function loadjsfile(e) {
	var t = document.createElement("script");
	t.type = "text/javascript";
	t.src = e;
	document.getElementsByTagName("head")[0].appendChild(t)
}
function loadcssfile(e) {
	var t = document.createElement("link");
	t.setAttribute("rel", "stylesheet");
	t.setAttribute("type", "text/css");
	t.setAttribute("href", e);
	document.getElementsByTagName("head")[0].appendChild(t)
}
jQuery(document).ready(function () {
	jQuery("#displayName").val(" ");
	var e = "";
	jQuery("#dropifi_create_new_account").click(function () {
		var t = jQuery("#requestUrl").val();
		var n = jQuery("#accessToken").val();
		var r = {};
		r.hostUrl = window.location.host;
		r.requestType = "SIGNUP";
		r.accessToken = n;
		r.requestUrl = t;
		r.displayName = jQuery("#displayName").val();
		r.user_email = jQuery("#user_email").val();
		r.user_re_password = jQuery("#user_re_password").val();
		r.user_password = jQuery("#user_password").val();
		r.user_domain = jQuery("#user_domain").val();
		r.site_url = jQuery("#site_url").val();
		r.location = e;
		if(jQuery("#phoneNumber")){
       	 r.phoneNumber = jQuery("#phoneNumber").val();
        }else{ 
    	   r.phoneNumber = "";
        }
		
		jQuery("body").css("cursor", "wait");
		jQuery("#dropifi_create_new_account").css("cursor", "wait");
		jQuery.ajax({
			type: "GET",
			url: "https://www.dropifi.com/blog/wordpress/signup.json",
			dataType: "jsonp",
			jsonp: "s",
			crossDomain: true,
			data: {
				displayName: r.displayName,
				user_email: r.user_email,
				user_password: r.user_password,
				user_re_password: r.user_re_password,
				user_domain: r.user_domain,
				hostUrl: r.hostUrl,
				requestUrl: r.requestUrl,
				accessToken: r.accessToken,
				site_url: r.site_url,
				location: r.location,
				phoneNumber:r.phoneNumber,
				type: "json"
			},
			success: function (e) {
				if (e.status == 200) {
					update_publickey(t, r.requestType, e)
				} else {
					jQuery("#dropifi_s_message_status").html(e.msg);
					jQuery("#dropifi_s_message_status").css({
						"background-color": "#de4343",
						"border-color": "#c43d3d"
					});
					jQuery("body").css("cursor", "pointer");
					jQuery("#dropifi_login_account").css("cursor", "pointer")
				}
			},
			error: function (e) {
				jQuery("#dropifi_s_message_status").html("An error occurred while submiting your details, try creating the account again");
				jQuery("#dropifi_s_message_status").css({
					"background-color": "#de4343",
					"border-color": "#c43d3d"
				});
				jQuery("body").css("cursor", "pointer");
				jQuery("#dropifi_create_new_account").css("cursor", "pointer")
			}
		})
	});
	jQuery("#dropifi_login_account").click(function () {
		var t = jQuery("#l_requestUrl").val();
		var n = {};
		n.requestType = "LOGIN";
		n.login_email = jQuery("#login_email").val();
		n.accessKey = jQuery("#accessKey").val();
		n.accessToken = jQuery("#l_accessToken").val();
		n.requestUrl = t;
		n.site_url = jQuery("#l_site_url").val();
		n.location = e;
		jQuery("body").css("cursor", "wait");
		jQuery("#dropifi_login_account").css("cursor", "wait");
		jQuery.ajax({
			type: "GET",
			url: "https://www.dropifi.com/blog/wordpress/loginToken.json",
			dataType: "jsonp",
			data: {
				login_email: n.login_email,
				accessKey: n.accessKey,
				requestUrl: n.requestUrl,
				accessToken: n.accessToken,
				site_url: n.site_url,
				location: n.location,
				type: "json"
			},
			jsonp: "s",
			crossDomain: true,
			success: function (e) {
				if (e.status == 200) {
					update_publickey(t, n.requestType, e)
				} else {
					jQuery("#dropifi_l_message_status").html(e.msg);
					jQuery("#dropifi_l_message_status").css({
						"background-color": "#de4343",
						"border-color": "#c43d3d"
					});
					jQuery("body").css("cursor", "pointer");
					jQuery("#dropifi_login_account").css("cursor", "pointer")
				}
			},
			error: function (e) {
				jQuery("body").css("cursor", "pointer");
				jQuery("#dropifi_login_account").css("cursor", "pointer");
				jQuery("#dropifi_l_message_status").html("An error occurred while submiting your details, try logging into your account again");
				jQuery("#dropifi_l_message_status").css({
					"background-color": "#de4343",
					"border-color": "#c43d3d"
				})
			}
		})
	});
	jQuery("#reset_dropifi_account").click(function () {
		var e = jQuery("#r_requestUrl").val();
		var t = {};
		t.requestType = "RESET_DROPIFI_ACCOUNT";
		t.requestUrl = e;
		jQuery.ajax({
			type: "GET",
			url: e,
			dataType: "json",
			data: {
				userdata: t
			},
			success: function (e) {
				window.location.reload()
			},
			error: function (e) {
				window.location.reload()
			}
		})
	});
	jQuery(".dropifi_l_msg_error").click(function () {
		jQuery("#dropifi_l_message_status").html("Once you submit your login details below, the Dropifi contact widget will be installed on your site. Login to your dropifi account to customize the look and feel of your widget.");
		jQuery("#dropifi_l_message_status").css({
			"background-color": "#4ea5cd",
			"border-color": "#3b8eb5"
		})
	});
	jQuery(".dropifi_s_msg_error").click(function () {
		jQuery("#dropifi_s_message_status").html("Once you submit the details below, the Dropifi contact widget will be installed on your site. Login to your dropifi account to customize the look and feel of your widget.");
		jQuery("#dropifi_s_message_status").css({
			"background-color": "#4ea5cd",
			"border-color": "#3b8eb5"
		})
	})
})