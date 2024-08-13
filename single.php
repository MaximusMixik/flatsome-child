<?php
/**
 * The blog template file.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

get_header();
do_action( 'flatsome_before_page' );

?>

<div id="content" class="blog-wrapper blog-single page-wrapper">
	<?php get_template_part( 'template-parts/posts/layout', get_theme_mod('blog_post_layout','right-sidebar') ); ?>
	<?php
// Параметры запроса для получения 6 последних постов
$args = array(
    'posts_per_page' => 6, // количество постов
    'post_status'    => 'publish', // только опубликованные посты
);

// Создание нового запроса
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <section class="related-articles">
			<div class="related-articles__container container">
				<div class="related-articles__header">
					<h2 class="related-articles__title">
						You may also like
					</h2>
					<a href="#" class="related-articles__link shop-btn">
							Other Articles 
					</a>
				</div>
					<div class="related-articles__list">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <article class="related-articles__item item-related">
                    <a class=" item-related__wrapper" href="<?php the_permalink(); ?>">
											<div class="item-related__image">
                        <?php if (has_post_thumbnail()) : ?>
													<?php the_post_thumbnail('medium'); // Миниатюра поста ?>
												<?php else : ?>
													<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAMrSURBVHgBxZhNchoxEIVfC/bmCANJ1sEnML5BUmVTycr2CWKfwPgENieArJICVyU5QfAJQtapADeIvQ5Iaf3M8DcwmkHBbyNGHkmfeqSntggBpXqv6hCzI0hUIejAVEr1BIExZOmBmr+GWX0QAkjd1z5A4Zx/1jNenYCoRSe/P+J/AKn+ywYw63A3kat65B6/cjmElE+mRogDjtIh/zpimCgBK8tjejuZIBSQi8qdfdAzlxd0OhlsbdOLznnI6wRshit6N7rbGWgFpk3N0WWu9v1ai4vrNKjcQOpLFGEqxu7xhk5HLRTQEhT487noCuTVlL7vCqNl2hLa9kl0UER6DfDMlOrVxggk1auOTZ+fa+az54sQkQ2xoBZCidSFKUs4M4++7Xjt1Hnt/NA7ihdxFQHFEfrDRQVKHpa9GmgH/ju9NPiEirp/0cnrwFsl1TeO+hmkaGwFmjvwrL4QTJ6JOjePSgPO9AwzHXirBOkJnfEEo1SgxIEVIleV7cBKdc1W3uDAW6Uk9y802MEakI2KvDMRKeLA7FG8Y9Yc2FdiHWbJgatZMFrUnHSpOdYL/cZUlHAbb2MvkaiYktdlAmQcOIbRppfzODD9WqOcQ/WjhldDpWyWIDGZR+g5HZh4HZrX5cAC7sGBN7+3PLaN0B4cePN7y2PTvhyYF/4w5e8aprU4tmCYhiXEAKGlHdiUbow0GK2ZPI7rRWJ+U/xEaFkH1qNEWIa5TWDACdr7uZGWectV+Dvqxo8IrQUHtiBxDp4AXvGuXDJQr8N1dzDVsOtJVrJOgDJHx0ZGqgpCK3bgJCJqyON1OSrtTU0YiGnNL3qN0NIOrJcDocuHcjttp61K8Ok8cI3fILRiB/aEMUCcKgxNKNkvvM8eD7kMILIe4wdjgGxBLrEqmP2naVf3T84e6xE7SZte0bNxftrHZw9w6Vy0MAxSHDg3kPOEK/fYKgK1zYF9RSmd6nQh/mxeyXvKLciaAxcGMgN84uyxxAnb4vUJmcOXk3xySb7i44Dqzi6sAXrm4LmBErDV65PNb1oHPtnswEGAMAfjqzrhrurgrurg/lGUD3l8Jkv/AGSQuVnFxZQRAAAAAElFTkSuQmCC" alt="Image">
												<?php endif; ?>
											</div>
                        <h3 class="item-related__title">
													<?php the_title(); ?>
                        </h3>
                    </a>
                </article>
            <?php endwhile; ?>
					</div>
			</div>
    </section>
<?php
endif;
wp_reset_postdata();
?>

</div>

<?php get_footer();
