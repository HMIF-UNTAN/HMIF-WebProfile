// Mobile Menu Dropdown Toggle
document.getElementById('menuToggle').addEventListener('click', function () {
  const menu = document.getElementById('mobileMenu');

  if (menu.classList.contains('max-h-0')) {
    menu.classList.remove('max-h-0', 'py-0');
    menu.classList.add('max-h-96', 'py-4');
  } else {
    menu.classList.remove('max-h-96', 'py-4');
    menu.classList.add('max-h-0', 'py-0');
  }
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

document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.divisi-button');
  const sections = document.querySelectorAll('.divisi-section');
  let isTransitioning = false;

  function clearTextWithFade(section, callback) {
    const elements = section.querySelectorAll('.blur-in-out-text');
    elements.forEach(el => {
      el.style.transition = 'opacity 1s ease-out';
      el.style.opacity = '0';
    });

    setTimeout(() => {
      if (callback) callback();
    }, 300);
  }

  function showSection(section) {
    section.classList.remove('hidden');
    setTimeout(() => {
      section.classList.remove('opacity-0');
      const elements = section.querySelectorAll('.blur-in-out-text');
      elements.forEach(el => {
        el.style.opacity = '1';
        el.innerHTML = el.dataset.text;
      });
      isTransitioning = false;
    }, 10);
  }

  function switchSection(newId) {
    if (isTransitioning) return;
    isTransitioning = true;

    const newSection = document.getElementById(newId);
    const currentSection = Array.from(sections).find(s => !s.classList.contains('hidden'));

    if (currentSection && currentSection !== newSection) {
      clearTextWithFade(currentSection, () => {
        currentSection.classList.add('opacity-0');
        setTimeout(() => {
          currentSection.classList.add('hidden');
          currentSection.classList.remove('opacity-0');
          showSection(newSection);
        }, 200);
      });
    } else if (!currentSection) {
      showSection(newSection);
    } else {
      isTransitioning = false;
    }
  }

  function setActiveButton(button) {
    const targetId = button.getAttribute('data-target');
  
    buttons.forEach(btn => {
      btn.classList.remove(
        'bg-white', 'text-[#0F4696]', 'shadow-md', '!font-bold', '!font-normal', 'shadow-2xl'
      );
      btn.classList.add(
        'bg-transparent', 'text-gray-500', 'shadow-none', '!font-normal'
      );
    });
  
    button.classList.add(
      'bg-white', 'text-[#0F4696]', 'shadow-md', '!font-bold', 'shadow-2xl'
    );
    button.classList.remove(
      'bg-transparent', 'text-gray-500', 'shadow-none', '!font-normal'
    );
  
    switchSection(targetId);
  }  

  buttons.forEach(button => {
    button.addEventListener('click', () => setActiveButton(button));
  });

  // Tampilkan pertama
  if (buttons.length) {
    setActiveButton(buttons[0]);
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const chars = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
  const elements = document.querySelectorAll(".typewriter-text");
  let hasAnimated = false;
  let isScrambling = false;

  function scrambleEffect(el, text, delay = 60, cycles = 8) {
    const letters = text.split("");
    let frame = 0;
    el.textContent = "";

    const interval = setInterval(() => {
      const output = letters.map((char, i) => {
        if (i < frame - cycles) return char;
        return chars[Math.floor(Math.random() * chars.length)];
      });
      el.textContent = output.join("");

      frame++;
      if (frame - cycles > letters.length) {
        clearInterval(interval);
        el.textContent = text;
      }
    }, delay);
  }

  function startScrambleIfVisible() {
    if (hasAnimated || isScrambling) return;

    const triggerAdvance = 200;
    const container = document.querySelector("#statistik-container");
    if (!container) return;

    const rect = container.getBoundingClientRect();
    const triggerPoint = window.innerHeight + triggerAdvance;

    if (rect.top < triggerPoint) {
      isScrambling = true; // cegah pemicu ulang selama animasi jalan
      elements.forEach(el => {
        const text = el.dataset.text || "";
        if (text) scrambleEffect(el, text);
      });
      hasAnimated = true; // setelah yakin semua scramble dimulai
      window.removeEventListener("scroll", onScroll);
    }
  }

  function onScroll() {
    requestAnimationFrame(startScrambleIfVisible);
  }

  window.addEventListener("scroll", onScroll);
  startScrambleIfVisible();
});

document.addEventListener("DOMContentLoaded", function () {
  const popup = document.getElementById('successPopup');
  if (popup) {
    // Tampilkan popup dengan animasi masuk
    popup.classList.remove('hidden');
    popup.classList.add('flex');
  }

  // Fungsi untuk menutup popup
  window.closePopup = function () {
    if (popup) {
      popup.classList.add('opacity-0');
      setTimeout(() => {
        popup.remove();
      }, 300); // tunggu animasi selesai baru hapus dari DOM
    }
  };
});
