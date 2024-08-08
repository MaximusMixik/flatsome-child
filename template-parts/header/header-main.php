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
        'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
        'depth'           => 0,
        'walker'          => '',
      ] );?>

</div>

<div class="category-burger-menu-section">
  <?php echo do_shortcode('[fibosearch]');?>

  <span class="back-btn-menu">Back to menu</span>

  <div class="category-list-box">
  <?php 
    $product_categories = get_terms('product_cat', array(
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
        'parent'     => 0,
    ));

    // Перебираем родительские категории
    foreach ($product_categories as $category) {
        // Выводим название родительской категории в <h4> теге с ссылкой
        echo '<span class="category-link"><a href="' . get_term_link($category) . '">' . $category->name . '</a></span>';
    }
  ?>
  </div>
  <a href="/shop/"><span class="shop-btn">Go to shop</span></a>
</div>

<style>
  .burger-menu-section{
    position: fixed;
    background: #fff;
    left: 0;
    top: 0;
    padding: 40px;
    z-index: 99;
    height: 100vh;
    width: 335px;
    transition: all 0.3s;
    transform: translateX(-100%);
  }

  .category-burger-menu-section{
    position: fixed;
    background: #fff;
    left: 335px;
    top: 0;
    padding: 40px;
    z-index: 98;
    height: 100vh;
    width: 700px;
    border-left: 1px solid #DBDBDB;
    transition: all 0.3s;
    transform: translateX(calc(-100% - 335px));
  }

  .active-burger-menu  .burger-menu-section{
    transform: translateX(0%);
  }

  .active-burger-menu-category .category-burger-menu-section{
    transform: translateX(0%);
  }

  .active-burger-menu  #main:before{
    content: "";
    display: block;
    width: 100%;
    height: 100vh;
    position: fixed;
    background: rgba(0, 0, 0, 0.50);
    top: 0;
    left: 0;
    z-index: 10;
  }

  .category-burger-menu-section .dgwt-wcas-search-wrapp{
    width: 100%;
  }

  .header-wrapper .category-burger-menu-section .dgwt-wcas-has-submit .dgwt-wcas-search-submit:after{
      background: url(/wp-content/uploads/2023/10/search-b.svg) !important;
      background-size: 100%;
      background-repeat: no-repeat;
      background-position: center;
  }

  .header-wrapper .category-burger-menu-section .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input{
    background: rgba(0, 0, 0, 0.05) !important;
    color: #000;
    font-family: Avenir Next!important;
  }

  .header-wrapper .category-burger-menu-section .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input::placeholder{
    color:#000;
  }

  .header-wrapper .category-burger-menu-section .dgwt-wcas-sf-wrapp{
    padding: 10px 0px;
  }

  .header-wrapper .burger-menu-section img.header-logo{
    display: none !important;
  }

  .header-wrapper .burger-menu-section img.header-logo-dark{
    display: block !important;
    width: 180px;
  }

  .category-link{
    color: rgba(0, 0, 0, 0.50);
    font-family: Avenir Next;
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: 16px; /* 114.286% */
    letter-spacing: -0.28px;
    padding: 4px 10px 4px 0;
  }

  .category-link a{
    color: rgba(0, 0, 0, 0.50);
  }

  .category-link:hover a{
    color: #FF5C00;
  }

  .logo__burger-menu{
    position: relative;
  }

  .menu-burger-menu-container{
    margin-top: 40px;
  }

  .burger-menu li{
    display: block;
    color: #000;
    font-family: Avenir Next;
    font-size: 18px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    padding:0 0 10px;
  }

  .burger-menu .home-link,
  .burger-menu .shop-link,
  .burger-menu .sale-link{
    font-family: Avenir Next;
    font-size: 24px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    text-transform: uppercase;
    padding: 18px 0px;
    margin: 0;
  }

   .burger-menu .sale-link:before{
    content: "";
    display: inline-block;
    width: 20px;
    height: 20px;
    background: url(/wp-content/uploads/2023/11/sale-icon.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin: 0 5px 0 0;
   }

   .privacy-link{
    position: absolute;
    bottom: 40px;
   }

   .privacy-link a{
    color: rgba(0, 0, 0, 0.30);
   }

  .home-link a,
  .shop-link a{
    color: #000;
  }

  .active-burger-menu-category .shop-link a{
    color: #89AF08;
  }

  .sale-link a{
    color: #FF5C00;
  }

  .burger-menu .sale-link{
    margin-bottom: 48px;
  }

  .category-list-box{
    display: grid;
    grid-template-columns: 1fr 1fr;
    padding: 40px 0 0;
    width: calc(100% - 200px);
  }

 .home .header-wrapper .menuburger-btn{
    display: block;
    width: 24px;
    height: 24px;
    background: url(/wp-content/uploads/2023/11/burger.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin: 0 40px 0 0;
    cursor: pointer;
    filter: invert(0) !important;
  }

  .header-wrapper.stuck .menuburger-btn,
  .header-wrapper .menuburger-btn{
    display: block;
    width: 24px;
    height: 24px;
    background: url(/wp-content/uploads/2023/11/burger.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin: 0 40px 0 0;
    cursor: pointer;
    filter: invert(1) !important;
  }

  .shop-btn{
    color: #000;
    font-family: Avenir Next;
    font-size: 16px;
    font-style: normal;
    font-weight: 600;
    line-height: normal;
    text-transform: uppercase;
    border-radius: 24px;
    border: 1px solid #89AF08;
    background: rgba(255, 255, 255, 0.00);
    padding: 3px 12px 12px 16px;
    position: absolute;
    top: 150px;
    right: 40px;
  }

  .shop-btn:after{
    content: "";
    display: inline-block;
    background: url(/wp-content/uploads/2023/11/arrow-right.svg);
    width: 24px;
    height: 24px;
    background-repeat: no-repeat;
    background-size: 100%;
    background-position: center;
    margin: 7px 0 -6px 5px;
  }

.mobile-nav-login-icon{
  display: none;
}

.valu,
.back-btn-menu,
.close-menu-burger{
  display: none;
}


@media(max-width:1000px){

  .logo__burger-menu{
    margin-left: 40px;
    width: 140px;
    margin-top: 2px;
  }

  .header-wrapper .burger-menu-section img.header-logo-dark {
    display: block !important;
    width: 160px;
}

  .header-wrapper .burger-menu-section .selectron23{
    right: 15px;
    top: 15px;
    position: absolute;
  }

  .close-menu-burger{
    display: block;
    width: 24px;
    height: 24px;
    background: url(/wp-content/uploads/2023/11/close-burger.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    position: absolute;
    top: 20px;
    left: 20px;
  }

  .header-wrapper .burger-menu-section .selectron23-container[data-opened="0"] > span{
    right: 5px !important;
  }

  .back-btn-menu{
    border-bottom: 1px solid rgba(0, 0, 0, 0.15);
    background: var(--color-white, #FFF);
    display: block;
    color: #000;
    font-family: Avenir Next;
    font-size: 16px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;
    padding: 20px 0;
  }

  .back-btn-menu:before{
    content: "";
    display: inline-block;
    width: 24px;
    height: 24px;
    background: url(/wp-content/uploads/2023/11/chevron-left.svg);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin: 0 10px -6px 0px;
  }


.valu{
  display: block;
}

   .header-wrapper .burger-menu-section .dgwt-wcas-has-submit .dgwt-wcas-search-submit:after{
      background: url(/wp-content/uploads/2023/10/search-b.svg) !important;
      background-size: 100%;
      background-repeat: no-repeat;
      background-position: center;
  }

  .mobile-nav-login-icon{
    display: block;
    border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 100%;
    width: 40px;
    height: 40px;
    position: absolute;
    right: 120px;
    top: 14px;
    padding: 5px 0 0 7px;
    z-index: 4;
  }

  .mobile-nav-login-icon.no-login{
    display: block;
  }

  .logged-in .mobile-nav-login-icon.login{
    display: block;
  }

  .logged-in .mobile-nav-login-icon.no-login{
    display: none;
  }

  .mobile-nav-login-icon.login{
    display: none;
  }

  .header-wrapper .burger-menu-section  .selectron23-container .selectron23-option {
      padding: 8px 22px 8px 21px !important;
      border: 1px solid rgba(0, 0, 0, 0.15);
      border-radius: 32px;
  }


  .header-wrapper .burger-menu-section .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input{
    background: rgba(0, 0, 0, 0.05) !important;
    color: #000;
    font-family: Avenir Next!important;
  }

  .header-wrapper .burger-menu-section .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input::placeholder{
    color:#000;
  }

  .header-wrapper .burger-menu-section .dgwt-wcas-search-wrapp {
      max-width: 800px;
      width: 100%;
      margin-top: 30px;
  }

  .burger-menu-section {
    padding: 20px;
    width: 100%;
  }

  .menu-burger-menu-container {
      margin-top: 10px;
  }

  .burger-menu-section .dgwt-wcas-sf-wrapp{
    padding: 10px 0;
  }

  .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input::placeholder{
    color: #000 !important;
  }

  .dgwt-wcas-style-pirx .dgwt-wcas-sf-wrapp input[type=search].dgwt-wcas-search-input{
    color: #000 !important;
  }


  .category-burger-menu-section {
      position: fixed;
      background: #fff;
      left: 0;
      top: 0;
      padding: 20px;
      z-index: 99;
      height: 100vh;
      width: 100%;
      border-left: initial;
      transition: all 0.3s;
      transform: translateX(calc(-100% - 335px));
  }

  .category-burger-menu-section .dgwt-wcas-search-wrapp{
    display: none !important;
  }

  .category-list-box {
      display: grid;
      grid-template-columns: 1fr;
      padding: 40px 0 0;
      width: 100%;
  }

  .shop-btn{
    position: relative;
    top: initial;
    right: initial;
    padding: 6px 12px 12px 16px;
    margin-top: 20px;
    display: block;
    text-align: center;
  }

  .category-burger-menu-section{
    height: 100vh;
    overflow-x: auto;
  }

  .category-link {
      color: rgba(0, 0, 0, 0.50);
      font-family: Avenir Next;
      font-size: 18px;
      font-style: normal;
      font-weight: 500;
      line-height: 16px;
      letter-spacing: -0.28px;
      padding: 4px 10px 4px 0;
      margin: 7px 0;
  }

  .header:not(.transparent)  .header-wrapper .burger-menu-section .selectron23-option-title {
      color: #000 !important;
  }

  .header-wrapper .burger-menu-section .selectron23-container:before {
      display: none;
  }

  .header-wrapper .burger-menu-section .selectron23-container[data-opened="0"] > span {
      border: initial !important;
      width: 24px;
      height: 24px;
      background: url(/wp-content/uploads/2023/11/Arrow-Down.svg);
      background-size: 100%;
      background-repeat: no-repeat;
      position: absolute;
      top: 8px !important;
      right: -4px;
  }


}


</style>


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


<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
  // Дождемся загрузки DOM, чтобы убедиться, что все элементы доступны

  // Находим кнопку меню, элемент body, элемент #main и элемент .shop-link
  var menuBtn = document.querySelector('.menuburger-btn');
  var body = document.body;
  var main = document.querySelector('#main');
  var shopLink = document.querySelector('.shop-link');
  var backMenuBtn = document.querySelector('.back-btn-menu');
  var closeMenuBtn = document.querySelector('.close-menu-burger');
  

  // Проверяем, что кнопка меню, body, элемент #main и .shop-link существуют
  if (menuBtn && body && main && shopLink) {
    // Добавляем обработчик события клика на кнопку меню
    menuBtn.addEventListener('click', function() {
      // Переключаем класс у body
      body.classList.toggle('active-burger-menu');
    });

    // Добавляем обработчик события клика на элемент .shop-link
    shopLink.addEventListener('click', function() {
      // Переключаем класс у body
      body.classList.toggle('active-burger-menu-category');
    });

    backMenuBtn.addEventListener('click', function() {
      // Переключаем класс у body
      body.classList.remove('active-burger-menu-category');
    });

    closeMenuBtn.addEventListener('click', function() {
      // Переключаем класс у body
      body.classList.remove('active-burger-menu');
    });

     // Добавляем обработчик события клика на элемент #main
    main.addEventListener('click', function() {
      body.classList.remove('active-burger-menu');
      body.classList.remove('active-burger-menu-category');
    });
  }
});


</script>