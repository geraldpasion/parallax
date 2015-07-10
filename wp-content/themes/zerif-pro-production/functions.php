<?php

/**

 * zerif functions and definitions

 *

 * @package zerif

 */



/**

 * Set the content width based on the theme's design and stylesheet.

 */

if ( ! isset( $content_width ) ) {

	$content_width = 640; /* pixels */

}



if ( ! function_exists( 'zerif_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function zerif_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on zerif, use a find and replace

	 * to change 'zerif' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'zerif', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );



	/* Set the image size by cropping the image */

	add_image_size( 'post-thumbnail', 250, 250, true );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'zerif' ),

	) );



	// Enable support for Post Formats.

	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );



	// Setup the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'wp_themeisle_custom_background_args', array(

		'default-color' => 'ffffff',

		'default-image' => '',

	) ) );



	// Enable support for HTML5 markup.

	add_theme_support( 'html5', array(

		'comment-list',

		'search-form',

		'comment-form',

		'gallery',

	) );

	

	if ( function_exists( 'add_image_size' ) ): 

		add_image_size( 'zerif_project_photo', 285, 214, true );

		add_image_size( 'zerif_our_team_photo', 174, 174, true );

	endif;	
	
	/* woocommerce support */
	add_theme_support( 'woocommerce' );

}

endif; 

add_action( 'after_setup_theme', 'zerif_setup' );



/* custom posts type */



add_action( 'init', 'zerif_create_post_type' );



function zerif_create_post_type() {

	/* portofolio */

	register_post_type( 'portofolio',

						array(

							'labels' => array(

							'name' => __( 'Portofolio','zerif' ),

							'singular_name' => __( 'Portofolio','zerif' )

						),

						'public' => true,

						'has_archive' => true,

						'taxonomies' => array('category'),

						'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),

						'show_ui' => true,

						)

	);	

	/* testimonial */

	register_post_type( 'testimonial',

						array(

							'labels' => array(

							'name' => __( 'Testimonial','zerif' ),

							'singular_name' => __( 'Testimonial','zerif' )

						),

						'public' => true,

						'has_archive' => true,

						'taxonomies' => array('post_tag'),

						'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),

						'show_ui' => true,

						)

	);	

}

add_action('after_switch_theme', 'zerif_flush');

function zerif_flush () {
	flush_rewrite_rules();
}

/**

 * Register widgetized area and update sidebar with default widgets.

 */

function zerif_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Sidebar', 'zerif' ),

		'id'            => 'sidebar-1',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

	register_sidebar( array(

		'name'          => __( 'Our focus section', 'zerif' ),

		'id'            => 'sidebar-ourfocus',

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

	register_sidebar( array(

		'name'          => __( 'Testimonials section', 'zerif' ),

		'id'            => 'sidebar-testimonials',

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

	register_sidebar( array(

		'name'          => __( 'About us section', 'zerif' ),

		'id'            => 'sidebar-aboutus',

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

	register_sidebar( array(

		'name'          => __( 'Our team section', 'zerif' ),

		'id'            => 'sidebar-ourteam',

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );
	
	register_sidebar( array(

		'name'          => __( 'Packages section', 'zerif' ),

		'id'            => 'sidebar-packages',

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );
	
	register_sidebar( array(

		'name'          => __( 'Subscribe section', 'zerif' ),

		'id'            => 'sidebar-subscribe',

		'before_widget' => '',

		'after_widget'  => '',

		'before_title'  => '<h1 class="widget-title">',

		'after_title'   => '</h1>',

	) );

}

add_action( 'widgets_init', 'zerif_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function zerif_scripts() {



	wp_register_style( 'zerif_font', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic|Montserrat:700|Homemade+Apple');

	wp_enqueue_style( 'zerif_font' );

	

	wp_register_style( 'zerif_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.min.css');

	wp_enqueue_style( 'zerif_bootstrap_style' );



	wp_register_style( 'zerif_owl_theme_style', get_template_directory_uri() . '/css/owl.theme.css', array('zerif_bootstrap_style'), 'v1' );

	wp_enqueue_style( 'zerif_owl_theme_style' );

	

	wp_register_style( 'zerif_owl_carousel_style', get_template_directory_uri() . '/css/owl.carousel.css', array('zerif_owl_theme_style'), 'v1');

	wp_enqueue_style( 'zerif_owl_carousel_style' );

	

	wp_register_style( 'zerif_vegas_style', get_template_directory_uri() . '/css/jquery.vegas.min.css', array('zerif_owl_carousel_style'), 'v1');

	wp_enqueue_style( 'zerif_vegas_style' );

	

	wp_register_style( 'zerif_icon_fonts_style', get_template_directory_uri() . '/assets/icon-fonts/styles.css', array('zerif_vegas_style'), 'v1');

	wp_enqueue_style( 'zerif_icon_fonts_style' );

	

	wp_register_style( 'zerif_pixeden_style', get_template_directory_uri() . '/css/pixeden-icons.css', array('zerif_icon_fonts_style'), 'v1');

	wp_enqueue_style( 'zerif_pixeden_style' );

	

	wp_enqueue_style( 'zerif_style', get_stylesheet_uri(), array('zerif_pixeden_style'),'v1' );

	

	wp_register_style( 'zerif_responsive_style', get_template_directory_uri() . '/css/responsive.css', array('zerif_style'), 'v1');

	wp_enqueue_style( 'zerif_responsive_style' );



	//wp_enqueue_style( 'justifyblog-bootstrap-responsive', get_template_directory_uri() . '/css/bootstrap-theme.min.css', array(), 'v3.1.1' );



	wp_enqueue_script( 'jquery' );

	

	/* Bootstrap script */

	wp_register_script( 'zerif_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true  );

	wp_enqueue_script( 'zerif_bootstrap_script' );

	

	/* ScrollTo script */

	wp_register_script( 'zerif_scrollTo', get_template_directory_uri() . '/js/jquery.scrollTo.min.js', array("jquery",'zerif_bootstrap_script'), '20120206', true  );

	wp_enqueue_script( 'zerif_scrollTo' );

	

	/* jQuery.nav script */

	wp_register_script( 'zerif_jquery_nav', get_template_directory_uri() . '/js/jquery.nav.js', array("jquery",'zerif_scrollTo'), '20120206', true  );

	wp_enqueue_script( 'zerif_jquery_nav' );



	/* Knob script */

	wp_register_script( 'zerif_knob_nav', get_template_directory_uri() . '/js/jquery.knob.js', array("jquery",'zerif_jquery_nav'), '20120206', true  );

	wp_enqueue_script( 'zerif_knob_nav' );

	

	/* Owl carousel script */

	wp_register_script( 'zerif_owl_carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array("jquery",'zerif_knob_nav'), '20120206', true  );

	wp_enqueue_script( 'zerif_owl_carousel' );

	

	/* Smootscroll script */

	wp_register_script( 'zerif_smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array("jquery",'zerif_owl_carousel'), '20120206', true  );

	wp_enqueue_script( 'zerif_smoothscroll' );

	

	/* Vegas script */

	wp_register_script( 'zerif_vegas_script', get_template_directory_uri() . '/js/jquery.vegas.min.js', array("jquery",'zerif_smoothscroll'), '20120206', true  );

	wp_enqueue_script( 'zerif_vegas_script' );

	

	/* scrollReveal script */
	if ( !wp_is_mobile() ){
		wp_register_script( 'zerif_scrollReveal_script', get_template_directory_uri() . '/js/scrollReveal.js', array("jquery",'zerif_vegas_script'), '20120206', true  );

		wp_enqueue_script( 'zerif_scrollReveal_script' );

	}
	

	/* zerif script */
	if ( !wp_is_mobile() ){

		wp_register_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', array('zerif_scrollReveal_script'), '20120206', true  );

		wp_enqueue_script( 'zerif_script' );

	}else{

		wp_register_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', array(), '20120206', true  );

		wp_enqueue_script( 'zerif_script' );

	}
	



	wp_enqueue_script( 'justifyblog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );



	wp_enqueue_script( 'justifyblog-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );







	wp_enqueue_script( 'wp_themeisle-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'zerif_scripts' );



/**

 * Implement the Custom Header feature.

 */

//require get_template_directory() . '/inc/custom-header.php';



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Custom functions that act independently of the theme templates.

 */

require get_template_directory() . '/inc/extras.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/category-dropdown-custom-control.php';



/* tgm-plugin-activation */



require_once get_template_directory() . '/class-tgm-plugin-activation.php';



add_action( 'tgmpa_register', 'zerif_register_required_plugins' );



function zerif_register_required_plugins() {

 

	$plugins = array(

		

		array(

			'name'     => 'Widget customizer',

			'slug'     => 'widget-customizer',

			'source'   => get_template_directory() . '/plugins/widget-customizer.zip', 

			'required' => true,

			'force_activation'   => false, 

            'force_deactivation' => true,

		),
		array(

			'name'     => 'SendinBlue Subscribe Form And WP SMTP',

			'slug'     => 'mailin',

			'source'   => get_template_directory() . '/plugins/mailin.zip', 

			'required' => true,

			'force_activation'   => false, 

            'force_deactivation' => true,

		),

	);

 

	$theme_text_domain = 'zerif';



	

	$config = array(

        'default_path' => '',                      

        'menu'         => 'tgmpa-install-plugins', 

        'has_notices'  => true,                   

        'dismissable'  => true,                  

        'dismiss_msg'  => '',                   

        'is_automatic' => false,                 

        'message'      => '',     

        'strings'      => array(

            'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),

            'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),

            'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ), 

            'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),

            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),

            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),

            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),

            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),

            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),

            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), 

            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), 

            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), 

            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),

            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),

            'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),

            'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),

            'complete'                        => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), 

            'nag_type'                        => 'updated'

        )

    );

 

	tgmpa( $plugins, $config );

 

}



/**

 * Load Jetpack compatibility file.

 */

require get_template_directory() . '/inc/jetpack.php';



/* metaboxes */ 

add_action('admin_menu', 'zerif_post_options_box');

 

function zerif_post_options_box() {

	add_meta_box('post_info', 'Post details', 'zerif_custom_post_info', 'post', 'side', 'high');

}



function zerif_custom_post_info() {

	global $post;

	?>

	<fieldset id="mycustom-div">

		<div>

			<p>

				<label for="zerif_testimonial_option"><?php _e('Testimonial author details:','zerif'); ?></label><br />

				<input type="text" name="zerif_testimonial_option" id="zerif_testimonial_option" value="<?php echo get_post_meta($post->ID, 'zerif_testimonial_option', true); ?>">

			</p>

			<p>

				<label for="zerif_team_member_option"><?php _e('Team member position:','zerif'); ?></label><br />

				<input type="text" name="zerif_team_member_option" id="zerif_team_member_option" value="<?php echo get_post_meta($post->ID, 'zerif_team_member_option', true); ?>">

			</p>

			<p>

				<label for="zerif_team_member_fb_option"><?php _e('Team member facebook link:','zerif'); ?></label><br />

				<input type="text" name="zerif_team_member_fb_option" id="zerif_team_member_fb_option" value="<?php echo get_post_meta($post->ID, 'zerif_team_member_fb_option', true); ?>">

			</p>

			<p>

				<label for="zerif_team_member_tw_option"><?php _e('Team member twitter link:','zerif'); ?></label><br />

				<input type="text" name="zerif_team_member_tw_option" id="zerif_team_member_tw_option" value="<?php echo get_post_meta($post->ID, 'zerif_team_member_tw_option', true); ?>">

			</p>

			<p>

				<label for="zerif_team_member_bh_option"><?php _e('Team member behance link:','zerif'); ?></label><br />

				<input type="text" name="zerif_team_member_bh_option" id="zerif_team_member_bh_option" value="<?php echo get_post_meta($post->ID, 'zerif_team_member_bh_option', true); ?>">

			</p>

			<p>

				<label for="zerif_team_member_db_option"><?php _e('Team member dribbble link:','zerif'); ?></label><br />

				<input type="text" name="zerif_team_member_db_option" id="zerif_team_member_db_option" value="<?php echo get_post_meta($post->ID, 'zerif_team_member_db_option', true); ?>">

			</p>

		</div>

	</fieldset>

	<?php

}

 

add_action('save_post', 'zerif_custom_add_save');

function zerif_custom_add_save($postID){



	if($parent_id = wp_is_post_revision($postID))

	{

		$postID = $parent_id;

	}

 



	if (isset($_POST['zerif_testimonial_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_testimonial_option'], 'zerif_testimonial_option');

	}

	if (isset($_POST['zerif_team_member_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_team_member_option'], 'zerif_team_member_option');

	}

	if (isset($_POST['zerif_team_member_fb_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_team_member_fb_option'], 'zerif_team_member_fb_option');

	}

	if (isset($_POST['zerif_team_member_tw_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_team_member_tw_option'], 'zerif_team_member_tw_option');

	}

	if (isset($_POST['zerif_team_member_bh_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_team_member_bh_option'], 'zerif_team_member_bh_option');

	}

	if (isset($_POST['zerif_team_member_db_option'])) {

		zerif_update_custom_meta($postID, $_POST['zerif_team_member_db_option'], 'zerif_team_member_db_option');

	}



}

 

function zerif_update_custom_meta($postID, $newvalue, $field_name) {

	

	if(!get_post_meta($postID, $field_name)){

		add_post_meta($postID, $field_name, $newvalue);

	}

	else{

		update_post_meta($postID, $field_name, $newvalue);

	}

}



function zerif_wp_page_menu() {

	echo '<ul class="nav navbar-nav navbar-right responsive-nav main-nav-list">';

		wp_list_pages(array('title_li'     => '' ));

	echo '</ul>';

}



function cwp_add_editor_styles() {

    add_editor_style( '/css/custom-editor-style.css' );

}

add_action( 'init', 'cwp_add_editor_styles' );



add_filter( 'the_title', 'cwp_default_title' );



function cwp_default_title( $title ) {



	if($title == '')

		$title = "Default title";



	return $title;

}





/*****************************************/

/******          WIDGETS     *************/

/*****************************************/



add_action('widgets_init', 'zerif_register_widgets');

function zerif_register_widgets() {

    register_widget( 'zerif_ourfocus' );

	register_widget( 'zerif_testimonial_widget' );

	register_widget( 'zerif_clients_widget' );

	register_widget( 'zerif_team_widget' );
	
	register_widget( 'zerif_packages' );

}





/**************************/

/****** our focus widget */

/************************/



add_action('admin_enqueue_scripts', 'zerif_ourfocus_widget_scripts');

function zerif_ourfocus_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('zerif_our_focus_widget_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);

}



class zerif_ourfocus extends WP_Widget {



    function zerif_ourfocus() {

        $widget_ops = array('classname' => 'ctUp-ads');

        $this->WP_Widget('ctUp-ads-widget', 'Zerif - Our focus widget', $widget_ops);

    }



    function widget($args, $instance) {

        extract($args);

		

?>


	
		<div class="col-lg-3 col-sm-3 focus-box" data-scrollreveal="enter left after 0.15s over 1s">



			<div class="service-icon">

				<?php if( !empty($instance['image_uri']) ): ?>

				<?php if( !empty($instance['link']) ): ?>
				
					<a href="<?php echo $instance['link']; ?>"><i class="pixeden" style="background:url(<?php echo esc_url($instance['image_uri']); ?>) no-repeat center;width:100%; height:100%;"></i> <!-- FOCUS ICON--></a>
				
				<?php else: ?>
				
					<i class="pixeden" style="background:url(<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>) no-repeat center;width:100%; height:100%;"></i> <!-- FOCUS ICON-->
				
				<?php endif; ?>

				<?php endif; ?>

			</div>



			<h5 class="red-border-bottom"><?php if( !empty($instance['title']) ): echo apply_filters('widget_title', $instance['title'] ); endif; ?></h5> <!-- FOCUS HEADING -->



			<p>

				<?php if( !empty($instance['text']) ): echo apply_filters('widget_title', $instance['text'] ); endif; ?>

			</p>

			

		</div>



<?php

       



    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['text'] = strip_tags( $new_instance['text'] );
		
		$instance['link'] = strip_tags( $new_instance['link'] );

		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" value="<?php if( !empty($instance['text']) ): echo $instance['text']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image','zerif'); ?></label><br />



        <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

        ?>



        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">



        <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />

    </p>



<?php

    }

}





/****************************/

/****** testimonial widget **/

/***************************/





add_action('admin_enqueue_scripts', 'zerif_testimonial_widget_scripts');

function zerif_testimonial_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('zerif_testimonial_widget_script', get_template_directory_uri() . '/js/widget-testimonials.js', false, '1.0', true);

}



class zerif_testimonial_widget extends WP_Widget {



    function zerif_testimonial_widget() {

        $widget_ops = array('classname' => 'zerif_testim');

        $this->WP_Widget('zerif_testim-widget', 'Zerif - Testimonial widget', $widget_ops);

    }



    function widget($args, $instance) {

        extract($args);



        echo $before_widget;

?>



		<div class="feedback-box">

			<!-- MESSAGE OF THE CLIENT -->

			<div class="message">

				<?php if( !empty($instance['text']) ): echo apply_filters('widget_title', $instance['text'] ); endif; ?>

			</div>

			<!-- CLIENT INFORMATION -->

			<div class="client">

				<div class="quote red-text">

					<i class="icon-fontawesome-webfont-294"></i>

				</div>

				<div class="client-info">

					<a class="client-name" href=""><?php if( !empty($instance['title']) ): echo apply_filters('widget_title', $instance['title'] ); endif; ?></a> 

					<div class="client-company">

						<?php 
						if( !empty($instance['details']) ):
							echo apply_filters('widget_title', $instance['details'] ); 
						endif;	
						?>

					</div>

				</div>

				<?php

					echo '<div class="client-image hidden-xs">';
						
						if( !empty($instance['image_uri']) ):

							echo '<img src="'.esc_url($instance['image_uri']).'" alt="">';
							
						endif;	

					echo '</div>';

				?>

			</div> <!-- / END CLIENT INFORMATION-->

		</div> <!-- / END SINGLE FEEDBACK BOX-->





<?php

        echo $after_widget;



    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['text'] = strip_tags( $new_instance['text'] );

		$instance['title'] = strip_tags( $new_instance['title'] );

		$instance['details'] = strip_tags( $new_instance['details'] );

        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Author','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" class="widefat" />

    </p>

	<p>

        <label for="<?php echo $this->get_field_id('details'); ?>"><?php _e('Author details','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('details'); ?>" id="<?php echo $this->get_field_id('details'); ?>" value="<?php if( !empty($instance['details']) ): echo $instance['details']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" value="<?php if( !empty($instance['text']) ): echo $instance['text']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image','zerif'); ?></label><br />



        <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_testimonial" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

        ?>



        <input type="text" class="widefat custom_media_url_testimonial" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">



        <input type="button" class="button button-primary custom_media_button_testimonial" id="custom_media_button_testimonial" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />

    </p>



<?php

    }

}





/****************************/

/****** clients widget **/

/***************************/





add_action('admin_enqueue_scripts', 'zerif_clients_widget_scripts');

function zerif_clients_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('zerif_clients_widget_script', get_template_directory_uri() . '/js/widget-clients.js', false, '1.0', true);

}



class zerif_clients_widget extends WP_Widget {



    function zerif_clients_widget() {

        $widget_ops = array('classname' => 'zerif_clients');

        $this->WP_Widget('zerif_clients-widget', 'Zerif - Clients widget', $widget_ops);

    }



    function widget($args, $instance) {

        extract($args);
		
        echo $before_widget;
		
		if( !empty($instance['image_uri']) && !empty($instance['link']) ):
			if( isset($instance['new_tab']) && ($instance['new_tab'] == 'on') ):
				echo '<a href="'.apply_filters('widget_title', $instance['link'] ).'" target="_blank"><img src="'.esc_url($instance['image_uri']).'" alt="Client"></a>';
			else:
				echo '<a href="'.apply_filters('widget_title', $instance['link'] ).'"><img src="'.esc_url($instance['image_uri']).'" alt="Client"></a>';
			endif;
		endif;
		
        echo $after_widget;

    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['link'] = strip_tags( $new_instance['link'] );

        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		
		$instance['new_tab'] = strip_tags( $new_instance['new_tab'] );

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>" class="widefat" />

    </p>

	<p>
		<input type="checkbox" <?php if( !empty($instance['new_tab']) ): checked($instance['new_tab'], 'on'); endif; ?> id="<?php echo $this->get_field_id('new_tab'); ?>" name="<?php echo $this->get_field_name('new_tab'); ?>" /> 
		<label for="<?php echo $this->get_field_id('new_tab'); ?>"><?php _e('Open in new tab','zerif'); ?></label>
	</p>

    <p>

        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image','zerif'); ?></label><br />



        <?php

            if ( !empty($instance['image_uri']) ) :

                echo '<img class="custom_media_image_clients" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

        ?>



        <input type="text" class="widefat custom_media_url_clients" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">



        <input type="button" class="button button-primary custom_media_button_clients" id="custom_media_button_clients" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />

    </p>

	

<?php

    }

}





/****************************/

/****** team member widget **/

/***************************/





add_action('admin_enqueue_scripts', 'zerif_team_widget_scripts');

function zerif_team_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('zerif_team_widget_script', get_template_directory_uri() . '/js/widget-team.js', false, '1.0', true);

}



class zerif_team_widget extends WP_Widget {



    function zerif_team_widget() {

        $widget_ops = array('classname' => 'zerif_team');

        $this->WP_Widget('zerif_team-widget', 'Zerif - Team member widget', $widget_ops);

    }



    function widget($args, $instance) {

        extract($args);

?>

		

							<div class="col-lg-3 col-sm-3">



								<div class="team-member">



									<figure class="profile-pic">



										<img src="<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>" alt="">



									</figure>



									<div class="member-details">



										<h5 class="dark-text red-border-bottom"><?php if( !empty($instance['name']) ): echo apply_filters('widget_title', $instance['name'] ); endif; ?></h5>



										<div class="position"><?php if( !empty($instance['position']) ): echo apply_filters('widget_title', $instance['position'] ); endif; ?></div>



									</div>



									<div class="social-icons">



										<ul>



											<?php if( !empty($instance['fb_link']) ): ?>
											<li><a href="<?php echo apply_filters('widget_title', $instance['fb_link'] ); ?>"><i class="icon-facebook"></i></a></li>
											<?php endif; ?>
											
											<?php if( !empty($instance['tw_link']) ): ?>
											<li><a href="<?php echo apply_filters('widget_title', $instance['tw_link'] ); ?>"><i class="icon-twitter-alt"></i></a></li>
											<?php endif; ?>
											
											<?php if( !empty($instance['bh_link']) ): ?>
											<li><a href="<?php echo apply_filters('widget_title', $instance['bh_link'] ); ?>"><i class="icon-behance"></i></a></li>
											<?php endif; ?>
											
											<?php if( !empty($instance['db_link']) ): ?>
											<li><a href="<?php echo apply_filters('widget_title', $instance['db_link'] ); ?>"><i class="icon-dribbble"></i></a></li>
											<?php endif; ?>

											<?php if( !empty($instance['ln_link']) ): ?>
											<li><a href="<?php echo apply_filters('widget_title', $instance['ln_link'] ); ?>"><i class="icon-linkedin"></i></a></li>
											<?php endif; ?>



										</ul>



									</div>



									<div class="details">



										<?php if( !empty($instance['description']) ): echo apply_filters('widget_title', $instance['description'] ); endif; ?>



									</div>



								</div>



							</div>



<?php

    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['name'] = strip_tags( $new_instance['name'] );

        $instance['position'] = strip_tags( $new_instance['position'] );

		$instance['description'] = strip_tags( $new_instance['description'] );

		$instance['fb_link'] = strip_tags( $new_instance['fb_link'] );

		$instance['tw_link'] = strip_tags( $new_instance['tw_link'] );

		$instance['bh_link'] = strip_tags( $new_instance['bh_link'] );

		$instance['db_link'] = strip_tags( $new_instance['db_link'] );
		
		$instance['ln_link'] = strip_tags( $new_instance['ln_link'] );

		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" value="<?php if( !empty($instance['position']) ): echo $instance['position']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php if( !empty($instance['description']) ): echo $instance['description']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('fb_link'); ?>"><?php _e('Facebook link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('fb_link'); ?>" id="<?php echo $this->get_field_id('fb_link'); ?>" value="<?php if( !empty($instance['fb_link']) ): echo $instance['fb_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('tw_link'); ?>"><?php _e('Twitter link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('tw_link'); ?>" id="<?php echo $this->get_field_id('tw_link'); ?>" value="<?php if( !empty($instance['tw_link']) ): echo $instance['tw_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('bh_link'); ?>"><?php _e('Behance link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('bh_link'); ?>" id="<?php echo $this->get_field_id('bh_link'); ?>" value="<?php if( !empty($instance['bh_link']) ): echo $instance['bh_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('db_link'); ?>"><?php _e('Dribble link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('db_link'); ?>" id="<?php echo $this->get_field_id('db_link'); ?>" value="<?php if( !empty($instance['db_link']) ): echo $instance['db_link']; endif; ?>" class="widefat" />

    </p>

	<p>

        <label for="<?php echo $this->get_field_id('ln_link'); ?>"><?php _e('Linkedin link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('ln_link'); ?>" id="<?php echo $this->get_field_id('ln_link'); ?>" value="<?php if( !empty($instance['ln_link']) ): echo $instance['ln_link']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image','zerif'); ?></label><br />



        <?php

            if ( !empty($instance['image_uri'] )) :

                echo '<img class="custom_media_image_team" src="' . $instance['image_uri'] . '" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" /><br />';

            endif;

        ?>



        <input type="text" class="widefat custom_media_url_team" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php if( !empty($instance['image_uri']) ): echo $instance['image_uri']; endif; ?>" style="margin-top:5px;">



        <input type="button" class="button button-primary custom_media_button_team" id="custom_media_button_clients" name="<?php echo $this->get_field_name('image_uri'); ?>" value="Upload Image" style="margin-top:5px;" />

    </p>



<?php

    }

}




/**************************/

/****** packages widget */

/************************/



add_action('admin_enqueue_scripts', 'zerif_packages_widget_scripts');

function zerif_packages_widget_scripts() {

    wp_enqueue_media();

    wp_enqueue_script('zerif_packages_widget_script', get_template_directory_uri() . '/js/widget.js', false, '1.0', true);

}



class zerif_packages extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'color-picker',
			_x( 'Zerif - Package widget', 'widget title', 'zerif' ),
			array(
				'classname'   => 'package-widget',
				'description' => ''
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}


	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

	}

	public function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}


	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
		?>
		
		<div class="col-lg-3 col-sm-3">
		
			<?php 
				if( !empty($instance['subtitle']) ):
					echo '<div class="best-value">';
				endif;
			?>		
		
			<div class="package" data-scrollreveal="enter left after 0s over 1s">
				<div class="package-header" style="background:<?php if( !empty($instance['color']) ): echo $instance['color']; endif; ?>">
					<?php 
						if( !empty($instance['subtitle']) ):
						
							if( !empty($instance['title']) ):
								echo '<h4>'.$instance['title'].'</h4>';
							endif;	
							echo '<div class="meta-text">'.$instance['subtitle'].'</div>';
							
						else:
						
							if( !empty($instance['title']) ):
								echo '<h5>'.$instance['title'].'</h5>';
							endif;
							
						endif;		
						
					?>
				</div>
				<div class="price dark-bg">
					<div class="price-container">
					<?php 
						if( !empty($instance['price']) ):
							echo '<h4>';
							
							if( !empty($instance['currency']) ):
								echo '<span class="dollar-sign">'.$instance['currency'].'</span>';
							endif;	
							
							echo $instance['price'];
							
							echo '</h4>';
						endif;
						
						if( !empty($instance['price_meta']) ):
							echo '<span class="price-meta">';	
								echo $instance['price_meta'];
							echo '</span>';
						endif;
					?>
					</div>
				</div>
				<ul>
					<?php 
						for ($i = 1; $i <= 10; $i++):
							$str_item = 'item'.$i;
							
							if( !empty($instance[$str_item]) ):
								echo '<li>'.$instance[$str_item].'</li>';
							endif;
						endfor;	
					?>
				</ul>
				<?php
					if( !empty($instance['button_label']) && !empty($instance['button_link']) ):
						if( !empty($instance['color']) ):
							echo '<a href="'.$instance['button_link'].'" class="btn btn-primary custom-button" style="background:'.$instance['color'].'">'.$instance['button_label'].'</a>';
						else:
							echo '<a href="'.$instance['button_link'].'" class="btn btn-primary custom-button">'.$instance['button_label'].'</a>';
						endif;
					endif;
				?>
				
			</div>
			<?php 
				if( !empty($instance['subtitle']) ):
					echo '</div>';
				endif;
			?>
		</div>
		
		<?php
		
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'color' ] = strip_tags( $new_instance['color'] );
		
		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		
		$instance['price'] = strip_tags( $new_instance['price'] );
		
		$instance['currency'] = strip_tags( $new_instance['currency'] );
		
		$instance['price_meta'] = strip_tags( $new_instance['price_meta'] );
		
		$instance['button_label'] = strip_tags( $new_instance['button_label'] );
		
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		
		$instance['item1'] = strip_tags( $new_instance['item1'] );
		
		$instance['item2'] = strip_tags( $new_instance['item2'] );
		
		$instance['item3'] = strip_tags( $new_instance['item3'] );
		
		$instance['item4'] = strip_tags( $new_instance['item4'] );
		
		$instance['item5'] = strip_tags( $new_instance['item5'] );
		
		$instance['item6'] = strip_tags( $new_instance['item6'] );
		
		$instance['item7'] = strip_tags( $new_instance['item7'] );
		
		$instance['item8'] = strip_tags( $new_instance['item8'] );
		
		$instance['item9'] = strip_tags( $new_instance['item9'] );
		
		$instance['item10'] = strip_tags( $new_instance['item10'] );
		
		$instance['background_color'] = $new_instance['background_color'];

		return $instance;
	}

	
	public function form( $instance ) {
		
		$instance = wp_parse_args(
			$instance,
			array(
				'title' => '',
				'subtitle' => '',
				'price' => '',
				'currency' => '',
				'price_meta' => '',
				'button_label' => '',
				'button_link' => '',
				'color' => ''
			)
		);

		$title = esc_attr( $instance[ 'title' ] );
		$subtitle = esc_attr( $instance[ 'subtitle' ] );
		$price = esc_attr( $instance[ 'price' ] );
		$currency = esc_attr( $instance[ 'currency' ] );
		$price_meta = esc_attr( $instance[ 'price_meta' ] );
		$button_label = esc_attr( $instance[ 'button_label' ] );
		$button_link = esc_attr( $instance[ 'button_link' ] );
		$color = esc_attr( $instance[ 'color' ] );
		$item1 = esc_attr( $instance[ 'item1' ] );
		$item2 = esc_attr( $instance[ 'item2' ] );
		$item3 = esc_attr( $instance[ 'item3' ] );
		$item4 = esc_attr( $instance[ 'item4' ] );
		$item5 = esc_attr( $instance[ 'item5' ] );
		$item6 = esc_attr( $instance[ 'item6' ] );
		$item7 = esc_attr( $instance[ 'item7' ] );
		$item8 = esc_attr( $instance[ 'item8' ] );
		$item9 = esc_attr( $instance[ 'item9' ] );
		$item10 = esc_attr( $instance[ 'item10' ] );
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color:' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'color' ); ?>" value="<?php if(!empty($color)): echo $color; endif; ?>" />
		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if(!empty($instance['title'])): echo $instance['title']; endif; ?>" class="widefat" />

		</p>

		<p>

			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('subtitle'); ?>" id="<?php echo $this->get_field_id('subtitle'); ?>" value="<?php if(!empty($instance['subtitle'])): echo $instance['subtitle']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('Price','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('price'); ?>" id="<?php echo $this->get_field_id('price'); ?>" value="<?php if(!empty($instance['price'])): echo $instance['price']; endif; ?>" class="widefat" />

		</p>

	   <p>

			<label for="<?php echo $this->get_field_id('currency'); ?>"><?php _e('Currency','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('currency'); ?>" id="<?php echo $this->get_field_id('currency'); ?>" value="<?php if(!empty($instance['currency'])): echo $instance['currency']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('price_meta'); ?>"><?php _e('Price meta (e.g. /MONTH)','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('price_meta'); ?>" id="<?php echo $this->get_field_id('price_meta'); ?>" value="<?php if(!empty($instance['price_meta'])): echo $instance['price_meta']; endif; ?>" class="widefat" />

		</p>

		<p>

			<label for="<?php echo $this->get_field_id('button_label'); ?>"><?php _e('Button label','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('button_label'); ?>" id="<?php echo $this->get_field_id('button_label'); ?>" value="<?php if(!empty($instance['button_label'])): echo $instance['button_label']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button link','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('button_link'); ?>" id="<?php echo $this->get_field_id('button_link'); ?>" value="<?php if(!empty($instance['button_link'])): echo $instance['button_link']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item1'); ?>"><?php _e('Item 1','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item1'); ?>" id="<?php echo $this->get_field_id('item1'); ?>" value="<?php if(!empty($instance['item1'])): echo $instance['item1']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item2'); ?>"><?php _e('Item 2','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item2'); ?>" id="<?php echo $this->get_field_id('item2'); ?>" value="<?php if(!empty($instance['item2'])): echo $instance['item2']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item3'); ?>"><?php _e('Item 3','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item3'); ?>" id="<?php echo $this->get_field_id('item3'); ?>" value="<?php if(!empty($instance['item3'])): echo $instance['item3']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item4'); ?>"><?php _e('Item 4','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item4'); ?>" id="<?php echo $this->get_field_id('item4'); ?>" value="<?php if(!empty($instance['item4'])): echo $instance['item4']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item5'); ?>"><?php _e('Item 5','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item5'); ?>" id="<?php echo $this->get_field_id('item5'); ?>" value="<?php if(!empty($instance['item5'])): echo $instance['item5']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item6'); ?>"><?php _e('Item 6','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item6'); ?>" id="<?php echo $this->get_field_id('item6'); ?>" value="<?php if(!empty($instance['item6'])): echo $instance['item6']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item7'); ?>"><?php _e('Item 7','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item7'); ?>" id="<?php echo $this->get_field_id('item7'); ?>" value="<?php if(!empty($instance['item7'])): echo $instance['item7']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item8'); ?>"><?php _e('Item 8','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item8'); ?>" id="<?php echo $this->get_field_id('item8'); ?>" value="<?php if(!empty($instance['item8'])): echo $instance['item8']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item9'); ?>"><?php _e('Item 9','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item9'); ?>" id="<?php echo $this->get_field_id('item9'); ?>" value="<?php if(!empty($instance['item9'])): echo $instance['item9']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item10'); ?>"><?php _e('Item 10','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item10'); ?>" id="<?php echo $this->get_field_id('item10'); ?>" value="<?php if(!empty($instance['item10'])): echo $instance['item10']; endif; ?>" class="widefat" />

		</p>
		
		<?php
	}

}


function zerif_customizer_custom_css() {
   
	
	wp_register_style( 'zerif_customizer_custom_css', get_template_directory_uri() . '/css/zerif_customizer_custom_css.css' );

	wp_enqueue_style( 'zerif_customizer_custom_css' );
}


add_action( 'customize_controls_print_styles', 'zerif_customizer_custom_css' );

add_action('wp_print_scripts','zerif_php_style');

function zerif_php_style() {

	echo ' <style type="text/css">';

	echo '	.intro-text { color: '. get_theme_mod('zerif_bigtitle_header_color') .'}';
	echo '	.red-btn { background: '. get_theme_mod('zerif_bigtitle_1button_background_color') .'}';
	echo '	.red-btn:hover { background: '. get_theme_mod('zerif_bigtitle_1button_background_color_hover') .'}';
	echo '	.buttons .red-btn { color: '. get_theme_mod('zerif_bigtitle_1button_color') .' !important }';
	echo '	.green-btn { background: '. get_theme_mod('zerif_bigtitle_2button_background_color') .'}';
	echo '	.green-btn:hover { background: '. get_theme_mod('zerif_bigtitle_2button_background_color_hover') .'}';
	echo '	.buttons .green-btn { color: '. get_theme_mod('zerif_bigtitle_2button_color') .' !important }';
	
	echo '	.focus { background: '. get_theme_mod('zerif_ourfocus_background') .' }';
	echo '	.focus .section-header h2{ color: '. get_theme_mod('zerif_ourfocus_header') .' }';
	echo '	.focus .section-header h6{ color: '. get_theme_mod('zerif_ourfocus_header') .' }';
	echo '	.focus .focus-box h5{ color: '. get_theme_mod('zerif_ourfocus_box_title_color') .' }';
	echo '	.focus .focus-box p{ color: '. get_theme_mod('zerif_ourfocus_box_text_color') .' }';
	echo '	.focus .ctUp-ads:nth-child(1) .service-icon:hover { border: 10px solid '. get_theme_mod('zerif_ourfocus_1box') .' }';
	echo '	.focus .ctUp-ads:nth-child(1) .red-border-bottom:before { background: '. get_theme_mod('zerif_ourfocus_1box') .' }';
	echo '	.focus .ctUp-ads:nth-child(2) .service-icon:hover { border: 10px solid '. get_theme_mod('zerif_ourfocus_2box') .' }';
	echo '	.focus .ctUp-ads:nth-child(2) .red-border-bottom:before { background: '. get_theme_mod('zerif_ourfocus_2box') .' }';
	echo '	.focus .ctUp-ads:nth-child(3) .service-icon:hover { border: 10px solid '. get_theme_mod('zerif_ourfocus_3box') .' }';
	echo '	.focus .ctUp-ads:nth-child(3) .red-border-bottom:before { background: '. get_theme_mod('zerif_ourfocus_3box') .' }';
	echo '	.focus .ctUp-ads:nth-child(4) .service-icon:hover { border: 10px solid '. get_theme_mod('zerif_ourfocus_4box') .' }';
	echo '	.focus .ctUp-ads:nth-child(4) .red-border-bottom:before { background: '. get_theme_mod('zerif_ourfocus_4box') .' }';

	echo '	.works { background: '. get_theme_mod('zerif_portofolio_background') .' }';
	echo '	.works .section-header h2 { color: '. get_theme_mod('zerif_portofolio_header') .' }';
	echo '	.works .section-header h6 { color: '. get_theme_mod('zerif_portofolio_header') .' }';
	echo '	.works .white-text { color: '. get_theme_mod('zerif_portofolio_text') .' }';
	
	echo '	.about-us { background: '. get_theme_mod('zerif_aboutus_background') .' }';
	echo '	.about-us { color: '. get_theme_mod('zerif_aboutus_title_color') .' }';
	echo '	.about-us p{ color: '. get_theme_mod('zerif_aboutus_title_color') .' }';
	
	echo '	.our-team { background: '. get_theme_mod('zerif_ourteam_background') .' }';
	echo '	.our-team .section-header h2, .our-team .member-details h5 { color: '. get_theme_mod('zerif_ourteam_header') .' }';
	echo '	.our-team .section-header h6, .our-team .member-details .position { color: '. get_theme_mod('zerif_ourteam_header') .' }';
	echo '	.team-member:hover .details { color: '. get_theme_mod('zerif_ourteam_text') .' }';
	echo '	.team-member .social-icons ul li a:hover { color: '. get_theme_mod('zerif_ourteam_socials_hover') .' }';
	echo '	.team-member .social-icons ul li a { color: '. get_theme_mod('zerif_ourteam_socials') .' }';
	
	echo '	.testimonial { background: '. get_theme_mod('zerif_testimonials_background') .' }';
	echo '	.testimonial .section-header h2 { color: '. get_theme_mod('zerif_testimonials_header') .' }';
	echo '	.testimonial .section-header h6 { color: '. get_theme_mod('zerif_testimonials_header') .' }';
	echo '	.testimonial .feedback-box .message { color: '. get_theme_mod('zerif_testimonials_text') .' }';
	echo '	.testimonial .feedback-box .client-info .client-name { color: '. get_theme_mod('zerif_testimonials_author') .' }';
	echo '	.testimonial .feedback-box .quote { color: '. get_theme_mod('zerif_testimonials_quote') .' }';
	
	echo '	.contact-us { background: '. get_theme_mod('zerif_contacus_background') .' }';
	echo '	.contact-us .section-header h2 { color: '. get_theme_mod('zerif_contacus_header') .' }';
	echo '	.contact-us .section-header h6 { color: '. get_theme_mod('zerif_contacus_header') .' }';
	echo '	.contact-us .red-btn { background: '. get_theme_mod('zerif_contacus_button_background') .' }';
	echo '	.contact-us .red-btn:hover { background: '. get_theme_mod('zerif_contacus_button_background_hover') .' }';
	echo '	.contact-us .red-btn { color: '. get_theme_mod('zerif_contacus_button_color') .' }';
	
	echo '	#footer { background: '. get_theme_mod('zerif_footer_background') .' }';
	echo '	.copyright { background: '. get_theme_mod('zerif_footer_socials_background') .' }';
	echo '	#footer, .company-details { color: '. get_theme_mod('zerif_footer_text_color') .' }';
	echo '	#footer .social li a { color: '. get_theme_mod('zerif_footer_socials') .' }';
	echo '	#footer .social li a:hover { color: '. get_theme_mod('zerif_footer_socials_hover') .' }';
	
	echo '	.separator-one { background: '. get_theme_mod('zerif_ribbon_background') .' }';
	echo '	.separator-one h3, .separator-one a { color: '. get_theme_mod('zerif_ribbon_text_color') .' }';
	echo '	.separator-one .green-btn { background: '. get_theme_mod('zerif_ribbon_button_background') .' }';
	echo '	.separator-one .green-btn:hover { background: '. get_theme_mod('zerif_ribbon_button_background_hover') .' }';
	
	echo '	.purchase-now { background: '. get_theme_mod('zerif_ribbonright_background') .' }';
	echo '	.purchase-now h3, .purchase-now a { color: '. get_theme_mod('zerif_ribbonright_text_color') .' }';
	echo '	.purchase-now .red-btn { background: '. get_theme_mod('zerif_ribbonright_button_background') .' !important }';
	echo '	.purchase-now .red-btn:hover { background: '. get_theme_mod('zerif_ribbonright_button_background_hover') .' !important }';
	
	echo '	.site-content { background: '. get_theme_mod('zerif_background_color') .' }';
	echo '	.entry-title, .entry-title a, .widget-title, .widget-title a, .page-header .page-title, .comments-title { color: '. get_theme_mod('zerif_titles_color') .' !important}';
	echo '	body, button, input, select, textarea { color: '. get_theme_mod('zerif_texts_color') .' }';
	echo '	.widget li a, article .entry-meta a, .entry-footer a, .navbar-inverse .navbar-nav>li>a { color: '. get_theme_mod('zerif_links_color') .' }';
	echo '	.widget li a:hover, article .entry-meta a:hover, .entry-footer a:hover, .navbar-inverse .navbar-nav>li>a:hover { color: '. get_theme_mod('zerif_links_color_hover') .' }';
	
	echo '	.comment-form #submit, .comment-reply-link,.woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order  { background: '. get_theme_mod('zerif_buttons_background_color') .' }';
	echo '	.comment-form #submit:hover, .comment-reply-link:hover, .woocommerce .add_to_cart_button:hover, .woocommerce .checkout-button:hover, .woocommerce  .single_add_to_cart_button:hover, .woocommerce #place_order:hover { background: '. get_theme_mod('zerif_buttons_background_color_hover') .' }';
	echo '	.comment-form #submit, .comment-reply-link, .woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order { color: '. get_theme_mod('zerif_buttons_text_color') .' !important }';
	
	echo '	.widget .widget-title:before, .entry-title:before, .page-header .page-title:before { background: '. get_theme_mod('zerif_titles_bottomborder_color') .'}';
	
	echo '	.packages .section-header h2, .packages .section-header h6 { color: '. get_theme_mod('zerif_packages_header') .'}';
	echo '	.packages .package-header h5,.best-value .package-header h4,.best-value .package-header .meta-text { color: '. get_theme_mod('zerif_package_title_color') .'}';
	echo '	.packages .package ul li, .packages .price .price-meta { color: '. get_theme_mod('zerif_package_text_color') .'}';
	echo '	.packages .package .custom-button { color: '. get_theme_mod('zerif_package_button_text_color') .' !important; }';
	echo '	.packages .dark-bg { background: '. get_theme_mod('zerif_package_price_background_color') .'; }';
	echo '	.packages .price h4 { color: '. get_theme_mod('zerif_package_price_color') .'; }';
	
	echo ' .newsletter h3, .newsletter .sub-heading, .newsletter label { color: '.get_theme_mod('zerif_subscribe_header_color').' !Important; }';
	echo ' .newsletter input[type="submit"] { color: '.get_theme_mod('zerif_subscribe_button_color').' !Important; }';
	echo ' .newsletter input[type="submit"] { background: '.get_theme_mod('zerif_subscribe_button_background_color').' !Important; }';
	echo ' .newsletter input[type="submit"]:hover { background: '.get_theme_mod('zerif_subscribe_button_background_color_hover').' !Important; }';

	$zerif_bigtitle_background = get_theme_mod('zerif_bigtitle_background');
	if ( !empty($zerif_bigtitle_background) ){
		echo '	.header { background: '. get_theme_mod('zerif_bigtitle_background') .'}';
	}

	echo '</style>';

}

function zerif_excerpt_more( $more ) {
	return '<a href="'.get_permalink().'">[...]</a>';
}
add_filter('excerpt_more', 'zerif_excerpt_more');