import Swiper from 'swiper';
import { Navigation, Pagination, EffectCoverflow, Autoplay } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

document.addEventListener('DOMContentLoaded', function () {
    const swiperTentangKami = new Swiper('.swiper-tentangkami', {
        modules: [Navigation, Pagination, EffectCoverflow, Autoplay],
        direction: 'vertical',
        loop: true,
        centeredSlides: true,
        slidesPerView: 2,
        spaceBetween: -70,
        effect: 'coverflow',
        coverflowEffect: {
            rotate: 0,
            stretch: 20,
            depth: 200,
            modifier: 2,
            slideShadows: true,
        },
        grabCursor: true,
        mousewheel: true,
        pagination: {
            el: '.swiper-tentangkami .swiper-pagination',
            clickable: true,
        },
        on: {
            init() {
                adjustTextSize(this);
            },
            slideChangeTransitionEnd() {
                adjustTextSize(this);
            }
        }
    });

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

    document.querySelectorAll('.swiper-tentangkami .swiper-slide').forEach((slide) => {
        slide.addEventListener('click', () => {
            if (!slide.classList.contains('swiper-slide-active')) {
                const index = parseInt(slide.getAttribute('data-swiper-slide-index'), 10);
                swiperTentangKami.slideToLoop(index);
            }
        });
    });

    function adjustTextSize(swiper) {
        swiper.slides.forEach(slide => {
            const texts = slide.querySelectorAll('.text-dynamic');
            if (slide.classList.contains('swiper-slide-active')) {
                texts.forEach(el => {
                    el.classList.remove('text-sm');
                    el.classList.add('text-[15px]', 'md:text-[16px]');
                });
            } else {
                texts.forEach(el => {
                    el.classList.remove('text-[15px]', 'md:text-[16px]');
                    el.classList.add('text-sm');
                });
            }
        });
    }  
});
