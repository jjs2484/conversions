<?php
/**
 * Template functions
 *
 * @package conversions
 */

namespace conversions;

/**
 * Template class.
 *
 * Contains template functions.
 *
 * @since 2019-08-15
 */
class Template {

	/**
	 * Class constructor
	 *
	 * @since 2019-08-15
	 */
	public function __construct() {
		add_action( 'edit_category', [ $this, 'category_transient_flusher' ] );
		add_action( 'save_post', [ $this, 'category_transient_flusher' ] );
		add_filter( 'post_class', [ $this, 'conversions_sticky_classes' ] );
		add_action( 'conversions_footer_info', [ $this, 'conversions_footer_credits' ], 10 );
	}

	/**
	 * Blog post categories
	 *
	 * @since 2019-08-18
	 */
	public function categorized_blog() {
		$all_the_cool_cats = get_transient( 'conversions_categories' );
		if ( false === $all_the_cool_cats ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'conversions_categories', $all_the_cool_cats );
		}

		// This blog has more than 1 category so components_categorized_blog should return true.
		return ( $all_the_cool_cats > 1 );
	}

	/**
	 * Flush the categories cache.
	 *
	 * @since 2019-08-18
	 */
	public function category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'conversions_categories' );
	}

	/**
	 * Entry footer links.
	 *
	 * @since 2019-08-18
	 */
	public function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'conversions' ) );
			if ( $categories_list && conversions()->template->categorized_blog() ) {
				printf(
					/* translators: %s: Categories of current post */
					'<span class="cat-links">' . esc_html__( 'Posted in %s', 'conversions' ) . '</span>',
					$categories_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'conversions' ) );
			if ( $tags_list ) {
				printf(
					/* translators: %s: Tags of current post */
					'<span class="tags-links">' . esc_html__( 'Tagged %s', 'conversions' ) . '</span>',
					$tags_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				);
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
	 * Pagination.
	 *
	 * @since 2019-08-18
	 *
	 * @param string $args Arguments.
	 * @param string $class pagination.
	 */
	public function the_posts_pagination( $args = array(), $class = 'pagination' ) {
		if ( $GLOBALS['wp_query']->max_num_pages <= 1 ) return;

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => __( '&laquo;', 'conversions' ),
				'next_text'          => __( '&raquo;', 'conversions' ),
				'screen_reader_text' => __( 'Posts navigation', 'conversions' ),
				'type'               => 'array',
				'current'            => max( 1, get_query_var( 'paged' ) ),
			)
		);

		$links = paginate_links( $args );

		?>

		<nav aria-label="<?php echo esc_attr( $args['screen_reader_text'] ); ?>">
			<ul class="pagination justify-content-center">
				<?php
				foreach ( $links as $key => $link ) {
					?>
					<li class="page-item <?php echo strpos( $link, 'current' ) ? 'active' : ''; ?>">
						<?php
						echo str_replace( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'page-numbers',
							'page-link',
							$link
						);
						?>
					</li>
					<?php
				}
				?>
			</ul>
		</nav>

		<?php
	}

	/**
	 * Post nav.
	 *
	 * @since 2019-08-18
	 */
	public function post_nav() {
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
	 * Posted by.
	 *
	 * @since 2019-09-10
	 */
	public function posted_by() {
		echo sprintf(
			'<span class="author vcard c-posted-by"><a class="url fn n" href="%1$s"> %2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}

	/**
	 * Posted on.
	 *
	 * @since 2019-08-18
	 */
	public function posted_on() {
		echo sprintf(
			'<span class="c-posted-on"><time class="entry-date published updated" datetime="%1$s">%2$s</time></span>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
	}

	/**
	 * Reading Time.
	 *
	 * @since 2019-09-05
	 */
	public function reading_time() {
		$content     = get_the_content();
		$word_count  = str_word_count( wp_strip_all_tags( $content ) );
		$readingtime = ceil( $word_count / 200 );
		$time_unit   = _x( 'min read', 'time unit', 'conversions' );

		echo sprintf(
			'<span class="c-reading-time">%d %s</span>',
			esc_html( $readingtime ),
			esc_html( $time_unit )
		);
	}

	/**
	 * Single comments display and link.
	 *
	 * @since 2019-09-10
	 */
	public function single_comments() {

		$num_comments = get_comments_number(); // get_comments_number returns only a numeric value.

		if ( comments_open() ) {
			if ( 0 == $num_comments ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
				$comments = '';
			} elseif ( $num_comments > 0 ) {
				$comments = sprintf(
					'<span class="c-single-comments"><a href="%s">%s</a></span>',
					esc_url( get_comments_link() ),
					esc_html( $num_comments )
				);
			}
			echo $comments; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- $comments is escaped before being passed in.
		}
	}

	/**
	 * Related posts.
	 *
	 * @since 2019-09-11
	 */
	public function related_posts() {

		global $post;

		if ( is_single() && 'post' != get_post_type() ) {
			return;
		}

		$related_posts_tax = get_theme_mod( 'conversions_blog_taxonomy', 'categories' );
		if ( 'tags' === $related_posts_tax ) {

			// tags.
			$tags    = wp_get_post_tags( $post->ID ); // retrieve a list of tags for current post.
			$tag_ids = array();
			foreach ( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id; // loop through list of tags and store term_id of each.

			$args = array(
				'tag__in'             => $tag_ids, // use tag ids that are within $tag_ids array.
				'post__not_in'        => array( $post->ID ), // don’t retrieve current post.
				'post_type'           => 'post', // specify post type to retrieve.
				'post_status'         => 'publish', // retrieve only published posts.
				'posts_per_page'      => 3, // specify number of related posts to show.
				'orderby'             => array( 'comment_count' => 'DESC' ), // how you want to order your posts.
				'no_found_rows'       => true, // use for better query performance.
				'cache_results'       => false, // use for better query performance.
				'ignore_sticky_posts' => 1, // ignore sticky posts.
			);

		} else {

			// categories.
			$cats = get_the_category( $post->ID );

			$args = array(
				'category__in'        => $cats[0],
				'post__not_in'        => array( $post->ID ),
				'post_type'           => 'post',
				'post_status'         => 'publish',
				'posts_per_page'      => 3,
				'orderby'             => array( 'comment_count' => 'DESC' ),
				'no_found_rows'       => true,
				'cache_results'       => false,
				'ignore_sticky_posts' => 1,
			);

		}

		$query_related_posts = new \WP_query( $args );

		if ( $query_related_posts->have_posts() ) {
			?>

			<div class="c-related-posts row">
				<div class="col-12">
					<h3 class="pb-2 border-bottom"><?php esc_html_e( 'Related Posts', 'conversions' ); ?></h3>
				</div>

				<?php
				while ( $query_related_posts->have_posts() ) {
					$query_related_posts->the_post();
					?>

					<!-- Post item -->
					<div class="col-sm-6 col-lg-4 mb-4 mb-lg-3">
						<article class="card shadow-sm h-100 mb-3">

							<!-- Post image -->
							<a class="c-news__img-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'conversions-news', array( 'class' => 'card-img-top' ) ); ?>
								<?php else : ?>
									<img class="card-img-top" alt="<?php the_title(); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/placeholder.png" />
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
									echo wp_kses_post( wp_trim_words( $related_content, 15, '...' ) );
									?>
								</p>
							</div>

						</article>
					</div>
					<!-- End Post Item -->

					<?php
				}
				?>
			</div>
			<?php
		}
		wp_reset_postdata();
	}

	/**
	 * Get featured image.
	 *
	 * @since 2019-11-29
	 */
	public function get_featured_image() {
		add_action( 'wp_head', [ $this, 'fullscreen_featured_image' ] );
	}

	/**
	 * Fullscreen featured image output.
	 *
	 * @since 2019-09-12
	 */
	public function fullscreen_featured_image() {

		global $post;

		// Get featured image sizes.
		$medium       = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium', false );
		$medium_large = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large', false );
		$large        = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large', false );
		$conversions_fullscreen   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'conversions-fullscreen', false );

		if ( is_page_template( 'page-templates/homepage.php' ) ) : // homepage template.
			// Get the customizer setting.
			$img_overlay_color = get_theme_mod( 'conversions_hh_img_color', '#000000' );
			$img_overlay       = get_theme_mod( 'conversions_hh_img_overlay', '.5' );
			$css_selector      = 'section.c-hero';
		else : // posts and pages.
			// Get the customizer setting.
			$img_overlay_color = get_theme_mod( 'conversions_featured_img_color', '#000000' );
			$img_overlay       = get_theme_mod( 'conversions_featured_img_overlay', '.5' );
			$css_selector      = '.conversions-hero-cover';
		endif;

		// convert color from hex to rgb.
		$hex = str_replace( '#', '', $img_overlay_color );
		if ( strlen( $hex ) == 3 ) :
			$rgb_array['r'] = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$rgb_array['g'] = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$rgb_array['b'] = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		else :
			$rgb_array['r'] = hexdec( substr( $hex, 0, 2 ) );
			$rgb_array['g'] = hexdec( substr( $hex, 2, 2 ) );
			$rgb_array['b'] = hexdec( substr( $hex, 4, 2 ) );
		endif;

		// Inline styles for background image.
		echo '<style>
			' . esc_html( $css_selector ) . ' {background-image: url(' . esc_url( $medium[0] ) . ');}
			@media (min-width: 300px) { ' . esc_html( $css_selector ) . ' { background-image: linear-gradient(rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . '), rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . ') ), url(' . esc_url( $medium_large[0] ) . ');} }
			@media (min-width: 768px) { ' . esc_html( $css_selector ) . ' { background-image: linear-gradient(rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . '), rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . ') ), url(' . esc_url( $large[0] ) . ');} }
			@media (min-width: 1024px) { ' . esc_html( $css_selector ) . ' { background-image: linear-gradient(rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . '), rgba(' . esc_attr( $rgb_array['r'] ) . ', ' . esc_attr( $rgb_array['g'] ) . ', ' . esc_attr( $rgb_array['b'] ) . ', ' . esc_attr( $img_overlay ) . ')), url(' . esc_url( $conversions_fullscreen[0] ) . ');} }
		</style>';

	}

	/**
	 * Adds .border-{color} class names to sticky posts.
	 *
	 * @param array $classes An array of post classes.
	 * @return array
	 */
	public function conversions_sticky_classes( $classes ) {

		// Bail if this is not a sticky post.
		if ( ! is_sticky() ) {
			return $classes;
		}

		$sticky_posts_highlight = get_theme_mod( 'conversions_blog_sticky_posts', 'primary' );
		$body_classes           = get_body_class();

		if ( $sticky_posts_highlight !== 'no' && in_array( 'blog', $body_classes ) ) {
			$classes[] = 'border-' . esc_attr( $sticky_posts_highlight );
		}

		return $classes;
	}

	/**
	 * Get image ID by image URL.
	 *
	 * - For the clients section images on page-templates/homepage.php.
	 * - Extends attachment_url_to_postid function.
	 * - Removes crop size which can prevent the ID from being returned.
	 *
	 * @since 2019-10-15
	 *
	 * @param string $chc_url URL of image.
	 * @return string
	 */
	public function conversions_id_by_url( $chc_url ) {
		$post_id = attachment_url_to_postid( $chc_url );

		if ( ! $post_id ) {
			$dir  = wp_upload_dir();
			$path = $chc_url;

			if ( 0 === strpos( $path, $dir['baseurl'] . '/' ) ) {
				$path = substr( $path, strlen( $dir['baseurl'] . '/' ) );
			}

			if ( preg_match( '/^(.*)(\-\d*x\d*)(\.\w{1,})/i', $path, $matches ) ) {
				$chc_url = $dir['baseurl'] . '/' . $matches[1] . $matches[3];
				$post_id = attachment_url_to_postid( $chc_url );
			}
		}
		return (int) $post_id;
	}

	/**
	 * Automatically calculate pricing table columns.
	 *
	 * @since 2019-11-15
	 *
	 * @param string $cpt_total_count Number of items the loop contains.
	 */
	public function auto_col_calc( $cpt_total_count ) {
		if ( 1 == $cpt_total_count ) {
			return 5;
		} elseif ( is_int( $cpt_total_count / 3 ) ) {
			return 4;
		} elseif ( is_int( $cpt_total_count / 2 ) ) {
			return 5;
		} else {
			// prime numbers test divided by three.
			$get_float = $cpt_total_count / 3;
			$integer   = floor( $get_float );
			$float     = $get_float - $integer;

			// Does it fill up atleast a half column?
			if ( $float >= 0.5 ) {
				return 4;
			} else { // if not than revert to 2 items per column.
				return 5;
			}
		}
	}

	/**
	 * Footer credits.
	 *
	 * @since 2019-12-17
	 */
	public function conversions_footer_credits() {
		echo '<div class="copyright col-md">';

		if ( ! empty( get_theme_mod( 'conversions_copyright_text' ) ) ) {
			$copyright_text = get_theme_mod( 'conversions_copyright_text' );
		} else {
			$copyright_text = get_bloginfo( 'name' );
		}

		echo sprintf(
			'&copy;%s&nbsp;&bull;&nbsp;<a class="site-name" href="%s" rel="home">%s</a>',
			esc_html( date_i18n( __( 'Y', 'conversions' ) ) ),
			esc_url( home_url( '/' ) ),
			esc_html( $copyright_text )
		);

		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '&nbsp;&bull;&nbsp;' );
		}

		echo sprintf(
			'&nbsp;&bull;&nbsp;<span class="conversions-powered">%s&nbsp;<a href="%s">%s</a></span>',
			esc_html__( 'Powered by', 'conversions' ),
			esc_url( 'https://conversionswp.com' ),
			esc_html__( 'Conversions Theme', 'conversions' )
		);

		echo '</div>';
	}

}
conversions()->template = new Template();
