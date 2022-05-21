<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cao_usuario;

class ConsultorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $resultado = Cao_usuario::getConsultores();
        return view("consulta", compact('resultado'));
        

    }

}
