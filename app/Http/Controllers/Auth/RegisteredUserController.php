<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\ActivityArea;
use App\Models\UserActivity;

class RegisteredUserController extends Controller{
    /**
     * Display the registration view.
     */
    public function create(): View{
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse{
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Seleccionar 3 áreas de actividad aleatorias con al menos una actividad disponible
        $activityAreas = ActivityArea::has('availableActivities')
            ->inRandomOrder()
            ->take(3)
            ->get();
    
        $activitiesIds = [];
    
        foreach ($activityAreas as $activityArea) {
            // Seleccionar una actividad aleatoria por cada área de actividad
            $activity = $activityArea->availableActivities()
                        ->inRandomOrder()
                        ->first();
    
            if ($activity) {
                $activitiesIds[] = $activity->id;
            }
        }
    
        // Crear el registro en UserActivity
        $userRegister = UserActivity::create([
            'user_id' => $user->id,
            'activity_id_1' => $activitiesIds[0] ?? null, // Verifica si existe el índice
            'activity_id_2' => $activitiesIds[1] ?? null,
            'activity_id_3' => $activitiesIds[2] ?? null
        ]);
        
        return redirect(route('home.index', absolute: false));
    }
}
