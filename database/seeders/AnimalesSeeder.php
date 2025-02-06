<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AnimalesSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        $animals = [
            ['id' => Str::uuid(), 'name' => 'León', 'image' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Elefante', 'image' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Tigre', 'image' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Jirafa', 'image' => '4', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Cebra', 'image' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Lobo', 'image' => '6', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Águila', 'image' => '7', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Delfín', 'image' => '8', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Pingüino', 'image' => '9', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Oso', 'image' => '10', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Canguro', 'image' => '11', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Cocodrilo', 'image' => '12', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Camaleón', 'image' => '13', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Pulpo', 'image' => '14', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Tortuga', 'image' => '15', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Caballo', 'image' => '16', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Zorro', 'image' => '17', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Búho', 'image' => '18', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Mapache', 'image' => '19', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Serpiente', 'image' => '20', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Puma', 'image' => '21', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Jaguar', 'image' => '22', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Gorila', 'image' => '23', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Rinoceronte', 'image' => '24', 'created_at' => now(), 'updated_at' => now()],
            ['id' => Str::uuid(), 'name' => 'Hipopótamo', 'image' => '25', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('game5_options')->insert($animals);
    }
}