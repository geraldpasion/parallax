<?php
$dropifi_plugin_directory = dirname(__FILE__); 
require_once($dropifi_plugin_directory.'/dropifi_install.php');

$file = dirname(__FILE__);
$file = substr($file, 0, stripos($file, "wp-content") );
// Require the file
require( $file . "/wp-load.php");

if($_GET['userdata'] !=NULL){
	
	$userdata = $_GET['userdata'];
	$requestType= $userdata['requestType'];
	
	if($requestType == "SIGNUP" || $requestType == "LOGIN"){ 		
		$send = new DropifiWordpress; 
		
		if($requestType == "SIGNUP"){
			//request signup accessToken 
			$userdata['site_url'] =network_site_url( '/' ); 
			$userdata['requestUrl']='localhost';
			$data = $send->rest_helper('http://www.dropifi.com/blog/wordpress/signup',$userdata,"POST");  		
		}else if($requestType == "LOGIN"){
			//request login accessToken
			$userdata['site_url'] =network_site_url( '/' ); 
                        $userdata['requestUrl']='localhost';
			$userdata['accessKey']= md5($userdata['accessKey']); 
			$data = $send->rest_helper('http://www.dropifi.com/blog/wordpress/loginToken',$userdata,"POST"); 
		
		}
		
		$response = get_response(false,$data->status, $data->msg,null); 		
		if($data->status==200){	
			update_option('dropifi_user_email', $data->userEmail); 
			update_option("dropifi_public_key", $data->publicKey); 
			update_option("dropifi_login_url", "http://www.dropifi.com/blog/wordpress/login/?temToken=".$data->temToken."&userEmail=".$data->userEmail);
			
			$response['temToken']=$data->temToken; 
			$response['userEmail']=$data->userEmail; 
		}
		
	}else if($requestType == "RESET_DROPIFI_ACCOUNT"){
		update_option("dropifi_public_key","");
		update_option("dropifi_login_url", "http://www.dropifi.com/login"); 
		$response = get_response(true,200, "Account resetted successfully", null);
	}else{
		$response = get_response(true,404, "Not a Signup request",null);		
	}
}else if($_GET['dropifi_token']){		
	$response = get_response(false,250,"Verification of Wordpress Blog", null);
	$response['accessToken'] = get_option('dropifi_access_token'); 
}else{
	$response = get_response(true,501, "Required data not specified check", null);	 
}



echo json_encode($response); 

function get_response($error=false, $success=200,$msg="",$data){
	$return['success'] = $success;
	$return['error'] = $error;	
	$return['msg'] = $msg;
	$return['response']=$data;
	return $return;
}

?>