<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FirmaECController extends Controller
{
    public function index(Request $request) {
		return view('pos.firma_ec');
	}

}