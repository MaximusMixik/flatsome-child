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

$the_query = new WP_Query($args);

if ($the_query->have_posts()) :
?>
    <?php
    while ($the_query->have_posts()) : $the_query->the_post();
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $permalink = get_permalink();
        $title = get_the_title();
        $category = get_the_category();
        $excerpt = get_the_excerpt();

        $category_name = !empty($category) ? esc_html($category[0]->name) : '';
        ?>
        <a  href="<?php echo esc_url($permalink); ?>"   class="featured-post ">
            <div class="featured-post__image">
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>" />
            </div>
            <div class="featured-post__content">
                <div class="featured-post__category">
                    <?php echo esc_html($category_name); ?>
                </div>
                <h3 class="featured-post__title">
                    <?php echo esc_html($title); ?>
                </h3>
                <p class="featured-post__excerpt">
                    <?php echo esc_html($excerpt); ?>
                </p>
                <div class="featured-post__button button">Read More</div>
            </div>
        </a>
    <?php  endwhile; ?>
<?php endif; ?>
