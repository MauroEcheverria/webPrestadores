<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Accesos_dct {
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response {
    try {

      $data_usuario = DB::select("SELECT 
                                  usr_id_rol,
                                  usr_estado,
                                  usr_estado_contrasenia,
                                  usr_expiro_contrasenia,
                                  usr_id_empresa,
                                  usr_estado_correo
                                  FROM dct_sistema_tbl_usuario
                                  WHERE usr_correo=:usr_correo;",
                                  ['usr_correo' => auth()->user()->email]);

      $data_empresa= DB::select("SELECT emp_estado,emp_vigencia_hasta
                                FROM dct_sistema_tbl_empresa 
                                WHERE emp_id_empresa = :emp_id_empresa;",
                                ['emp_id_empresa' => $data_usuario[0]->usr_id_empresa]);

      $data_rol = DB::select("SELECT rol_estado
                              FROM dct_sistema_tbl_rol
                              WHERE rol_id_rol=:rol_id_rol;",
                              ['rol_id_rol' => $data_usuario[0]->usr_id_rol]);

      $data_opcion = DB::select("SELECT opc_id_opcion, opc_estado
                                FROM dct_sistema_tbl_opcion
                                WHERE opc_ruta=:opc_ruta;",
                                ['opc_ruta' => Route::currentRouteName()]);

      $data_aplicacion = DB::select("SELECT apl_id_aplicacion,apl_estado
                                    FROM dct_sistema_tbl_aplicacion
                                    WHERE apl_id_aplicacion = (SELECT opc_id_aplicacion
                                    FROM dct_sistema_tbl_opcion
                                    WHERE opc_id_opcion = :opc_id_opcion);",
                                    ['opc_id_opcion' => $data_opcion[0]->opc_id_opcion]);

      $data_empresa_aplicativo = DB::select("SELECT ape_estado
                                            FROM dct_sistema_tbl_aplicacion_empresa
                                            WHERE ape_id_aplicacion = :ape_id_aplicacion
                                            AND ape_id_empresa = :ape_id_empresa;",
                                            [
                                              'ape_id_aplicacion' => $data_aplicacion[0]->apl_id_aplicacion,
                                              'ape_id_empresa' => $data_usuario[0]->usr_id_empresa
                                            ]);

      $data_rol_aplicativo = DB::select("SELECT rla_estado
                                        FROM dct_sistema_tbl_rol_aplicacion
                                        WHERE rla_id_rol = :rla_id_rol
                                        AND rla_id_aplicacion = :rla_id_aplicacion;",
                                        [
                                          'rla_id_rol' => $data_usuario[0]->usr_id_rol,
                                          'rla_id_aplicacion' => $data_aplicacion[0]->apl_id_aplicacion
                                        ]);
      
      $data_rol_opcion = DB::select("SELECT rlo_estado
                                    FROM dct_sistema_tbl_rol_opcion
                                    WHERE rlo_id_rol = :rlo_id_rol
                                    AND rlo_id_opcion = :rlo_id_opcion;",
                                    [
                                      'rlo_id_rol' => $data_usuario[0]->usr_id_rol,
                                      'rlo_id_opcion' => $data_opcion[0]->opc_id_opcion
                                    ]);

      if ($data_usuario[0]->usr_estado == 0) {
        return redirect('/usuario_inactivo');
      }
      else if ($data_usuario[0]->usr_estado_contrasenia == 0) {
        return redirect('/contrasena_inactiva');
      }
      else if ($data_usuario[0]->usr_expiro_contrasenia == 1) {
        return redirect('/expiro_contrasena');
      }
      else if ($data_usuario[0]->usr_estado_correo == 0) {
        return redirect('/correo_no_validado');
      }
      else if ($data_empresa[0]->emp_estado == 0) {
        return redirect('/empresa_inactiva');
      }
      else if ($data_empresa[0]->emp_vigencia_hasta < config('global.fechaActual_4')) {
        return redirect('/licencia_caducada');
      }
      else if ($data_rol[0]->rol_estado == 0) {
        return redirect('/rol_inactivo');
      }
      else if ($data_opcion[0]->opc_estado == 0) {
        return redirect('/opcion_inactiva');
      }
      else if ($data_aplicacion[0]->apl_estado == 0) {
        return redirect('/aplicativo_inactivo');
      }
      else if ($data_empresa_aplicativo[0]->ape_estado == 0) {
        return redirect('/empresa_aplicativo_inactivo');
      }
      else if ($data_rol_aplicativo[0]->rla_estado == 0) {
        return redirect('/rol_aplicativo_inactivo');
      }
      else if ($data_rol_opcion[0]->rlo_estado == 0) {
        return redirect('/rol_opcion_inactivo');
      }
      else {
        return $next($request);
      }
    } catch (\Exception $e) {
      Log::error($e->getMessage());
      $data_result["message"] = "exitForException";
      return $data_result;
    }
  }
}
