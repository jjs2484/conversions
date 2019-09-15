<?php

namespace conversions;

/**
	@brief		Template functions.
	@since		2019-08-15 23:01:47
**/
class Template
{
	/**
		@brief		Constructor.
		@since		2019-08-15 23:01:47
	**/
	public function __construct()
	{
		add_action( 'edit_category', [ $this, 'category_transient_flusher' ] );
		add_action( 'save_post', [ $this, 'category_transient_flusher' ] );
	}

	/**
		@brief		categorized_blog
		@since		2019-08-18 19:56:24
	**/
	public function categorized_blog()
	{
		if ( false === ( $all_the_cool_cats = get_transient( 'conversions_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number'     => 2,
			) );
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'conversions_categories', $all_the_cool_cats );
		}

		// This blog has more than 1 category so components_categorized_blog should return true.
		return ($all_the_cool_cats > 1 );
	}

	/**
		@brief		Flush the categories cache.
		@since		2019-08-18 19:57:33
	**/
	public function category_transient_flusher()
	{
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'conversions_categories' );
	}

	/**
		@brief		Entry footer.
		@since		2019-08-18 19:56:02
	**/
	public function entry_footer()
	{
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'conversions' ) );
			if ( $categories_list && conversions()->template->categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'conversions' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'conversions' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'conversions' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'conversions' ),
				the_title( '<span class="sr-only">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

	/**
		@brief		Pagination.
		@since		2019-08-18 20:11:44
	**/
	public function pagination( $args = array(), $class = 'pagination' )
	{
        if ($GLOBALS['wp_query']->max_num_pages <= 1) return;

		$args = wp_parse_args( $args, array(
			'mid_size'           => 2,
			'prev_next'          => true,
			'prev_text'          => __('&laquo;', 'conversions'),
			'next_text'          => __('&raquo;', 'conversions'),
			'screen_reader_text' => __('Posts navigation', 'conversions'),
			'type'               => 'array',
			'current'            => max( 1, get_query_var('paged') ),
		) );

        $links = paginate_links($args);

        ?>

        <nav aria-label="<?php echo $args['screen_reader_text']; ?>">

            <ul class="pagination">

                <?php

                    foreach ( $links as $key => $link ) { ?>

                        <li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : '' ?>">

                            <?php echo str_replace( 'page-numbers', 'page-link', $link ); ?>

                        </li>

                <?php } ?>

            </ul>

        </nav>

        <?php
	}

	/**
		@brief		Post nav.
		@since		2019-08-18 20:02:28
	**/
	public function post_nav()
	{
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
				<nav class="container navigation post-navigation">
					<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'conversions' ); ?></h2>
					<div class="row nav-links justify-content-between">
						<?php

							if ( get_previous_post_link() ) {
								previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-double-left"></i>&nbsp;%title', 'Previous post link', 'conversions' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-double-right"></i>', 'Next post link', 'conversions' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->

		<?php
	}

	/**
		@brief		Posted by.
		@since		2019-09-10 23:14:42
	**/
	public function posted_by()
	{
		$byline      = apply_filters(
			'conversions_posted_by', sprintf(
				'<span class="author vcard"><a class="url fn n" href="%1$s"> %2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $byline; // WPCS: XSS OK.
	}

	/**
		@brief		Posted on.
		@since		2019-08-18 19:55:38
	**/
	public function posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		$posted_on   = apply_filters(
			'conversions_posted_on', sprintf(
				'<span class="posted-on">%1$s</span>',
				apply_filters( 'conversions_posted_on_time', $time_string )
			)
		);
		echo $posted_on; // WPCS: XSS OK.
	}

	/**
		@brief		Reading Time.
		@since		2019-09-05 16:55:18
	**/
	public function reading_time() {
    	$content = get_the_content();
    	$word_count = str_word_count( strip_tags( $content ) );
    	$readingtime = ceil($word_count / 200);
      	$time_unit = esc_html_x( 'min read', 'time unit', 'conversions' );
		$totalreadingtime = sprintf("<span class='c-reading-time'>%d %s</span>", esc_html( $readingtime ), $time_unit );
		
		echo $totalreadingtime;	
	}


	/**
		@brief		Single comments display and link.
		@since		2019-09-10 17:11:10
	**/
	public function single_comments() {
		
		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

		if ( comments_open() ) {
			if ( $num_comments == 0 ) {
				$comments = __('No Comments', 'conversions');
			} elseif ( $num_comments > 0 ) {
				$comments = $num_comments;
			}
			echo '<span class="c-single-comments"><a href="' . get_comments_link() .'">'. $comments.'</a></span>';
		}
	}

	/**
		@brief		Related posts
		@since		2019-09-11 20:35:17
	**/
	public function related_posts() {

		// Are related posts enabled?
		$related_posts_state = esc_html(get_theme_mod('conversions_blog_related', 'enable'));
		if( $related_posts_state == 'enable' ) {
	
			global $post;
			
			$related_posts_tax = esc_html(get_theme_mod('conversions_blog_taxonomy', 'categories'));
			if( $related_posts_tax == 'tags' ) 
			{
				
				// tags
				$tags = wp_get_post_tags($post->ID); //retrieve a list of tags for current post  
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id; //loop through list of tags and store term_id of each

				$args=array(
					'tag__in' => $tag_ids, //use tag ids that are within $tag_ids array
					'post__not_in' => array($post->ID), //don’t retrieve current post
					'post_type' => 'post', //specify post type to retrieve
					'post_status' => 'publish', //retrieve only published posts
					'posts_per_page' => 3, //specify number of related posts to show
					'orderby' => array( 'comment_count' => 'DESC'), //how you want to order your posts
					'no_found_rows' => true, //use for better query performance
					'cache_results' => false, //use for better query performance
					'ignore_sticky_posts' => 1, //ignore sticky posts
				);

			} else {
	
				// categories
				$cats = get_the_category($post->ID);
	
				$args=array(
					'category__in' => $cats[0],
					'post__not_in' => array($post->ID),
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 3,
					'orderby' => array('comment_count' => 'DESC'),
					'no_found_rows' => true,
					'cache_results' => false,
					'ignore_sticky_posts' => 1,
				);
			
			}

			$query_related_posts = new \WP_query( $args );

			if( $query_related_posts->have_posts() ) { ?>
		
				<div class="c-related-posts row">
					<div class="col-12">
						<h3 class="pb-2 border-bottom"><?php esc_html_e( 'Related Posts', 'conversions' ); ?></h3>
					</div>

					<?php while( $query_related_posts->have_posts() ) {
						$query_related_posts->the_post(); ?>

						<!-- Post item -->
  						<div class="col-sm-6 col-lg-4 mb-4 mb-lg-3">
    						<article class="card shadow-sm h-100 mb-3">
      			
            					<!-- Post image -->
      							<a class="c-news__img-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title(); ?>">
      								<?php if ( has_post_thumbnail() ) : ?>
        								<?php the_post_thumbnail( 'news-image', array( 'class' => 'card-img-top' ) ); ?>
    								<?php else : ?>
        								<img class="card-img-top" alt="<?php the_title(); ?>" src="<?php echo get_template_directory_uri(); ?>/placeholder.png" />
    								<?php endif; ?>
      							</a>
      							<div class="card-body pb-1">
        							<h4 class="h6">
          		  						<a href="<?php echo esc_url( get_permalink() ); ?>">
                  							<?php the_title(); ?>
          		  						</a>
        							</h4>
        							<p class="text-muted">
          								<?php
          									$related_content = strip_shortcodes( get_the_content() );
          									echo wp_trim_words( $related_content, 15, '...' ); 
          								?>
          							</p>
      							</div>
      			
    						</article>
  						</div>
  						<!-- End Post Item -->
	
					<?php }
				echo '</div>';
			}
			wp_reset_postdata();
		}
	}

	/**
		@brief		Fullscreen featured image
		@since		2019-09-12 11:17:04
	**/
	public function fullscreen_featured_image() {

		global $post;
			
		if ( has_post_thumbnail( $post->ID ) ) // check if featured image is set
		{
			// Get featured image sizes
			$medium	= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium', false );
			$medium_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large', false );
			$large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false );
			$fullscreen = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'fullscreen', false );

			// Get the customizer setting
			$blog_img_overlay = get_theme_mod('conversions_blog_overlay', '0.5');

			// Inline styles for background image
    		echo '<style>
	    		.conversions-hero-cover {background-image: url('. esc_url($medium[0]) .');}
	    		@media (min-width: 300px) { .conversions-hero-cover { background-image: linear-gradient(rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .'), rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .')), url('.  esc_url($medium_large[0]) .');} }
	    		@media (min-width: 768px) { .conversions-hero-cover { background-image: linear-gradient(rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .'), rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .')), url('. esc_url($large[0]) .');} }
	    		@media (min-width: 1024px) { .conversions-hero-cover { background-image: linear-gradient(rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .'), rgba(0, 0, 0, '. esc_attr($blog_img_overlay) .')), url('. esc_url($fullscreen[0]) .');} }
    		</style>';

    		// HTML for background image and title
    		echo '<div class="col-sm-12">
        		<div class="conversions-hero-cover">
        			<div class="conversions-hero-cover__inner-container"><h1 class="entry-title text-center">'.get_the_title( $post->ID ).'</h1></div>
        		</div>
        	</div>';
    	}

	}

}
conversions()->template = new Template();
