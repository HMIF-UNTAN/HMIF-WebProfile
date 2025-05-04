import Swiper from 'swiper';
import { Navigation, Pagination, EffectCoverflow, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

document.addEventListener('DOMContentLoaded', function () {

    const swiperGaleri = new Swiper('.swiper-galeri', {
      modules: [Navigation, Pagination, EffectCoverflow, Autoplay],
      loop: true,
      centeredSlides: true,
      slidesPerView: 2,
      spaceBetween: -100,
      grabCursor: true,
      effect: 'coverflow',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 200,
        modifier: 2,
        slideShadows: true,
      },
      pagination: {
        el: '.swiper-galeri .swiper-pagination',
        clickable: true,
      },
      watchSlidesProgress: true,
      autoplay: {
        delay: 3000, // <= Tambahkan ini untuk auto-slide 5 detik
        disableOnInteraction: false, // agar tetap autoplay walau user swipe manual
      },
      breakpoints: {
        640: {
          slidesPerView: 1, // untuk hp
          spaceBetween: -150,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: -100,
        }
      }
    });       

    const swiperArtikel = new Swiper(".artikel-carousel", {
      modules: [Autoplay],
      slidesPerView: 1, 
      spaceBetween: 20,
      loop: true,
      speed: 3000,
      direction: 'horizontal',
      autoplay: {
        delay: 0, // Tidak ada jeda antar autoplay
      },
      breakpoints: {
        640: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 5,
        },
        1280: {
          slidesPerView: 5,
        },
        1600: {
          slidesPerView: 5,
        },
        1920: {
          slidesPerView: 7,
        },
        2560: {
          slidesPerView: 7,
        },
      },
    });    
});
