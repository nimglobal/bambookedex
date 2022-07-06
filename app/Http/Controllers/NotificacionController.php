<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notifications;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Notification;
use App\Notifications\NotificarCambios;

class NotificacionController extends Controller
{
  public function EnviarNotificacion(Request $request)
  {
      return view('notificacion.envio');  
  }

  public function ListaNotificacion(Request $request)
  {
      $usuario = auth()->user();
      $lista = Notifications::where(['notifiable_id'=> $usuario->id])->get();
      return view('notificacion.lista', ['notificaciones'=>$lista]);
  }

  public function EnviadoNotificacion(Request $request)
  {
      $validatedData = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'message' => ['required', 'string', 'max:255'],
      ]);

      $esquema = User::all();
  
      $notificacion = [
        'titulo' => $request->title,
        'contenido' => $request->message
      ];
  
      Notification::send($esquema, new NotificarCambios($notificacion));

      return view('notificacion.envio');  
  }

}
