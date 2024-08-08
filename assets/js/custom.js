jQuery(document).ready(function($){
    $('.accordion-item .accordion-title').on('click',function(){
        if($(window).width() > 1200) {
            $('html, body').animate({
                scrollTop: $('.product-page-accordian').offset().top - 150
            }, 1000);
        }
    })
});