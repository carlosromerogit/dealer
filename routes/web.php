<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\FinanciamientoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Route::get('/about', function () {
//     return view('about');
// });

Route::resource('vehiculos', VehiculoController::class);
    Route::resource('clientes', ClienteController::class);
    // Route::resource('vendedores', VendedorController::class);
    Route::resource('ventas', VentaController::class);



    Route::resource('financiamientos', FinanciamientoController::class)
    ->only(['index', 'show', 'edit', 'update']);


    Route::get('/vendedores', [VendedorController::class, 'index'])->name('vendedores.index')->middleware('auth:sanctum');

Route::get('/vendedores/create', [VendedorController::class, 'create'])->name('vendedores.create');

Route::post('/vendedores', [VendedorController::class, 'store'])->name('vendedores.store');

Route::get('/vendedores/{vendedor}', [VendedorController::class, 'show'])->name('vendedores.show');

Route::get('/vendedores/{vendedor}/edit', [VendedorController::class, 'edit'])->name('vendedores.edit');

Route::put('/vendedores/{vendedor}', [VendedorController::class, 'update'])->name('vendedores.update');

Route::delete('/vendedores/{vendedor}', [VendedorController::class, 'destroy'])->name('vendedores.destroy');


Route::get('/pagos/create/{financiamiento}', [PagoController::class, 'create'])
    ->name('pagos.create');

Route::post('/pagos', [PagoController::class, 'store'])
    ->name('pagos.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('usuarios', UserController::class);


Route::resource('marcas', MarcaController::class);
Route::resource('modelos', ModeloController::class);