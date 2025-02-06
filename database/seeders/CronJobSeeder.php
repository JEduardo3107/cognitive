<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ActivityArea;
use App\Models\AvailableActivity;
use App\Models\UserActivity;
use Illuminate\Support\Str;

class CronJobSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $users = User::whereDoesntHave('roles', function($query){
            $query->where('name', 'administrador');
        })->get();

    foreach($users as $user){
        // Obtener 3 áreas con al menos 2 actividades disponibles
        $activityAreas = ActivityArea::has('availableActivities')
            ->inRandomOrder()
            ->take(4) // Puedes seguir tomando 3 áreas
            ->get();

        $activitiesIds = [];

        foreach($activityAreas as $activityArea){
            // Obtener 2 actividades aleatorias de cada área
            $activities = $activityArea->availableActivities()
                        ->inRandomOrder()
                        ->take(2) // Tomar 2 actividades por área
                        ->get();
            
            foreach($activities as $activity){
                $activitiesIds[] = $activity->id;
            }
        }

        // Asegúrate de que no haya más de 6 actividades asignadas
        $activitiesIds = array_slice($activitiesIds, 0, 6);

        // Crear el registro en UserActivity con las 6 actividades asignadas
        $userRegister = UserActivity::create([
            'user_id' => $user->id,
            'activity_id_1' => $activitiesIds[0] ?? null,
            'activity_id_2' => $activitiesIds[1] ?? null,
            'activity_id_3' => $activitiesIds[2] ?? null,
            'activity_id_4' => $activitiesIds[3] ?? null,
            'activity_id_5' => $activitiesIds[4] ?? null,
            'activity_id_6' => $activitiesIds[5] ?? null,
        ]);
    }
    }
}