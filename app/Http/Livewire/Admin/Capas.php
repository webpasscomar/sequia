<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capa;
use App\Models\Indicador;
use Livewire\Component;
use Livewire\WithFileUploads;

class Capas extends Component
{
    protected $capas;
    protected $listeners = ['delete', 'updateTable'];
    public $preserveInput = ['nombre', 'descripcion', 'color', 'frecuencia', 'organismo_id', 'orden', 'fechaDesde', 'fechaHasta'];

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
        $georeferencial;

    use WithFileUploads;

    public function render()
    {
        $this->capas = Capa::orderBy('titulo', 'asc')->get();
        $indicadores = Indicador::all();
        $enumPresentacion = ['Vectorial', 'Puntos', 'Poligono'];

        return view('livewire.admin.capas', [
            'capas' => $this->capas,
            'indicadores' => $indicadores,
            'presentaciones' => $enumPresentacion
        ])
            ->layout('layouts.adminlte');
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
                'titulo' => 'required|min:3',
                'indicador_id' => 'required',
                'presentacion'=>'required',
                'fechaDesde'=> 'nullable|date'
            ];
        } else {
            return [
                'titulo' => 'required',
                'indicador_id' => 'required',
                'presentacion'=>'required',
                'fechaDesde'=> 'nullable'
            ];
        }
    }

    // Mensajes
    protected function messages()
    {
        if ($this->accion == 'create') {
            return [
                'titulo.required' => 'El nombre es requerido',
                'titulo.min' => 'Escriba 3 caracteres mínimo',
                'indicador_id.required' => 'El indicador es requerido',
                'presentacion.required'=> 'Campo requerido'
            ];
        } else {
            return [
                'titulo.required' => 'El nombre es requerido',
                'titulo.min' => 'Escriba 3 caracteres mínimo',
                'indicador_id.required' => 'El organismo es requerido',
                'presentacion.required'=> 'Campo requerido'
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

        // if ($this->georeferencial) {

        //     $file_name = $this->georeferencial->getClientOriginalName();
        //     $this->georeferencial->storeAs('georeferencial', $file_name);
        // } else {
        //     $file_name = $this->georeferencial;
        // }


        Capa::updateOrCreate(
            ['id' => $this->capa_id],
            [
                'titulo' => $this->titulo,
                'indicador_id' => $this->indicador_id,
                'resumen' => $this->resumen,
                // 'georeferencial' => $this->georeferencial,
                'presentacion' => $this->presentacion,
                'fechaDesde' => $this->fechaDesde,
                'fechaHasta' => $this->fechaHasta,
                'orden' => $this->orden,
                'status' => 1,
            ]
        );
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
        $this->orden = null;
        $this->fechaDesde = null;
        $this->fechaHasta = null;
        $this->resetErrorBag();
    }
}
