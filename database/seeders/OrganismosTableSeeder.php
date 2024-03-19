<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organismo;

class OrganismosTableSeeder extends Seeder
{

    public function run(): void
    {
        $org1 = new Organismo();
        $org1->nombre = 'SAGYP';
        $org1->sigla = 'SAGYP';
        $org1->status = 1;
        $org1->save();

        $org2 = new Organismo();
        $org2->nombre = 'SMN';
        $org2->sigla = 'SMN';
        $org2->status = 1;
        $org2->save();

        $org3 = new Organismo();
        $org3->nombre = 'FAUBA';
        $org3->sigla = 'FAUBA';
        $org3->status = 1;
        $org3->save();

        $org4 = new Organismo();
        $org4->nombre = 'INTA';
        $org4->sigla = 'INTA';
        $org4->status = 1;
        $org4->save();

        $org5 = new Organismo();
        $org5->nombre = 'ORA';
        $org5->sigla = 'ORA';
        $org5->status = 1;
        $org5->save();

        $org6 = new Organismo();
        $org6->nombre = 'IANIGLA';
        $org6->sigla = 'IANIGLA';
        $org6->status = 1;
        $org6->save();

        $org7 = new Organismo();
        $org7->nombre = 'INA';
        $org7->sigla = 'INA';
        $org7->status = 1;
        $org7->save();
    }
}
