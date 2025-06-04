<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\EstadoEnergiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/municipios', [MunicipioController::class, 'index'])->name('municipios.index');
Route::resource('localidades', LocalidadController::class);
Route::resource('estado-energia', EstadoEnergiaController::class);


require __DIR__.'/auth.php';
