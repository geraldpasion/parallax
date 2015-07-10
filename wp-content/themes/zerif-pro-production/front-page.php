<?php 
	if(isset($_POST['submitted'])) :        
			/* name */
			if(trim($_POST['myname']) === ''):               
				$nameError = __('* Please enter your name.','zerif');               
				$hasError = true;        
			else:               
				$name = trim($_POST['myname']);        
			endif; 
			/* email */	
			if(trim($_POST['myemail']) === ''):               
				$emailError = __('* Please enter your email address.','zerif');               
				$hasError = true;        
			elseif (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['myemail']))) :               
				$emailError = __('* You entered an invalid email address.','zerif');               
				$hasError = true;        
			else:               
				$email = trim($_POST['myemail']);        
			endif;  
			/* subject */
			if(trim($_POST['mysubject']) === ''):               
				$subjectError = __('* Please enter a subject.','zerif');               
				$hasError = true;        
			else:               
				$subject = trim($_POST['mysubject']);        
			endif; 
			/* message */
			if(trim($_POST['mymessage']) === ''):               
				$messageError = __('* Please enter a message.','zerif');               
				$hasError = true;        
			else:                                     
				$message = stripslashes(trim($_POST['mymessage']));               
			endif; 		
			
			/* send the email */
			if(!isset($hasError)):               
					$emailTo = get_theme_mod('zerif_email');
				if(isset($emailTo) && $emailTo != ""):
						$subject = 'From '.$name;
					$body = "Name: $name \n\nEmail: $email \n\n Subject: $subject \n\n Message: $message";               
					$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email; 				               
					wp_mail($emailTo, $subject, $body, $headers);               
					$emailSent = true;        
				else:
					$emailSent = false;
				endif;
			endif;	
		endif;	
		
		include get_template_directory() . "/sections/big_title.php";
?>
</header> <!-- / END HOME SECTION  -->
<div id="content" class="site-content">
<?php
get_footer(); ?>