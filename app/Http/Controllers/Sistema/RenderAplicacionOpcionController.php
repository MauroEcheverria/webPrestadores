<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenderAplicacionOpcionController extends Controller
{
    public function menu_render(){
        try {

            $data_id_rol= DB::select("SELECT usr_id_rol 
            FROM dct_sistema_tbl_usuario  
            WHERE usr_correo = :usr_correo;",
            ['usr_correo' => auth()->user()->email]);

            $render_aplicativo_array = [];
            $render_aplicativo = [];
            $data_aplicativo= DB::select("SELECT apl_id_aplicacion FROM dct_sistema_tbl_aplicacion;");
            foreach ($data_aplicativo as $data_aplicativo) {
                $data_rol_aplicaccion = DB::select("SELECT rla_estado
                                                    FROM dct_sistema_tbl_rol_aplicacion
                                                    WHERE rla_id_rol = :rla_id_rol 
                                                    AND rla_id_aplicacion = :rla_id_aplicacion;",
                                                    [
                                                        'rla_id_rol'=>$data_id_rol[0]->usr_id_rol,
                                                        'rla_id_aplicacion'=>$data_aplicativo->apl_id_aplicacion,
                                                    ]);
                if ( COUNT($data_rol_aplicaccion) == 1) {
                    $render_aplicativo_array = [
                                                'id_dct_aplicativo' => $data_aplicativo->apl_id_aplicacion,
                                                'estado_aplicativo' => $data_rol_aplicaccion[0]->rla_estado,
                                                ];
                }
                else {
                    $render_aplicativo_array = [
                                                'id_dct_aplicativo' => $data_aplicativo->apl_id_aplicacion,
                                                'estado_aplicativo' => 0,
                                                ];
                }
                array_push($render_aplicativo,$render_aplicativo_array);
            }
            

            $render_opcion_array = [];
            $render_opcion = [];
            $data_rol= DB::select("SELECT opc_id_opcion FROM dct_sistema_tbl_opcion;");
            foreach ($data_rol as $data_rol) {
                $data_rol_opcion = DB::select("SELECT rlo_estado
                                                    FROM dct_sistema_tbl_rol_opcion
                                                    WHERE rlo_id_rol = :rlo_id_rol 
                                                    AND rlo_id_opcion = :rlo_id_opcion;",
                                                    [
                                                        'rlo_id_rol'=>$data_id_rol[0]->usr_id_rol,
                                                        'rlo_id_opcion'=>$data_rol->opc_id_opcion,
                                                    ]);
                if ( COUNT($data_rol_opcion) == 1) {
                    $render_opcion_array = [
                                                'id_dct_rol' => $data_rol->opc_id_opcion,
                                                'estado_rol' => $data_rol_opcion[0]->rlo_estado,
                                                ];
                }
                else {
                    $render_opcion_array = [
                                                'id_dct_rol' => $data_rol->opc_id_opcion,
                                                'estado_rol' => 0,
                                                ];
                }
                array_push($render_opcion,$render_opcion_array);
            }

            $data_result["message"] = "saveOK";
            $data_result["dataRenderAplicativo"] = $render_aplicativo;
            $data_result["dataRenderRol"] = $render_opcion;
            echo json_encode($data_result);
   
        } catch (\Exception $e) {
            Log::error("Salida por Excepción");
            Log::error("Archivo: ", [__FILE__]);
            Log::error("Línea: ", [__LINE__]);
            $data_result["message"] = "saveError";
            $data_result["exception"] = $e;
            echo json_encode($data_result);
        } 
    }
}