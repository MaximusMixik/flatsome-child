<?php 


/**
 * Add ACF PRO
 * Register Shop Promo Slider tab
 * Add repeater with text, link
 */

$slides = get_field('slides','option');

if ($slides) : 

?>

<div>
add your markup here

<?php foreach ($slides as $slide) :

    $text = $slide['text'];
    $link = $slide['link'];
    ?>

    <?php if ($text) : ?>

        <?php echo $text; ?>

    <?php endif; ?>

    <?php 
    if( $link ): 
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
        ?>
        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    <?php endif; ?>

<?php endforeach; ?>


</div>

<?php endif; ?>
