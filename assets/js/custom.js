jQuery(document).ready(function ($) {
    $('.accordion-item .accordion-title').on('click', function () {
        if ($(window).width() > 1200) {
            $('html, body').animate({
                scrollTop: $('.product-page-accordian').offset().top - 150
            }, 1000);
        }
    })


    // !!! header
    // document.addEventListener('DOMContentLoaded', function () {
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
        menuBtn.addEventListener('click', function () {
            // Переключаем класс у body
            body.classList.toggle('active-burger-menu');
        });

        // Добавляем обработчик события клика на элемент .shop-link
        shopLink.addEventListener('click', function () {
            // Переключаем класс у body
            body.classList.toggle('active-burger-menu-category');
        });

        backMenuBtn.addEventListener('click', function () {
            // Переключаем класс у body
            body.classList.remove('active-burger-menu-category');
        });

        closeMenuBtn.addEventListener('click', function () {
            // Переключаем класс у body
            body.classList.remove('active-burger-menu');
        });

        // Добавляем обработчик события клика на элемент #main
        main.addEventListener('click', function () {
            body.classList.remove('active-burger-menu');
            body.classList.remove('active-burger-menu-category');
        });
    }
    // });

});