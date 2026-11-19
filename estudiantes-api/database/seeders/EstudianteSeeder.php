<?php

namespace Database\Seeders;

use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    public function run(): void
    {
        $datos = [
            ['nombre' => 'Ana Torres',     'correo' => 'ana.torres@example.com',     'programa' => 'Ingeniería Informática'],
            ['nombre' => 'Luis Gómez',     'correo' => 'luis.gomez@example.com',     'programa' => 'Ingeniería Industrial'],
            ['nombre' => 'María Rojas',    'correo' => 'maria.rojas@example.com',    'programa' => 'Ingeniería de Sistemas'],
            ['nombre' => 'Carlos Pérez',   'correo' => 'carlos.perez@example.com',   'programa' => 'Administración de Empresas'],
            ['nombre' => 'Laura Medina',   'correo' => 'laura.medina@example.com',   'programa' => 'Contaduría Pública'],
        ];

        foreach ($datos as $d) {
            Estudiante::updateOrCreate(['correo' => $d['correo']], $d);
        }
    }
}