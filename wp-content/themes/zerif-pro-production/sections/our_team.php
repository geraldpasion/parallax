<?php	
			echo '<section class="our-team" id="team">';
				echo '<div class="container">';
					echo '<div class="section-header">';
							echo '<h2 class="dark-text">'.$zerif_ourteam_title.'</h2>';
						$zerif_ourteam_subtitle = get_theme_mod('zerif_ourteam_subtitle','Add a subtitle in Customizer, "Our team section"');
						if( !empty($zerif_ourteam_subtitle) ):
							echo '<h6>'.$zerif_ourteam_subtitle.'</h6>';
						endif;
					echo '</div>';
					if(is_active_sidebar( 'sidebar-ourteam' )):
				echo '</div>';
			echo '</section>';
?>			