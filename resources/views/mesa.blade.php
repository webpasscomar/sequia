@extends('layouts.app')

@section('title', $title)

@section('content')


  <!-- jumbotrob / título productos -->
  <div class="container-fluid p-0 mb-3">
    <div class="jumbotron jumbotron-fluid imagencover px-4 mb-0 d-flex align-items-center text-center mt-md-n2">
      <div class="container">
        <p class="text-black-50 display-5">{{ $title }}</p>
      </div>
    </div>
    <div class="bg-opacity-10 bg-black d-none d-lg-block d-sm-none">
      <div class="container mt-md-n5 pt-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent px-0 py-2">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
            <li class="breadcrumb-item active text-black" aria-current="page">{{ $title }}</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>



  <!-- contenido form / mapa -->
  <div class="container-md mt-5 mb-3">
    <div class="row">
      <!-- form -->
      <div class="col mb-3">
        <h1>Algún titulo opcional</h1>
        <p>La mesa nacional de monitoreo está compuesta por Eiusmod in veniam incididunt et culpa nisi non ullamco.
          Exercitation magna non aliquip labore in. Adipisicing
          ullamco ex excepteur non in nulla proident eu reprehenderit ipsum excepteur labore laboris anim. Cillum proident
          ut exercitation est dolore nisi cillum quis ipsum dolor deserunt nulla exercitation nulla.
        </p>
        <p>
          Cillum irure ipsum aliquip esse. Qui do laborum ut esse ipsum veniam in laborum ad. Tempor elit ea occaecat do
          id eiusmod nulla sint cillum dolor non adipisicing deserunt labore.
        </p>
        <p>
          Amet nostrud sint ea cupidatat cillum ad magna labore anim laboris. Enim voluptate tempor deserunt fugiat id
          laboris non. Laborum ut proident Lorem enim aute laborum nulla excepteur ex. Excepteur sit cupidatat
          exercitation qui fugiat excepteur excepteur sunt. Quis pariatur eu esse est ut aute nisi proident non.
          Reprehenderit esse ullamco sunt cillum cillum officia esse esse aliqua non ipsum quis. Excepteur incididunt et
          deserunt veniam tempor occaecat sint consectetur.</p>
      </div>

    </div>
  </div>


@endsection
