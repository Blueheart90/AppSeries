// import Swiper JS and modules
import Swiper, { Navigation, Pagination, Autoplay } from 'swiper';

// configure Swiper to use modules
Swiper.use([Navigation, Pagination, Autoplay]);

// Solo se ejecutara si en el documento existe un elemento con la etiqueta/clase 'swiper-container'
if (document.querySelector('.swiper-container')) {
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 15,
        // autoplay: {
        //     delay: 2500,
        //     disableOnInteraction: false,
        // },
        pagination: {
        el: '.swiper-pagination',
        clickable: true,
        },
        navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
        },
        breakpoints: {

            // when window width is >= 640px
            640: {
            slidesPerView: 3,
            spaceBetween: 15
            },
            // when window width is >= 868px
            868: {
                slidesPerView: 4,
                spaceBetween: 15
            },
            // when window width is >= 1024px
            1024: {
                slidesPerView: 6,
                spaceBetween: 15
            },

        }
    });

    // var el = document.querySelector(".swiper-container");
    // el.addEventListener('mouseover', function(){
    //     swiper.autoplay.stop();
    // });
    // el.addEventListener('mouseout', function(){
    //     swiper.autoplay.start();
    // });

}

