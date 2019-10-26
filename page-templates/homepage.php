<?php
/**
 * Template Name: Homepage
 *
 * Template for displaying the homepage.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="homepage-wrapper" class="wrapper">

  <?php 
    if ( has_post_thumbnail( get_the_ID() ) ) {
      conversions()->template->fullscreen_featured_image();
    } 
  ?>

  <!-- Hero Section -->
	<section class="c-hero d-flex align-items-center">
  	<div class="container-fluid">
  		<div class="row">
        <div class="col-lg-6">
           			
          <!-- Title -->
    			<h1 class="display-4"><?php echo esc_html( get_the_title() ); ?></h1>
    			
          <?php
            if ( !empty( get_theme_mod( 'conversions_hh_desc') ) ) {
              echo '<p class="lead c-hero__description">'.wp_kses_post( get_theme_mod( 'conversions_hh_desc' ) ).'</p>';
            }
          ?>

          <?php if ( ( get_theme_mod( 'conversions_hh_button', 'no' ) != 'no' ) || ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) != 'no' ) ) : ?>
    			
            <!-- Button links -->
            <p class="lead">

              <?php

                // callout button
                if ( get_theme_mod( 'conversions_hh_button', 'no' ) != 'no' ) {
                  echo sprintf( '<a href="%s" class="btn %s btn-lg c-hero__callout-btn">%s</a>', 
                    esc_url( get_theme_mod( 'conversions_hh_button_url', 'https://wordpress.org' ) ), 
                    esc_attr( get_theme_mod( 'conversions_hh_button', 'no' ) ),
                    esc_html( get_theme_mod( 'conversions_hh_button_text', 'Click me' ) )
                  );
                }

                // video modal
                if ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) != 'no' ) {
                  echo sprintf( '<a data-fancybox="c-hero__fb-video1" href="%1$s" class="c-hero__fb-video"><span class="c-hero__video-btn btn btn-%2$s btn--circle"><i class="fa fa-play"></i></span><span class="c-hero__video-text btn btn-link text-%2$s">%3$s</span></a>', 
                    esc_url( get_theme_mod( 'conversions_hh_vbtn_url', 'https://www.youtube.com/watch?v=_sI_Ps7JSEk' ) ), 
                    esc_attr( get_theme_mod( 'conversions_hh_vbtn', 'no' ) ),
                    esc_html( get_theme_mod( 'conversions_hh_vbtn_text', 'Play Intro' ) )
                  );
                }
              ?>

            </p>

          <?php endif; ?>

  			</div>
  		</div>
		</div>
  </section>

	<!-- Clients section -->
	<section class="c-clients border-top border-bottom">
		<div class="container-fluid">
			<div class="row">
  			<div class="col-12">

          <?php 
            $chc_max_slides = get_theme_mod( 'conversions_hc_max', '5' );
            $chc_logo_width = get_theme_mod( 'conversions_hc_logo_width', '100' ) + 60;

            if ( esc_html( get_theme_mod( 'conversions_hc_respond', 'auto' ) == 'auto' ) ) 
            {
              
              $chc_breakpoints = [
                '768',
                '576',
                '375',
              ];

              foreach ($chc_breakpoints as $s) {
                $n = floor( $s / $chc_logo_width );
                if ( $n > $chc_max_slides ) {
                  $n = $chc_max_slides;
                }
                elseif ( $n < 1 ) {
                  $n = 1;
                }
                $chc_items_to_show[] = $n;
              }

            } 
            else 
            {
              $chc_items_to_show = [
                ''.esc_html( get_theme_mod( 'conversions_hc_lg', '4' ) ).'',
                ''.esc_html( get_theme_mod( 'conversions_hc_md', '3' ) ).'',
                ''.esc_html( get_theme_mod( 'conversions_hc_sm', '2' ) ).'',
              ];
            }
          ?>
          
  				<!-- Client logos -->
					<div class='c-clients__carousel py-4' data-slick='{"arrows":true,"dots":false,"infinite":true,"slidesToShow":<?php esc_attr_e( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"slidesToScroll":<?php esc_attr_e( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"responsive":[{"breakpoint":992,"settings":{"slidesToShow":<?php esc_attr_e( $chc_items_to_show[0] ); ?>,"slidesToScroll":<?php esc_attr_e( $chc_items_to_show[0] ); ?>}},{"breakpoint":768,"settings":{"slidesToShow":<?php esc_attr_e( $chc_items_to_show[1] ); ?>,"slidesToScroll":<?php esc_attr_e( $chc_items_to_show[1] ); ?>}},{"breakpoint":576,"settings":{"slidesToShow":<?php esc_attr_e( $chc_items_to_show[2] ); ?>,"slidesToScroll":<?php esc_attr_e( $chc_items_to_show[2] ); ?>}}]}'>
  					
            <?php
              $chc_logos = get_theme_mod( 'conversions_hc_logos' );
              $chc_logos_decoded = json_decode( $chc_logos );
      
              if ( !empty( $chc_logos_decoded ) ) {
              
                $count = 0;
              
                foreach( $chc_logos_decoded as $chc_logo ){
                  // Retrieve img id
                  $chc_url = $chc_logo->image_url;
                  $chc_logo_id = conversions()->template->conversions_id_by_url( $chc_url );
                  // Retrieve the correct img size
                  $chc_logo_med = wp_get_attachment_image_src( $chc_logo_id, 'medium' );
                  // Retrieve the alt text
                  $chc_logo_alt = get_post_meta( $chc_logo_id, '_wp_attachment_image_alt', true );

                  echo '<div class="c-clients__item px-3" id="c-clients__'.$count.'">
                    <img class="client" src="'. esc_url( $chc_logo_med[0] ) .'" alt="'. esc_html( $chc_logo_alt ) .'">
                  </div>';

                  ++$count;
                }
              }
            ?>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Features icon block -->
	<section class="c-icon-block container-fluid py-5">
		<div class="row">
			
			<!-- Title -->
			<div class="col-12">
				<div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
					<h2 class="h3">Features section</h2>
					<p class="text-muted">
						We offer custom services to our clients. Got a project in mind that you'd like to work together on? We'd love to hear more about it.
					</p>
				</div>
			</div>

      <!-- Features -->
  <div class="card-deck d-block d-lg-flex">
    

    

<?php
    $conversions_hf_icon_block = get_theme_mod('conversions_hf_icon_block');
      /*This returns a json so we have to decode it*/
      $conversions_hf_icon_block_decoded = json_decode($conversions_hf_icon_block);
      
      if ( !empty( $conversions_hf_icon_block_decoded ) ) {
      foreach($conversions_hf_icon_block_decoded as $hf_icon_block){ ?>
          <div class="card border-0 mb-3 mb-lg-0 text-center">
      <!-- Icon Blocks -->
      <div class="card-body p-1">
        <span class="c-icon-block__icon">
            <i class="<?php echo $hf_icon_block->icon_value; ?> text-success"></i>
          </span>
        <h3 class="h5"><?php echo $hf_icon_block->title; ?></h3>
        <p class="text-muted"><?php echo $hf_icon_block->text; ?></p>
        <a href="<?php echo $hf_icon_block->link; ?>">Explore now <span class="fas fa-angle-right align-middle ml-2"></span></a>
      </div>
      <!-- End Icon Blocks -->
    </div>

    <?php  }
  }
?>

    <div class="card border-0 mb-3 mb-lg-0 text-center">
      <!-- Icon Blocks -->
      <div class="card-body p-1">
        <span class="c-icon-block__icon">
            <i class="fas fa-coffee text-success"></i>
          </span>
        <h3 class="h5">Customizable</h3>
        <p class="text-muted">Front template can be easily customized with its cutting-edge components and features.</p>
        <a href="#">Explore now <span class="fas fa-angle-right align-middle ml-2"></span></a>
      </div>
      <!-- End Icon Blocks -->
    </div>

    <div class="card border-0 mb-3 mb-lg-0 text-center">
      <!-- Icon Blocks -->
      <div class="card-body p-1">
        <span class="c-icon-block__icon">
            <i class="fas fa-coffee text-success"></i>
          </span>
        <h3 class="h5">Documentation</h3>
        <p class="text-muted">Every component and plugin is well documented with live examples.</p>
        <a href="#">Explore now <span class="fas fa-angle-right align-middle ml-2"></span></a>
      </div>
      <!-- End Icon Blocks -->
    </div>

    <div class="card border-0 mb-3 mb-lg-0 text-center">
      <!-- Icon Blocks -->
      <div class="card-body p-1">
        <span class="c-icon-block__icon">
            <i class="fas fa-coffee text-success"></i>
          </span>
        <h3 class="h5">Documentation</h3>
        <p class="text-muted">Every component and plugin is well documented with live examples.</p>
        <a href="#">Explore now <span class="fas fa-angle-right align-middle ml-2"></span></a>
      </div>
      <!-- End Icon Blocks -->
    </div>
  </div>
<!-- End Features -->

		</div>
	</section>


	<!-- Pricing section -->
	<section class="c-pricing" style="background-color: #F3F3F3;">
		<div class="container-fluid py-5">
			<div class="row justify-content-sm-center">

				<!-- Title -->
				<div class="col-12">
					<div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
						<h2 class="h3">Pricing table section</h2>
						<p class="text-muted">
							We offer custom services to our clients. Got a project in mind that you'd like to work together on? We'd love to hear more about it.
						</p>
					</div>
				</div>

				<!-- Pricing table #1 -->
  				<div class="col-sm-12 col-lg-4 mb-3 mb-lg-0">
    				<div class="card shadow">
      					<header class="card-header bg-white text-center p-4">
        					<h4 class="h5 text-primary mb-3">Company</h4>
        					<span class="d-block">
          						<span class="display-4">
            						$69
          						</span>
          						<span class="d-block text-muted">
          							per month
          						</span>
        					</span>
      					</header>
      					<div class="card-body pt-4 pb-5 px-5">
        					<ul class="list-unstyled mb-4">
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							Community support
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							400+ pages
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							100+ header variations
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							20+ home page options
          						</li>
        					</ul>
							<button type="button" class="btn btn-block btn-primary">
								Start Free Trial
							</button>
      					</div>
    				</div>
  				</div>

  				<!-- Pricing table #2 -->
  				<div class="col-sm-12 col-lg-4 mb-3 mb-lg-0">
    				<div class="card shadow">
      					<header class="card-header bg-white text-center p-4">
        					<h4 class="h5 text-success mb-3">Enterprise</h4>
        					<span class="d-block">
          						<span class="display-4">
            						$69
          						</span>
          						<span class="d-block text-muted">
          							per month
          						</span>
        					</span>
      					</header>
      					<div class="card-body pt-4 pb-5 px-5">
        					<ul class="list-unstyled mb-4">
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							Community support
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							400+ pages
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							100+ header variations
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							20+ home page options
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							Priority Support
          						</li>
          						<li class="d-flex align-items-center py-2">
          							<span class="fa fa-check mr-3"></span>
          							More features
          						</li>
        					</ul>
        					<button type="button" class="btn btn-block btn-success">
        						Contact Us
        					</button>
      					</div>
    				</div>
  				</div>

          <!-- Pricing table #3 -->
          <div class="col-sm-12 col-lg-4 mb-3 mb-lg-0">
            <div class="card shadow">
                <header class="card-header bg-white text-center p-4">
                  <h4 class="h5 text-danger mb-3">Enterprise</h4>
                  <span class="d-block">
                      <span class="display-4">
                        $69
                      </span>
                      <span class="d-block text-muted">
                        per month
                      </span>
                  </span>
                </header>
                <div class="card-body pt-4 pb-5 px-5">
                  <ul class="list-unstyled mb-4">
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        Community support
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        400+ pages
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        100+ header variations
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        20+ home page options
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        Priority Support
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        More features
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        Priority Support
                      </li>
                      <li class="d-flex align-items-center py-2">
                        <span class="fa fa-check mr-3"></span>
                        More features
                      </li>
                  </ul>
                  <button type="button" class="btn btn-block btn-danger">
                    Contact Us
                  </button>
                </div>
            </div>
          </div>

			</div>
		</div>
	</section>


  <!-- Testimonial Section -->
  <section class="c-testimonials">
    <div class="container-fluid py-5">
      <div class="row">

        <!-- Title -->
        <div class="col-12">
          <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
            <h2 class="h3">What people say about us</h2>
            <p class="text-muted">
              We offer custom services to our clients. Got a project in mind that you'd like to work together on? We'd love to hear more about it.
            </p>
          </div>
        </div>

        <!-- Testimonials -->
        <div class="col-12">
         
          <!-- Slick Carousel -->
          <div class="c-testimonials__carousel">
            
            <!-- Testimonial -->
            <div class="c-testimonials__item">
              <blockquote class="c-testimonials__quote border-right border-bottom border-top shadow mx-5 mb-4">
                <p class="h5">
                  Conversions brings so many benefits to any team that does anything following a process. It is the easiest way for teams to build cool things and get results fast. 
                </p>
                <div class="d-flex justify-content-between">
                  <cite>
                    <span class="d-block">Mark McManus</span>
                    <span class="d-block">Associate Director of Spotify</span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </cite>
                  <div class="c-testimonials__nav align-self-end">
                    <i class="fas fa-chevron-left slick-arrow mr-2"></i>
                    <i class="fas fa-chevron-right slick-arrow"></i>
                  </div>
                </div>
              </blockquote>
            </div>

            <!-- Testimonial -->
            <div class="c-testimonials__item">
              <blockquote class="c-testimonials__quote border-right border-bottom border-top shadow mx-5 mb-4">
                <p class="h5">
                  Conversions brings so many benefits to any team that does anything following a process. It is the easiest way for teams to build cool things and get results fast. Conversions brings so many benefits to any team that does anything following a process. It is the easiest way for teams to build cool things and get results fast. 
                </p>
                <div class="d-flex justify-content-between">
                  <cite>
                    <span class="d-block">Mark McManus</span>
                    <span class="d-block">Associate Director of Spotify</span>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                  </cite>
                  <div class="c-testimonials__nav align-self-end">
                    <i class="fas fa-chevron-left slick-arrow mr-2"></i>
                    <i class="fas fa-chevron-right slick-arrow"></i>
                  </div>
                </div>
              </blockquote>   
            </div>

          </div> <!-- End Slick Carousel -->
        </div>
      </div>
    </div>
  </section>

	<!-- News Section -->
	<section class="c-news">
		<div class="container-fluid py-5">
			<div class="row justify-content-sm-center">

        <!-- Title -->
        <div class="col-12">
				  <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
            <?php 
              if ( !empty( get_theme_mod( 'conversions_news_title') ) ) {
                // Title
                echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_news_title' ) ).'</h2>';
              }

              if ( !empty( get_theme_mod( 'conversions_news_desc') ) ) {
                // Description
                echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_news_desc' ) ).'</p>';
              }
            ?>
				  </div>
        </div>

        <?php 
        // Get latest posts
        $args=array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 3,
          'orderby' => array( 'comment_count' => 'DESC'),
          'ignore_sticky_posts' => 1,
        );

        $recent_posts = new WP_Query( $args );
        while ($recent_posts -> have_posts()) : $recent_posts -> the_post(); 
        ?>

          <!-- Post item -->
          <div class="col-sm-12 col-lg-4 mb-4 mb-lg-3 c-news__card-wrapper">
            <article class="card shadow h-100 mb-3">
            
              <!-- Post image -->
              <a class="c-news__img-link" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                  <?php the_post_thumbnail( 'news-image', array( 'class' => 'card-img-top' ) ); ?>
                <?php else : ?>
                  <img class="card-img-top" alt="<?php the_title(); ?>" src="<?php echo get_template_directory_uri(); ?>/placeholder.png" />
                <?php endif; ?>
              </a>
              <div class="card-body pb-1">
                <h3 class="h5">
                  <a href="<?php esc_url( the_permalink() ); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <p class="text-muted">
                  <?php
                    $related_content = strip_shortcodes( get_the_content() );
                    echo wp_trim_words( $related_content, 15, '...' ); 
                  ?>
                </p>
              </div>
              <div class="card-footer text-muted d-flex justify-content-between align-items-center small">
                <?php conversions()->template->posted_on(); ?>
                <?php conversions()->template->reading_time(); ?>
              </div>
            </article>
          </div>
          <!-- End Post Item -->

        <?php 
        endwhile;
        wp_reset_postdata();
        ?>

			</div>
		</div>
	</section>


	<!-- Call-to-action section -->
	<section class="c-cta">
		<div class="container-fluid py-5">
			<div class="row">
  			<div class="col-12">

          <div class="w-md-80 w-lg-60 mx-auto">
  					<!-- Call-to-action text -->
  					<div class="c-cta__items">
              <?php 
                if ( !empty( get_theme_mod( 'conversions_hcta_title') ) ) {
                  // Title
                  echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_hcta_title' ) ).'</h2>';
                }

                if ( !empty( get_theme_mod( 'conversions_hcta_desc') ) ) {
                  // Description
                  echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_hcta_desc' ) ).'</p>';
                }

                if ( get_theme_mod( 'conversions_hcta_btn', 'btn-primary' ) != 'no' ) {
                  // Button
                  echo sprintf( '<a href="%s" class="btn %s btn-lg">%s</a>', 
                    esc_url( get_theme_mod( 'conversions_cta_btn_url', 'https://wordpress.org' ) ), 
                    esc_attr( get_theme_mod( 'conversions_hcta_btn', 'btn-primary' ) ),
                    esc_html( get_theme_mod( 'conversions_hcta_btn_text', 'Click me' ) )
                  );
                }
              ?>
  					</div>
            
            <?php
              if ( !empty( get_theme_mod( 'conversions_hcta_shortcode') ) ) {
                // Shortcode
                echo do_shortcode( wp_kses_post( get_theme_mod( 'conversions_hcta_shortcode' ) ) );
              } 
            ?>
          </div>

				</div>
      </div>
		</div>
	</section>

</div><!-- Wrapper end -->

<?php get_footer();