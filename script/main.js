(function($, window, document) {
    AOS.init({
      once: true
    });
    
    const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: true
        
      });
      
      const navbar = document.getElementById("navbar");
      const logo = document.getElementById("logo");
      window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
          navbar.style.backgroundColor = "#ffffff"; // Cambia al color blanco cuando se desplaza
          logo.style.opacity = 1
        } else {
          logo.style.opacity = 0
          navbar.style.backgroundColor = "transparent"; // Fondo transparente cuando está en la parte superior
        }
      });

    const opener= document.getElementById("opener");
    const invMenu= document.getElementById('invMenu');
    const closer = document.getElementById('closer');
    opener.addEventListener('click', () => {
      
      invMenu.style.display = 'flex';

    })

    closer.addEventListener('click', () => {
      invMenu.style.display = 'none';
      invMenu.removeAttribute("data-aos");
      invMenu.setAttribute("data-aos-duration");
    })

    document.querySelectorAll(".closerMenu").forEach(element => {
      element.addEventListener('click', () => {
        invMenu.style.display = 'none';
      });
    });
}(window.jQuery, window, document));