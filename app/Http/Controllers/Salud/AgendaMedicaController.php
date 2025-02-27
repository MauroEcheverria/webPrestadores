<?php

namespace App\Http\Controllers\Salud;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use App\Models\Salud\AgendaMedica;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AgendaMedicaController extends Controller
{
  public function index(Request $request) {
		return view('salud.agendaMedica');
	}

	public function getDataTableAgendaMedica(Request $request){
		try {
			$Agendas = DB::select("SELECT * FROM dct_salud_tbl_agenda_medica");
			$events = array();
			foreach ($Agendas as $agenda) {
				$events[] = [
          'id'            => $agenda['agm_iden_uni'],
          'title'         => $agenda['agm_titulo'],
          'start'         => $agenda['agm_fecha_inicio']."".$agenda['agm_hora_inicio'],
          'end'           => $agenda['agm_fecha_final']."".$agenda['agm_hora_final'],
          'borderColor'   => '#0000ff',
          'url'           => '#',
          'extendedProps' => [
            'observación'  => $agenda['agm_observacion'],
          ],
          'className' => ["redEvent"]
        ];
			}
		  echo json_encode($events);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			$data_result["message"] = "exitForException";
			$data_result["exception"] = $e->getMessage();
			echo json_encode($data_result);
		}
	}
	public function guardar_usuario(Request $request) {
		if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();
				/*$dataValidateForm = $request->validate([
					'usr_cod_usuario' => 'required',
					'usr_correo' => 'required',
					'usr_nombre_1' => 'required',
					'usr_nombre_2' => 'required',
					'usr_apellido_1' => 'required',
					'usr_celular' => 'required',
					'usr_id_empresa' => 'required',
					'usr_id_rol' => 'required'
				]);*/


				$save_tbl_user = new User();
				$save_tbl_user->name = $funcionAcceso->cleanData(true,60,false,$nombre_completo);
				$save_tbl_user->email = $funcionAcceso->cleanData(true,60,false,$request->usr_correo);
				$save_tbl_user->password = Hash::make($request->usr_cod_usuario);
				$save_tbl_user->save();

										
				/*$data['email_to'] = $request->usr_correo;
				$data['nombre_usuario'] = $nombre_completo;
				$data['token_usuario'] = $tokenAsignado;
				$envioCorreoBienvenida = Mail::send('emails.bienvenida', $data, function ($message) use ($data) {
					$message
					->to($data['email_to'])
					->subject('👋 Bienvenid@ a ServiciosDCT, ayudanos confirmando tu correo electrónico. ✅');
				});*/
				if (/*$dataValidateForm && */$save_tbl_user /*&& $envioCorreoBienvenida*/) {
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

}