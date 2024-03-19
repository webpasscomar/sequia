<div>
  {{-- The whole world belongs to you. --}}
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item {{ request()->routeIS('mesa') ? 'active' : 'mesa' }}">
        <a href="{{ route('mesa') }}" title="Página principal" class="nav-link">Mesa nacional del monitor<span
            class="visually-hidden">(Mesa)</span></a>
      </li>
      <li class="nav-item {{ request()->routeIS('proceso') ? 'active' : 'proceso' }}">
        <a href="{{ route('proceso') }}" title="Nuestros servicios" class="nav-link">Proceso de trabajo</a>
      </li>
      <li class="nav-item {{ request()->routeIS('referencias') ? 'active' : 'referencias' }}">
        <a href="{{ route('referencias') }}" title="Nuestras actividades" class="nav-link">Referencias</a>
      </li>
      <li class="nav-item dropdown {{ request()->routeIS('indices') ? 'active' : '' }}">
        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Indices
        </a>
        <div class="dropdown-menu bg-light mt-1 shadow-sm" aria-labelledby="navbarDropdown">
          @foreach ($indices as $indice)
            <a class="dropdown-item" wire:click="seleccionarIndice({{ $indice->id }})"">{{ $indice->nombre }}</a>
          @endforeach
        </div>
      </li>
      <li class="nav-item {{ request()->routeIS('contacto') ? 'active' : 'contacto' }}">
        <a href="{{ route('contacto') }}" title="Contactanos" class="nav-link">Contacto</a>
      </li>
      <!-- buscador -->
      <li class="nav-item search">
        <form>
          <div class="animated-search m-md-0 mb-sm-4">
            <input type="search" id="animated-input">
            <a href="#">
              <i class="fas fa-search" id="searchBtn"></i>
            </a>
          </div>
        </form>
      </li>
    </ul>
  </div>
</div>
