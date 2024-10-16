<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ActivityArea;
use App\Models\AvailableActivity;
use App\Models\UserActivity;
use Illuminate\Support\Str;

class AssignRandomActivities extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-random-activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign 3 random activities from random activity areas to each non-admin user';

    /**
     * Execute the console command.
     */
    public function handle(){
        $users = User::whereDoesntHave('roles', function($query){
                $query->where('name', 'administrador');
            })->get();

        foreach($users as $user){
            $activityAreas = ActivityArea::has('availableActivities')
                ->inRandomOrder()
                ->take(3)
                ->get();

            $activitiesIds = [];

            foreach($activityAreas as $activityArea){
                $activity = $activityArea->availableActivities()
                            ->inRandomOrder()
                            ->first();
                if($activity){
                    $activitiesIds[] = $activity->id;
                }
            }

            $userRegister = UserActivity::create([
                'user_id' => $user->id,
                'activity_id_1' => $activitiesIds[0] ?? null,
                'activity_id_2' => $activitiesIds[1] ?? null,
                'activity_id_3' => $activitiesIds[2] ?? null
            ]);
        }
        $this->info('Random activities assigned to non-admin users.');
    }
}