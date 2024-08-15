<?php
/**
 * Posts single.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

if ( have_posts() ) : ?>

<?php /* Start the Loop */ ?>
<?php echo do_shortcode('[shop_promo_slider_top]');?>
<?php echo do_shortcode('[rank_math_breadcrumb]');?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">
		<?php
			if(flatsome_option('blog_post_style') == 'default' || flatsome_option('blog_post_style') == 'inline'){
				get_template_part('template-parts/posts/partials/entry-header', flatsome_option('blog_posts_header_style') );
			}
		?>
		<?php get_template_part( 'template-parts/posts/content', 'single' ); ?>
	</div>
</article>

<?php endwhile; ?>

<?php else : ?>

	<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>
