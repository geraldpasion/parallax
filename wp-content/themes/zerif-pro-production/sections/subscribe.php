<section class="newsletter">
<div class="container">
	<?php 
		$zerif_subscribe_title = get_theme_mod('zerif_subscribe_title','STAY IN TOUCH');
		$zerif_subscribe_subtitle = get_theme_mod('zerif_subscribe_subtitle','Sign Up for Email Updates on on News & Offers');
		
		if( !empty($zerif_subscribe_title) ):
			echo '<h3 class="white-text" data-scrollreveal="enter left after 0s over 1s">'.$zerif_subscribe_title.'</h3>';
		endif;
		
		if( !empty($zerif_subscribe_subtitle) ):
			echo '<div class="sub-heading white-text" data-scrollreveal="enter right after 0s over 1s">';
				echo $zerif_subscribe_subtitle;
			echo '</div> ';
		endif;
		
		if(is_active_sidebar( 'sidebar-subscribe' )):
			dynamic_sidebar( 'sidebar-subscribe' );
		endif;
	?>
	
	
	
	<!-- SUBSCRIPTION FORM -->
	<!--<form action="#" class="subscription" role="form" data-scrollreveal="enter left after 0s over 1s">
		<input type="email" placeholder="Enter email" class="form-control input-box">
		<button class="btn btn-primary custom-button red-btn">Sign Up</button>
	</form>-->
	<!-- / END SUBSCRIPTION FORM -->
	
</div> <!-- / END CONTAINER -->
</section> <!-- / END NEWSLETTER SECTION -->