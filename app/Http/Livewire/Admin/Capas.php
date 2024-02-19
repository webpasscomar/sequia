<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Capas extends Component
{
    protected $indicadores;
    protected $listeners = ['delete', 'updateTable'];
    public $preserveInput = ['nombre', 'descripcion', 'color', 'frecuencia', 'organismo_id', 'orden'];

    public $showModal = 'none';
    public $capa_id,
        $indicador_id,
        $accion,
        $titulo,
        $resumen,
        $status,
        $presentacion,
        $fechaDesde,
        $fechaHasta,
        $georeferencial,
        $latitude, //para datos geometricos
        $longitude, // para datos geometricos
        $punto; // guarda el dato geométrico cuando es de tipo punto

    // Array para guardar datos geométricos de tipo vector - mínimo son 2 pares   
    public $puntosVector = [
        ['latitude' => '', 'longitude' => ''],
        ['latitude' => '', 'longitude' => ''],
    ];

    //Array para guardar datos de tipo geométricos para polygonos - mínimo 3 pares
    public $puntosPoligono = [
        ['latitude' => '', 'longitude' => ''],
        ['latitude' => '', 'longitude' => ''],
        ['latitude' => '', 'longitude' => ''],
    ];

    // Agregar puntos en vector ó poligono si hacen falta dependiendo de la presentación seleccionada
    public function agregarPunto()
    {
        if ($this->presentacion === 'Vectorial') {
            $this->puntosVector[] = ['latitude' => '', 'longitude' => ''];
        } else if ($this->presentacion === 'Poligono') {
            $this->puntosPoligono[] = ['latitude' => '', 'longitude' => ''];
        }
    }


    public function render()
    {

        return view('livewire.admin.capas')
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
                'nombre' => 'required',
                'frecuencia' => 'required|in:Semanal,Mensual,Trimestral,Variable',
                'organismo_id' => 'required'
            ];
        } else {
            return [
                'nombre' => 'required',
                'frecuencia' => 'required|in:Semanal,Mensual,Trimestral,Variable',
                'organismo_id' => 'required'
            ];
        }
    }

    // Mensajes
    protected function messages()
    {
        if ($this->accion == 'create') {
            return [
                'nombre.required' => 'El nombre es requerido',
                'frecuencia.required' => 'La frecuencia es requerida',
                'organismo_id.required' => 'El organismo es requerido'
            ];
        } else {
            return [
                'nombre.required' => 'El nombre del indicador es necesario',
                'frecuencia.required' => 'La frecuencia es requerida',
                'organismo_id.required' => 'El organismo es requerido'
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

        $indicador = Indicador::findOrFail($id);

        $this->indicador_id = $indicador->id;
        $this->organismo_id = $indicador->organismo_id;
        $this->nombre = $indicador->nombre;
        $this->color = $indicador->color;
        $this->descripcion = $indicador->descripcion;
        $this->frecuencia = $indicador->frecuencia;
        $this->estado = $indicador->estado;
        $this->orden = $indicador->orden;

        $this->openModal();
    }

    // Guardar ó actualzar el Organismo
    public function store()
    {
        $this->validate();

        Indicador::updateOrCreate(
            ['id' => $this->indicador_id],
            [
                'nombre' => $this->nombre,
                'organismo_id' => $this->organismo_id,
                'descripcion' => $this->descripcion,
                'color' => $this->color,
                'frecuencia' => $this->frecuencia,
                'orden' => $this->orden,
                'estado' => 1,
            ]
        );
        $this->emit('mensajePositivo', ['mensaje' => 'Operación exitosa']);
        $this->resetInputField();
        $this->closeModal();
    }

    // Borrar un organismo
    public function delete($id)
    {
        Indicador::find($id)->delete();
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
        $this->nombre = '';
        $this->descripcion = '';
        $this->color = '';
        $this->frecuencia = '';
        $this->estado = 1;
        $this->organismo_id = '';
        $this->indicador_id = 0;
        $this->orden = '';
        $this->resetErrorBag();
    }
}
