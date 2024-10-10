<?php

namespace App\Http\Controllers;
use App\Models\AvailableActivity;
use Illuminate\Http\Request;

class GameManagerController extends Controller{
    public function index(AvailableActivity $game){
        switch ($game->game_id){
            case 1:
                dd("Juego 1 - lenguaje1");
               // return view('games.game1', compact('game'));
            case 2:
                dd("Juego 2 - memoria");
                //return view('games.game2', compact('game'));
            case 3:
                dd("Juego 3 - construccion");
                //return view('games.game3', compact('game'));
            default:
                dd("Recurso no encontrado");
               // return view('games.default', compact('game'));
        }
    }
}