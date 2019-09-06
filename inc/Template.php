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
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'conversions' ), esc_html__( '1 Comment', 'conversions' ), esc_html__( '% Comments', 'conversions' ) );
			echo '</span>';
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
								previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'conversions' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'conversions' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->

		<?php
	}

	/**
		@brief		Posted on.
		@since		2019-08-18 19:55:38
	**/
	public function posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on   = apply_filters(
			'conversions_posted_on', sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'post date', 'conversions' ),
				esc_url( get_permalink() ),
				apply_filters( 'conversions_posted_on_time', $time_string )
			)
		);
		$byline      = apply_filters(
			'conversions_posted_by', sprintf(
				'<span class="byline"> %1$s<span class="author vcard"><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
				$posted_on ? esc_html_x( 'by', 'post author', 'conversions' ) : esc_html_x( 'Posted by', 'post author', 'conversions' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $posted_on . $byline; // WPCS: XSS OK.
	}

	/**
		@brief		Reading Time.
		@since		2019-09-05 16:55:18
	**/
	public function reading_time() {
    	$content = get_the_content();
    	$word_count = str_word_count( strip_tags( $content ) );
    	$readingtime = ceil($word_count / 200);

    	if ($readingtime == 1) {
      		$timer = " minute";
    	} else {
      		$timer = " minutes";
    	}
    	$totalreadingtime = $readingtime . $timer;

		$totalreadingtime = sprintf("<i class='fas fa-clock'></i> Reading time: %s.", esc_html( $totalreadingtime ) );
		
		echo $totalreadingtime;
    	
	}
}
conversions()->template = new Template();
