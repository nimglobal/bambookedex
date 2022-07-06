<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $usuario = auth()->user();

        if($usuario->type == 0 && $usuario->first_login == 0)
        {
            return view('entrenadores.change-password');
        }
        else
        {
            if($usuario->type == 1)
            {
                return redirect()->action([EntrenadorController::class, 'ListaEntrenadores']);
            }
            else
            {
                if($request->pokemon)
                {
                    $url = 'https://pokeapi.co/api/v2/pokemon/'.$request->pokemon;
                    $json = file_get_contents($url);
                    $json_data = json_decode($json, true);
                    $results = array(array("name"=>$json_data['name'],"url"=>"https://pokeapi.co/api/v2/pokemon/".$request->pokemon."/"));
                    return view('home',['id'=>$json_data['id'],'pokemones'=>$results, 'next'=>null, 'prev'=>null]);
                }
                else
                {
                    $url = 'https://pokeapi.co/api/v2/pokemon';
                    $json = file_get_contents($url);
                    $json_data = json_decode($json, true);
                    return view('home',['id'=>null,'pokemones'=>$json_data['results'], 'next'=>$json_data['next'], 'prev'=>$json_data['previous']]);
                }
                
            }
        }
    }

    public function PaginacionPokemones(Request $request)
    {
        $getUrl = $request->url;
        $url = $getUrl;
        $json = file_get_contents($url);
        $json_data = json_decode($json, true);
        return view('home',['pokemones'=>$json_data['results'], 'next'=>$json_data['next'], 'prev'=>$json_data['previous']]);
    }

}
