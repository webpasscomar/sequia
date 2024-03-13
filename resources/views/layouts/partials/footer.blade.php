    <!-- footer -->
    <div class="bg-dark">
      <div class="container py-4 small">
        <div class="row">
          <!-- contacto -->
          <div class="col-md-3 mb-3">
            <p class="h6 fw-bold text-white">Contacto</p>
            <ul class="list-unstyled light text-light">
              <li> Av. San Martín 451 (1000) <br>
                C.A.B.A. - Argentina</li>
              <li class="pt-3 pb-2 fw-bold h5 text-white">11 4444-4444</li>
            </ul>
            <p class="h6 fw-bold text-white">Horarios</p>
            <span class="text-light light"> lun a vier 9 a 18:00</span>
          </div>
          <!-- categorias -->
          <div class="col-md-3 mb-3">
            <p class="h6 fw-bold text-white">Mapa del sitio</p>
            <ul class="list-unstyled text-white-50 light">
              <li><a href="{{ route('mesa') }}" class="text-decoration-none link-light"
                  title="Mesa nacional del monitor"> Mesa nacional del monitor
                </a></li>
              <li><a href="{{ route('proceso') }}" class="text-decoration-none link-light" title="Proceso de trabajo">
                  Proceso de trabajo
                </a></li>
              <li><a href="{{ route('referencias') }}" class="text-decoration-none link-light" title="Referencias">
                  Referencias </a></li>
              <li><a href="/" class="text-decoration-none link-light" title="Indices">
                  Indices </a></li>

              <li><a href="{{ route('contacto') }}" class="text-decoration-none link-light" title="Nuestros contactos">
                  Contacto </a>
              </li>
            </ul>
          </div>
          <!-- data fiscal -->
          <div class="col-md-3 mb-3">
            <p class="h6 fw-bold text-white">Organismos</p>
            <img src="{{ asset('img/organismo1.png') }}" title="Organismo 1">
          </div>
          <!-- redes -->
          <div class="col-md-3">
            <p class="h6 fw-bold text-white">Nuestras redes</p>
            <ul class="list-group list-group-horizontal">
              <li class="list-group-item bg-transparent ps-0 border-0 light text-light">
                <a href="/" class="text-decoration-none link-light" title="Mirá nuestro canal de youtube"> <i
                    class="fa-brands fa-youtube"></i> </a>
              </li>
              <li class="list-group-item bg-transparent ps-0 border-0 light text-light">
                <a href="/" class="text-decoration-none link-light" title="Nuestro Instagram"> <i
                    class="fa-brands fa-instagram"></i> </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN footer -->


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Leaflet CSS y JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" charset="utf-8">
      // tooltip
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });

      // menú dropdown hover
      const $dropdown = $(".dropdown");
      const $dropdownToggle = $(".dropdown-toggle");
      const $dropdownMenu = $(".dropdown-menu");
      const showClass = "show";

      $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 768px)").matches) {
          $dropdown.hover(
            function() {
              const $this = $(this);
              $this.addClass(showClass);
              $this.find($dropdownToggle).attr("aria-expanded", "true");
              $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
              const $this = $(this);
              $this.removeClass(showClass);
              $this.find($dropdownToggle).attr("aria-expanded", "false");
              $this.find($dropdownMenu).removeClass(showClass);
            }
          );
        } else {
          $dropdown.off("mouseenter mouseleave");
        }
      });

      // search animado
      const searchBtn = document.querySelector('#searchBtn');
      const animatedInput = document.querySelector('#animated-input');

      searchBtn.addEventListener('click', openSearch);

      function openSearch(e) {
        animatedInput.focus();
      }
      // Check if there is text in input every 50ms
      setInterval(function() {
        if (animatedInput.value) {
          animatedInput.style.width = '225px';
        }
      }, 50);
    </script>
