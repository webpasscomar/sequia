<!-- NAV / menú -->
<header class="sticky-md-top border-top border-5 border-primary">
  <nav class="container-fluid navbar navbar-expand-lg bg-white py-0 menutop shadow">
    <div class="container-md">
      <a class="navbar-brand col-6 col-md-3 col-lg-3" href="{{ route('home') }}" title="Inicio del Monitor">
        <!-- logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Monitor de Sequía" class="img-fluid float-left">
        <h1 class="visually-hidden"> Monitor de Sequía</h1>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div>
        <livewire:menu />
      </div>



    </div>
  </nav>
</header>
