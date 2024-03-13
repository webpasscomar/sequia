<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capa;
use App\Models\Indicador;
use Livewire\Component;

class Capas extends Component
{
    protected $capas;
    protected $listeners = ['delete', 'updateTable'];
    public $preserveInput = ['nombre', 'descripcion', 'color', 'frecuencia', 'organismo_id', 'orden'];

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
        $indicadores;


    public function render()
    {
        $this->capas = Capa::all();
        $this->indicadores = Indicador::all();

        return view('livewire.admin.capas', [
            'capas' => $this->capas,
            'indicadores' => $this->indicadores
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
                'titulo' => 'required',
                'indicador_id' => 'required'
            ];
        } else {
            return [
                'titulo' => 'required',
                'indicador_id' => 'required'
            ];
        }
    }

    // Mensajes
    protected function messages()
    {
        if ($this->accion == 'create') {
            return [
                'nombre.required' => 'El nombre es requerido',
                'indicador_id.required' => 'El indicador es requerido'
            ];
        } else {
            return [
                'nombre.required' => 'El nombre del indicador es necesario',
                'indicador_id.required' => 'El organismo es requerido'
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

        if ($this->georeferencial) {
            $file_name = $this->georeferencial->getClientOriginalName();
            $this->georeferencial->sotreAs('georeferencial', $file_name);
        } else {
            $file_name = $this->georeferencial;
        }

        Capa::updateOrCreate(
            ['id' => $this->capa_id],
            [
                'titulo' => $this->titulo,
                'indicador_id' => $this->indicador_id,
                'resumen' => $this->resumen,
                'georeferencial' => $this->georeferencial,
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
        $this->orden = '';
        $this->fechaDesde = '';
        $this->fechaHasta = '';
        $this->resetErrorBag();
    }
}
