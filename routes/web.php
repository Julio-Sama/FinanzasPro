<?php

use App\Http\Controllers\VentaController;
use App\Http\Livewire\Calendar;
use App\Http\Livewire\Calendar2;
use App\Http\Livewire\FormAdvanced;
use App\Http\Livewire\FormEditor;
use App\Http\Livewire\FormElements;
use App\Http\Livewire\FormLayouts;
use App\Http\Livewire\FormValidation;
use App\Http\Livewire\FormWizard;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Index;

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

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ActivoController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\TipoController;

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

/* Rutas para el login */
Route::view('/login', 'login')->name('login');
Route::view('/registro', 'register')->name('registro');

Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('iniciar-sesion');
Route::get('/cerrar-sesion', [LoginController::class, 'logout'])->name('cerrar-sesion');

// Ruta principal
Route::get('/', function () {
    return view('login');
});

// Rutas para el dashboard con la sesion del usuario y su respectivo rol
// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/index', [LoginController::class, 'index'])->name('index');
// });

/* Rutas para el dashboard */
// Route::get('/', Index::class);
Route::get('index', Index::class)->name('index');

Route::resource('clientes', ClienteController::class);

Route::resource('proveedores', ProveedorController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('productos', ProductoController::class);

Route::resource('compras', CompraController::class);

Route::resource('ventas', VentaController::class);

Route::resource('tipos', TipoController::class); // Tipo de activo
Route::resource('activos', ActivoController::class); // Activo
// Route::get('roles', RolController::class); // Rol


// Kardex
Route::get('kardex', [ProductoController::class, 'kardex'])->name('kardex.index');



Route::get('calendar', Calendar::class);
Route::get('calendar2', Calendar2::class);

Route::get('form-advanced', FormAdvanced::class);
Route::get('form-editor', FormEditor::class);
Route::get('form-elements', FormElements::class);
Route::get('form-layouts', FormLayouts::class);
Route::get('form-validation', FormValidation::class);
Route::get('form-wizard', FormWizard::class);
