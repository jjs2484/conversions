<?php
/**
 * The template for displaying easy digital downloads single products.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="edd-wrapper">

    <div class="container-fluid" id="content" tabindex="-1">

        <div class="row">

            <div class="col-md-8 col-lg-9 pr-lg-5 content-area" id="primary">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) : the_post(); ?>

                        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                            <header class="entry-header">
                                <?php the_title( '<h1 class="entry-title edd-title">', '</h1>' ); ?>
                                <?php the_excerpt( '<p class="h3 text-muted">', '</p>' ); ?>
                            </header><!-- .entry-header -->

                            <div class="post-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->

                            <footer class="entry-footer">
                                <?php edit_post_link( __( 'Edit', 'conversions' ), '<span class="edit-link">', '</span>' ); ?>
                            </footer><!-- .entry-footer -->

                        </article><!-- #post-## -->

                        <?php
                            // If comments are open or we have at least one comment, load comments.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>

                    <?php endwhile; // end of the loop. ?>

                </main><!-- #main -->

            </div>

            <!-- right sidebar -->
            <div class="col-md-4 col-lg-3 widget-area pl-md-4 pl-lg-3" id="sidebar-1" role="complementary">

            </div><!-- #end sidebar -->

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer();
