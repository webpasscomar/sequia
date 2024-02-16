<?php

namespace App\Http\Livewire\Admin;

use App\Models\Organismo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Organismos extends Component
{
    protected $organismos;
    protected $listeners = ['delete', 'updateTable'];

    public $showModal = 'none';
    public $organismo_id, $organismo, $currentImage, $currentTitle, $action, $nombre, $sigla, $status;

    public function render()
    {
        $organismos = Organismo::all();
        return view('livewire.admin.organismos', [
            'organismos' => $organismos
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
        if ($this->action == 'create') {
            return [
                'nombre' => 'required',
                'sigla' => 'required|max:10',
            ];
        } else {
            return [
                'nombre' => 'required',
                'sigla' => 'required',
            ];
        }
    }

    // Mensajes
    protected function messages()
    {
        if ($this->action == 'create') {
            return [
                'nombre.required' => 'El título del organismo es necesario',
                'sigla.required' => 'La sigla del organismo es requerida',
                'sigla.max' => 'La sigla no puede superar los 10 caracteres'
            ];
        } else {
            return [
                'nombre.required' => 'El título del organismo es necesario',
                'sigla.required' => 'La sigla del organismo es requerida',
                'sigla.max' => 'La sigla no puede superar los 10 caracteres'
            ];
        }
    }

    // Crear un nuevo Organismo abriendo el modal del formulario
    public function create()
    {
        $this->action = 'create';
        $this->resetInputField();
        $this->openModal();
    }

    // Editar un organismo
    public function edit($id)
    {
        $this->action = 'edit';

        $organismo = Organismo::findOrFail($id);
        $this->organismo_id = $organismo->id;
        $this->nombre = $oganismo->nombre;
        $this->sigla = $organismo->sigla;
        $this->status = $organismo->status;

        $this->openModal();
    }

    // Guardar ó actualzar el Organismo
    public function store()
    {
        $this->validate();

        Organismo::updateOrCreate(
            ['id' => $this->organismo_id],
            [
                'nombre' => $this->nombre,
                'sigla' => $this->sigla,
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
        Service::find($id)->delete();
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
        $this->sigla = '';
        $this->status = 1;
        $this->service_id = 0;
        $this->resetErrorBag();
    }
}

