<?php
/**
 * Header main.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

?>

<div class="burger-menu-section">

  <div class="close-menu-burger"></div>

  <div class="logo__burger-menu">
    <?php get_template_part('template-parts/header/partials/element','logo'); ?>
  </div>


<a href="https://nutribalance360.org/my-account/" data-open="#login-form-popup" class="mobile-nav-login-icon no-login">
  <img src="/wp-content/uploads/2023/10/user-b.svg" alt="">
</a>

<a href="https://nutribalance360.org/my-account/" class="mobile-nav-login-icon login">
  <img src="/wp-content/uploads/2023/10/user-b.svg" alt="">
</a>


<div class="valu">
<?php echo do_shortcode('[woocs sd=1]');?>

 <?php echo do_shortcode('[fibosearch]');?>

 </div>

  <?php wp_nav_menu( [
        'theme_location'  => '',
        'menu'            => 'Burger menu',
        'container'       => 'div',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'burger-menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu', 
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => '',
      ] );?>

</div>

<div class="category-burger-menu-section">
  <div class="category-burger-menu-section__header">
    <?php echo do_shortcode('[fibosearch]');?>
    <div  class="category-burger-menu-section__button" aria-label="close categories button"></div>
  </div>

  <span class="back-btn-menu">Back to menu</span>

  <div class="category-list-box">
    <?php
        wp_nav_menu(array(
            'theme_location' => 'all_products_menu', 
            'menu_class'     => 'all-products-menu', 
            'container'      => 'nav',               
            'container_class'=> 'all-products-nav' 
        ));
    ?>
    <a href="/shop/ " class="shop-btn">Go to shop</a>
  </div>
</div>

<div id="masthead" class="header-main <?php header_inner_class('main'); ?>">
      <div class="header-inner flex-row container <?php flatsome_logo_position(); ?>" role="navigation">

        <div class="menuburger-btn"></div>

          <!-- Logo -->
          <div id="logo" class="flex-col logo">
            <?php get_template_part('template-parts/header/partials/element','logo'); ?>
          </div>

          <!-- Mobile Left Elements -->
          <div class="flex-col show-for-medium flex-left">
            <ul class="mobile-nav nav nav-left <?php flatsome_nav_classes('main-mobile'); ?>">
              <?php flatsome_header_elements('header_mobile_elements_left','mobile'); ?>
            </ul>
          </div>

          <!-- Left Elements -->
          <div class="flex-col hide-for-medium flex-left
            <?php if(get_theme_mod('logo_position', 'left') == 'left') echo 'flex-grow'; ?>">
            <ul class="header-nav header-nav-main nav nav-left <?php flatsome_nav_classes('main'); ?>" >
              <?php flatsome_header_elements('header_elements_left'); ?>
            </ul>
          </div>

          <!-- Right Elements -->
          <div class="flex-col hide-for-medium flex-right">
            <ul class="header-nav header-nav-main nav nav-right <?php flatsome_nav_classes('main'); ?>">
              <?php flatsome_header_elements('header_elements_right'); ?>
            </ul>
          </div>

          <!-- Mobile Right Elements -->
          <div class="flex-col show-for-medium flex-right">
            <ul class="mobile-nav nav nav-right <?php flatsome_nav_classes('main-mobile'); ?>">
              <?php flatsome_header_elements('header_mobile_elements_right','mobile'); ?>
            </ul>
          </div>

      </div>

      <?php if(get_theme_mod('header_divider', 1)) { ?>
      <div class="container"><div class="top-divider full-width"></div></div>
      <?php }?>
</div>