<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Envio_SMS_WS_Controller extends Controller
{
    public function index(Request $request) {
        return view('sistema.envio_SMS_WS');
	}

    public function send_SMS_WS(Request $request){
        try {
            $params=array(
                'token' => config('global.apiWhatsapp.ultramsg_token'),
                'to' => $request->ws_celular,
                'body' => $request->ws_mensaje
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/".config('global.apiWhatsapp.instance_id')."/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));   
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl); 
            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                return redirect()->route('envio_SMS_WS.index');
            }
        } catch (\Exception $e) {
            Log::error("Salida por Excepción");
            Log::error("Archivo: ", [__FILE__]);
            Log::error("Línea: ", [__LINE__]);
            $data_result["message"] = "saveError";
            $data_result["exception"] = $e;
            echo json_encode($data_result);
        }
        
    }
}
