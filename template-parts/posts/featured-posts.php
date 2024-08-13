<?php
/**
 * Posts featured.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

$args = array(
	'posts_per_page' => 1,
	'post__in'  => get_option('sticky_posts'),
	'ignore_sticky_posts' => 0
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( $the_query->have_posts() ) : $the_query->the_post();

        /*
        $thumbnail
        $permalink
        $title
        $category
        $exceprt
        */

        ?>
        <div class="tsts">
        <h2><?php the_title();?> </h2>
        </div>
       
		<?php 
	endwhile; // end of the loop.
?>

<?php endif; ?>
