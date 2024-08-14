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
    const menuBtn = document.querySelector('.menuburger-btn');
    const body = document.body;
    const main = document.querySelector('#main');
    const shopLink = document.querySelector('.shop-link');
    // var backMenuBtn = document.querySelector('.back-btn-menu');
    const backMenuBtnList = document.querySelectorAll('.back-btn-menu, .category-burger-menu-section__button');
    const closeMenuBtn = document.querySelector('.close-menu-burger');


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

        // backMenuBtn.addEventListener('click', function () {
        //     // Переключаем класс у body
        //     body.classList.remove('active-burger-menu-category');
        // });
        backMenuBtnList.forEach(button => {
            button.onclick = () => {
                body.classList.remove('active-burger-menu-category');
            }
        })

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


    //! popup form tabs
    function activeTab(list) {
        list.forEach(item => {
            item.addEventListener('click', function () {
                const targetForm = item.getAttribute('data-tab-button');
                const forms = document.querySelectorAll('[data-tab-form]');
                const buttons = document.querySelectorAll('[data-tab-button]');

                forms.forEach(form => form.style.display = 'none');
                buttons.forEach(button => button.classList.remove('active-tab'));

                document.querySelector(`[data-tab-form="${targetForm}"]`).style.display = 'block';
                item.classList.add('active-tab');
            });
        });
    }

    function initTabs() {
        const popupBody = document.querySelector('.account-popup');
        if (!popupBody) return;

        const buttonsList = document.querySelectorAll('[data-tab-button]');
        activeTab(buttonsList);

        document.querySelector('.account-popup__button.active-tab').click();
    }

    initTabs();

    //! add new scripts ...

});