<section class="packages" id="pricingtable">
<div class="container">
	
	<!-- SECTION HEADER -->
	<div class="section-header">

		<?php
		$zerif_packages_title = get_theme_mod('zerif_packages_title','PACKAGES');
		
		if( !empty($zerif_packages_title) ):
			echo '<h2 class="white-text">'.$zerif_packages_title.'</h2>';
		endif;	
		

		$zerif_packages_subtitle = get_theme_mod('zerif_packages_subtitle','We have 4 friendly packages for you. Check all the packages and choose the right one for you.');



		if( !empty($zerif_packages_subtitle) ):

			echo '<h6 class="white-text">'.$zerif_packages_subtitle.'</h6>';

		endif;	

		?>
	</div>
	<!-- / END SECTION HEADER -->
	
	<!-- PACKAGES -->
	<div class="row">
	
		<?php

			if ( is_active_sidebar( 'sidebar-packages' ) ) :	

				dynamic_sidebar( 'sidebar-packages' ); 

			else:

				the_widget( 'zerif_packages','title=Basic&price=15&currency=$&price_meta=/MO&button_label=SIGN UP&button_link=#&color=#20AA73&item1=100GB Storage&item2=All Themes&item3=Access to Tutorials&item4=Auto Backup&item5=Extended Security' );

				the_widget( 'zerif_packages','title=Standard&price=21&currency=$&price_meta=/MO&button_label=SIGN UP&button_link=#&color=#3ab0e2&item1=100GB Storage&item2=All Themes&item3=Access to Tutorials&item4=Auto Backup&item5=Extended Security' );

				the_widget( 'zerif_packages','title=Premium&subtitle=Best Value&price=53&currency=$&price_meta=/MO&button_label=SIGN UP&button_link=#&color=#e96656&item1=100GB Storage&item2=All Themes&item3=Access to Tutorials&item4=Auto Backup&item5=Extended Security' );

				the_widget( 'zerif_packages','title=Ultimate&price=99&currency=$&price_meta=/MO&button_label=SIGN UP&button_link=#&color=#E7AC44&item1=100GB Storage&item2=All Themes&item3=Access to Tutorials&item4=Auto Backup&item5=Extended Security' );

			endif;

		?>

	</div> <!-- / END PACKAGES -->
	
</div> <!--END CONTAINER  -->
</section> <!-- END PACKAGES SECTION -->