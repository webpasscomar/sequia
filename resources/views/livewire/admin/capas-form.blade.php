<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $showModal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">Capas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="titulo">Nombre:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <input type="text" class="form-control" id="titulo" wire:model="titulo">
                        @error('titulo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="indicador_id">Indicador:</label><span
                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <select id="indicador_id" class="form-select" wire:model="indicador_id">
                            <option value="">Seleccione un indicador</option>
                            @foreach ($indicadores as $indicador)
                                <option value="{{ $indicador->id }}">{{ $indicador->nombre }}</option>
                            @endforeach
                        </select>
                        @error('indicador_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="resumen">Descripción:</label>
                    <textarea rows="2" class="form-control" id="resumen" wire:model="resumen"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-label">Archivo:</label>
                        <button class="btn btn-outline-secondary" id="btnGeoreferencia">Cargar archivo <i
                                class="far fa-file-alt ml-1"></i></button>
                        @if ($georeferencial)
                            {{-- @if ($accion === 'create') --}}
                            <p class="mt-1 ml-1" title="{{ $georeferencial->getClientOriginalName() }}"><i
                                    class="fas fa-file-upload"></i>
                                Archivo cargado</p>
                            {{-- @elseif($accion === 'edit') --}}
                            {{-- <p class="mt-1 ml-1"><i class="fas fa-file-upload"></i> Archivo cargado</p> --}}
                            {{-- @endif --}}
                        @else
                            <p class="mt-1 ml-1">Sin archivos</p>
                        @endif
                        <input type="file" id="georeferencia" class="sr-only" wire:model="georeferencial">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="orden">Orden:</label>
                        <input type="number" min="0" id="orden" class="form-control" wire:model="orden">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="presentacion">Presentación:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <select class="form-select" id="presentacion" wire:model="presentacion">
                            <option value="">Seleccione presentación</option>
                            @foreach ($presentaciones as $presentacion)
                                <option value="{{ $presentacion }}">{{ $presentacion }}</option>
                            @endforeach
                        </select>
                        @error('presentacion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="fechaDesde">Fecha Desde:</label>
                        <input type="date" class="form-control" id="fechaDesde" wire:model="fechaDesde">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="fechaHasta">Fecha Hasta:</label>
                        <input type="date" class="form-control" id="fechaHasta" wire:model="fechaHasta">
                    </div>
                </div>

                {{-- Mensaje de campos obligatorios en el formulario --}}
                <div class="me-3 text-end">
                    <p class="fw-semibold" style="font-size: 12px;"><span class="text-danger fs-6 fw-semibold">*</span>
                        Campos Obligatorios</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-secondary" data-dismiss="modal">Cerrar
                </button>
                @if ($accion === 'create')
                    <button wire:click="store" class="btn btn-primary">Guardar</button>
                @elseif ($accion === 'edit')
                    <button wire:click="store" class="btn btn-primary">Actualizar</button>
                @endif
            </div>
        </div>
    </div>

    {{-- Enlazar botón de cargar archivo con input File --}}
    <script>
        console.log('prueba');
        document.getElementById('btnGeoreferencia').addEventListener('click', () => {
            document.getElementById('georeferencia').click();
        });
    </script>
</div>
