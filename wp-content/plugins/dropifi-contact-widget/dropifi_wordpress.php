<?php
/*
Plugin Name: Dropifi Contact Widget
Plugin URI: https://www.dropifi.com
Description: Spam-free contact form that delivers extensive visitor engagement insight. Dropifi is the easiest way to connect with your customers, understand their needs, and boost your sales with authentic word-of-mouth referral
Version: 2.1
Author: Dropifi
Author URI: https://www.dropifi.com
*/

/** If you hardcode a WP.com API key here, all key config screens will be hidden */

if ( defined('WPCOM_API_KEY') )
	$wpcom_api_key = constant('WPCOM_API_KEY'); 
else
	$wpcom_api_key = '';

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "Hi there!  smile, a wondeful day awaits you."; 
	exit; 
}

$plugin = plugin_basename(__FILE__);
$dropifi_plugin_directory = dirname(__FILE__); 
$setting_url="?page=dropifi-contact-widget/dropifi_wordpress.php";
$pluginPost = admin_url($setting_url, __FILE__);  

add_action('init', 'dropifi_header_init');
add_action('wp_head', 'dropifi_install_widget');
register_activation_hook(__FILE__, 'activate_dropifi_settings');
  
add_action('admin_init', 'on_plugin_activated_dropifi_redirect');  
add_filter("plugin_action_links_$plugin", 'dropifi_plugin_settings_link');

// create custom plugin settings menu
add_action('admin_menu', 'dropifi_create_menu'); 
function dropifi_header_init() {
   if (!is_admin()) {
	wp_enqueue_script('jquery');
        dropifi_widget_load_js();
   }
}


function dropifi_install_widget(){
	?>
	<!--start dropifi --><script type='text/javascript'>document.renderDropifiWidget('<?php echo get_option('dropifi_public_key') ?>');</script><!-- end dropifi -->
   <?php
}

// Add login link on plugin page
function dropifi_plugin_login_link($links) { 
  $login_link = '<a href="https://www.dropifi.com">Login</a>';
  array_unshift($links, $login_link); 
  return $links; 
} 
 
// Add settings link on plugin page

function dropifi_plugin_settings_link($links) { 
  $setting_url="?page=dropifi-contact-widget/dropifi_wordpress.php";
  $settings_link = '<a href="' . admin_url($setting_url,__FILE__). '">Settings</a>';   
  array_unshift($links, $settings_link);
  return $links; 
}

function dropifi_create_menu(){
	 
	//create new top-level menu 
	$value = get_option('dropifi_public_key');
	
	if($value ==NULL || $value==""){
		add_menu_page('Dropifi Plugin Settings', 'Dropifi', 'administrator',__FILE__, 'dropifi_settings_page', plugins_url('/images/favicon.png', __FILE__)); 
		add_settings_field('dropifi-contact-widget', 'Dropifi', 'settings','dropifi_settings_page','dropifi_settings_page'); 
	}else{
		add_menu_page('Dropifi Plugin Settings', 'Dropifi', 'administrator',__FILE__, 'dropifi_instruction_page', plugins_url('/images/favicon.png', __FILE__)); 
		add_settings_field('dropifi-contact-widget', 'Dropifi', 'settings','dropifi_settings_page','dropifi_settings_page'); 
		//add_menu_page('Dropifi Plugin Settings', 'Dropifi', 'settings',__FILE__, 'dropifi_instruction_page', plugins_url('/images/favicon.png', __FILE__)); 
	}
    //add_action('admin_head', 'dropifi_admin_js');
	add_action('admin_enqueue_scripts', 'dropifi_admin_js');
	
	//call register settings function
	add_action( 'admin_init', 'dropifi_register_mysettings'); 
    submitToDropifi();
}

function dropifi_get_response($error=false, $success=200,$msg="",$data){
	$return['success'] = $success;
	$return['error'] = $error;	
	$return['msg'] = $msg;
	$return['response']=$data;
	return $return;
}

 
function dropifi_register_mysettings_test() {
	//register our settings
	register_setting( 'dropifi-settings-group', 'new_option_name' );
	register_setting( 'dropifi-settings-group', 'some_other_option' );
	register_setting( 'dropifi-settings-group', 'option_etc' );
}

function dropifi_register_mysettings(){
			
	$current_user = wp_get_current_user(); 
	$accessToken = md5($current_user->user_email.date(DATE_RFC822));
	
	$value = get_option('dropifi_public_key');
	if($value== NULL || $value=""){ 
	
		register_setting( 'dropifi-settings-group', 'dropifi_public_key' );
		register_setting( 'dropifi-settings-group', 'dropifi_access_token' );
		register_setting( 'dropifi-settings-group', 'dropifi_user_email' );
		register_setting( 'dropifi-settings-group', 'dropifi_domain' ); 
		register_setting( 'dropifi-settings-group', 'dropifi_password' ); 
		register_setting( 'dropifi-settings-group', 'dropifi_fullname' ); 
                register_setting( 'dropifi-settings-group', 'dropifi_phone' ); 
		register_setting( 'dropifi-settings-group', 'dropifi_login_url'); 
		register_setting( 'dropifi-settings-group', 'dropifi_error_msg');
		register_setting( 'dropifi-settings-group', 'dropifi_error_msg_s'); 		
		register_setting( 'dropifi-settings-group', 'dropifi_error_msgcolor'); 
		register_setting( 'dropifi-settings-group', 'dropifi_error_msgcolor_s');
		
		add_option("dropifi_public_key", $value="",'', $autoload='yes'); 
		add_option("dropifi_access_token", $accessToken,'', $autoload='yes'); 
		add_option("dropifi_user_email", $current_user->user_email,'', $autoload='yes');
		add_option("dropifi_domain", $value="",'', $autoload='yes');
		add_option("dropifi_password", $value="",'', $autoload='yes');
		add_option("dropifi_fullname", $current_user->display_name,'', $autoload='yes');
		add_option("dropifi_login_url", "#",'', $autoload='yes');
		add_option("dropifi_error_msg", 'Once you submit your login details below, the Dropifi contact widget will be installed on your site. Login to your dropifi account to customize the look and feel of your widget.','', $autoload='yes');
		add_option("dropifi_error_msgcolor", "#4ea5cd",'', $autoload='yes');
		add_option("dropifi_error_msg_s", 'Once you submit the details below, the Dropifi contact widget will be installed on your site. Login to your dropifi account to customize the look and feel of your widget.','', $autoload='yes');
		add_option("dropifi_error_msgcolor_s", "#4ea5cd",'', $autoload='yes');
		add_option("dropifi_phone", $current_user->dropifi_phone,'', $autoload='yes');
		
	}else{
	  	update_option("dropifi_access_token", $accessToken); 
	}
	 
}

//============================Redirect when plugin is activated==============================//

function activate_dropifi_settings() {  
    add_option('my_plugin_do_activation_redirect', true);  
}

function on_plugin_activated_dropifi_redirect(){
	$setting_url="?page=dropifi-contact-widget/dropifi_wordpress.php";	
	if (get_option('my_plugin_do_activation_redirect', false)) {  
        delete_option('my_plugin_do_activation_redirect'); 
        wp_redirect(admin_url($setting_url)); 
    }  
}

function dropifi_admin_js(){  
  wp_enqueue_script( 
		'dropifi_wordpress', 
		'//api.dropifi.com/widget/dropifi_wordpress.js'
	);
} 

function dropifi_widget_js(){  
  wp_enqueue_script( 
		'dropifi_widget', 
		'//api.dropifi.com/widget/dropifi_widget.wordpress.js'
  );
}

function dropifi_widget_load_js(){   
  wp_enqueue_script( 
		'dropifi_widget_min', 
		'//api.dropifi.com/widget/dropifi_widget.wordpress.js' 
  );
} 
 

//==========================================================================================
function dropifi_instruction_page(){
	$plugin = plugins_url('/dropifi_wordpress.php', __FILE__); 
	$setting_url="?page=dropifi-contact-widget/dropifi_wordpress.php";
	$pluginPost = admin_url($setting_url, __FILE__); 	
?>
<div class="wrap">

<div class="icon32" id="icon-options-general"></div>
 <h2>Dropifi Contact Widget</h2> 
    <div id="wordpress_dropifi" style="width:100%;min-width:800px;margin-top:10px;"> 
    
    <div id="dropifi_header" style="width:100%;
	background-color:#5AA9D3;
	-webkit-border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    border-radius: 5px 5px 0px 0px;
	padding:10px 0px;">
    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><img src="<?php echo plugins_url('/images/dropifi_wordpress.png', __FILE__); ?>" width="113" height="65" alt="Dropifi Contact Widget" />
    <span style="top:-7px; position:relative;color: #FFFFFF;
    font-size: 2.0em;
    font-weight: bold;
    height: auto;
    line-height: 0.95em;
    margin-bottom: 5px;
    padding-left: 20px;
    width: auto;">Turn Your Site Visitors Into Loyal Customers </span>
    </div>
    
    <div id="dropifi_after_header" style="min-height:50px; 
	background-color:#F9F9F9;
	padding:10px;
	-webkit-border-radius: 0px 0px 5px 5px;
    -moz-border-radius: 0px 0px 5px 5px;
    border-radius: 0px 0px 5px 5px;
	border:1px solid #DADADA;">
    <form method="POST" action="<?php echo $pluginPost ?>" name="userdata" id="dropifi_reset">
    <input  type="hidden" name="r_requestUrl" id="r_requestUrl" value="<?php echo $plugin ?>"/>
  <p> <input type="hidden" name="requestType" id="requestType" value="RESET_DROPIFI_ACCOUNT" />
   <input type="submit" class="button-primary" id="test_reset_dropifi_account" style=" margin-left:10px;margin-right:10px;" value="Reset Your Account"/> <span> OR </span>  
   <a class="button-primary" target="_blank" href="<?php echo get_option('dropifi_login_url'); ?>" id="login_dropifi_account" style="margin-left:10px;">Go to your Dropifi Dashboard</a></p> 
   </form>
                   
    </div>
    
    
    <div id="dropifi_content" style="-webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
	background-color:#F9F9F9;
	height:300px;
	margin-top:20px;
	border:1px solid #DADADA;">
    <div style="padding:10px;font-size:14px;">
    <p><strong>You have successfully installed your Dropifi contact widget. Your customer engagement is now simplified and more insightful. Best of all, getting  you off to a good start is really easy!</strong></p>
 <ol>
<li>Customize the Dropifi contact widget from <span style="font-style:italic">Admin >> Mail Management >> Contact Widget</span> on your Dropifi dashboard. You can modify the content of the form, widget color and tab text to suit your preferences.</li>
<li>Add your customer support staff for easy collaboration to wow your customers.</li>
<li>Does your company use different email addresses to support your customers? Then consider adding mailboxes. This gives you the option anytime to select the email address from which to send a message.</li>
<li>Among the range of customizations that make your life flexible, you can also add quick response templates, add predefined subjects for your widget and add message recipients whom copies of all messages will be sent to.</li>
</ol>
<p>If you hit a stumbling block, reference our <a href="http://support.dropifi.com" target="_blank">support</a> page or get in touch with us through <a href="mailto:support@dropifi.com">support@dropifi.com</a>. We promise to get back to you within a couple of hours.</p>
</div>
    </div>
    
    </div>

    
</div>
<?php
}

function dropifi_settings_page(){
	$plugin = plugins_url('/dropifi_wordpress.php', __FILE__); 
	$ErrorMsgS = get_option('dropifi_error_msg_s');
	$ErrorMsgColorS =get_option('dropifi_error_msgcolor_s');
	$ErrorMsg = get_option('dropifi_error_msg');
	$ErrorMsgColor =get_option('dropifi_error_msgcolor');
	
	$setting_url="?page=dropifi-contact-widget/dropifi_wordpress.php";
	$pluginPost = admin_url($setting_url, __FILE__); 
 
?>
<div class="wrap">
<div class="icon32" id="icon-options-general"></div>
    <h2>Dropifi Contact Widget Setup</h2> 
    <h3>Refresh this page after Signup or Login if it does not redirect to the Dropifi dashboard page</h3>

    <div class="postbox-container" style="margin-right:40px; min-width:400px; width:45%;margin-top:0px;">
        <div id="dropifi_signup" class="metabox-holder"> 
            <div class="meta-box-sortables">
                <div class="postbox">
                    <h3 class="hndle"><span>New to Dropifi ? Create An Account</span></h3>
                    
                    <div class="inside">   
                    	<div id="dropifi_s_message_status" class="" style="background-size: 40px 40px;background-image: linear-gradient(135deg, rgba(255, 255, 255, .05) 25%, transparent 25%,
							transparent 50%, rgba(255, 255, 255, .05) 50%, rgba(255, 255, 255, .05) 75%,transparent 75%, transparent);box-shadow: inset 0 -1px 0 rgba(255,255,255,.4);
		 width: 100%; border: 1px solid; color: #fff; padding: 15px;text-shadow: 0 1px 0 rgba(0,0,0,.5);  animation: animate-bg 5s linear infinite; width:94%;
       background-color:<?php echo($ErrorMsgColorS) ?>; border-color: #3b8eb5;"><?php echo($ErrorMsgS) ?></div>
                        <hr /> 
                        <form method="POST" action="<?php echo $pluginPost ?>" name="userdata" id="dropifi_signup" > 
                            <?php settings_fields( 'dropifi-settings-group' ); ?> 
                            <?php do_settings_sections( 'dropifi-settings-group' ); ?> 
                            <input type="hidden" name="requestType" id="requestType" value="SIGNUP" />
                            <input type="hidden" name="requestUrl" id="requestUrl" value="<?php echo $pluginPost; ?>" />
                            <input type="hidden" name="accessToken" id="accessToken" value="<?php echo get_option('dropifi_access_token') ?>" /> 
							<input type="hidden" name="site_url" id="site_url" value="<?php echo network_site_url( '/' ) ?>" /> 
                             
                            <table class="form-table">
                            
                                <tr valign="top">
                                <th scope="row" style="width:100px">Full Name </th>
                                <td><input type="text" name="displayName" id="displayName" value="<?php echo get_option('dropifi_fullname'); ?>" style="width:100%" class="dropifi_s_msg_error"/></td>
                                </tr>
                                
                                <tr valign="top">
                                <th scope="row" style="width:100px">Email</th>
                                <td><input type="text" name="user_email" id="user_email" value="<?php echo get_option('dropifi_user_email'); ?>" style="width:100%" class="dropifi_s_msg_error"/></td>
                                </tr>
                                <tr valign="top"> 
                                <th scope="row" style="width:100px">Password</th>
                                <td><input type="password" name="user_password" id="user_password" value="<?php echo get_option('dropifi_password'); ?>" style="width:100%" class="dropifi_s_msg_error"/></td>
                                </tr>
                                 
                                <tr valign="top">
                                <th scope="row" style="width:80px">Re-Password</th>
                                <td><input type="password" name="user_re_password" id="user_re_password" value="<?php echo get_option('dropifi_password'); ?>" style="width:100%" class="dropifi_s_msg_error"/></td>
                                </tr>
                                
                                <tr valign="top">
                                <th scope="row" style="width:100px">Company Name</th>
                                <td><input type="text" name="user_domain" id="user_domain" value="<?php echo get_option('dropifi_domain'); ?>" 				style="width:100%" class="dropifi_s_msg_error" title="your company name should not contain special characters" /></td>
                                </tr>
				
				<tr valign="top">
                                <th scope="row" style="width:100px">Phone Number</th>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" value="<?php echo get_option('dropifi_phone'); ?>" 				style="width:100%" class="dropifi_s_msg_error" title="please enter your phone number starting with country code" /></td>
                                </tr>
                                
                                <tr valign="top">
                                <th colspan="2">By creating an account, you agree to Dropifi's 
                                    <a href="https://www.dropifi.com/legal_terms" target="_blank" class="">Beta Terms and Conditions</a></th>
                                </tr>
                                
                                <tr valign="top"> 
                                 
                                <th colspan="2"><input type="button"  class="button-primary" value="Create A New Account" id="dropifi_create_new_account" /></th>
                                </tr>
                            </table> 
                            
                        </form>  
                    </div>		
                </div>
            </div>  
        </div> 
    </div>    
    
    <div class="postbox-container" style="min-width:400px; width:45%;margin-top:10px;">
        <div id="dropifi_login" class="metabox-holder">
         <div class="meta-box-sortables">
                <div class="postbox">
                    <h3 class="hndle"><span>Already a Dropifi user ? Login with your Dropifi Account</span></h3>
                     <div class="inside">
                     		<div id="dropifi_l_message_status" class="" style="background-size: 40px 40px;background-image: linear-gradient(135deg, rgba(255, 255, 255, .05) 25%, transparent 25%,
							transparent 50%, rgba(255, 255, 255, .05) 50%, rgba(255, 255, 255, .05) 75%,transparent 75%, transparent);box-shadow: inset 0 -1px 0 rgba(255,255,255,.4);
		 width: 100%; border: 1px solid; color: #fff; padding: 15px;text-shadow: 0 1px 0 rgba(0,0,0,.5);  animation: animate-bg 5s linear infinite; width:94%;
       background-color: <?php echo($ErrorMsgColor) ?>; border-color: #3b8eb5;"><?php echo($ErrorMsg) ?></div>
                         
                        <hr />
                        <form method="POST" action="<?php echo $pluginPost; ?>" name="userdata" id="dropifi_login">
                        <?php settings_fields( 'dropifi-settings-group' ); ?> 
                        <?php do_settings_sections('dropifi-settings-group' ); ?> 
                        
                        <input type="hidden" name="requestType" id="l_requestType" value="LOGIN" />
                        <input type="hidden" name="requestUrl" id="l_requestUrl" value="<?php echo $pluginPost; ?>" /> 
                        <input type="hidden" name="accessToken" id="l_accessToken" value="<?php echo get_option('dropifi_access_token') ?>" />
						<input type="hidden" name="site_url" id="l_site_url" value="<?php echo network_site_url( '/' ) ?>" /> 
						
                         <table class="form-table"> 
                            
                            <tr valign="top">
                            <th scope="row" style="width:60px">Email</th> 
                            <td><input type="text" name="login_email" id="login_email" value= "<?php echo get_option('dropifi_user_email'); ?>" class="dropifi_l_msg_error" style="width:100%"/></td>
                            </tr>
                            
                            <tr valign="top"> 
                            <th scope="row" style="width:60px">Password</th>
                            <td><input type="password" name="accessKey" id="accessKey" value= "<?php echo get_option('dropifi_password'); ?>" class="dropifi_l_msg_error" style="width:100%"/></td>
                            </tr>
                            
                            <tr valign="top">  
                            
                            <th colspan="2">
							<input type="button" class="button-primary" value="Login" id="dropifi_login_account" />
							<a style="float:right;font-size:11.5px;color:#666;text-decoration: underline;" target="_blank" href="http://www.dropifi.com/forgot_password" title="click to reset your password">Forgot your password?</a>
							</th>
                            </tr>
                          
                          </table>
                          </form>
                      </div>
                  </div>
        </div>
    </div>
	
	<div style='visibility:hidden;'>
		<form method="POST" action="<?php echo $pluginPost; ?>" name="userdata" id="up_dropifi_login">
		 <input type="hidden" name="requestType" id="up_requestType" value="LOGIN" />
         <input type="hidden" name="userEmail" id="up_userEmail" value="" /> 
         <input type="hidden" name="temToken" id="up_temToken" value="" />		 
         <input type="hidden" name="status" id="up_status" value="" />
		 <input type="hidden" name="publicKey" id="up_publicKey" value="" /> 
		 <input type="submit" value="" id="up_submit"/>
		 </form>
	</div>
    
</div>
 

<?php }

function submitToDropifi(){	  
	$requestType= $_POST['requestType'];
	 
	if($requestType == "SIGNUP" || $requestType == "LOGIN"){
 
		$response = dropifi_get_response(false,$_POST['status'],"",null); 
		
		if($_POST['status']==200){ 
			update_option('dropifi_user_email', $_POST['userEmail']); 
			update_option("dropifi_public_key",$_POST['publicKey']);
			update_option("dropifi_login_url", "http://www.dropifi.com/blog/wordpress/login/?temToken=".$_POST['temToken']."&userEmail=".$_POST['userEmail']);
			$response['temToken']=$_POST['temToken']; 
			$response['userEmail']=$_POST['userEmail'];
		}else{
			update_option('dropifi_user_email', '');
		}	
	    	
		header("Location: $pluginPost"); 
	}else if($requestType == "RESET_DROPIFI_ACCOUNT"){
		update_option("dropifi_public_key","");		 	
		update_option("dropifi_login_url", "http://www.dropifi.com/login"); 
		$response = dropifi_get_response(true,200, "Account resetted successfully", null);
		header("Location: $pluginPost");
	}else{  
		$response = dropifi_get_response(true,404, "",null);	    
	}
	
}

?>
