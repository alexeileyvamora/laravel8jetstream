<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cao_usuario;

class GananciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $consultores = Cao_usuario::getConsultores();

        $Array= [];
        $periodos= [];
        $ganancia= [];
        $fijo= [];
        $comi= [];
        $benefi= [];
        $puntos = [];

        $ave = [];
        $aveg= [];
        $suma =0;

        if ($request->get('derecha')){
            $Array= $request->get('derecha');

            $resultado = Cao_usuario::getGanancia($request->get('labelyeardesde'),$request->get('labelmonthdesde'), $request->get('labelyearhasta'),$request->get('labelmonthhasta'), $Array);
            
            $graficar = Cao_usuario::getDatagrafico($request->get('labelyeardesde'),$request->get('labelmonthdesde'), $request->get('labelyearhasta'),$request->get('labelmonthhasta'), $Array);

            foreach($resultado as $dat) {

                $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", 
               "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        
               $periodos[$dat->co_usuario][] = $meses[date($dat->mes)-1] ;
               $ganancia[$dat->co_usuario][] = round($dat->valorsuma - ($dat->valorsuma * ($dat->total_imp_incsuma/100)),2);
               $fijo[$dat->co_usuario][] = $dat->brut_salario;
               $comi[$dat->co_usuario][] = round((($dat->valorsuma - (($dat->valorsuma * $dat->total_imp_incsuma)/100)) * $dat->comissao_cncsuma)/100,2);
               $benefi[$dat->co_usuario][] = round($dat->valorsuma - ($dat->valorsuma * ($dat->total_imp_incsuma/100)),2) - ($dat->brut_salario + round((($dat->valorsuma - (($dat->valorsuma * $dat->total_imp_incsuma)/100)) * $dat->comissao_cncsuma)/100,2) );
    
             }

             foreach($graficar as $gra){

               $puntos[] = ['name' => $gra->no_usuario, 'y' => round (($gra->valorsuma - $gra->total_imp_incsuma),2) ] ;
               
               $suma += $gra->brut_salario;
               $ave[] = ['name' => $gra->no_usuario, 'y' => round (($suma),2) ] ;
              

            }  
            
            foreach($ave as $gra){
                $aveg[] = ['name' => $gra['name'], 'y' => round (($suma/count($ave))) ] ;

            } 

        }  
       
        return view("ganancia", compact('consultores','Array','periodos','ganancia','fijo','comi','benefi'),
    
        ["data" => json_encode($puntos),  
        "ave" => json_encode($aveg),    
        ]
        );
        

    }

}
