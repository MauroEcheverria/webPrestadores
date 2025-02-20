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

}