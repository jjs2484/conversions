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
    				
    				<!-- Button modal video -->
					<button type="button" class="c-hero-video-btn btn btn-light btn-circle ml-2" data-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#c-hero-modal">
						<i class="fa fa-play"></i>
            		</button>

					<!-- Modal -->
					<div class="modal fade" id="c-hero-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  						<div class="modal-dialog" role="document">
    						<div class="modal-content">
								<div class="modal-body">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>        
        							<!-- 16:9 aspect ratio -->
									<div class="embed-responsive embed-responsive-16by9">
  										<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
									</div>
								</div>
							</div>
						</div>
					</div>

  				</div>
  			</div>
		</div>
	</section>

	<!-- Clients section -->
	<section id="c-clients" style="background-color: #eee;">
		<div class="container-fluid">
			<div class="row">
  				<div class="col-12">

					<div class="c-clients__carousel text-center mb-0 py-3">
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

	<!-- Icon Blocks -->
	<section id="c-icon-block" class="container-fluid my-5">
		<div class="row">
			
			<div class="col-12">
				<h2>Icon Block Section</h2>
				<hr>
			</div>
			
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

			<div class="w-100"></div>

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

</div><!-- Wrapper end -->

<?php get_footer();