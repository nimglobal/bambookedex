<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Capturas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Mail\Email;

class EntrenadorController extends Controller
{
  public function ListaEntrenadores(Request $request)
  {
      $lista = User::where(['type'=> 0])->get();
      return view('entrenadores.lista', ['entrenadores'=>$lista]);  
  }

  public function VerEntrenadores(Request $request)
  {
      $entrenador = User::where(['id'=> $request->id])->first();
      $pokemones = Capturas::where(['id_entrenador'=> $request->id])->get(['nombre']);
      return view('entrenadores.ver', ['entrenador'=>$entrenador,'pokemones'=>$pokemones]);  
  }

  public function changePasswordPost(Request $request) {


        $validatedData = $request->validate([
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = $password = app('hash')->make($request->get('new-password'));
        $user->first_login = 1;
        $user->save();

        return redirect()->route('home');
    }

  public function RankingEntrenadores(Request $request)
  {
      $lista = User::where(['type'=> 0])->orderBy('pokemones', 'desc')->get();
      return view('entrenadores.ranking', ['entrenadores'=>$lista]);  
  }

  public function PerfilEntrenador(Request $request)
  {
      $usuario = auth()->user();
      $lista = User::where(['id'=> $usuario->id])->orderBy('pokemones', 'desc')->first();
      return view('entrenadores.perfil', ['entrenador'=>$lista]);  
  }

  public function PerfilEntrenadorUpdate(Request $request)
  {
      $usuario = auth()->user();

      $validatedData = $request->validate([
         'picture' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

      $entrenador = User::findOrFail($usuario->id);
      $entrenador->name = $request->name;
      $entrenador->lastname = $request->lastname;
      

      // script para subir la imagen
      if($request->hasFile("picture")){

        $imagen = $request->file("picture");
        $nombreimagen = Str::slug($request->name).".".$imagen->guessExtension();
        $ruta = public_path("img/perfil/");

        //$imagen->move($ruta,$nombreimagen);
        copy($imagen->getRealPath(),$ruta.$nombreimagen);

        $entrenador->picture = $nombreimagen;            
            
        }

        $entrenador->save();
      return redirect()->action([EntrenadorController::class, 'PerfilEntrenador']);
  }

  public function RegistrarEntrenador(Request $request)
  {
      return view('entrenadores.registro');  
  }

  public function RegistroEntrenador(Request $request)
  {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'lastname' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    ]);

    User::create([
      'name' => $request['name'],
      'lastname' => $request['lastname'],
      'email' => $request['email'],
      'password' => Hash::make('123456'),
    ]);


     $email = $request['email'];
   
    $mailData = [
      'title' => 'Titulo',
      'url' => 'http://127.0.0.1:8000'
    ];
  
    Mail::to($email)->send(new Email($mailData));
   
    return redirect()->action([EntrenadorController::class, 'ListaEntrenadores']);  
  }
  
}
