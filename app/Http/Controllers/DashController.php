<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cao_usuario;

class DashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$consultores = Cao_usuario::all();

        $resultado = Cao_usuario::join("permissao_sistema", "permissao_sistema.co_usuario", "=", "cao_usuario.co_usuario")
        ->select("*")
        //->selectRaw("COUNT(*) as total")
        ->where("permissao_sistema.co_sistema", "=", 1)
        ->where("permissao_sistema.in_ativo", "=", "S")
        ->orWhere("permissao_sistema.co_tipo_usuario", "=", "0")
        ->orWhere("permissao_sistema.co_tipo_usuario", "=", "1")
        ->orWhere("permissao_sistema.co_tipo_usuario", "=", "2")
        ->orderBy('permissao_sistema.co_tipo_usuario')
       /* ->paginate(5)*/
        ->get();

        $ganancia = Cao_usuario::join("cao_os", "cao_os.co_usuario", "=", "cao_usuario.co_usuario")
        ->join("cao_fatura", "cao_fatura.co_os", "=", "cao_os.co_os")
        ->join("cao_salario", "cao_salario.co_usuario", "=", "cao_usuario.co_usuario")
        ->select("no_usuario","brut_salario")
        ->selectRaw("SUM(cao_fatura.valor) as valorsuma")
        ->selectRaw("Month(cao_fatura.data_emissao) as mes")
        ->selectRaw("SUM(cao_fatura.total_imp_inc) as total_imp_incsuma")
        ->selectRaw("SUM(cao_fatura.comissao_cn) as comissao_cncsuma")
        ->whereYear('cao_fatura.data_emissao', '2007')
        ->groupBy("mes", "cao_usuario.no_usuario","brut_salario")
        ->orderBy('mes','asc')
        ->get();


        return view("dash.dash", ["consultores" => count($resultado), "data" => count($ganancia)]);
        //return view("dash.dash", compact('resultado'));
        

    }

   
}
