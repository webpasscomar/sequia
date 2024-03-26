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
            <label for="nombre">Nombre:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
            <input type="text" class="form-control" id="nombre" wire:model.debounce.3000ms="titulo">
            @error('nombre')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group col-md-6">
            <label for="indicador_id">Indicador:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
            <select id="indicador_id" class="form-select" wire:model.lazy="indicador_id">
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
          <textarea rows="2" class="form-control" id="resumen" wire:model.debounce.3000ms="resumen"></textarea>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label for="fechaDesde">Desde:</label>
            <input type="date" id="fechaDesde" class="form-control" wire:model="fechaDesde">
          </div>
          <div class="form-group col-md-6">
            <label for="fechaHasta">Hasta:</label>
            <input type="date" min="0" id="fechaHasta" class="form-control" wire:model="fechaHasta">
          </div>
          <div class="form-group">
            <label for="capaFilename" class="custom-file-upload ">
                Archivo de capa:
            </label>
            <span id="file-name"></span>
            <input type="file" id="capaFilename" class="form-control" wire:model="capaFilename">
            @error('capaFilename')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
          {{-- <div class="form-group col-md-8">
            <label for="frecuencia">Frecuencia:</label><span class="ms-1 text-danger fs-6 fw-semibold">*</span>
            <select class="form-select" id="frecuencia" wire:model="frecuencia">
              <option value="">Seleccione una frecuencia</option>
              @foreach ($frecuencias as $frecuencia)
                <option value="{{ $frecuencia }}">{{ $frecuencia }}</option>
              @endforeach
            </select>
            @error('frecuencia')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div> --}}
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
