<?php
function bsimple_scripts() {
    wp_enqueue_style( 'bsimple-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bsimple-clean', get_template_directory_uri() . '/css/clean-blog.css' );
    wp_enqueue_style( 'bsimple-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bsimple-fontawesome', get_template_directory_uri() . '/css/fa-all.min.css' );
    wp_enqueue_style( 'bsimple-font1', "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" );
    wp_enqueue_style( 'bsimple-font2', "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );

    wp_enqueue_script( 'bsimple-jq', get_template_directory_uri() . '/js/jquery-3.4.1.min.js');
    wp_enqueue_script( 'bsimple-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script( 'bsimple-clean', get_template_directory_uri() . '/js/clean-blog.js');
    wp_enqueue_script( 'deshette-js', get_template_directory_uri() . '/js/deshette.js');

    $css = '';
    $home_header_bg_image = get_theme_mod( 'home_header_bg_img' , get_stylesheet_directory_uri() . '/images/basic_header_bg.jpg'  );
    $frontpage_header_bg_image = get_theme_mod( 'frontpage_header_bg_img' , get_stylesheet_directory_uri() . '/images/basic_header_bg.jpg'  );
    $global_header_bg_image = get_theme_mod( 'global_header_bg_img' , get_stylesheet_directory_uri() . '/images/basic_header_bg.jpg'  );

    $css .= ( !empty($home_header_bg_image) ) ? sprintf('
    #main_header.phome {
        background: url(%s) no-repeat center;
    }
    ', $home_header_bg_image ) : '';

    $css .= ( !empty($frontpage_header_bg_image) ) ? sprintf('
    #main_header.pfront {
        background: url(%s) no-repeat center;
    }
    ', $frontpage_header_bg_image ) : '';

    $css .= ( !empty($global_header_bg_image) ) ? sprintf('
    #main_header.pglobal {
        background: url(%s) no-repeat center;
    }
    ', $global_header_bg_image ) : '';

    if ( $css ) {
        wp_add_inline_style( "bsimple-style"  , $css );
    }
}    

add_action( 'wp_enqueue_scripts', 'bsimple_scripts' );

add_theme_support( 'post-thumbnails' );
add_image_size( 'list-thumb-1', 730, 400, true);
add_image_size( 'small-list-thumb-1', 400, 200, true);
add_image_size( 'small-list-thumb-2', 300, 200, true);
add_image_size( 'small-list-thumb-3', 220, 140, true);

function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Header Menu' ),
        'extra-menu' => __( 'Extra Menu' )
      )
    );
  }
  add_action( 'init', 'register_my_menus' );

function add_menu_link_class( $atts, $item, $args ) {
    if($args->link_class) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

function add_menu_list_item_class($classes, $item, $args) {
    if($args->list_item_class) {
        $classes[] = $args->list_item_class;
    }
    if( in_array('current-menu-item', $classes) ){
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);






if(!function_exists('dynamic_header')){

    function dynamic_header(){
    
        global $post;
    
        ?>
    
        <?php if (is_front_page()){ ?>
    
            <header class="masthead" style="background:#ccc;">
                <div class="videobg">
                    <?php dynamic_sidebar( 'home_header' ); ?>
                </div>
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 mx-auto">
                            <div class="site-heading">
                            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <span class="subheading"><?php get_bloginfo( 'description', 'display' );?></span>
                            </div>
                        </div>
                    </div>
                </div>
        </header>

    <?php } else if (is_home()){ ?>

        <header class="masthead" style="background:#ccc;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <span class="subheading"><?php get_bloginfo( 'description', 'display' );?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <?php } else if (is_page()){ ?>
        <header class="masthead" style="background:#ccc;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <span class="subheading"><?php get_bloginfo( 'description', 'display' );?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <?php } else if (is_single()){ ?>

        <header class="masthead" style="background:#ccc;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <span class="subheading"><?php get_bloginfo( 'description', 'display' );?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <?php } else { ?>

        <header class="masthead" style="background:#ccc;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="site-heading">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <span class="subheading"><?php get_bloginfo( 'description', 'display' );?></span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <?php }
}
}


if ( ! function_exists( 'bsimple_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function bsimple_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'botega_st' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
	}
endif;
if ( ! function_exists( 'bsimple_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function bsimple_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'botega_st' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
endif;
if ( ! function_exists( 'bsimple_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function bsimple_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

// Register custom sidebars
function sidebar_register() {

    $args = array(
        'name'          => __( 'home_header', 'bsimple' ),
        'description'   => __( 'home_header', 'bsimple' ),
        'id'            => 'h_h',
        'class'         => 'home_header',
        'before_widget' => ' <div class="dyn-sidebar side sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    );
    register_sidebar($args);

    $args = array(
        'name'          => __( 'archive_sidebar_1', 'bsimple' ),
        'description'   => __( 'Archive Sidebar no 1', 'bsimple' ),
        'id'            => 'a_s_1',
        'class'         => 'archive_sidebar_1',
        'before_widget' => ' <div class="dyn-sidebar side sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    );
    register_sidebar($args);

    $args = array(
        'name'          => __( 'bottom_center_sidebar', 'bsimple' ),
        'description'   => __( 'Bottom Center Sidebar', 'bsimple' ),
        'id'            => 'b_c_s',
        'class'         => 'bottom_center_sidebar',
        'before_widget' => '<div id="bottom-center-sidebar">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    );
    register_sidebar($args);

}
add_action( 'widgets_init', 'sidebar_register' );

function register_customizer_controls( $wp_customize ) {
    // Create custom panel.
    $wp_customize->add_panel( 'basic_stylings', array(
        'priority'       => 70,
        'theme_supports' => '',
        'title'          => __( 'Basic Stylings', 'bsimple' ),
        'description'    => __( 'Set main website headers.', 'bsimple' ),
    ) );


    // Add section
    $wp_customize->add_section( 'frontpage_settings' , array(
        'title'      => __( 'Frontpage Settings','bsimple' ),
        'panel'      => 'basic_stylings',
        'priority'   => 20,
    ) );


    // Add setting.
    $wp_customize->add_setting( 'frontpage_header_bg_img', array(
        'default'     => get_stylesheet_directory_uri() . '/images/basic_header_bg.jpg',
    ) );

    // Add control.
    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize, 'frontpage_background_image', array(
              'label'      => __( 'Add Home Header Background Image Here, the width should be approx 1900px', 'bsimple' ),
              'section'    => 'frontpage_settings',
              'settings'   => 'frontpage_header_bg_img',
              )
    ) );

}

add_action( 'customize_register', 'register_customizer_controls' );
?>