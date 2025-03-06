<?php

use App\Http\Controllers\POS\AdministracionPOSController;
use App\Http\Controllers\POS\ClientesController;
use App\Http\Controllers\POS\FacturacionController;
use App\Http\Controllers\POS\FidelizacionController;
use App\Http\Controllers\POS\FirmaECController;
use App\Http\Controllers\POS\ReportesController;
use App\Http\Controllers\POS\TransaccionesController;
use App\Http\Controllers\Sistema\RenderAplicacionOpcionController;
use App\Http\Controllers\Sistema\AdministrarUsuariosController;
use App\Http\Controllers\Sistema\AdministrarAccesosController;
use App\Http\Controllers\Sistema\Envio_SMS_WS_Controller;
use App\Http\Controllers\Salud\AdministracionSaludController;
use App\Http\Controllers\Salud\ConsultaEnfermeriaController;
use App\Http\Controllers\Salud\ConsultaMedicaController;
use App\Http\Controllers\Salud\EstadisticaController;
use App\Http\Controllers\Salud\HistoriaClinicaController;
use App\Http\Controllers\Salud\PacienteController;
use App\Http\Controllers\Salud\VademecumController;
use App\Http\Controllers\Salud\AgendaMedicaController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware('auth','accesos_dct');
});

/******************************************************************************************/
Route::get('/productos', function () {
    return view('info.productos');
})->name('info.productos');

Route::get('/planes', function () {
    return view('info.planes');
})->name('info.planes');

Route::get('/contactanos', function (){
    return view('info.contactanos');
})->name('info.contactanos');

/******************************************************************************************/

Route::get('/usuario_inactivo',function(){
    $accion = ['acceso' => 'usuario_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('usuario_inactivo');

Route::get('/contrasena_inactiva',function(){
    $accion = ['acceso' => 'contrasena_inactiva' ];
    return view('sistema.informativo',compact('accion'));
})->name('contrasena_inactiva');

Route::get('/expiro_contrasena',function(){
    $accion = ['acceso' => 'expiro_contrasena' ];
    return view('sistema.informativo',compact('accion'));
})->name('expiro_contrasena');

Route::get('/correo_no_validado',function(){
    $accion = ['acceso' => 'correo_no_validado' ];
    return view('sistema.informativo',compact('accion'));
})->name('correo_no_validado');

Route::get('/empresa_inactiva',function(){
    $accion = ['acceso' => 'empresa_inactiva' ];
    return view('sistema.informativo',compact('accion'));
})->name('empresa_inactiva');

Route::get('/licencia_caducada',function(){
    $accion = ['acceso' => 'licencia_caducada' ];
    return view('sistema.informativo',compact('accion'));
})->name('licencia_caducada');

Route::get('/rol_inactivo',function(){
    $accion = ['acceso' => 'rol_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('rol_inactivo');

Route::get('/opcion_inactiva',function(){
    $accion = ['acceso' => 'opcion_inactiva' ];
    return view('sistema.informativo',compact('accion'));
})->name('opcion_inactiva');

Route::get('/aplicativo_inactivo',function(){
    $accion = ['acceso' => 'aplicativo_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('aplicativo_inactivo');

Route::get('/empresa_aplicativo_inactivo',function(){
    $accion = ['acceso' => 'empresa_aplicativo_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('empresa_aplicativo_inactivo');

Route::get('/rol_aplicativo_inactivo',function(){
    $accion = ['acceso' => 'rol_aplicativo_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('rol_aplicativo_inactivo');

Route::get('/rol_opcion_inactivo',function(){
    $accion = ['acceso' => 'rol_opcion_inactivo' ];
    return view('sistema.informativo',compact('accion'));
})->name('rol_opcion_inactivo');


/******************************************************************************************/
/*Controller para opciones en menú*/

Route::get('/sistema/renderAplicacionOpcion', 
    [RenderAplicacionOpcionController::class,'menu_render']
)->name('render_opciones');

Route::controller(Envio_SMS_WS_Controller::class)->group(function(){
    Route::get('/sistema/envio_SMS_WS','index')->name('envio_SMS_WS.index')->middleware('auth','accesos_dct');
    Route::post('/sistema/envio_SMS_WS/proceso_1','send_SMS_WS')->name('envioSMS_WS.proceso_1');
});

Route::controller(AdministrarUsuariosController::class)->group(function(){
    Route::get('/sistema/administrarUsuarios','index')->name('administrarUsuarios.index')->middleware('auth','accesos_dct');
    Route::post('/sistema/administrarUsuarios/proceso_1','getDataTableUsuarios')->name('administrarUsuarios.proceso_1');
    Route::post('/sistema/administrarUsuarios/proceso_2','getCedulaRepetida')->name('administrarUsuarios.proceso_2');
    Route::post('/sistema/administrarUsuarios/proceso_3','getCorreoRepetido')->name('administrarUsuarios.proceso_3');
    Route::post('/sistema/administrarUsuarios/proceso_4','getEmpresaRoles')->name('administrarUsuarios.proceso_4');
    Route::post('/sistema/administrarUsuarios/proceso_5','getDataTableSistemaEmpresa')->name('administrarUsuarios.proceso_5');
    Route::post('/sistema/administrarUsuarios/proceso_6','getDataTableSistemaAplicacion')->name('administrarUsuarios.proceso_6');
    Route::post('/sistema/administrarUsuarios/proceso_7','getDataTableSistemaOpcion')->name('administrarUsuarios.proceso_7');
    Route::post('/sistema/administrarUsuarios/proceso_8','getDataTableSistemaRol')->name('administrarUsuarios.proceso_8');
    Route::post('/sistema/administrarUsuarios/proceso_9','getDataTableSistemaEmpresaAplicativo')->name('administrarUsuarios.proceso_9');
    Route::post('/sistema/administrarUsuarios/proceso_10','getDataTableSistemaRolAplicativo')->name('administrarUsuarios.proceso_10');
    Route::post('/sistema/administrarUsuarios/proceso_11','getDataTableSistemaRolOpcion')->name('administrarUsuarios.proceso_11');
    Route::post('/sistema/administrarUsuarios/guardar_usuario','guardar_usuario')->name('administrarUsuarios.guardar_usuario');
    Route::post('/sistema/administrarUsuarios/editar_usuario','editar_usuario')->name('administrarUsuarios.editar_usuario');
    Route::post('/sistema/administrarUsuarios/resetear_usuario','resetear_usuario')->name('administrarUsuarios.resetear_usuario');
    Route::get('/sistema/token/{token}','verificarToken')->name('administrarUsuarios.verificar_token');
});

Route::controller(AdministrarAccesosController::class)->group(function(){
    Route::get('/sistema/administrarAccesos','index')->name('administrarAccesos.index')->middleware('auth','accesos_dct');
    Route::post('/sistema/administrarAccesos/proceso_1','getDataTableSistemaEmpresa')->name('administrarAccesos.proceso_1');
    Route::post('/sistema/administrarAccesos/proceso_2','getDataTableSistemaAplicacion')->name('administrarAccesos.proceso_2');
    Route::post('/sistema/administrarAccesos/proceso_3','getDataTableSistemaOpcion')->name('administrarAccesos.proceso_3');
    Route::post('/sistema/administrarAccesos/proceso_4','getDataTableSistemaRol')->name('administrarAccesos.proceso_4');
    Route::post('/sistema/administrarAccesos/proceso_5','getDataTableSistemaEmpresaAplicativo')->name('administrarAccesos.proceso_5');
    Route::post('/sistema/administrarAccesos/proceso_6','getDataTableSistemaRolAplicativo')->name('administrarAccesos.proceso_6');
    Route::post('/sistema/administrarAccesos/proceso_7','getDataTableSistemaRolOpcion')->name('administrarAccesos.proceso_7');
    Route::post('/sistema/administrarAccesos/proceso_8','getDataSelect')->name('administrarAccesos.proceso_8');
    Route::post('/sistema/administrarAccesos/proceso_9','cargaSistemaRolOpcion')->name('administrarAccesos.proceso_9');
    Route::post('/sistema/administrarAccesos/proceso_10','adminSistemaRolOpcion')->name('administrarAccesos.proceso_10');
    Route::post('/sistema/administrarAccesos/proceso_11','cargaSistemaRolAplicativo')->name('administrarAccesos.proceso_11');
    Route::post('/sistema/administrarAccesos/proceso_12','adminSistemaRolAplicativo')->name('administrarAccesos.proceso_12');
    Route::post('/sistema/administrarAccesos/proceso_13','cargaSistemaEmpresaAplicativo')->name('administrarAccesos.proceso_13');
    Route::post('/sistema/administrarAccesos/proceso_14','adminSistemaEmpresaAplicativo')->name('administrarAccesos.proceso_14');
    Route::post('/sistema/administrarAccesos/proceso_15','adminSistemaRol')->name('administrarAccesos.proceso_15');
    Route::post('/sistema/administrarAccesos/proceso_16','adminSistemaOpcion')->name('administrarAccesos.proceso_16');
    Route::post('/sistema/administrarAccesos/proceso_17','adminSistemaAplicacion')->name('administrarAccesos.proceso_17');
    Route::post('/sistema/administrarAccesos/proceso_18','adminSistemaEmpresa')->name('administrarAccesos.proceso_18');
});

Route::controller(FacturacionController::class)->group(function(){
    Route::get('/pos/facturacion','index')->name('posFacturacion.index')->middleware('auth','accesos_dct');
    Route::GET('/pos/facturacion/proceso_1','verificarFacturaCabecera')->name('verificarFacturaCabecera.proceso_1');
    Route::post('/pos/facturacion/proceso_2','obtenerDataProductoServicio')->name('obtenerDataProductoServicio.proceso_2');
    Route::post('/pos/facturacion/proceso_3','generarFacturaCabecera')->name('generarFacturaCabecera.proceso_3');
});

Route::controller(AdministracionPOSController::class)->group(function(){
    Route::get('/pos/administracionPOS','index')->name('posAdministracionPOS.index')->middleware('auth','accesos_dct');
});

Route::controller(ClientesController::class)->group(function(){
    Route::get('/pos/clientes','index')->name('posClientes.index')->middleware('auth','accesos_dct');
});

Route::controller(FidelizacionController::class)->group(function(){
    Route::get('/pos/fidelizacion','index')->name('posFidelizacion.index')->middleware('auth','accesos_dct');
});

Route::controller(FirmaECController::class)->group(function(){
    Route::get('/pos/firma_ec','index')->name('posFirmaEC.index')->middleware('auth','accesos_dct');
});

Route::controller(ReportesController::class)->group(function(){
    Route::get('/pos/reportes','index')->name('posReportes.index')->middleware('auth','accesos_dct');
});

Route::controller(TransaccionesController::class)->group(function(){
    Route::get('/pos/transacciones','index')->name('posTransacciones.index')->middleware('auth','accesos_dct');
});

Route::controller(AdministracionSaludController::class)->group(function(){
    Route::get('/salud/administracionSalud','index')->name('saludAdministracionSalud.index')->middleware('auth','accesos_dct');
});

Route::controller(ConsultaEnfermeriaController::class)->group(function(){
    Route::get('/salud/consultaEnfermeria','index')->name('saludConsultaEnfermeria.index')->middleware('auth','accesos_dct');
});

Route::controller(ConsultaMedicaController::class)->group(function(){
    Route::get('/salud/consultaMedica','index')->name('saludConsultaMedica.index')->middleware('auth','accesos_dct');
});

Route::controller(EstadisticaController::class)->group(function(){
    Route::get('/salud/estadistica','index')->name('saludEstadistica.index')->middleware('auth','accesos_dct');
});

Route::controller(HistoriaClinicaController::class)->group(function(){
    Route::get('/salud/historiaClinica','index')->name('saludHistoriaClinica.index')->middleware('auth','accesos_dct');
});

Route::controller(PacienteController::class)->group(function(){
    Route::get('/salud/paciente','index')->name('saludPaciente.index')->middleware('auth','accesos_dct');
});

Route::controller(ReportesController::class)->group(function(){
    Route::get('/salud/reportes','index')->name('saludReportes.index')->middleware('auth','accesos_dct');
});

Route::controller(VademecumController::class)->group(function(){
    Route::get('/salud/vademecum','index')->name('saludVademecum.index')->middleware('auth','accesos_dct');
});

Route::controller(AgendaMedicaController::class)->group(function(){
    Route::get('/salud/agendaMedica','index')->name('saludAgendaMedica.index')->middleware('auth','accesos_dct');
    Route::get('/salud/agendaMedica/proceso_1','getDataTableAgendaMedica')->name('agendaMedica.proceso_1');
    Route::post('/salud/agendaMedica/guardar_agenda','guardar_agenda')->name('agendaMedica.guardar_agenda');
    Route::post('/salud/agendaMedica/editar_agenda','editar_agenda')->name('agendaMedica.editar_agenda');
});

/******************************************************************************************/
/*APIS*/

Route::get('/api/getAllUsers', [ApiController::class, 'getAllUsers'])->name('getAllUsers');
