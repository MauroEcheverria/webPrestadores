<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RenderAplicacionOpcionController extends Controller {
  public function menu_render(){
    try {

      $data_id_rol= DB::select("SELECT usr_id_rol,usr_id_empresa
                                FROM dct_sistema_tbl_usuario  
                                WHERE usr_correo = :usr_correo
                                LIMIT 1;",
      ['usr_correo' => auth()->user()->email]);

      $data_empresa= DB::select("SELECT emp_id_empresa,emp_estado 
                                FROM dct_sistema_tbl_empresa 
                                WHERE emp_id_empresa = :emp_id_empresa;",
                                ['emp_id_empresa'=>$data_id_rol[0]->usr_id_empresa]);

      $render_aplicativo_array = [];
      $render_aplicativo = [];
      $data_aplicativo= DB::select("SELECT apl_id_aplicacion,apl_estado FROM dct_sistema_tbl_aplicacion;");
      foreach ($data_aplicativo as $data_aplicativo) {
          $render_aplicativo_array = [
              'apl_id_aplicacion' => $data_aplicativo->apl_id_aplicacion,
              'apl_estado' => $data_aplicativo->apl_estado
          ];
          array_push($render_aplicativo,$render_aplicativo_array);
      }

      $render_rol_aplicativo_array = [];
      $render_rol_aplicativo = [];
      $data_rol_aplicaccion = DB::select("SELECT rla_id_aplicacion,rla_estado
                                          FROM dct_sistema_tbl_rol_aplicacion
                                          WHERE rla_id_rol = :rla_id_rol;",
                                          ['rla_id_rol'=>$data_id_rol[0]->usr_id_rol]);
      foreach ($data_rol_aplicaccion as $data_rol_aplicaccion) {
          $render_rol_aplicativo_array = [
              'rla_id_aplicacion' => $data_rol_aplicaccion->rla_id_aplicacion,
              'rla_estado' => $data_rol_aplicaccion->rla_estado
          ];
          array_push($render_rol_aplicativo,$render_rol_aplicativo_array);
      }
  
      $render_opcion_array = [];
      $render_opcion = [];
      $data_opcion= DB::select("SELECT opc_id_aplicacion,opc_id_opcion,opc_estado FROM dct_sistema_tbl_opcion;");
      foreach ($data_opcion as $data_opcion) {
          $render_opcion_array = [
              'opc_id_aplicacion' => $data_opcion->opc_id_aplicacion,
              'opc_id_opcion' => $data_opcion->opc_id_opcion,
              'opc_estado' => $data_opcion->opc_estado
          ];
          array_push($render_opcion,$render_opcion_array);
      }

      $render_rol_opcion_array = [];
      $render_rol_opcion = [];
      $data_rol_opcion = DB::select("SELECT rlo_id_opcion,rlo_estado
                                      FROM dct_sistema_tbl_rol_opcion
                                      WHERE rlo_id_rol = :rlo_id_rol;",
                                      ['rlo_id_rol'=>$data_id_rol[0]->usr_id_rol]);
      foreach ($data_rol_opcion as $data_rol_opcion) {
          $render_rol_opcion_array = [
              'rlo_id_opcion' => $data_rol_opcion->rlo_id_opcion,
              'rlo_estado' => $data_rol_opcion->rlo_estado
          ];
          array_push($render_rol_opcion,$render_rol_opcion_array);
      }

      $data_result["message"] = "saveOK";
      $data_result["dataRenderAplicativo"] = $render_aplicativo;
      $data_result["dataRenderRolAplicativo"] = $render_rol_aplicativo;
      $data_result["dataRenderOpcion"] = $render_opcion;
      $data_result["dataRenderRolOpcion"] = $render_rol_opcion;
      echo json_encode($data_result);

    } catch (\Exception $e) {
      Log::error($e->getMessage());
      $data_result["message"] = "exitForException";
      $data_result["exception"] = $e->getMessage();
      echo json_encode($data_result);
    } 
  }
}