document.getElementById('menuToggle').addEventListener('click', function () {
  document.getElementById('mobileMenu').classList.toggle('hidden');
});

// Scroll Behavior Navbar
window.addEventListener('scroll', function () {
  const navbar = document.getElementById('mainNavbar');
  const scrollTextItems = document.querySelectorAll('.scroll-text');

  if (window.scrollY > 50) {
    navbar.classList.remove('bg-transparent');
    navbar.classList.add('bg-white', 'shadow-md');

    scrollTextItems.forEach(el => {
      el.classList.remove('text-white');
      el.classList.add('text-[#0F4696]');
    });
  } else {
    navbar.classList.add('bg-transparent');
    navbar.classList.remove('bg-white', 'shadow-md');

    scrollTextItems.forEach(el => {
      el.classList.remove('text-[#0F4696]');
      el.classList.add('text-white');
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  console.log("JavaScript Loaded");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const target = entry.target;
          const animation = target.getAttribute('data-animate');
          target.classList.remove('opacity-0');
          target.classList.add('animate-' + animation);
          observer.unobserve(target); // stop observing once animated
        }
      });
    },
    {
      threshold: 0.2,
    }
  );

  document.querySelectorAll('[data-animate]').forEach((el) => {
    observer.observe(el);
  });
});

import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/effect-coverflow';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

document.addEventListener('DOMContentLoaded', function () {
    const swiperTentangKami = new Swiper('.swiper-tentangkami', {
        direction: 'vertical',
        loop: true,
        centeredSlides: true,
        slidesPerView: 2.5,
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
      loop: true,
      spaceBetween: -50,
      centeredSlides: true,
      grabCursor: true,
      effect: 'coverflow',
      slidesPerView: 1.2,
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 2,
        slideShadows: false,
      },
      pagination: {
        el: '.swiper-galeri .swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 2.2,
        },
        1024: {
          slidesPerView: 3.2,
        }
      },
      on: {
        init: function () {
          syncSlideHeight();
        },
        resize: function () {
          syncSlideHeight();
        }
      }
    });
    
    function syncSlideHeight() {
      const ref = document.querySelector('.youtube-frame') || document.querySelector('iframe');
      const height = ref?.offsetHeight || 400;
    
      document.querySelectorAll('.swiper-galeri .swiper-slide').forEach(slide => {
        slide.style.height = height + 'px';
      });
    }
     

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
