<?php
/**
 * The blog template file.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

get_header();

echo do_shortcode('[rank_math_breadcrumb]');

do_action( 'flatsome_before_page' );?>

<div id="content" class="blog-wrapper blog-archive page-wrapper">
	<?php get_template_part( 'template-parts/posts/layout', get_theme_mod('blog_layout','right-sidebar') ); ?>
</div>

<?php get_footer(); ?>
