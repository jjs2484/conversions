<?php
// social media icons list
function conversions_get_social_sites() {
     // Store social site names in array
     $social_sites = array(
         'twitter', 
         'facebook', 
         'google-plus',
         'flickr',
         'pinterest', 
         'youtube',
         'vimeo',
         'tumblr',
         'dribbble',
         'rss',
         'linkedin',
         'instagram',
         'email'
     );
 return $social_sites;
}

// social media icons output
add_action( 'conversions_output_social' , 'conversions_show_social_icons' );
function conversions_show_social_icons() {
 
    $social_sites = conversions_get_social_sites();
 
    // Any inputs that aren't empty are stored in $active_sites array
    foreach( $social_sites as $social_site ) {
        if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
            $active_sites[] = $social_site;
        }
    }
 
    // For each active social site, add it as a list item
    if ( !empty( $active_sites ) ) {
        
        echo "<ul class='social-media-icons'>";
 
        foreach ( $active_sites as $active_site ) { ?>

            <li>
             	<a href="<?php echo get_theme_mod( $active_site ); ?>">
             		<?php if( $active_site == 'vimeo' ) { ?>
                 		<i class="fas fa-<?php echo $active_site; ?>-square"></i> 
                    <?php } else if( $active_site == 'email' ) { ?>
                 		<i class="fas fa-envelope"></i> 
                    <?php } else { ?>
                 		<i class="fab fa-<?php echo $active_site; ?>"></i> <?php
             		} ?>
             	</a>
            </li> 

        <?php }

        echo "</ul>";
    }
}
							