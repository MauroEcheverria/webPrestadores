<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Accesos_dct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {

            //Auth::user()->var_db;

            $contValidaAcceso = 0;
            $valAccesoOpcion = false;
            $valEstadoUsuario = false;
            $valEstadoContrasena = false;
            $valEstadoCorreo = false;
            $valExpiroContrasena = false;
            $valEnOtraPC = false;
            $valEstadoOpcion = false;
            $valEstadoAplicativo = false;
            $valEstadoRol = false;
            $valEstadoEmpresa = false;
            $valEstadoVigencia = false;
            $estadoValidarAcceso = false;
            $data_usuario = DB::select("SELECT u.usr_cod_usuario,u.usr_ip_pc_acceso,u.usr_id_rol,u.usr_estado,u.usr_estado_contrasenia,u.usr_expiro_contrasenia,
                                    CONCAT(usr_nombre_1,' ',usr_nombre_2,' ',usr_apellido_1,' ', usr_apellido_2) usr_nom_completos,r.rol_rol,u.usr_estado_correo,
                                    u.usr_id_rol,u.usr_id_empresa, r.rol_estado, m.emp_estado, m.emp_vigencia_desde, m.emp_vigencia_hasta
                                    FROM dct_sistema_tbl_usuario u, dct_sistema_tbl_rol r, dct_sistema_tbl_empresa m
                                    WHERE u.usr_id_rol=r.rol_id_rol
                                    AND u.usr_id_empresa=m.emp_id_empresa
                                    AND u.usr_correo=:usr_correo;",
                                    ['usr_correo' => auth()->user()->email]);
            $opcion = DB::select("SELECT opc_id_opcion, opc_estado
                                FROM dct_sistema_tbl_opcion
                                WHERE opc_ruta=:opc_ruta;",
                                ['opc_ruta' => Route::currentRouteName()]);
            $aplicacion = DB::select("SELECT apl_estado
                                    FROM dct_sistema_tbl_aplicacion
                                    WHERE apl_id_aplicacion = (SELECT opc_id_aplicacion
                                    FROM dct_sistema_tbl_opcion
                                    WHERE opc_id_opcion = :opc_id_opcion);",
                                    ['opc_id_opcion' => $opcion[0]->opc_id_opcion]);
            $rol_opcion = DB::select("SELECT rlo_id_opcion
                                    FROM dct_sistema_tbl_rol_opcion
                                    WHERE rlo_id_rol = (SELECT usr_id_rol 
                                    FROM dct_sistema_tbl_usuario
                                    WHERE usr_cod_usuario = :usr_cod_usuario)
                                    AND rlo_estado = 1;",
                                    ['usr_cod_usuario' => $data_usuario[0]->usr_cod_usuario]);
            $return = array();
            foreach ($rol_opcion as $rol_opcion) {
                $return[] = $rol_opcion->rlo_id_opcion;
            }
            if (in_array($opcion[0]->opc_id_opcion, $return)) {$valAccesoOpcion = true; $contValidaAcceso += 1;}
            if($data_usuario[0]->usr_estado == 1) { $valEstadoUsuario = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->usr_estado_correo == 1) { $valEstadoCorreo = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->usr_estado_contrasenia == 1) { $valEstadoContrasena = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->usr_expiro_contrasenia == 0) { $valExpiroContrasena = true; $contValidaAcceso += 1; }
            //if($data_usuario[0]->usr_ip_pc_acceso == request()->ip() || $data_usuario[0]->usr_ip_pc_acceso == NULL) { $valEnOtraPC = true; $contValidaAcceso += 1; }
            if($opcion[0]->opc_estado == 1) { $valEstadoOpcion = true; $contValidaAcceso += 1; }
            if($aplicacion[0]->apl_estado == 1) { $valEstadoAplicativo = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->rol_estado == 1) { $valEstadoRol = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->emp_estado == 1) { $valEstadoEmpresa = true; $contValidaAcceso += 1; }
            if($data_usuario[0]->emp_vigencia_hasta >= config('global.fecha_actual.fechaActual_5')) { $valEstadoVigencia = true; $contValidaAcceso += 1; }
            if($contValidaAcceso == 10) { $estadoValidarAcceso = true;}
            if ($estadoValidarAcceso) {
                return $next($request);
            }
            else {
                if (!$valEstadoUsuario) {
                    return redirect('/usuario_inactivo');
                }
                else if (!$valEstadoContrasena) {
                    return redirect('/contrasena_inactiva');
                }
                else if (!$valExpiroContrasena) {
                    return redirect('/expiro_contrasena');
                }
                else if (!$valEstadoAplicativo) {
                    return redirect('/aplicativo_inactivo');
                }
                else if (!$valEstadoRol) {
                    return redirect('/rol_inactivo');
                }
                else if (!$valEstadoEmpresa) {
                    return redirect('/empresa_inactiva');
                }
                else if (!$valEstadoVigencia) {
                    return redirect('/licencia_caducada');
                }
                else if (!$valEstadoOpcion) {
                    return redirect('/modulo_inactivo');
                }
                else if (!$valEstadoCorreo) {
                    return redirect('/correo_no_validado');
                }
                else if (!$valAccesoOpcion) {
                    return redirect('/no_possee_autorizacion');
                }
                else {
                    /*if (!$valEnOtraPC) {
                        return redirect('/ingreso_otra_PC');
                    }*/
                    return redirect('/opcion_no_registrada');
                }
            }
        } catch (\Exception $e) {
            Log::error("Salida por Excepción");
            Log::error("Archivo: ", [__FILE__]);
            Log::error("Línea: ", [__LINE__]);
            $data_result["message"] = "saveError";
            $data_result["exception"] = $e;
            return $data_result;
        }
    }
}
