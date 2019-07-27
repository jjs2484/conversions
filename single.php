<?php
/**
 * The template for displaying all single posts.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="single-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<?php

			global $post;
			if ( has_post_thumbnail( $post->ID ) ) // check if featured image is set
			{
				// Get fetured image sizes and set them as background
				$medium	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium', false );
				$medium_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large', false );
				$large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false );
				$fullscreen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'fullscreen', false ); 
				$full = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false );

				// echo inline styles for background image
    			echo '<style type="text/css">';
	    		echo '.conversions-hero-cover {background-image: url('. $medium[0] .');}';
	    		echo '@media (min-width: 300px) { .conversions-hero-cover {background-image: url('.  $medium_large[0] .');} }';
	    		echo '@media (min-width: 768px) { .conversions-hero-cover {background-image: url('. $large[0] .');} }';
	    		echo '@media (min-width: 1024px) { .conversions-hero-cover {background-image: url('. $fullscreen[0] .');} }';
	    		echo '@media (min-width: 1920px) { .conversions-hero-cover {background-image: url('. $full[0] .');} }';
    			echo '</style>';

    			// echo html for background image
    			echo '<div class="col-sm-12">';
        		echo '<div class="conversions-hero-cover">';
        		echo '<div class="conversions-hero-cover__inner-container">';
        		echo the_title( '<h1 class="entry-title text-center">', '</h1>' );
        		echo '</div>';
        		echo '</div>';
        		echo '</div>';
    		}
			
			?>

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'single' ); ?>

						<?php conversions_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
