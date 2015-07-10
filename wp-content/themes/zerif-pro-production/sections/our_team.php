<?php	
			echo '<section class="our-team" id="team">';
				echo '<div class="container">';
					echo '<div class="section-header">';						$zerif_ourteam_title = get_theme_mod('zerif_ourteam_title','Our Team');											if( !empty($zerif_ourteam_title) ):
							echo '<h2 class="dark-text">'.$zerif_ourteam_title.'</h2>';						endif;
						$zerif_ourteam_subtitle = get_theme_mod('zerif_ourteam_subtitle','Add a subtitle in Customizer, "Our team section"');
						if( !empty($zerif_ourteam_subtitle) ):
							echo '<h6>'.$zerif_ourteam_subtitle.'</h6>';
						endif;
					echo '</div>';
					if(is_active_sidebar( 'sidebar-ourteam' )):						echo '<div class="row" data-scrollreveal="enter left after 0s over 2s">';							dynamic_sidebar( 'sidebar-ourteam' );						echo '</div> ';					else:						echo '<div class="row" data-scrollreveal="enter left after 0s over 2s">';							the_widget( 'zerif_team_widget','name=Member 1&position=CEO&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri='.get_template_directory_uri().'/images/product-bg.png' );							the_widget( 'zerif_team_widget','name=Member 2&position=dev&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri='.get_template_directory_uri().'/images/product-bg.png' );							the_widget( 'zerif_team_widget','name=Member 3&position=hr&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri='.get_template_directory_uri().'/images/product-bg.png' );							the_widget( 'zerif_team_widget','name=Member 4&position=CEO&description=text about this member&fb_link=#&tw_link=#&bh_link=#&db_link=#&ln_link=#&image_uri='.get_template_directory_uri().'/images/product-bg.png' );						echo '<div>';					endif;	 
				echo '</div>';
			echo '</section>';
?>			