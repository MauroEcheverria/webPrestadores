<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Sistema\Token;
use App\Models\Sistema\Usuario;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller {
	public function getAllUsers(Request $request){
		try {
			$usuarios = DB::select("SELECT u.usr_cod_usuario,u.usr_correo,
									r.rol_rol,u.usr_id_empresa,m.emp_empresa,u.usr_id_rol,
									u.usr_estado_contrasenia,
									u.usr_estado,u.usr_estado_correo,
									CONCAT(IFNULL(usr_nombre_1,''),' ',IFNULL(usr_nombre_2,''),' ',IFNULL(usr_apellido_1,''),' ',IFNULL(usr_apellido_2,'')) usr_nom_completos
									FROM dct_sistema_tbl_usuario u,dct_sistema_tbl_rol r,dct_sistema_tbl_empresa m
									WHERE u.usr_id_rol = r.rol_id_rol
									AND u.usr_id_empresa = m.emp_id_empresa");
			$return_array = array();
			$return= array();
			foreach ($usuarios as $usuario) {
				$return_array["usr_cod_usuario"] = $usuario->usr_cod_usuario;
				$return_array["usr_nom_completos"] = $usuario->usr_nom_completos;
				$return_array["usr_correo"] = $usuario->usr_correo;
				array_push($return,$return_array);
			}
      return response()->json(['data' => $return]);
    }
		catch (\Exception $e) {
			$data_result["message"] = "saveError";
			$data_result["exception"] = $e;
			echo json_encode($data_result);
		}
  }
}