<div class="modal fade show" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true"
    style="display: {{ $showModal }}; background-color:rgba(51,51,51,0.9);">

    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3332;">
                <h5 class="modal-title" id="roleModalLabel">Indicadores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <input type="text" class="form-control" id="nombre" wire:model="nombre">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="organismo_id">Organismo:</label><span
                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <select id="organismo_id" class="form-select" wire:model="organismo_id">
                            <option value="">Seleccione un organismo</option>
                            @foreach ($organismos as $organismo)
                                <option value="{{ $organismo->id }}">{{ $organismo->nombre }}</option>
                            @endforeach
                        </select>
                        @error('organismo_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea rows="2" class="form-control" id="descripcion" wire:model="descripcion"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <label for="color">Color:</label>
                        <input type="color" id="color" class="form-control" wire:model="color">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="orden">Orden:</label>
                        <input type="number" min="0" id="orden" class="form-control" wire:model="orden">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="frecuencia">Frecuencia:</label><span
                            class="ms-1 text-danger fs-6 fw-semibold">*</span>
                        <select class="form-select" id="frecuencia" wire:model="frecuencia">
                            <option value="">Seleccione una frecuencia</option>
                            @foreach ($frecuencias as $frecuencia)
                                <option value="{{ $frecuencia }}">{{ $frecuencia }}</option>
                            @endforeach
                        </select>
                        @error('frecuencia')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
</div>
