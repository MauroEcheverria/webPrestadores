<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Sistema\Aplicacion;
use App\Models\Sistema\Empresa;
use App\Models\Sistema\Empresa_Aplicativo;
use App\Models\Sistema\Opcion;
use App\Models\Sistema\Rol;
use App\Models\Sistema\Rol_Aplicativo;
use App\Models\Sistema\Rol_Opcion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdministrarAccesosController extends Controller
{
    public function index(Request $request) {
		return view('sistema.administrarAccesos');
	}

	public function getDataTableSistemaEmpresa(Request $request){
        if ($request->ajax()) {
			try {
				$empresas = DB::select("select
										em.emp_id_empresa, 
										em.emp_empresa, 
										em.emp_ruc, 
										em.emp_vigencia_desde, 
										em.emp_vigencia_hasta, 
										c.ctg_descripcion tipo_plan,
										em.em_archivo_fact_elec,
										em.emp_estado, 
										em.ctg_id_catalogo,
										em.emp_nom_comercial,
										em.emp_contrib_especial,
										em.emp_direccion_matriz,
										ifnull(em.emp_obli_contabilidad,'NO') emp_obli_contabilidad,
										em.wsr_tipo_ambiente,
										s.ser_factura_serie,
										s.ser_nota_credito_serie,
										s.ser_nota_debito_serie,
										s.ser_guia_remision_serie,
										s.ser_comp_ret_serie
										FROM dct_sistema_tbl_empresa em
										inner join dct_sistema_tbl_catalogo c
										on em.ctg_id_catalogo = c.ctg_id_catalogo
										inner join dct_pos_tbl_empresa_serial s
										on em.emp_id_empresa = s.emp_id_empresa;");
				$return_array = array();
				$return= array();
				foreach ($empresas as $empresa) {
					$return_array[0] = $empresa->emp_id_empresa;
					$return_array[1] = $empresa->emp_ruc;
					$return_array[2] = $empresa->emp_empresa;
					$return_array[3] = $empresa->emp_nom_comercial;
					$return_array[4] = $empresa->emp_contrib_especial;
					$return_array[5] = $empresa->emp_direccion_matriz;
					$return_array[6] = $empresa->ser_factura_serie;
					$return_array[7] = $empresa->ser_nota_credito_serie;
					$return_array[8] = $empresa->ser_nota_debito_serie;
					$return_array[9] = $empresa->ser_guia_remision_serie;
					$return_array[10] = $empresa->ser_comp_ret_serie;
					$return_array[11] = $empresa->emp_obli_contabilidad;
					$return_array[12] = $empresa->wsr_tipo_ambiente;
					$return_array[13] = $empresa->emp_vigencia_desde;
					$return_array[14] = $empresa->emp_vigencia_hasta;
					$return_array[15] = $empresa->tipo_plan;
					$return_array[16] = $empresa->em_archivo_fact_elec;
					$return_array[17] = $empresa->emp_estado;
					$return_array[18] = null;
					$return_array[19] = $empresa->ctg_id_catalogo;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($empresas),
					"recordsFiltered" => count($empresas),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaAplicacion(Request $request){
        if ($request->ajax()) {
			try {
				$aplicaciones = DB::select("SELECT * FROM dct_sistema_tbl_aplicacion;");
				$return_array = array();
				$return= array();
				foreach ($aplicaciones as $aplicacion) {
					$return_array[0] = $aplicacion->apl_id_aplicacion;
					$return_array[1] = $aplicacion->apl_aplicacion;
					$return_array[2] = $aplicacion->apl_nom_superior;
					$return_array[3] = $aplicacion->apl_nom_inferior;
					$return_array[4] = $aplicacion->apl_id_htm;
					$return_array[5] = $aplicacion->apl_id_imagen;
					$return_array[6] = $aplicacion->apl_estado;
					$return_array[7] = null;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($aplicaciones),
					"recordsFiltered" => count($aplicaciones),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaOpcion(Request $request){
        if ($request->ajax()) {
			try {
				$opciones = DB::select("SELECT * FROM dct_sistema_tbl_opcion;");
				$return_array = array();
				$return= array();
				foreach ($opciones as $opcion) {
					$return_array[0] = $opcion->opc_id_opcion;
					$return_array[1] = $opcion->opc_opcion;
					$aplicacion = DB::select("SELECT apl_aplicacion
											FROM dct_sistema_tbl_aplicacion
											WHERE apl_id_aplicacion = :apl_id_aplicacion;",
											['apl_id_aplicacion' =>$opcion->opc_id_aplicacion]);
					$return_array[2] = $aplicacion[0]->apl_aplicacion;
					$return_array[3] = $opcion->opc_orden;
					$return_array[4] = $opcion->opc_estado;
					$return_array[5] = null;
					$return_array[6] = $opcion->opc_id_aplicacion;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($opciones),
					"recordsFiltered" => count($opciones),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaRol(Request $request){
        if ($request->ajax()) {
			try {
				$roles = DB::select("SELECT * FROM dct_sistema_tbl_rol;");
				$return_array = array();
				$return= array();
				foreach ($roles as $rol) {
					$return_array[0] = $rol->rol_id_rol;
					$return_array[1] = $rol->rol_rol;
					$return_array[2] = $rol->rol_estado;
					$return_array[3] = null;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($roles),
					"recordsFiltered" => count($roles),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaEmpresaAplicativo(Request $request){
        if ($request->ajax()) {
			try {
				$empresa_aplicativos = DB::select("SELECT ape_id_empresa, ape_id_aplicacion,
												(SELECT emp.emp_empresa FROM dct_sistema_tbl_empresa emp WHERE emp.emp_id_empresa = ape_id_empresa) emp_empresa,
												(SELECT apl.apl_aplicacion FROM dct_sistema_tbl_aplicacion apl WHERE apl.apl_id_aplicacion  = ape_id_aplicacion) apl_aplicacion, ape_estado
												FROM dct_sistema_tbl_aplicacion_empresa;");
				$return_array = array();
				$return= array();
				foreach ($empresa_aplicativos as $empresa_aplicativo) {
					$return_array[0] = $empresa_aplicativo->ape_id_empresa;
					$return_array[1] = $empresa_aplicativo->ape_id_aplicacion;
					$return_array[2] = $empresa_aplicativo->emp_empresa;
					$return_array[3] = $empresa_aplicativo->apl_aplicacion;
					$return_array[4] = $empresa_aplicativo->ape_estado;
					$return_array[5] = null;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($empresa_aplicativos),
					"recordsFiltered" => count($empresa_aplicativos),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaRolAplicativo(Request $request){
        if ($request->ajax()) {
			try {
				$rol_aplicativos = DB::select("SELECT 
											rla_id_rol, 
											rla_id_aplicacion,
											(SELECT emp.rol_rol FROM dct_sistema_tbl_rol emp WHERE emp.rol_id_rol = rla_id_rol) rol_rol,
											(SELECT apl.apl_aplicacion FROM dct_sistema_tbl_aplicacion apl WHERE apl.apl_id_aplicacion = rla_id_aplicacion) apl_aplicacion,
											rla_estado
											FROM dct_sistema_tbl_rol_aplicacion;");
				$return_array = array();
				$return= array();
				foreach ($rol_aplicativos as $rol_aplicativo) {
					$return_array[0] = $rol_aplicativo->rla_id_rol;
					$return_array[1] = $rol_aplicativo->rla_id_aplicacion;
					$return_array[2] = $rol_aplicativo->rol_rol;
					$return_array[3] = $rol_aplicativo->apl_aplicacion;
					$return_array[4] = $rol_aplicativo->rla_estado;
					$return_array[5] = null;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($rol_aplicativos),
					"recordsFiltered" => count($rol_aplicativos),
					"data"            => $return
				);
				return $return;
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

	public function getDataTableSistemaRolOpcion(Request $request){
        if ($request->ajax()) {
			try {
				$rol_opciones = DB::select("SELECT 
										rlo_id_rol , 
										rlo_id_opcion ,
										(SELECT emp.rol_rol FROM dct_sistema_tbl_rol emp WHERE emp.rol_id_rol = rlo_id_rol ) rol_rol,
										(SELECT id.apl_aplicacion FROM dct_sistema_tbl_aplicacion id WHERE id.apl_id_aplicacion = (SELECT rol.opc_id_aplicacion FROM dct_sistema_tbl_opcion rol WHERE rol.opc_id_opcion  = rlo_id_opcion)) apl_aplicacion,
										(SELECT apl.opc_opcion FROM dct_sistema_tbl_opcion apl WHERE apl.opc_id_opcion  = rlo_id_opcion ) opc_opcion,
										rlo_estado 
										FROM dct_sistema_tbl_rol_opcion;");
				$return_array = array();
				$return= array();
				foreach ($rol_opciones as $rol_opcion) {
					$return_array[0] = $rol_opcion->rlo_id_rol;
					$return_array[1] = $rol_opcion->rlo_id_opcion;
					$return_array[2] = $rol_opcion->rol_rol;
					$return_array[3] = $rol_opcion->apl_aplicacion;
					$return_array[4] = $rol_opcion->opc_opcion;
					$return_array[5] = $rol_opcion->rlo_estado;
					$return_array[6] = null;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($rol_opciones),
					"recordsFiltered" => count($rol_opciones),
					"data"            => $return
				);
				return $return;
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

	public function getDataSelect(){
        if (true) {
			try {
				$data_catalogo = DB::select("SELECT ctg_id_catalogo,ctg_descripcion 
											FROM dct_sistema_tbl_catalogo
											WHERE ctg_tipo = 'POS';");

				$data_empresa = DB::select("SELECT emp_id_empresa,emp_empresa FROM dct_sistema_tbl_empresa;");						
			
				$data_aplicacion = DB::select("SELECT apl_id_aplicacion ,apl_aplicacion FROM dct_sistema_tbl_aplicacion;");

				$data_rol = DB::select("SELECT rol_id_rol,rol_rol FROM dct_sistema_tbl_rol;");

				$data_opcion = DB::select("SELECT opc_id_opcion,
										CONCAT((SELECT apl.apl_aplicacion 
										FROM dct_sistema_tbl_aplicacion apl 
										WHERE apl.apl_id_aplicacion = opc_id_aplicacion),' - ',opc_opcion) opc_opcion
										FROM dct_sistema_tbl_opcion;");
				
				$rpta_catalogos="<option value=''>Seleccione una opción</option>";
				foreach ($data_catalogo as $data_catalogo) {
					$rpta_catalogos.="<option value='".$data_catalogo->ctg_id_catalogo."'>".$data_catalogo->ctg_descripcion."</option>";
				}
				$rpta_empresas="<option value=''>Seleccione una opción</option>";
				foreach ($data_empresa as $data_empresa) {
					$rpta_empresas.="<option value='".$data_empresa->emp_id_empresa."'>".$data_empresa->emp_empresa."</option>";
				}
				$rpta_aplicaciones="<option value=''>Seleccione una opción</option>";
				foreach ($data_aplicacion as $data_aplicacion) {
					$rpta_aplicaciones.="<option value='".$data_aplicacion->apl_id_aplicacion."'>".$data_aplicacion->apl_aplicacion."</option>";
				}
				$rpta_roles="<option value=''>Seleccione una opción</option>";
				foreach ($data_rol as $data_rol) {
					$rpta_roles.="<option value='".$data_rol->rol_id_rol."'>".$data_rol->rol_rol."</option>";
				}
				$rpta_opciones="<option value=''>Seleccione una opción</option>";
				foreach ($data_opcion as $data_opcion) {
					$rpta_opciones.="<option value='".$data_opcion->opc_id_opcion."'>".$data_opcion->opc_opcion."</option>";
				}

				if( $data_catalogo && $data_empresa && $data_aplicacion && $data_rol && $data_opcion) {
					$data_result["message"] = "saveOK";
					$data_result["dataCatalogos"] = $rpta_catalogos;
					$data_result["dataEmpresas"] = $rpta_empresas;
					$data_result["dataAplicaciones"] = $rpta_aplicaciones;
					$data_result["dataRoles"] = $rpta_roles;
					$data_result["dataOpciones"] = $rpta_opciones;
				}
				else {
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
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

	public function cargaSistemaRolOpcion(Request $request){
        if ($request->ajax()) {
			try {
				if ($request->dataEdit == "new") {
					$data_rol_opcion = DB::select("SELECT opc_id_opcion,CONCAT((SELECT apl.apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion apl 
					WHERE apl.apl_id_aplicacion = opc_id_aplicacion),' - ',opc_opcion) opc_opcion 
					FROM dct_sistema_tbl_opcion
					WHERE opc_id_opcion NOT IN (SELECT rlo_id_opcion 
					FROM dct_sistema_tbl_rol_opcion
					WHERE rlo_id_rol = :rlo_id_rol)
					ORDER BY 2",
					['rlo_id_rol' => $request->dataSelect]);
				}
				else {
					$data_rol_opcion = DB::select("SELECT opc_id_opcion,CONCAT((SELECT apl.apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion apl 
					WHERE apl.apl_id_aplicacion = opc_id_aplicacion),' - ',opc_opcion) opc_opcion 
					FROM dct_sistema_tbl_opcion
					WHERE opc_id_opcion IN (SELECT rlo_id_opcion 
					FROM dct_sistema_tbl_rol_opcion
					WHERE rlo_id_rol = :rlo_id_rol)
					ORDER BY 2",
					['rlo_id_rol' => $request->dataSelect]);
				}

				$rpta_rol_opcion="<option value=''>Seleccione una opción</option>";
				foreach ($data_rol_opcion as $data_rol_opcion) {
					$rpta_rol_opcion.="<option value='".$data_rol_opcion->opc_id_opcion."'>".$data_rol_opcion->opc_opcion."</option>";
				}
				
				$data_result["message"] = "saveOK";
				$data_result["dataRolOpcion"] = $rpta_rol_opcion;
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

	public function adminSistemaRolOpcion (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_rol_opc == "New") {
					$save_tbl_rol_opcion = new Rol_Opcion();
					$save_tbl_rol_opcion->rlo_id_rol = $request->rol_rol_3;
					$save_tbl_rol_opcion->rlo_id_opcion = $request->opc_opcion_3;
					$save_tbl_rol_opcion->rlo_estado = 1;
					$save_tbl_rol_opcion->rlo_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
					$save_tbl_rol_opcion->rlo_fecha_creacion = now();
					$save_tbl_rol_opcion->rlo_ip_creacion = request()->ip();
					$save_tbl_rol_opcion->save();
					if ($save_tbl_rol_opcion) {
						DB::commit();
						Log::info("Se crea uno nuevo Rol Opcion:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else if ($request->tipo_form_sist_rol_opc == "Old") {
					$rol_opcion_update = Rol_Opcion::where([
						'rlo_id_rol' => $request->rol_rol_3,
						'rlo_id_opcion' => $request->opc_opcion_3
					])
					->update([
						'rlo_estado' => $request->rlo_estado,
						'rlo_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'rlo_fecha_modificacion' => now(),
						'rlo_ip_modificacion' => request()->ip()
					]);
					if ($rol_opcion_update) {
						DB::commit();
						Log::info("Se actualiza Rol Opcion:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar rol-opcion");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function cargaSistemaRolAplicativo(Request $request){
        if ($request->ajax()) {
			try {
				if ($request->dataEdit == "new") {
					$data_rol_aplicacion = DB::select("SELECT apl_id_aplicacion ,apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion
					WHERE apl_id_aplicacion NOT IN (SELECT rla_id_aplicacion 
					FROM dct_sistema_tbl_rol_aplicacion
					WHERE rla_id_rol = :rla_id_rol)
					ORDER BY 2",
					['rla_id_rol' => $request->dataSelect]);
				}
				else {
					$data_rol_aplicacion = DB::select("SELECT apl_id_aplicacion ,apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion
					WHERE apl_id_aplicacion IN (SELECT rla_id_aplicacion 
					FROM dct_sistema_tbl_rol_aplicacion
					WHERE rla_id_rol = :rla_id_rol)
					ORDER BY 2",
					['rla_id_rol' => $request->dataSelect]);
				}

				$rpta_rol_aplicacion="<option value=''>Seleccione una opción</option>";
				foreach ($data_rol_aplicacion as $data_rol_aplicacion) {
					$rpta_rol_aplicacion.="<option value='".$data_rol_aplicacion->apl_id_aplicacion."'>".$data_rol_aplicacion->apl_aplicacion."</option>";
				}
				
				$data_result["message"] = "saveOK";
				$data_result["dataRolAplicacion"] = $rpta_rol_aplicacion;
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

	public function adminSistemaRolAplicativo (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_rol_apl == "New") {
					$save_tbl_rol_aplicativo = new Rol_Aplicativo();
					$save_tbl_rol_aplicativo->rla_id_rol = $request->rol_rol_2;
					$save_tbl_rol_aplicativo->rla_id_aplicacion = $request->apl_aplicacion_2;
					$save_tbl_rol_aplicativo->rla_estado = 1;
					$save_tbl_rol_aplicativo->rla_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
					$save_tbl_rol_aplicativo->rla_fecha_creacion = now();
					$save_tbl_rol_aplicativo->rla_ip_creacion = request()->ip();
					$save_tbl_rol_aplicativo->save();
					if ($save_tbl_rol_aplicativo) {
						DB::commit();
						Log::info("Se crea uno nuevo Rol Aplicacion:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else if ($request->tipo_form_sist_rol_apl == "Old") {
					$rol_aplicativo_update = Rol_Aplicativo::where([
						'rla_id_rol' => $request->rol_rol_2,
						'rla_id_aplicacion' => $request->apl_aplicacion_2
					])
					->update([
						'rla_estado' => $request->rla_estado,
						'rla_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'rla_fecha_modificacion' => now(),
						'rla_ip_modificacion' => request()->ip()
					]);
					if ($rol_aplicativo_update) {
						DB::commit();
						Log::info("Se actualiza Rol Aplicacion:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar rol-aplicacion");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function cargaSistemaEmpresaAplicativo(Request $request){
        if ($request->ajax()) {
			try {
				if ($request->dataEdit == "new") {
					$data_empresa_aplicacion = DB::select("SELECT apl_id_aplicacion ,apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion
					WHERE apl_id_aplicacion NOT IN (SELECT ape_id_aplicacion 
					FROM dct_sistema_tbl_aplicacion_empresa
					WHERE ape_id_empresa = :ape_id_empresa)
					ORDER BY 2",
					['ape_id_empresa' => $request->dataSelect]);
				}
				else {
					$data_empresa_aplicacion = DB::select("SELECT apl_id_aplicacion ,apl_aplicacion 
					FROM dct_sistema_tbl_aplicacion
					WHERE apl_id_aplicacion IN (SELECT ape_id_aplicacion 
					FROM dct_sistema_tbl_aplicacion_empresa
					WHERE ape_id_empresa = :ape_id_empresa)
					ORDER BY 2",
					['ape_id_empresa' => $request->dataSelect]);
				}
				$rpta_empresa_aplicacion="<option value=''>Seleccione una opción</option>";
				foreach ($data_empresa_aplicacion as $data_empresa_aplicacion) {
					$rpta_empresa_aplicacion.="<option value='".$data_empresa_aplicacion->apl_id_aplicacion."'>".$data_empresa_aplicacion->apl_aplicacion."</option>";
				}

				$data_result["message"] = "saveOK";
				$data_result["dataEmpresaAplicacion"] = $rpta_empresa_aplicacion;
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError3";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
        }
    }

	public function adminSistemaEmpresaAplicativo (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_emp_apl == "New") {
					$save_tbl_empresa_aplicativo = new Empresa_Aplicativo();
					$save_tbl_empresa_aplicativo->ape_id_aplicacion = $request->apl_aplicacion_1;
					$save_tbl_empresa_aplicativo->ape_id_empresa = $request->emp_empresa_1;
					$save_tbl_empresa_aplicativo->ape_estado = 1;
					$save_tbl_empresa_aplicativo->ape_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
					$save_tbl_empresa_aplicativo->ape_fecha_creacion = now();
					$save_tbl_empresa_aplicativo->ape_ip_creacion = request()->ip();
					$save_tbl_empresa_aplicativo->save();
					if ($save_tbl_empresa_aplicativo) {
						DB::commit();
						Log::info("Se crea una nueva Empresa Aplicativo:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else if ($request->tipo_form_sist_emp_apl == "Old") {
					$empresa_aplicativo_update = Empresa_Aplicativo::where([
						'ape_id_aplicacion' => $request->apl_aplicacion_1,
						'ape_id_empresa' => $request->emp_empresa_1
					])
					->update([
						'ape_estado' => $request->ape_estado,
						'ape_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'ape_fecha_modificacion' => now(),
						'ape_ip_modificacion' => request()->ip()
					]);
					if ($empresa_aplicativo_update) {
						DB::commit();
						Log::info("Se actualiza una Empresa Aplicativo:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar empresa-aplicacion");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function adminSistemaRol (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_rol == "New") {
					$save_tbl_rol = new Rol();
					$save_tbl_rol->rol_rol = $request->rol_rol;
					$save_tbl_rol->rol_estado = 1;
					$save_tbl_rol->rol_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
					$save_tbl_rol->rol_fecha_creacion = now();
					$save_tbl_rol->rol_ip_creacion = request()->ip();
					$save_tbl_rol->save();
					if ($save_tbl_rol) {
						DB::commit();
						Log::info("Se crea un nuevo Rol:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else if ($request->tipo_form_sist_rol == "Old") {
					$rol_update = Rol::where([
						'rol_id_rol' => $request->rol_rol
					])
					->update([
						'rol_estado' => $request->rol_estado,
						'rol_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'rol_fecha_modificacion' => now(),
						'rol_ip_modificacion' => request()->ip()
					]);
					if ($rol_update) {
						DB::commit();
						Log::info("Se actualiza un Rol:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar un Rol");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function adminSistemaOpcion (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_opc == "Old") {
					$opcion_update = Opcion::where([
						'opc_id_opcion' => $request->opc_opcion
					])
					->update([
						'opc_estado' => $request->opc_estado,
						'opc_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'opc_fecha_modificacion' => now(),
						'opc_ip_modificacion' => request()->ip()
					]);
					if ($opcion_update) {
						DB::commit();
						Log::info("Se actualizo la opcion");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar la opcion");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function adminSistemaAplicacion (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_apl == "Old") {
					$aplicacion_update = Aplicacion::where([
						'apl_id_aplicacion' => $request->apl_aplicacion
					])
					->update([
						'apl_estado' => $request->apl_estado,
						'apl_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'apl_fecha_modificacion' => now(),
						'apl_ip_modificacion' => request()->ip()
					]);
					if ($aplicacion_update) {
						DB::commit();
						Log::info("Se actualizo la opcion");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar la opcion");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

	public function adminSistemaEmpresa (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				if ($request->tipo_form_sist_empre == "New") {
					$save_tbl_empresa = Empresa::insert([
						'emp_empresa' => $request->emp_empresa,
						'emp_nom_comercial' => $request->emp_nom_comercial,
						'emp_ruc' => $request->emp_ruc,
						'emp_vigencia_desde' => $request->emp_vigencia_desde,
						'emp_vigencia_hasta' => $request->emp_vigencia_hasta,
						'ctg_id_catalogo' => $request->ctg_id_catalogo,
						'em_logo' => null,
						'emp_contrib_especial' => $request->emp_contrib_especial,
						'emp_direccion_matriz' => $request->emp_direccion_matriz,
						'wsr_tipo_ambiente' => $request->em_tipo_ambiente,
						'em_tipo_emision' => 1,
						'emp_obli_contabilidad' => $request->emp_obli_contabilidad,
						'emp_estado' => 1,
						'em_usuario_creacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'em_fecha_creacion' => now(),
						'em_ip_creacion' => request()->ip(),
					]);
					/*$save_tbl_empresa_serial = Empresa_Serial::insert([
						'emp_id_empresa' => $max_empresa[0]->max,
						'ser_factura_serie' => $request->ser_factura_serie,
						'ser_nota_credito_serie' => $request->ser_nota_credito_serie,
						'ser_nota_debito_serie' => $request->ser_nota_debito_serie,
						'ser_guia_remision_serie' => $request->ser_guia_remision_serie,
						'ser_comp_ret_serie' => $request->ser_comp_ret_serie,
						'ser_factura_cod_num' => 1,
						'ser_nota_credito_cod_num' => 1,
						'ser_nota_debito_cod_num' => 1,
						'ser_guia_remision_cod_num' => 1,
						'ser_comp_ret_cod_num' => 1,
						'ser_estado' => 1,
						'ser_usuario_creacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'ser_fecha_creacion' => now(),
						'ser_ip_creacion' => request()->ip(),
					]);
					$save_tbl_empresa_establecimiento = Empresa_Establecimiento::insert([
						'emp_id_empresa' => $max_empresa[0]->max,
						'est_direccion_emisor' => $request->emp_direccion_matriz,
						'est_es_matriz' => 1,
						'est_estado' => 1,
						'est_usuario_creacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'est_fecha_creacion' => now(),
						'est_ip_creacion' => request()->ip(),
					]);
					$save_tbl_empresa_punto_emision = Empresa_Punto_Emision::insert([
						'epe_id_empresa' => $max_empresa[0]->max,
						'epe_descripcion_punto_emisor' => "Punto de Emisión 1",
						'epe_estado' => 1,
						'epe_usuario_creacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'epe_fecha_creacion' => now(),
						'epe_ip_creacion' => request()->ip(),
					]);*/
					if ($save_tbl_empresa) {
						DB::commit();
						Log::info("Se crea una nueva Empresa:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else if ($request->tipo_form_sist_empre == "Old") {
					$empresa_update = Empresa::where([
						'emp_id_empresa' => $request->emp_id_empresa
					])
					->update([
						'emp_empresa' => $request->emp_empresa,
						'emp_ruc' => $request->emp_ruc,
						'emp_vigencia_desde' => $request->emp_vigencia_desde,
						'emp_vigencia_hasta' => $request->emp_vigencia_hasta,
						'ctg_id_catalogo' => $request->ctg_id_catalogo,
						'emp_estado' => $request->emp_estado,
						'em_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
						'em_fecha_modificacion' => now(),
						'em_ip_modificacion' => request()->ip()
					]);
					if ($empresa_update) {
						DB::commit();
						Log::info("Se actualizo Empresa:");
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Query");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				}
				else {
					DB::rollback();
					Log::error("No entro por ninguna opción para administrar una Empresa");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error("Salida por Excepción");
				Log::error("Archivo: ", [__FILE__]);
				Log::error("Línea: ", [__LINE__]);
				$data_result["message"] = "saveError";
				$data_result["exception"] = $e;
				echo json_encode($data_result);
			}
		}
	}

}