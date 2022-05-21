<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cao_usuario extends Model
{
    use HasFactory;
    protected $table='cao_usuario';

    public function getGanancia($anyo,$mes, $anyohasta, $meshasta,$id)
    {

        $resultado = Cao_usuario::join("cao_os", "cao_os.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->join("cao_fatura", "cao_fatura.co_os", "=", "cao_os.co_os")
                                    ->join("cao_salario", "cao_salario.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->select("cao_usuario.co_usuario", "no_usuario","brut_salario")
                                    ->selectRaw("SUM(cao_fatura.valor) as valorsuma")
                                    ->selectRaw("Month(cao_fatura.data_emissao) as mes")
                                    ->selectRaw("SUM(cao_fatura.total_imp_inc) as total_imp_incsuma")
                                    ->selectRaw("SUM(cao_fatura.comissao_cn) as comissao_cncsuma")
                                    ->whereIn("cao_os.co_usuario",$id)
                                    ->whereBetween ('cao_fatura.data_emissao', [$anyo.'-'.$mes.'-'."01", $anyohasta.'-'. $meshasta.'-'."31"])
                                    ->groupBy("mes", "cao_usuario.no_usuario","brut_salario","cao_usuario.co_usuario",)
                                    ->orderBy('mes','asc')
                                    ->get();
        return $resultado;
    }

    public function getDatagrafico($anyo,$mes, $anyohasta, $meshasta,$id)
    {

        $resultado = Cao_usuario::join("cao_os", "cao_os.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->join("cao_fatura", "cao_fatura.co_os", "=", "cao_os.co_os")
                                    ->join("cao_salario", "cao_salario.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->select("no_usuario","brut_salario")
                                    ->selectRaw("SUM(cao_fatura.valor) as valorsuma")
                                    //->selectRaw("Month(cao_fatura.data_emissao) as mes")
                                    ->selectRaw("SUM(cao_fatura.total_imp_inc) as total_imp_incsuma")
                                    //->selectRaw("SUM(cao_fatura.comissao_cn) as comissao_cncsuma")
                                    ->whereIn("cao_os.co_usuario",$id)
                                    ->whereBetween ('cao_fatura.data_emissao', [$anyo.'-'.$mes.'-'."01", $anyohasta.'-'. $meshasta.'-'."31"])
                                    ->groupBy(/*"mes",*/ "cao_usuario.no_usuario","brut_salario")
                                    //->orderBy('mes','asc')
                                    //->orderBy('mes', 'desc')
                                    ->get();


        return $resultado;

    } 
    
    public function getDatapizza()
    {

        $resultado = Cao_usuario::join("cao_os", "cao_os.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->join("cao_fatura", "cao_fatura.co_os", "=", "cao_os.co_os")
                                    ->join("cao_salario", "cao_salario.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->select("no_usuario","brut_salario")
                                    ->selectRaw("SUM(cao_fatura.valor) as valorsuma")
                                    //->selectRaw("Month(cao_fatura.data_emissao) as mes")
                                    ->selectRaw("SUM(cao_fatura.total_imp_inc) as total_imp_incsuma")
                                    //->selectRaw("SUM(cao_fatura.comissao_cn) as comissao_cncsuma")
                                    //->whereIn("cao_os.co_usuario",$id)
                                    //->whereBetween ('cao_fatura.data_emissao', [$anyo.'-'.$mes.'-'."01", $anyohasta.'-'. $meshasta.'-'."31"])
                                    ->groupBy(/*"mes",*/ "cao_usuario.no_usuario","brut_salario")
                                    //->orderBy('mes','asc')
                                    //->orderBy('mes', 'desc')
                                    ->get();


        return $resultado;

    } 

    public function getConsultores()
    {

        $resultado = Cao_usuario::join("permissao_sistema", "permissao_sistema.co_usuario", "=", "cao_usuario.co_usuario")
                                    ->select("*")
                                    ->where("permissao_sistema.co_sistema", "=", 1)
                                    ->where("permissao_sistema.in_ativo", "=", "S")
                                    ->orWhere("permissao_sistema.co_tipo_usuario", "=", "0")
                                    ->orWhere("permissao_sistema.co_tipo_usuario", "=", "1")
                                    ->orWhere("permissao_sistema.co_tipo_usuario", "=", "2")
                                    //->orderBy('permissao_sistema.co_tipo_usuario')
                                    ->orderBy('cao_usuario.co_usuario')
                                /* ->paginate(5)*/
                                    ->get();

        return $resultado;

    } 
    
}
