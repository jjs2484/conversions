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
	<section id="c-hero" class="d-flex align-items-center">
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
    				<a data-fancybox="c-hero__fb-video" class="c-hero__video-btn btn btn-light btn-circle ml-2" href="https://www.youtube.com/watch?v=_sI_Ps7JSEk">
    					<i class="fa fa-play"></i>
					</a>

  				</div>
  			</div>
		</div>
	</section>

	<!-- Clients section -->
	<section id="c-clients" class="border border-right-0 border-left-0" style="background-color: #F3F3F3;">
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
	<section id="c-icon-block" class="container-fluid my-5">
		<div class="row">
			
			<!-- Title -->
			<div class="col-12">
				<h2>Icon Block Section</h2>
				<hr>
			</div>
			
			<!-- Icon block #1 -->
			<div class="col-md-6 mb-5">
				<div class="media pr-lg-4">
					<span class="c-icon mr-3 mt-2">
						<i class="fas fa-coffee text-success"></i>
					</span>
					<div class="media-body">
						<h3 class="h6">Professional design</h3>
						<p class="mb-2 text-muted">Achieve virtually any look and layout from within the one template.</p>
						<a href="#">
							Read more
							<span class="fa fa-angle-right align-middle ml-1"></span>
						</a>
					</div>
				</div>
			</div>
			
			<!-- Icon block #2 -->
			<div class="col-md-6 mb-5">
				<div class="media pl-lg-4">
					<span class="c-icon mr-3 mt-2">
						<i class="fab fa-phoenix-framework text-danger"></i>
					</span>
					<div class="media-body">
						<h3 class="h6">Unlimited power</h3>
						<p class="mb-2 text-muted">Find what you need in one template and combine features at will.</p>
						<a href="#">
							Read more
							<span class="fa fa-angle-right align-middle ml-1"></span>
						</a>
					</div>
				</div>
			</div>

			<!-- Icon block separator -->
			<div class="w-100"></div>
			<!-- End separator -->

			<!-- Icon block #3 -->
			<div class="col-md-6 mb-5">
				<div class="media pr-lg-4">
					<span class="c-icon mr-3 mt-2">
						<i class="fab fa-wordpress text-primary"></i>
					</span>
					<div class="media-body">
						<h3 class="h6">Super-light</h3>
						<p class="mb-2 text-muted">Manage document assembly with sophisticated yet super-light templates.</p>
						<a href="#">
							Read more
							<span class="fa fa-angle-right align-middle ml-1"></span>
 						</a>
					</div>
				</div>
			</div>

			<!-- Icon block #4 -->
			<div class="col-md-6 mb-5">
				<div class="media pl-lg-4">
					<span class="c-icon mr-3 mt-2">
						<i class="fas fa-coffee text-success"></i>
					</span>
					<div class="media-body">
						<h3 class="h6">Fully documented</h3>
						<p class="mb-2 text-muted">Every component and plugin is well documented with live examples.</p>
						<a href="#">
							Read more
							<span class="fa fa-angle-right align-middle ml-1"></span>
						</a>
					</div>
				</div>
			</div>

		</div>
	</section>


	<!-- Pricing section -->
	<section id="c-pricing">
		<div class="container-fluid my-5">
			<div class="row justify-content-lg-center">

				<!-- Pricing table #1 -->
  				<div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
    				<div class="card">
      					<header class="card-header bg-white text-center p-4">
        					<h4 class="h5 text-primary mb-3">Company</h4>
        					<span class="d-block">
          						<span class="display-4">
            						$69
          						</span>
          						<span class="d-block text-secondary">
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
  				<div class="col-sm-6 col-lg-4">
    				<div class="card">
      					<header class="card-header bg-white text-center p-4">
        					<h4 class="h5 text-success mb-3">Enterprise</h4>
        					<span class="d-block">
          						<span class="display-4">
            						$69
          						</span>
          						<span class="d-block text-secondary">
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

			</div>
		</div>
	</section>


	<!-- Call-to-action section -->
	<section id="c-cta" style="background-color: #F3F3F3;">
		<div class="container-fluid">
			<div class="row">
  				<div class="col-12">

					<div class="w-md-80 w-lg-60 text-center py-5 mx-auto">
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