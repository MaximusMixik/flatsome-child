<?php 


/**
 * Add ACF PRO
 * Register Shop Promo Slider tab
 * Add repeater with text, link
 */
?>
<div class="poster">
    <div class="poster__container">
        <div class="poster__slider swiper-poster">
            <div class="poster__wrapper swiper-wrapper">
                <?php
                $slides = get_field('slides','option');
                if ($slides) : 
                foreach ($slides as $slide) :
                $text = $slide['text'];
                $link = $slide['link'];
                ?>
                    <div class="poster__slide slide-poster swiper-slide">
                        <div class="slide-poster__wrapper">
                            <?php if ($text) : ?>
                                <h2 class="slide-poster__title">
                                    <?php echo $text; ?>
                                </h2>
                            <?php endif; ?>
                            <?php if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <a class="slide-poster__button button button--green" 
                                href="<?php echo esc_url( $link_url ); ?>" 
                                target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;  endif; ?>
            </div>
            <div class="poster__navigation navigation-swiper">
                <button type="button" aria-label="button prev" class="navigation-swiper__button navigation-swiper__button--prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="none">
                        <path stroke="#333" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="M8 14 2 8l6-6"/>
                    </svg>
                </button>
                <!-- <div class="navigation-swiper__pagination"></div> -->
                <button aria-label="button next" type="button" class="navigation-swiper__button navigation-swiper__button--next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="none">
                    <path stroke="#333" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25" d="m2 14 6-6-6-6"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <img  class="poster__bg" src="<?php echo get_template_directory_uri(); ?>-child/assets/images/banner.jpg" alt="background">
</div>