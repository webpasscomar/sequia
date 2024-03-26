<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capa;
use App\Models\Indice;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Capas extends Component
{
    use WithFileUploads;

    protected $capas;
    protected $listeners = ['delete', 'updateTable'];
    public $preserveInput = ['titulo', 'resumen', 'color', 'fechaDesde', 'fechaHasta', 'frecuencia', 'organismo_id', 'orden', 'capaFilename'];

    public $showModal = 'none';
    public $capa_id,
        $indicador_id,
        $accion,
        $titulo,
        $resumen,
        $status,
        $orden,
        $presentacion,
        $fechaDesde,
        $fechaHasta,
        $georeferencial,
        $capaFilename,
        $indicadores;


    public function render()
    {
        $this->capas = Capa::all();
        $this->indicadores = Indice::all();

        return view('livewire.admin.capas', [
            'capas' => $this->capas,
            'indicadores' => $this->indicadores
        ])->layout('layouts.adminlte');
    }

    // Actualizar datos del dataTables para la paginación y estilos de la tabla
    public function updateTable()
    {
        $this->emit('table');
    }

    //Validar campos de formulario Organismo
    protected function rules()
    {
        if ($this->accion == 'create') {
            return [
                'titulo' => 'required',
                'indicador_id' => 'required',
                'capaFilename' => 'mimes:rar,zip',
            ];
        } else {
            return [
                'titulo' => 'required',
                'indicador_id' => 'required',
                'capaFilename' => 'mimes:rar,zip',
            ];
        }
    }

    // Mensajes
    protected function messages()
    {
        if ($this->accion == 'create') {
            return [
                'titulo.required' => 'El nombre es requerido',
                'indicador_id.required' => 'El indicador es requerido',
                'capaFilename.mimes' => 'Solamente se permiten archivos .rar o .zip'
            ];
        } else {
            return [
                'titulo.required' => 'El nombre del indicador es necesario',
                'indicador_id.required' => 'El organismo es requerido',
                'capaFilename.mimes' => 'Solamente se permiten archivos .rar o .zip'
            ];
        }
    }

    // Crear un nuevo Organismo abriendo el modal del formulario
    public function create()
    {
        $this->accion = 'create';
        $this->resetInputField();
        $this->openModal();
    }

    // Editar un organismo
    public function edit($id)
    {
        $this->accion = 'edit';

        $capa = Capa::findOrFail($id);

        $this->capa_id = $capa->id;
        $this->indicador_id = $capa->indicador_id;
        $this->titulo = $capa->titulo;
        $this->resumen = $capa->resumen;
        $this->presentacion = $capa->presentacion;
        $this->georeferencial = $capa->georeferencial;
        $this->fechaDesde = $capa->fechaDesde;
        $this->fechaHasta = $capa->fechaHasta;
        $this->status = $capa->status;
        $this->orden = $capa->orden;

        $this->openModal();
    }

    // Guardar ó actualzar el Organismo
    public function store()
    {
        $this->validate();

        /* ESTO VUELA, NO??? */
        if ($this->georeferencial) {
            $file_name = $this->georeferencial->getClientOriginalName();
            $this->georeferencial->storeAs('georeferencial', $file_name);
        } else {
            $file_name = $this->georeferencial;
        }

        $capa = Capa::updateOrCreate(
            ['id' => $this->capa_id],
            [
                'titulo' => $this->titulo,
                'indice_id' => $this->indicador_id,
                'resumen' => $this->resumen,
                //'georeferencial' => $this->georeferencial,
                'geom_capa' => $this->georeferencial,
                //'presentacion' => $this->presentacion,
                'fechaDesde' => $this->fechaDesde,
                'fechaHasta' => $this->fechaHasta,
                'orden' => $this->orden,
                'status' => 1,
            ]
        );

        $capa_filename = null;
        if ($this->capaFilename) {
            $date = date('Ymdhis');
            $path = "indices/{$this->indicador_id}";
            $capa_filename = "{$capa->id}-{$date}.{$this->capaFilename->getClientOriginalExtension()}";
            $this->capaFilename->storeAs(
                $path,
                $capa_filename,
                'local'
            );
            $capa->capa_filename = $capa_filename;
            $capa->save();
        }

        $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
        $this->resetInputField();
        $this->closeModal();
    }

    // Borrar un organismo
    public function delete($id)
    {
        Capa::find($id)->delete();
        $this->emit('mensajePositivo', ['mensaje' => 'Organismo eliminado correctamente']);
        $this->emit('table');
    }

    // Abrir el modal del formulario
    public function openModal()
    {
        $this->emit('table');
        $this->showModal = 'block';
    }

    // Cerrar el modal del formulario
    public function closeModal()
    {
        $this->emit('table');
        $this->showModal = 'none';
        $this->resetInputField();
    }

    private function resetInputField()
    {
        $this->titulo = '';
        $this->resumen = '';
        $this->georeferencial = '';
        $this->presentacion = '';
        $this->status = 1;
        $this->indicador_id = '';
        $this->capa_id = 0;
        $this->orden = '';
        $this->fechaDesde = '';
        $this->fechaHasta = '';
        $this->resetErrorBag();
    }
}
