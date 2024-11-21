<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;

class CatalogoController extends Controller
{
    public function index(): View
    {
        $catalogos = Producto::all();
        return view('catalogo.index', compact('catalogos'));
    }
}