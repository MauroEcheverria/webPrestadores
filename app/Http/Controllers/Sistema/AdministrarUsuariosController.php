<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Sistema\Usuario;
use App\Models\Sistema\Token;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class AdministrarUsuariosController extends Controller
{

   public function index(Request $request) {
		return view('sistema.administrarUsuarios');
	}

	public function getDataTableUsuarios(Request $request){
		if ($request->ajax()) {
			try {
				$usuarios = DB::select("SELECT u.usr_cod_usuario,u.usr_correo,
										r.rol_rol,u.usr_id_empresa,m.emp_empresa,u.usr_id_rol,
										u.usr_estado_contrasenia,u.usr_celular,
										u.usr_estado,u.usr_estado_correo,
										CONCAT(IFNULL(usr_nombre_1,''),' ',IFNULL(usr_nombre_2,''),' ',IFNULL(usr_apellido_1,''),' ',IFNULL(usr_apellido_2,'')) usr_nom_completos,
										u.usr_nombre_1,u.usr_nombre_2,u.usr_apellido_1,u.usr_apellido_2
										FROM dct_sistema_tbl_usuario u,dct_sistema_tbl_rol r,dct_sistema_tbl_empresa m
										WHERE u.usr_id_rol = r.rol_id_rol
										AND u.usr_id_empresa = m.emp_id_empresa");
				$return_array = array();
				$return= array();
				foreach ($usuarios as $usuario) {
					$return_array[0] = $usuario->usr_cod_usuario;
					$return_array[1] = $usuario->usr_nom_completos;
					$return_array[2] = $usuario->usr_correo;
					$return_array[3] = $usuario->usr_celular;
					$return_array[4] = $usuario->rol_rol;
					$return_array[5] = $usuario->emp_empresa;
					$return_array[6] = $usuario->usr_estado;
					$return_array[7] = $usuario->usr_estado_contrasenia;
					$return_array[8] = $usuario->usr_estado_correo;
					$return_array[9] = $usuario->usr_id_empresa;
					$return_array[10] = $usuario->usr_id_rol;
					$return_array[11] = null;
					$return_array[12] = $usuario->usr_nombre_1;
					$return_array[13] = $usuario->usr_nombre_2;
					$return_array[14] = $usuario->usr_apellido_1;
					$return_array[15] = $usuario->usr_apellido_2;
					array_push($return,$return_array);
				}
				$return = array(
					"recordsTotal"    => count($usuarios),
					"recordsFiltered" => count($usuarios),
					"data"            => $return
				);
				return $return;
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
   		}
    }

	public function getCedulaRepetida(Request $request){
        if ($request->ajax()) {
			try {
				$all_usuarios = DB::select("SELECT usr_cod_usuario FROM dct_sistema_tbl_usuario;");
				$cont = 0;
				foreach ($all_usuarios as $all_usuarios) {
					if ( $all_usuarios->usr_cod_usuario == $request->usr_cod_usuario ) { $cont++; }
				}
				if($all_usuarios && $cont == 0) {		
					$data_result["message"] = "saveOK";
				}
				else {
					$data_result["message"] = "dataRepetida";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
        }
    }

	public function getCorreoRepetido(Request $request){
        if ($request->ajax()) {
			try {
				$all_correos= DB::select("SELECT usr_correo FROM dct_sistema_tbl_usuario;");
				$cont = 0;
				foreach ($all_correos as $all_correos) {
					if ( $all_correos->usr_correo == $request->usr_correo ) { $cont++; }
				}
				if($all_correos && $cont == 0) {		
					$data_result["message"] = "saveOK";
					}
				else {
					$data_result["message"] = "dataRepetida";
				}	
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}	
        }
    }

	public function getEmpresaRoles(Request $request){
        if ($request->ajax()) {
			try {
				$data_rol= DB::select("SELECT rol_id_rol,rol_rol 
										FROM dct_sistema_tbl_rol
										WHERE rol_estado = 1;");

				$data_empresa= DB::select("SELECT emp_id_empresa,emp_empresa 
										FROM dct_sistema_tbl_empresa
										WHERE emp_estado = 1;");						
			
				$rpta_roles="<option value=''>Seleccione una opción</option>";
				foreach ($data_rol as $data_rol) {
					$rpta_roles.="<option value='".$data_rol->rol_id_rol."'>".$data_rol->rol_rol."</option>";
				}
				$rpta_empresas="<option value=''>Seleccione una opción</option>";
				foreach ($data_empresa as $data_empresa) {
					$rpta_empresas.="<option value='".$data_empresa->emp_id_empresa."'>".$data_empresa->emp_empresa."</option>";
				}
				if( $data_rol && $data_empresa ) {
					$data_result["message"] = "saveOK";
					$data_result["dataRoles"] = $rpta_roles;
					$data_result["dataEmpresas"] = $rpta_empresas;
				}
				else {
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
        }
    }

	public function verificarToken(Request $request){
		$existeToken = "NO";
    	$tokenUsado = "SI";
		$find_token = DB::select("SELECT tok_cedula,tok_estado
								FROM dct_sistema_tbl_token
								WHERE tok_token = :tok_token;",
								['tok_token' => $request->token]);
		if(COUNT($find_token) == 1) {
			if ($find_token[0]->tok_estado == 1) {
			  $tokenUsado = "NO";
			}
			$existeToken = "SI";
		}
		if ($existeToken == "SI") {
			if ($tokenUsado == "NO") {
				$token_update = Token::where('tok_token',$request->token)
				->update([
					'tok_estado' => 0,
					'tok_ip_modificacion' => request()->ip()
				]);
				$usuario_update = Usuario::where('usr_cod_usuario',$find_token[0]->tok_cedula)
				->update([
					'usr_estado_correo' => 1,
					'usr_estado' => 1,
					'usr_ip_modificacion' => request()->ip()
				]);
				if ($token_update && $usuario_update) {
					$data_result["message"] = "tokenOk";
				}
				else {
					$data_result["message"] = "tokenError";
				}
			}
			else {
				$data_result["message"] = "tokenUsado";
			}
		}
		else {
			$data_result["message"] = "tokenNoExiste";
		}
		return view('sistema.token',compact('data_result'));
	}

	public function guardar_usuario(Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				$dataValidateForm = $request->validate([
					'usr_cod_usuario' => 'required',
					'usr_correo' => 'required',
					'usr_nombre_1' => 'required',
					'usr_nombre_2' => 'required',
					'usr_apellido_1' => 'required',
					'usr_celular' => 'required',
					'usr_id_empresa' => 'required',
					'usr_id_rol' => 'required'
				]);
				$nombre_completo = $request->usr_nombre_1." ".$request->usr_nombre_2." ".$request->usr_apellido_1." ".$request->usr_apellido_2;
				$save_tbl_user = new User();
				$save_tbl_user->name = $funcionAcceso->cleanData(true,60,false,$nombre_completo);
				$save_tbl_user->email = $funcionAcceso->cleanData(true,60,false,$request->usr_correo);
				$save_tbl_user->password = Hash::make($request->usr_cod_usuario);
				$save_tbl_user->save();

				$save_tbl_sistema_usuario = new Usuario();
				$save_tbl_sistema_usuario->usr_cod_usuario = $funcionAcceso->cleanData(true,13,false,$request->usr_cod_usuario);
				$save_tbl_sistema_usuario->usr_nombre_1 = $funcionAcceso->cleanData(true,15,false,$request->usr_nombre_1);
				$save_tbl_sistema_usuario->usr_nombre_2 = $funcionAcceso->cleanData(true,15,false,$request->usr_nombre_2);
				$save_tbl_sistema_usuario->usr_apellido_1 = $funcionAcceso->cleanData(true,15,false,$request->usr_apellido_1);
				$save_tbl_sistema_usuario->usr_apellido_2 = $funcionAcceso->cleanData(true,15,false,$request->usr_apellido_2);
				$save_tbl_sistema_usuario->usr_correo = $funcionAcceso->cleanData(true,60,false,$request->usr_correo);
				$save_tbl_sistema_usuario->usr_celular = $funcionAcceso->cleanData(true,10,false,$request->usr_celular);
				$save_tbl_sistema_usuario->usr_id_rol = $funcionAcceso->cleanData(false,0,false,$request->usr_id_rol);
				$save_tbl_sistema_usuario->usr_id_empresa = $funcionAcceso->cleanData(false,0,false,$request->usr_id_empresa);
				$save_tbl_sistema_usuario->usr_logeado = 0;
				$save_tbl_sistema_usuario->usr_estado = 0;
				$save_tbl_sistema_usuario->usr_estado_contrasenia = 1;
				$save_tbl_sistema_usuario->usr_contador_error_contrasenia = 0;
				$save_tbl_sistema_usuario->usr_expiro_contrasenia = 0;
				$save_tbl_sistema_usuario->usr_estado_correo = 0;
				$save_tbl_sistema_usuario->usr_fecha_cambio_contrasenia = config('global.fechaActual_4');
				$save_tbl_sistema_usuario->usr_fecha_creacion = Carbon::now();
				$save_tbl_sistema_usuario->usr_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
				$save_tbl_sistema_usuario->usr_ip_creacion = request()->ip();
				$save_tbl_sistema_usuario->save();
										
				$tokenAsignado = md5($request->usr_cod_usuario.config('global.fechaActual_0'));
				$save_tbl_token = new Token();
				$save_tbl_token->tok_token = $tokenAsignado;
				$save_tbl_token->tok_tipo = 'ACTIVACION';
				$save_tbl_token->tok_cedula = $request->usr_cod_usuario;
				$save_tbl_token->tok_estado = 1;
				$save_tbl_token->tok_ip_creacion = request()->ip();
				$save_tbl_token->save();

				$data['email_to'] = $request->usr_correo;
				$data['nombre_usuario'] = $nombre_completo;
				$data['token_usuario'] = $tokenAsignado;
				$envioCorreoBienvenida = Mail::send('emails.bienvenida', $data, function ($message) use ($data) {
					$message
					->to($data['email_to'])
					->subject('👋 Bienvenid@ a ServiciosDCT, ayudanos confirmando tu correo electrónico. ✅');
				});
				if ($dataValidateForm && $save_tbl_user && $save_tbl_sistema_usuario && $save_tbl_token && $envioCorreoBienvenida) {
					DB::commit();
					Log::info("Se crea usuario correctamente usuario y se envió correo: ".$request->usr_cod_usuario);
					$data_result["message"] = "saveOK";
				}
				else {
					DB::rollback();
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
		}
	}

	public function editar_usuario (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				$dataValidateForm = $request->validate([
					'edit_usr_estado' => 'required',
					'edit_usr_correo' => 'required',
					'edit_usr_celular' => 'required',
					'edit_usr_nombre_1' => 'required',
					'edit_usr_nombre_2' => 'required',
					'edit_usr_apellido_1' => 'required',
					'edit_usr_id_empresa' => 'required',
					'edit_usr_id_rol' => 'required'
				]);
				$usuario_update = Usuario::where('usr_cod_usuario',$request->usr_cod_usuario)
				->update([
					'usr_correo' => $funcionAcceso->cleanData(true,60,false,$request->edit_usr_correo),
					'usr_celular' => $funcionAcceso->cleanData(true,10,false,$request->edit_usr_celular),
					'usr_id_rol' => $funcionAcceso->cleanData(false,0,false,$request->edit_usr_id_rol),
					'usr_estado' => $funcionAcceso->cleanData(false,0,false,$request->edit_usr_estado),
					'usr_id_empresa' => $funcionAcceso->cleanData(false,0,false,$request->edit_usr_id_empresa),
					'usr_nombre_1' => $funcionAcceso->cleanData(true,15,false,$request->edit_usr_nombre_1),
					'usr_nombre_2' => $funcionAcceso->cleanData(true,15,false,$request->edit_usr_nombre_2),
					'usr_apellido_1' => $funcionAcceso->cleanData(true,15,false,$request->edit_usr_apellido_1),
					'usr_apellido_2' => $funcionAcceso->cleanData(true,15,false,$request->edit_usr_apellido_2),
					'usr_usuario_modificacion' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
					'usr_fecha_modificacion' => Carbon::now(),
					'usr_ip_modificacion' => request()->ip()
				]);
				if ($dataValidateForm && $usuario_update) {
					DB::commit();
					Log::info("Se actualizo correctamente usuario/cedula: ".$request->usr_cod_usuario);
					$data_result["message"] = "saveOK";
				}
				else {
					DB::rollback();
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
		}
	}

	public function resetear_usuario (Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				$user_update = User::where('email',$funcionAcceso->getCorreoPorCedula($request->usr_cod_usuario))
				->update([
					'password' => Hash::make($request->usr_cod_usuario)
				]);
				$usuario_update = Usuario::where('usr_cod_usuario',$request->usr_cod_usuario)
				->update([
					'usr_estado_contrasenia' => 1,
					'usr_expiro_contrasenia' => 1,
					'usr_contador_error_contrasenia' => 0,
					'usr_fecha_cambio_contrasenia' => config('global.fechaActual_5')
				]);
				if ($user_update && $usuario_update) {
					DB::commit();
					Log::info("Se reseteo la contraseña de usuario/cedula: ".$request->usr_cod_usuario);
					$data_result["message"] = "saveOK";
				}
				else {
					DB::rollback();
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				$data_result["cedula"] = $funcionAcceso->getCorreoPorCedula($request->usr_cod_usuario);
				echo json_encode($data_result);
			} catch (\Exception $e) {
				DB::rollback();
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
		}
	}

}