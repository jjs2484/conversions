<?php
/**
 * conversions customizer social icon output
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// social media icons list
function conversions_get_social_sites() {
    // Store social site names in array
    $social_sites = array(
        'amazon',
        'discord',
        'dribbble',
        'facebook',
        'flickr',
        'github',
        'google my business',
        'instagram',
        'linkedin',
        'pinterest',
        'reddit',
        'slack',
        'tumblr',
        'twitter',
        'vimeo',
        'wordpress',
        'yelp',
        'youtube',
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
        
        echo "<div class='social-media-icons col-md'>";

            echo "<ul class='list-inline'>";
 
                foreach ( $active_sites as $active_site ) { ?>

                    <li class="list-inline-item">
                        <a href="<?php echo get_theme_mod( $active_site ); ?>" target="<?php echo get_theme_mod('conversions_social_link_target', '_self'); ?>">
                            <?php if( $active_site == 'dribbble' ) { ?>
                                <i class="fab fa-<?php echo $active_site; ?>-square"></i>
                            <?php } elseif( $active_site == 'google my business' ) { ?>
                                <i class="fas fa-map-marker-alt"></i>
                            <?php } else { ?>
                                <i class="fab fa-<?php echo $active_site; ?>"></i>
                            <?php } ?>
                        </a>
                    </li>

                <?php }

            echo "</ul>";

        echo "</div>";
    }
}
							