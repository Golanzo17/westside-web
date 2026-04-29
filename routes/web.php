<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto; // Le decimos al portero dónde está tu modelo

Route::get('/', function () {
    // Para activar el catálogo dinámico, descomentar:
    // $productos = Producto::all();
    // return view('Principal', compact('productos'));
    return view('Principal');
});

Route::get('/catalogo', function () {
    return view('Catalogo');
});

// Redirige /principal a / (compatibilidad con links anteriores)
Route::redirect('/principal', '/');

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/terminos-y-usos', function () {
    return view('Terminos-y-usos');
});

Route::get('/comercializacion', function () {
    return view('Comercializacion');
});

Route::get('/contacto', function () {
    return view('Contacto');
});

Route::get('/consultas', function () {
    return view('Consultas');
});


Route::get('/turnos', function () {
    return view('Turnos');
});
