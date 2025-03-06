<?php

namespace App\Http\Controllers\Salud;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use App\Models\Salud\AgendaMedica;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaMedicaController extends Controller
{
  public function index(Request $request) {
		return view('salud.agendaMedica');
	}

	public function getDataTableAgendaMedica(Request $request){
		
			try {
				$agendas = DB::select("SELECT * FROM dct_salud_tbl_agenda_medica");
				$events = array();
				foreach ($agendas as $agenda) {
					$events[] = [
	          'id'            => $agenda->agm_id_agenda,
	          'title'         => $agenda->agm_titulo,
	          'start'         => $agenda->agm_fecha_inicio."T".$agenda->agm_hora_inicio,
	          'end'           => $agenda->agm_fecha_final."T".$agenda->agm_hora_final,
	          'borderColor'   => '#0000ff',
	          'url'           => '#',
	          'extendedProps' => [
	            'observacion'  => $agenda->agm_observacion,
	            'correo_paciente'  => $agenda->agm_correo_paciente,
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
	public function guardar_agenda(Request $request) {
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

				$save_tbl_agenda_medica = new AgendaMedica();
				$save_tbl_agenda_medica->pct_id_paciente = $funcionAcceso->cleanData(false,0,false,1);
				$save_tbl_agenda_medica->emp_id_empresa = $funcionAcceso->cleanData(false,0,false,1);
				$save_tbl_agenda_medica->esp_id_especialidad = $funcionAcceso->cleanData(false,0,false,1);
				$save_tbl_agenda_medica->usr_cod_usuario = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
				$save_tbl_agenda_medica->agm_tipo = $funcionAcceso->cleanData(false,0,false,"CITA");
				$save_tbl_agenda_medica->agm_titulo = $funcionAcceso->cleanData(false,0,false,"CITA");
				$save_tbl_agenda_medica->agm_correo_paciente = $funcionAcceso->cleanData(false,0,false,"asasds");
				$save_tbl_agenda_medica->agm_fecha_inicio = $funcionAcceso->cleanData(false,0,false,"2025-03-05");
				$save_tbl_agenda_medica->agm_hora_inicio = $funcionAcceso->cleanData(false,0,false,"08:00");
				$save_tbl_agenda_medica->agm_fecha_final = $funcionAcceso->cleanData(false,0,false,"2025-03-05");
				$save_tbl_agenda_medica->agm_hora_final = $funcionAcceso->cleanData(false,0,false,"08:30");
				$save_tbl_agenda_medica->agm_background_color = $funcionAcceso->cleanData(false,0,false,"#dddd");
				$save_tbl_agenda_medica->agm_border_color = $funcionAcceso->cleanData(false,0,false,"#ffff");
				$save_tbl_agenda_medica->agm_observacion = $funcionAcceso->cleanData(false,0,false,"NA");
				$save_tbl_agenda_medica->agm_estado = $funcionAcceso->cleanData(false,0,false,"A");
				$save_tbl_agenda_medica->agm_fecha_creacion = Carbon::now();
				$save_tbl_agenda_medica->agm_usuario_creacion = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
				$save_tbl_agenda_medica->agm_ip_creacion = request()->ip();
				$save_tbl_agenda_medica->save();

										
				/*$data['email_to'] = $request->usr_correo;
				$data['nombre_usuario'] = $nombre_completo;
				$data['token_usuario'] = $tokenAsignado;
				$envioCorreoBienvenida = Mail::send('emails.bienvenida', $data, function ($message) use ($data) {
					$message
					->to($data['email_to'])
					->subject('👋 Bienvenid@ a ServiciosDCT, ayudanos confirmando tu correo electrónico. ✅');
				});*/
				if (/*$dataValidateForm && */$save_tbl_agenda_medica /*&& $envioCorreoBienvenida*/) {
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