<?php

$zerif_googlemap_address = get_theme_mod('zerif_googlemap_address');

if( !empty($zerif_googlemap_address) ):

	echo "<iframe class='zerif_google_map' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0' src='https://maps.google.com/maps?&amp;q=".urlencode( $zerif_googlemap_address )."&amp;output=embed&iwloc'></iframe>";
	
endif;	

?>