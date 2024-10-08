<?php
/**
 * Posts archive 3 column.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if ( have_posts() ) : ?>

<?php
	// Create IDS
	$ids = array();
	while ( have_posts() ) : the_post();
		array_push($ids, get_the_ID());
	endwhile; // end of the loop.
	$ids = implode(',', $ids);


?>
 
    <div class="archive-posts">
			<?php
			echo flatsome_apply_shortcode( 'blog_posts', array(
				'type'        => get_theme_mod( 'blog_style_type', 'masonry' ),
				'depth'       => get_theme_mod( 'blog_posts_depth', 0 ),
				'depth_hover' => get_theme_mod( 'blog_posts_depth_hover', 0 ),
				'text_align'  => get_theme_mod( 'blog_posts_title_align', 'center' ),
				'columns'     => '4',
				'show_date'   => get_theme_mod( 'blog_badge', 1 ) ? 'true' : 'false',
				'ids'         => $ids,
				'show_category' => 'true',
			) );
			?>
		</div>

<?php flatsome_posts_pagination(); ?>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>
