@extends('layouts.app')
@section('title', 'Inicio')

@section('content')


  <!-- jumbotrob / título productos -->
  <div class="container-fluid p-0 mb-3">
    {{-- <div class="jumbotron jumbotron-fluid imagencover px-4 mb-0 d-flex align-items-center text-center mt-md-n2">
      <div class="container">
        <p class="text-black-50 display-5">{{ $title }}</p>
      </div>
    </div> --}}
    <div class="bg-opacity-10 bg-black d-none d-lg-block d-sm-none">
      <div class="container mt-md-n5 pt-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent px-0 py-2">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Inicio</a></li>
            {{-- <li class="breadcrumb-item active text-black" aria-current="page">{{ $title }}</li> --}}
          </ol>
        </nav>
      </div>
    </div>
  </div>

  <div class="container-md mt-5 mb-3">
    <div class="row">
      <!-- Columna izquierda con mapa y gráfico -->
      <div class="col-md-6 mb-3 mt-3">
        <div id="map" style="height: 600px;"></div>
        <div id="chart" style="height: 300px;"></div>
      </div>


      <!-- Columna derecha con indicadores y texto -->
      <div class="col-md-6 mb-3">
        <div class="row">
          <h2>Indicadores del mapa</h2>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h4>Indicador 1</h4>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h4>Indicador 2</h4>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h4>Indicador 3</h4>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h4>Indicador 4</h4>
              </div>
            </div>
          </div>

        </div>

        {{-- <div class="card">
          <div class="card-body">
            <!-- Contenido de los indicadores -->
           @foreach ($indicators as $indicator)
              <div>{{ $indicator }}</div>
            @endforeach 
          </div>
        </div> --}}

        <hr>
        <h2>Texto del informe</h2>

        <div class="mt-4">
          <!-- Bloque de texto -->
          {{-- <p>{{ $textBlock }}</p> --}}
          <p>Amet enim ea veniam duis mollit mollit pariatur ullamco nulla ex laborum esse quis minim. Ipsum occaecat
            ipsum eu anim nostrud. Tempor sit nulla incididunt mollit anim ullamco labore.
          </p>
          <p>
            Tempor anim esse incididunt aliqua officia do ut commodo mollit aliquip mollit. Labore dolore fugiat
            consectetur excepteur ullamco est eiusmod adipisicing ipsum ea nulla minim. Esse id id irure amet culpa anim
            qui. Commodo laborum minim sit laboris id fugiat ullamco. In dolore occaecat amet laborum commodo labore quis
            commodo. Est et irure nostrud incididunt incididunt.
          </p>
          <p>
            Ex sunt labore velit occaecat. Cillum Lorem qui tempor proident aliqua amet ad elit. Dolor exercitation
            reprehenderit pariatur ea. Aliquip voluptate nulla irure sint.
          </p>
          <p>
            Cillum amet est dolore elit adipisicing aute reprehenderit irure ut ea. Laboris dolor tempor cupidatat
            exercitation commodo voluptate pariatur Lorem excepteur ea. Ad dolor tempor ut et. Eu sint voluptate commodo
            occaecat. Laborum eu proident reprehenderit duis ea elit irure tempor labore.
          </p>
          Ullamco laboris pariatur do minim laboris mollit et dolor. Labore voluptate cillum Lorem irure eiusmod in. In
          enim dolore quis exercitation tempor excepteur eu velit. Nulla irure velit tempor culpa aute. Qui minim
          exercitation sint sunt esse cillum aute. Do dolore labore esse ad consequat enim.

          Aute magna dolor consequat consectetur incididunt sit. Adipisicing consequat magna exercitation fugiat sunt
          irure occaecat. Id consectetur ullamco ullamco consequat. Pariatur magna esse enim esse quis consectetur
          ullamco exercitation dolor reprehenderit. Proident pariatur cillum cupidatat voluptate incididunt quis cillum
          consequat laborum amet tempor aute.</p>
        </div>
      </div>
    </div>
  </div>


  <!-- Código para inicializar el mapa en el script -->
  <script>
    var mapa = L.map('map').setView([-38.416097, -63.616672], 4);

    // Agregar la capa base de IGN utilizando TMS
    var ignLayer = L.tileLayer(
      'https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/capabaseargenmap@EPSG%3A3857@png/{z}/{x}/{y}.png', {
        tms: true,
        attribution: 'IGN Argentina'
      }).addTo(mapa);

    // Agregar la capa vectorial de IGN
    var vectorLayer = L.tileLayer.wms('https://wms.ign.gob.ar/geoserver/ows?', {
      layers: 'area_protegida', // Reemplaza 'nombre_de_la_capa' con el nombre real de la capa vectorial
      format: 'image/png',
      transparent: true,
      attribution: 'IGN Argentina'
    }).addTo(mapa);

    // Agregar la capa vectorial de IGN
    var vectorLayer2 = L.tileLayer.wms('https://wms.ign.gob.ar/geoserver/ows?', {
      layers: 'areas_de_gestion_de_residuos_AB000', // Reemplaza 'nombre_de_la_capa' con el nombre real de la capa vectorial
      format: 'image/png',
      transparent: true,
      attribution: 'IGN Argentina'
    }).addTo(mapa);


    // Agregar un marcador en el centro de Argentina
    var centroArgentina = L.marker([-38.416097, -63.616672]).addTo(mapa);

    // Definir control de capas
    var controlCapas = L.control.layers(null, {
      'Área Protegida': vectorLayer,
      'Áreas de Gestión de Residuos': vectorLayer2
    }).addTo(mapa);

    // Crear control de capas con estructura de árbol
    // var controlCapas = L.control.layers.tree({
    //   'Capas Base': {
    //     'IGN Argentina': ignLayer
    //   },
    //   'Capas Vectoriales IGN': {
    //     'Área Protegida': vectorLayer,
    //     'Áreas de Gestión de Residuos': vectorLayer2
    //   }
    // }).addTo(mapa);
  </script>



  <!-- Código para inicializar el gráfico en el script -->
  <script>
    var ctx = document.getElementById('chart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Dato 1', 'Dato 2', 'Dato 3', 'Dato 4'],
        datasets: [{
          label: 'Ejemplo de Gráfico de Barras',
          data: [12, 19, 3, 5],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>



@endsection
