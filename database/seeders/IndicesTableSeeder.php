<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indice;

class IndicesTableSeeder extends Seeder
{

  public function run(): void
  {
    $i1 = new Indice();
    $i1->organismo_id = 1;
    $i1->nombre = 'SPI1';
    $i1->descripcion = '';
    $i1->save();

    $i3 = new Indice();
    $i3->organismo_id = 1;
    $i3->nombre = 'SPI3';
    $i3->descripcion = '';
    $i3->save();

    $i6 = new Indice();
    $i6->organismo_id = 1;
    $i6->nombre = 'SPI6';
    $i6->descripcion = '';
    $i6->save();
  }
}
