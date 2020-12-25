<?php
/**
 * Admin Page
 *
 * @package conversions
 */

?>

<div class="wrap about-wrap full-width-layout c-info">
	<!-- Page title -->
	<h1><?php esc_html_e( 'Get Started in 3 Easy Steps', 'conversions' ); ?></h1>

	<!-- Page description -->
	<?php
	echo sprintf(
		'<p>%s<br>%s</p>',
		esc_html__( 'We\'re glad you chose Conversions theme and hope it will help you create a beautiful website in no time!', 'conversions' ),
		esc_html__( 'If you have any suggestions, don\'t hesitate to leave us feedback.', 'conversions' )
	);
	?>

	<!-- Step 1 -->
	<h3 class="c-info__subtitle"><?php esc_html_e( '1. Install the recommended plugins:', 'conversions' ); ?></h3>

	<div class="recommended-plugins">
		<?php
		echo \conversions\Admin::get_plugins_state(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		?>
	</div>

	<!-- Step 2 -->	
	<h3 class="c-info__subtitle">
		<?php
		esc_html_e( '2. Import a demo (optional): ', 'conversions' );
		echo \conversions\Admin::get_import_page_btn(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		?>
	</h3>

	<!-- Step 3 -->	
	<h3 class="c-info__subtitle">
		<?php
		esc_html_e( '3. Customize your site: ', 'conversions' );
		echo \conversions\Admin::get_customize_btn(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		?>
	</h3>

	<!-- Enjoy -->
	<h3 class="c-info__enjoy"><?php esc_html_e( 'Enjoy! :)', 'conversions' ); ?></h3>
</div>
