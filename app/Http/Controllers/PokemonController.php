<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Capturas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PokemonController extends Controller
{

  public function VerPokemon(Request $request)
  {
        $usuario = auth()->user();
        $name = $request->name;
        $url = 'https://pokeapi.co/api/v2/pokemon/'.$name;
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);
        $id_pokemon = $json_data['id'];

        $captura = Capturas::where(['id_entrenador'=> $usuario->id, 'id_pokemon'=>$id_pokemon])->get();

        if(count($captura)!=0)
        {
          $capturado = 1;
        }
        else
        {
          $capturado = 0;
        }

        return view('pokemones.ver', ['id'=>$json_data['id'],'capturado'=>$capturado,'imagen'=>$json_data['sprites']['front_default'],'nombre'=>$json_data['name'],'experiencia'=>$json_data['base_experience'],'habilidades'=>$json_data['abilities'],'peso'=>$json_data['weight'],'altura'=>$json_data['height'],'tipo'=>$json_data['types'],'estadisticas'=>$json_data['stats'],'movimientos'=>$json_data['moves'],]);  
  }

  public function LiberarPokemon(Request $request)
  {
        $usuario = auth()->user();
        $id_usuario = $usuario->id;
        $id_pokemon = $request->id;

        $captura = Capturas::where(['id_entrenador'=> $usuario->id, 'id_pokemon'=>$id_pokemon])->delete();

        $capturados = Capturas::where(['id_entrenador'=> $usuario->id])->count();

        $user = Auth::user();
        $user->pokemones = $capturados;
        $user->save();

        return redirect()->back();
  }

  public function CapturarPokemon(Request $request)
  {
        $usuario = auth()->user();
        $id_usuario = $usuario->id;
        $id_pokemon = $request->id;
        $nombre = $request->name;

        $now = new \DateTime();

        $captura = Capturas::insert(['nombre'=>$nombre,'id_entrenador'=> $usuario->id, 'id_pokemon'=>$id_pokemon, 'created_at'=>$now->format('Y-m-d H:i:s'),'updated_at'=>$now->format('Y-m-d H:i:s'),]);

        $capturados = Capturas::where(['id_entrenador'=> $usuario->id])->count();

        $user = Auth::user();
        $user->pokemones = $capturados;
        $user->save();

        return redirect()->back(); 
  }

  public function ListaPokemones(Request $request)
  {
      $usuario = auth()->user();
      $id_usuario = $usuario->id;
      $lista = Capturas::where(['id_entrenador'=> $id_usuario])->get();
      return view('pokemones.lista', ['pokemones'=>$lista]);  
  }

}
