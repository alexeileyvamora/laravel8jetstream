<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cao_usuario;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $puntos = [];

        $resultado = Cao_usuario::getDatapizza();

                                    $i=0;
                                    $suma =0;
                                    foreach($resultado as $dat){
                                        //if ((round($dat->valorsuma - ($dat->valorsuma * ($dat->total_imp_incsuma)/100),2))> 0)
                                        //$puntos[] = ['name' => $dat->no_usuario, 'y' => round($dat->valorsuma - ($dat->valorsuma * ($dat->total_imp_incsuma)/100),2) ] ;
                                        $puntos[] = ['name' => $dat->no_usuario, 'y' => round (($dat->valorsuma - $dat->total_imp_incsuma),2) ] ;

                                       $header[] =  $dat->mes;
                                       $nombre[] =  $dat->no_usuario;

                                       $da[] = round (($dat->valorsuma - $dat->total_imp_incsuma),2);

                                       $suma += $dat->brut_salario;

                                      $ave[] = ['name' => $dat->no_usuario, 'y' => round (($suma),2) ] ;

                                       $i++;
                                       $average[] = ['name' => $dat->no_usuario ] ;
 
                                    }

                                    foreach($ave as $gra){
                                        $aveg[] = ['name' => $gra['name'], 'y' => round (($suma/count($ave))) ] ;
                        
                                    } 
                                    $average[] = [$suma/$i ] ;

                                    $ganancia[] = [
                                        'type' => 'column',
                                           'name' => $dat->mes,
                                            'data' => $da
                                       ,];

        return view("pizza", 
                            ["data" => json_encode($puntos),
                             "header" => json_encode($header),
                              "ganancia" => json_encode($ganancia),
                               "average"=> json_encode($aveg),
                               "nombre"=> json_encode($nombre)
                           
                 ]);


    }

}
