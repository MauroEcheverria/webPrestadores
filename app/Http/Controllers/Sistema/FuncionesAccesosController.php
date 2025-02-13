<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuncionesAccesosController extends Controller {
    public function cleanData($limite,$max,$mayuscula,$data) {
		if ($data != "" && $data != NULL) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlentities($data);
			$data = htmlspecialchars($data, ENT_QUOTES, 'utf-8');
			if ($limite) {
				$data = substr($data,0,$max);
			}
			if ($mayuscula) {
				$data = strtoupper($data);
			}
		}
		else {
			$data = NULL;
		}
	  return $data;
	}

	public function getCedulaPorCorreo($correo){ 
		try {
			$usr_cod_usuario = DB::select("SELECT usr_cod_usuario FROM dct_sistema_tbl_usuario WHERE usr_correo = :usr_correo;",['usr_correo' => $correo]);
			return $usr_cod_usuario[0]->usr_cod_usuario;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function getEmpresaPorCorreo($correo){ 
		try {
			$usr_id_empresa = DB::select("SELECT usr_id_empresa FROM dct_sistema_tbl_usuario WHERE usr_correo = :usr_correo;",['usr_correo' => $correo]);
			return $usr_id_empresa[0]->usr_id_empresa;
		} catch (\Exception $e) {
			return NULL;
		}
	}

	public function getCorreoPorCedula($cedula){
		try {
			$usr_correo = DB::select("SELECT usr_correo FROM dct_sistema_tbl_usuario WHERE usr_cod_usuario = :usr_cod_usuario;",['usr_cod_usuario' => $cedula]);
			return $usr_correo[0]->usr_correo;
		} catch (\Exception $e) {
			return NULL;
		}
	}

}
