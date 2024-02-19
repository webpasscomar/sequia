@section('title', 'Admin Capas')

<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-8 mt-4 col-6">
                <h3>Capas</h3>
            </div>
            <div class="col-md-4 text-right mt-3 mt-md-4 col-6">
                <button wire:click="create" class="btn btn-success" data-toggle="modal" data-target="#roleModal"><i
                        class="fas fa-plus-circle mr-2" style="color: white;"></i>Agregar
                </button>
            </div>
        </div>

        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered mt-3 datatable" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descipción</th>
                            <th scope="col">Orden</th>
                            <th scope="col">Indicador</th>
                            <th scope="col" class="text-center" style="width: 15%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indicadores as $indicador)
                            <tr>
                                <th scope="row" class="align-middle">{{ $indicador->id }}</th>
                                <td class="align-middle">{{ $indicador->nombre }}</td>
                                <td class="align-middle">{{ $indicador->descripcion }}</td>
                                <td class="align-middle">{{ $indicador->orden }}</td>
                                <td class="align-middle">{{ $indicador->organismo->nombre }}</td>
                                <td class="align-middle">
                                    <div class="d-flex flex-md-row gap-1 justify-content-evenly">
                                        <div class="m-1 mt-3">
                                            <livewire:toggle-button :model="$indicador" field="estado"
                                                key="{{ $indicador->id }}" />
                                        </div>
                                        <button wire:click="edit({{ $indicador->id }})"
                                            class="btn btn-sm btn-primary m-1" data-toggle="modal"
                                            data-target="#roleModal" title="Editar"><i class="fa fa-edit"></i></button>
                                        <button wire:click="$emit('alertDelete',{{ $indicador->id }})"
                                            class="btn btn-sm btn-danger m-1" title="Eliminar"><i
                                                class="fas fa-trash-alt" style="color: white "></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{--    Mostrar modal para agregar o editar indicadores --}}
    @if ($showModal == 'block')
        @include('livewire.admin.indicadores-form')
    @endif
</div>
