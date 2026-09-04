
document.addEventListener("DOMContentLoaded", function () {
  const counters = document.querySelectorAll(".counter");
  let started = false;

  function runCounters() {
    counters.forEach(counter => {
      const target = +counter.dataset.target;
      const speed = 200;

      const update = () => {
        const current = +counter.innerText;
        const increment = Math.ceil(target / speed);

        if (current < target) {
          counter.innerText = current + increment;
          setTimeout(update, 20);
        } else {
          counter.innerText = target;
        }
      };

      update();
    });
  }

  window.addEventListener("scroll", () => {
    const firstStat = document.querySelector(".iwca-stat");
    if (!firstStat) return;

    const position = firstStat.getBoundingClientRect().top;
    if (position < window.innerHeight && !started) {
      started = true;
      runCounters();
    }
  });
});



/** ============================================================
 *  JS File for Kipya Template
 *===============================================================*/
$(document).ready(function() {
    $('.menu-item').hover(
        function() {
            $(this).children('.sub-menu').stop(true, true).slideDown(200); // Adjust the speed as needed
        },
        function() {
            $(this).children('.sub-menu').stop(true, true).slideUp(200);
        }
    );
});

/** ============================================================================
 * HEADER SCROLL
*=============================================================================*/
document.addEventListener("DOMContentLoaded", function() {
    var header = document.querySelector('.menu-section');
    var header2 = document.querySelector('.menu-section2');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('sticky-header');           
            header2.classList.add('sticky-header');
        } else {
            header.classList.remove('sticky-header');
            header2.classList.remove('sticky-header');
        }
    });
});



/**====================================================
   * Slides - Animation JS
   *====================================================**/


 
document.addEventListener('DOMContentLoaded', function() {
    // Initialize thumbnail slider first
    const thumbnailSwiper = new Swiper('.thumbnail-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        freeMode: true,
        watchSlidesProgress: true,
        centeredSlides: true,
        breakpoints: {
            320: {
                slidesPerView: 3,
            },
            768: {
                slidesPerView: 5,
            },
            1024: {
                slidesPerView: 7,
            }
        }
    });

    // Initialize main slider with thumbs control
    const mainSwiper = new Swiper('.main-swiper', {
        loop: true,
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        thumbs: {
            swiper: thumbnailSwiper,
        },
    });
});

function thmSwiperInit() {
    // swiper slider
    if ($(".thm-swiper__slider").length) {
      $(".thm-swiper__slider").each(function () {
        let elm = $(this);
        let options = elm.data('swiper-options');
        let thmSwiperSlider = new Swiper(elm, options);
      });
    }
  }
  if ($(".banner-bg-slide").length) {
    $(".banner-bg-slide").each(function () {
      var Self = $(this);
      var bgSlideOptions = Self.data("options");
      var bannerTwoSlides = Self.vegas(bgSlideOptions);
    });
  }
  if ($(".wow").length) {
    var wow = new WOW({
      boxClass: "wow", // animated element css class (default is wow)
      animateClass: "animated", // animation css class (default is animated)
      mobile: true, // trigger animations on mobile devices (default is true)
      live: true // act on asynchronously loaded content (default is true)
    });
    wow.init();
  }
    // window load event
    $(window).on("load", function () {

      thmSwiperInit();
      handlePreloader();
      languageSwitcher();
      projectMasonaryLayout();
  
  
      //Jquery Spinner / Quantity Spinner
      if ($('.quantity-spinner').length) {
        $("input.quantity-spinner").TouchSpin({
          verticalbuttons: true
        });
      }
  
    });

/**====================================
* AOS
=====================================**/
     document.addEventListener('DOMContentLoaded', function () {
    // Initialize AOS for each column
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false,
        });
    }
});
 /**====================================
     * HIDE OVERFLOW
=====================================**/
     
(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		$("html").attr("style", "overflow-x:hidden;");
		
	});
	
})(jQuery, this);


document.addEventListener('DOMContentLoaded', function() {
  const counters = document.querySelectorAll('.kpy-counter');
  const speed = 500000; // Animation duration in ms
  
  function animateCounters() {
    counters.forEach(counter => {
      const target = +counter.getAttribute('data-target');
      const count = +counter.innerText.replace('+','');
      const increment = target / speed;
      
      if (count < target) {
        counter.innerText = Math.ceil(count + increment) + '+';
        setTimeout(animateCounters, 1);
      } else {
        counter.innerText = target.toLocaleString() + '+';
      }
    });
  }
  
  // Trigger on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  document.querySelector('.kpy-impact-metrics').style.opacity = '1';
  observer.observe(document.querySelector('.kpy-impact-metrics'));
});


document.addEventListener("DOMContentLoaded", function () {
  const sections = document.querySelectorAll('.scroll-section');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        // Uncomment to trigger only once
        // observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.1
  });

  sections.forEach(section => {
    observer.observe(section);
  });
});



document.addEventListener('DOMContentLoaded', function() {
  const eventsSection = document.querySelector('.kpy-events-section');
  
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
      }
    });
  }, { threshold: 0.1 });
  
  if (eventsSection) {
    observer.observe(eventsSection);
  }
});


/* Add this JavaScript to trigger animations on scroll */
document.addEventListener('DOMContentLoaded', function() {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('in-view');
      }
    });
  }, { threshold: 0.1 });
  
  document.querySelectorAll('.kpy-story-section, .kpy-values-section').forEach(section => {
    observer.observe(section);
  });
});


// Simple scroll animation trigger
document.addEventListener('DOMContentLoaded', function() {
    // Elements to animate
    const sections = [
        document.querySelector('.quick-view'),
        document.querySelector('.kpy-services-grid-wrapper'),
        document.querySelector('.kpy-news-slider-container')
    ];
    
    // Check if element is in viewport
    function isInViewport(element) {
        if (!element) return false;
        const rect = element.getBoundingClientRect();
        return (
            rect.top <= (window.innerHeight * 0.8) &&
            rect.bottom >= 0
        );
    }
    
    // Add scroll-visible class when in view
    function checkScroll() {
        sections.forEach(section => {
            if (section && isInViewport(section)) {
                section.classList.add('scroll-visible');
            }
        });
    }
    
    // Run on load and scroll
    checkScroll();
    window.addEventListener('scroll', checkScroll);
    
    // Also check on resize
    window.addEventListener('resize', checkScroll);
});






   