<?php

namespace App\Http\Controllers\Salud;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
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
			$events = [
		      	[
		      		'id'          => '123ASD',
			        'title'          => ' - Cita',
			        'start'          =>  '2025-01-10T10:30:00',
			        'end'          =>  '2025-01-10T12:30:00',
			        'borderColor'    =>  '#0000ff',
			        'url'    =>  '#',
			        'extendedProps' => [
			        	'department'=>  'BioChemistry',
			        	'descriptionMau'    =>  'sdfsdfsdf',
			        ],
			        'className'=>["redEvent"]
		      	],
		      	[
		      		'id'          => '2356FG',
			        'title'          => ' - Cita',
			        'start'          =>  '2025-01-14T10:30:00',
			        'end'          =>  '2025-01-14T12:30:00',
			        'borderColor'    =>  '#ffff00',
			        'url'    =>  '#',
			        'extendedProps' => [
			        	'department'=>  '34534hgh',
			        	'descriptionMau'    =>  '45546dfg',
			        ],
			        'className'=>["greenEvent"]
		      	]
		   ];
		   echo json_encode($events);
		} catch (\Exception $e) {
			Log::error($e->getMessage());
			$data_result["message"] = "exitForException";
			$data_result["exception"] = $e->getMessage();
			echo json_encode($data_result);
		}
    }
}