<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/paginacion',  [App\Http\Controllers\HomeController::class, 'PaginacionPokemones'])->name('pagination');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/changePassword',[App\Http\Controllers\EntrenadorController::class, 'ChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword',[App\Http\Controllers\EntrenadorController::class, 'changePasswordPost'])->name('changePasswordPost');
});

Route::get('/enviar-email', [App\Http\Controllers\EmailController::class, 'enviarEmail']);

/*
 entrenadores
 */
$router->group(['prefix' => 'entrenadores'], function () use ($router) 
{
    $router->get('/lista',  [App\Http\Controllers\EntrenadorController::class, 'ListaEntrenadores']);
    $router->get('/ver/{id}',  [App\Http\Controllers\EntrenadorController::class, 'VerEntrenadores']);
    $router->get('/ranking',  [App\Http\Controllers\EntrenadorController::class, 'RankingEntrenadores']);
    $router->get('/perfil',  [App\Http\Controllers\EntrenadorController::class, 'PerfilEntrenador']);
    $router->post('/update-perfil',  [App\Http\Controllers\EntrenadorController::class, 'PerfilEntrenadorUpdate'])->name('update-perfil');
    $router->get('/registrar',  [App\Http\Controllers\EntrenadorController::class, 'RegistrarEntrenador'])->name('registrar');
    $router->post('/registrar-entrenador',  [App\Http\Controllers\EntrenadorController::class, 'RegistroEntrenador'])->name('registrar-entrenador');
});

/*
 pokemon
 */
$router->group(['prefix' => 'pokemon'], function () use ($router) 
{
    $router->get('/lista',  [App\Http\Controllers\PokemonController::class, 'ListaPokemones']);
    $router->get('/ver/{name}',  [App\Http\Controllers\PokemonController::class, 'VerPokemon']);
    $router->post('/liberar',  [App\Http\Controllers\PokemonController::class, 'LiberarPokemon'])->name('liberarPokemon');
    $router->post('/capturar',  [App\Http\Controllers\PokemonController::class, 'CapturarPokemon'])->name('capturarPokemon');
});

/*
 notificación
 */
$router->group(['prefix' => 'notificacion'], function () use ($router) 
{
    $router->get('/enviar',  [App\Http\Controllers\NotificacionController::class, 'EnviarNotificacion']);
    $router->get('/lista',  [App\Http\Controllers\NotificacionController::class, 'ListaNotificacion']);
    $router->post('/enviado',  [App\Http\Controllers\NotificacionController::class, 'EnviadoNotificacion'])->name('enviadoNotificacion');
});