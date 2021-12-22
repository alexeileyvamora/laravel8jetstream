<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Browser;

class BrowserController extends Controller
{
    public function index(){

        $navegadores = Browser::all();

        $puntos = [];

        foreach($navegadores as $navegador) {
            $puntos[] = ['name' => $navegador['nombre'], 'y' => floatval($navegador['porcentaje']) ] ;

        }
        return view("graficos", ["data" => json_encode($puntos)]);
    }
}
