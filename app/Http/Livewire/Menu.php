<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Indice;

class Menu extends Component
{

    public $indices;

    public function mount()
    {
        $this->indices = Indice::where('estado', 1)->orderBy('nombre')->get();
    }

    public function seleccionarIndice($indiceId)
    {
        // Aquí puedes realizar acciones relacionadas con la selección del índice,
        // como emitir eventos, redirigir a una ruta o cargar datos adicionales.

        // Por ejemplo, podrías emitir un evento Livewire para manejar la selección
        // o simplemente redirigir al usuario a la ruta del índice.
        return redirect()->route('indice.show', ['id' => $indiceId]);
    }


    public function render()
    {
        $indices = $this->indices;
        return view('livewire.menu', ['indices' => $indices]);
    }
}
