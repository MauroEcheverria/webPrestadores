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

        switch ($agenda->agm_estado) {
          case 'AG':
            $className = "evt_agendada";
            break;
          case 'AT':
            $className = "evt_agendada";
            break;
          case 'CU':
            $className = "evt_agendada";
            break;
          case 'EL':
            $className = "evt_agendada";
            break;
          default:
          $className = "evt_agendada";
            break;
        }

        $events[] = [
          'id'            => $agenda->agm_id_agenda,
          'title'         => $agenda->agm_motivo,
          'start'         => $agenda->agm_fecha_inicio."T".$agenda->agm_hora_inicio,
          'end'           => $agenda->agm_fecha_final."T".$agenda->agm_hora_final,
          'url'           => '#',
          'extendedProps' => [
            'observacion'  => $agenda->agm_observacion,
            'desde'  => $agenda->agm_fecha_inicio."  ".$agenda->agm_hora_inicio,
            'hasta'  => $agenda->agm_fecha_final."  ".$agenda->agm_hora_final,
          ],
          'className' => [$className]
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
				$dataValidateForm = $request->validate([
					/*'usr_cod_usuario' => 'required',
					'esp_id_especialidad' => 'required',*/
					'pct_id_paciente' => 'required',
					'agm_tipo' => 'required',
					'agm_motivo' => 'required',
					'agm_fecha_inicio' => 'required',
					'agm_hora_inicio' => 'required',
					'agm_hora_final' => 'required'
				]);

				$save_tbl_agenda_medica = new AgendaMedica();
				$save_tbl_agenda_medica->pct_id_paciente = $funcionAcceso->cleanData(false,0,false,1);
				$save_tbl_agenda_medica->esp_id_especialidad = $funcionAcceso->cleanData(false,0,false,1);
				$save_tbl_agenda_medica->usr_cod_usuario = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
				$save_tbl_agenda_medica->agm_tipo = $funcionAcceso->cleanData(true,2,false,$request->agm_tipo);
				$save_tbl_agenda_medica->agm_motivo = $funcionAcceso->cleanData(true,60,false,$request->agm_motivo);
				$save_tbl_agenda_medica->agm_fecha_inicio = $funcionAcceso->cleanData(false,0,false,$request->agm_fecha_inicio);
				$save_tbl_agenda_medica->agm_hora_inicio = $funcionAcceso->cleanData(false,0,false,$request->agm_hora_inicio);
				$save_tbl_agenda_medica->agm_fecha_final = $funcionAcceso->cleanData(false,0,false,$request->agm_fecha_inicio);
				$save_tbl_agenda_medica->agm_hora_final = $funcionAcceso->cleanData(false,0,false,$request->agm_hora_final);
				$save_tbl_agenda_medica->agm_observacion = $funcionAcceso->cleanData(false,0,false,$request->agm_observacion);
				$save_tbl_agenda_medica->agm_estado = $funcionAcceso->cleanData(false,0,false,"AG");
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
