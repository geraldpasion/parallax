<?php
			echo '<section class="testimonial" id="testimonials">';
				echo '<div class="container">';
					echo '<div class="section-header">';
							echo '<h2 class="white-text">'.$zerif_testimonials_title.'</h2>';
						$zerif_testimonials_subtitle = get_theme_mod('zerif_testimonials_subtitle');
						if( !empty($zerif_testimonials_subtitle) ):
							echo '<h6 class="white-text">'.$zerif_testimonials_subtitle.'</h6>';
						endif;
					echo '</div>';
					echo '<div class="row" data-scrollreveal="enter right after 0s over 1s">';
						echo '<div class="col-md-12">';
							echo '<div id="client-feedbacks" class="owl-carousel owl-theme">';
									
								
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</section>';
?>