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

	<!-- Hero Section -->
	<section class="c-hero d-flex align-items-center">
  		<div class="container-fluid">
  			<div class="row">
           		<div class="col-lg-6">
           			
           			<!-- Title -->
    				<h1 class="display-4">Fluid jumbotron</h1>
    				
    				<!-- Description -->
    				<p class="lead">
    					This is a modified jumbotron that occupies the entire horizontal space of its parent.
    				</p>
    				
    				<!-- Button link -->
    				<a href="#" class="btn btn-primary btn-lg">Large button</a>
    				
    				<!-- Fancybox button modal video -->
    				<a data-fancybox="c-hero__fb-video" class="c-hero__video-btn btn btn-light btn--circle ml-2" href="https://www.youtube.com/watch?v=_sI_Ps7JSEk">
    					<i class="fa fa-play"></i>
					</a>

  				</div>
  			</div>
		</div>
	</section>

	<!-- Clients section -->
	<section class="c-clients border-top border-bottom" style="background-color: #F3F3F3;">
		<div class="container-fluid">
			<div class="row">
  				<div class="col-12">

  					<!-- Client logos -->
					<div class="c-clients__carousel text-center mb-0 py-4">
  						<div class="c-clients__item py-6 px-3">
    						<img class="client" src="//i.imgur.com/NpmZS3w.png" alt="Image Description">
  						</div>
  						<div class="c-clients__item py-6 px-3">
    						<img class="client" src="//i.imgur.com/ZjU7Zl4.png" alt="Image Description">
  						</div>
						<div class="c-clients__item py-6 px-3">
    						<img class="client" src="//i.imgur.com/zRZLfx0.png" alt="Image Description">
						</div>
  						<div class="c-clients__item py-6 px-3">
    						<img class="client" src="//i.imgur.com/HAyRaOh.png" alt="Image Description">
  						</div>
  						<div class="c-clients__item py-6 px-3">
    						<img class="client" src="//i.imgur.com/HAyRaOh.png" alt="Image Description">
  						</div>
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
				<div class="w-md-80 w-lg-60 text-center mt-4 mb-5 mx-auto">
					<h3>Features section</h3>
					<p class="text-muted">
						We offer custom services to our clients. Got a project in mind that you'd like to work together on? We'd love to hear more about it.
					</p>
				</div>
			</div>
			
			




      

      <!-- Features -->
  <div class="card-deck d-block d-lg-flex">
    <div class="card border-0 mb-3 mb-lg-0 text-center">
      <!-- Icon Blocks -->
      <div class="card-body p-1">
        <span class="c-icon-block__icon">
            <i class="fas fa-coffee text-success"></i>
          </span>
        <h3 class="h5">Responsive</h3>
        <p class="text-muted">Front is an incredibly beautiful, fully responsive, and mobile-first projects on the web.</p>
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
					<div class="w-md-80 w-lg-60 text-center mt-4 mb-5 mx-auto">
						<h3>Pricing table section</h3>
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
        <div class="w-md-80 w-lg-60 text-center mt-4 mb-5 mx-auto">
          <h3>What people say about us</h3>
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
	<section class="c-news" style="background-color: #F3F3F3;">
		<div class="container-fluid py-5">
			<div class="row justify-content-sm-center">

			<!-- Title -->
			<div class="col-12">
				<div class="w-md-80 w-lg-60 text-center mt-4 mb-5 mx-auto">
					<h3>Latest News</h3>
					<p class="text-muted">
						We offer custom services to our clients. Got a project in mind that you'd like to work together on? We'd love to hear more about it.
					</p>
				</div>
			</div>

    	<?php
    		// Get latest posts
    		$recent_posts = wp_get_recent_posts(array(
        		'numberposts' => 3, // Number of recent posts thumbnails to display
        		'post_status' => 'publish' // Show only the published posts
    		)); 
    	?>
    
    		
    	<?php foreach($recent_posts as $post) : ?>

  			<!-- Post item -->
  			<div class="col-sm-6 col-lg-4 mb-4 mb-lg-3">
    			<article class="card shadow h-100 mb-3">
      			
            <!-- Post image -->
      			<a class="c-news__img-link" href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>" title="<?php echo $post['post_title'] ?>">
      				<?php echo get_the_post_thumbnail( $post['ID'], 'homepage-news', array( 'class' => 'card-img-top' ) ); ?>
      			</a>
      			<div class="card-body pb-1">
        			<h3 class="h5">
          		  <a href="<?php echo esc_url( get_permalink( $post['ID'] ) ); ?>">
                  <?php echo esc_html( $post['post_title'] ); ?>
          		  </a>
        			</h3>
        			<p class="text-muted">
          			<?php echo wp_trim_words( $post[ 'post_content' ], 15, '...' ); ?>
          		</p>
      			</div>
      			<div class="card-footer text-muted border-0 d-flex justify-content-between align-items-center small">
        			<div class="d-flex align-items-center">
          			<?php echo esc_html( the_author_meta( 'display_name', $post['post_author'] ) ); ?>
        			</div>
              <div class="d-flex align-items-center">
          			<?php echo esc_html( date( 'F d', strtotime( $post['post_date'] ) ) ); ?>
        			</div>
      			</div>
    			</article>
  			</div>
  			<!-- End Post Item -->

  			<?php endforeach; wp_reset_query(); ?>

			</div>
		</div>
	</section>


	<!-- Call-to-action section -->
	<section id="c-cta">
		<div class="container-fluid">
			<div class="row">
  				<div class="col-12">

					<div class="w-md-80 w-lg-60 text-center my-5 mx-auto">
  						<!-- Call-to-action text -->
  						<div class="mb-4">
    						<h2 class="h3">Get started today!</h2>
    						<p class="text-muted">Conversions is an HTML5 template, and its mission to improve the future of web. Are you ready to join us?</p>
  						</div>
  						<!-- Call-to-action button -->
  						<a class="btn btn-primary btn-lg mb-2 mb-md-0 mr-md-2" href="#">
    						Get Access
  						</a>
					</div>

				</div>
			</div>
		</div>
	</section>




</div><!-- Wrapper end -->

<?php get_footer();