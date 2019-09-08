<?php
/**
 *
 * @package Deshette_Theme
 */
get_header(); ?>
        <?php
        if ( have_posts() ) : while ( have_posts() ): the_post();

            get_template_part( 'partials/content', get_post_type() );
    
          endwhile;
        endif;
        ?>
<?php get_footer(); ?>