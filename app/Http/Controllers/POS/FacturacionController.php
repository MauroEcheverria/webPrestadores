<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Sistema\FuncionesAccesosController;
use App\Http\Controllers\Controller;
use App\Models\POS\Factura_Transaccion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    public function index(Request $request) {
		return view('pos.facturacion');
	}
	
	public function verificarFacturaCabecera(Request $request){
        if ($request->ajax()) {
			try {
				$funcionAcceso = new FuncionesAccesosController();

				$data_catalogo_pago = DB::select("SELECT ctg_key,ctg_descripcion
				FROM dct_sistema_tbl_catalogo
				WHERE ctg_estado = 1
				AND ctg_tipo = 'PAGO'
				ORDER BY 1 DESC;");
				$rpta_catalogo_pago = "<option value=''>Seleccione una opción</option>";
				foreach ($data_catalogo_pago as $data_catalogo_pago) {
					$rpta_catalogo_pago.="<option value='".$data_catalogo_pago->ctg_key."'>".$data_catalogo_pago->ctg_descripcion."</option>";
				}

				$data_catalogo_iden = DB::select("SELECT ctg_key,ctg_descripcion
				FROM dct_sistema_tbl_catalogo
				WHERE ctg_estado = 1
				AND ctg_tipo = 'IDEN';");
				$rpta_catalogo_iden = "<option value=''>Seleccione una opción</option>";
				foreach ($data_catalogo_iden as $data_catalogo_iden) {
					$rpta_catalogo_iden.="<option value='".$data_catalogo_iden->ctg_key."'>".$data_catalogo_iden->ctg_descripcion."</option>";
				}

				$data_prod_servicio = DB::select("SELECT prs_id_prod_serv,prs_descripcion_item
				FROM dct_pos_tbl_producto_servicio
				WHERE prs_estado = 1
				AND emp_id_empresa = :emp_id_empresa;",['emp_id_empresa' => $funcionAcceso->getEmpresaPorCorreo(auth()->user()->email)]);
				$rpta_prod_servicio = "<option value=''>Seleccione una opción</option>";
				foreach ($data_prod_servicio as $data_prod_servicio) {
					$rpta_prod_servicio.="<option value='".$data_prod_servicio->prs_id_prod_serv."'>".$data_prod_servicio->prs_descripcion_item."</option>";
				}

				$data_result["formas_pago"] = $rpta_catalogo_pago;
				$data_result["tipo_identificacion"] = $rpta_catalogo_iden;
				$data_result["productos_servicios"] = $rpta_prod_servicio;

				$verificar_existencia = DB::select("SELECT tr.ftr_id_factura_transaccion,tr.emp_id_empresa,tr.cli_id_cliente, tr.ftr_id_forma_pago,
				(SELECT cli_tipo_identificacion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_tipo_identificacion,
				(SELECT cli_identificacion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_identificacion,
				(SELECT CONCAT(IFNULL(cli_nombre_1,''),' ',IFNULL(cli_nombre_2,''),' ',IFNULL(cli_apellido_1,''),' ',IFNULL(cli_apellido_2,'')) FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_nombres,
				(SELECT cli_correo FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_correo,
				(SELECT cli_direccion FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_direccion,
				(SELECT cli_telefono FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_telefono,
				(SELECT cli_placa FROM dct_pos_tbl_cientes WHERE cli_id_cliente = tr.cli_id_cliente) cli_placa
				FROM dct_pos_tbl_factura_transaccion tr
				WHERE tr.ftr_usuario_creacion = :usr_cod_usuario
				AND tr.ftr_estado_transaccion = 'TMP'
				AND tr.emp_id_empresa = :emp_id_empresa;",
				[
					'usr_cod_usuario' => $funcionAcceso->getCedulaPorCorreo(auth()->user()->email),
					'emp_id_empresa' => $funcionAcceso->getEmpresaPorCorreo(auth()->user()->email),
				]);

				if(COUNT($verificar_existencia) == 1) {
					$data_detalle_factura = DB::select("SELECT fd.fdt_id_factura_detalle, fd.prs_id_prod_serv, fd.fdt_cantidad, ps.prs_codigo_item, 
					ps.prs_descripcion_item, ps.prs_valor_unitario, ps.prs_descuento, ps.prs_iva_cod_impuesto, ps.prs_iva_cod_tarifa, 
					ps.prs_ice_cod_impuesto, ps.prs_ice_cod_tarifa, ps.prs_irbpnr_cod_impuesto, ps.prs_irbpnr_cod_tarifa
					FROM dct_pos_tbl_factura_detalle fd, dct_pos_tbl_producto_servicio ps
					WHERE fd.prs_id_prod_serv = ps.prs_id_prod_serv
					AND fd.ftr_id_factura_transaccion = :ftr_id_factura_transaccion
					AND fd.fdt_estado = 1
					AND ps.emp_id_empresa = :emp_id_empresa
					ORDER BY fd.fdt_fecha_creacion;",
					[
						'ftr_id_factura_transaccion' => $verificar_existencia[0]->ftr_id_factura_transaccion,
						'emp_id_empresa' => $funcionAcceso->getEmpresaPorCorreo(auth()->user()->email),
					]);
					$data_tabla = '<table class="table table-striped dct_table"><tr><th style="text-align:center;">Código Ítem</th><th style="text-align:center;">Descripción</th><th style="text-align:center;">Cantidad</th><th style="text-align:center;">Precio Unitadrio</th><th style="text-align:center;">Sub Total</th><th style="text-align:center;">Acciones</th></tr>';
					foreach ($data_detalle_factura as $data_detalle_factura) {
						$data_tabla .= '<tr>';
						$data_tabla .= '<td align="center">'.$data_detalle_factura[0]->prs_codigo_item.'</td>';
						$data_tabla .= '<td>'.$data_detalle_factura[0]->prs_descripcion_item.'</td>';
						$data_tabla .= '<td align="center">'.$data_detalle_factura[0]->fdt_cantidad.'</td>';
						$data_tabla .= '<td align="right">'.$data_detalle_factura[0]->prs_valor_unitario.'</td>';
						$data_tabla .= '<td align="right">'.($data_detalle_factura[0]->fdt_cantidad * $data_detalle_factura[0]->prs_valor_unitario) .'</td>';
						$data_tabla .= '<td align="center"><div class="btn-group btn-group-sm"><a href="#" class="btn btn-info" title="Detalle Ítem" id="item_detalle_'.$data_detalle_factura[0]->fdt_id_factura_detalle.'"><i class="fas fa-eye"></i></a><a href="#" class="btn btn-danger" title="Descatar Ítem" id="item_descartar_'.$data_detalle_factura[0]->fdt_id_factura_detalle.'"><i class="fas fa-trash"></i></a></div></td>';    
						$data_tabla .= '</tr>';
					}
					$data_tabla .= '</table>';

					$data_result["data_tabla"] = $data_tabla;
					$data_result["data_row"] = $verificar_existencia;
					$data_result["message"] = "si_transaccion";
					$_SESSION["id_factura_transaccion"] = $data_detalle_factura[0]->ftr_id_factura_transaccion;
				
				} else {
					$data_result["message"] = "no_transaccion";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
        }
    }

	public function obtenerDataProductoServicio(Request $request){
        if ($request->ajax()) {
			try {
				$funcionAcceso = new FuncionesAccesosController();

				$data_catalogo_pago = DB::select("SELECT fd.fdt_id_factura_detalle, 
				fd.prs_id_prod_serv, 
				fd.fdt_cantidad, 
				ps.prs_codigo_item, 
				ps.prs_descripcion_item, 
				ps.prs_valor_unitario, 
				ps.prs_descuento,
				ps.prs_iva_cod_tarifa,
				ps.prs_iva_dif_porc,
				IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_iva_cod_impuesto AND trf_codigo = ps.prs_iva_cod_tarifa),0) trf_porcentaje_iva,
				IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_ice_cod_impuesto AND trf_codigo = ps.prs_ice_cod_tarifa),0) trf_porcentaje_ice,
				IFNULL((SELECT trf_porcentaje FROM dct_pos_tbl_tarifa_impuesto WHERE imp_codigo = ps.prs_irbpnr_cod_impuesto AND trf_codigo = ps.prs_irbpnr_cod_tarifa),0) trf_porcentaje_irbpnr
				FROM dct_pos_tbl_factura_transaccion ft,dct_pos_tbl_factura_detalle fd, dct_pos_tbl_producto_servicio ps
				WHERE ft.ftr_id_factura_transaccion = fd.ftr_id_factura_transaccion
				AND fd.prs_id_prod_serv = ps.prs_id_prod_serv
				AND ft.ftr_estado_transaccion = 'TMP'
				AND fd.ftr_id_factura_transaccion = :ftr_id_factura_transaccion
				AND fd.fdt_estado = 1
				AND ps.emp_id_empresa = :emp_id_empresa
				ORDER BY fd.fdt_fecha_creacion DESC;",
				[
					'ftr_id_factura_transaccion' => $_SESSION["id_factura_transaccion"],
					'emp_id_empresa' => $funcionAcceso->getEmpresaPorCorreo(auth()->user()->email),
				]);

				$pos_cant_item = 0;
				$pos_trans_descuento = 0;
				$pos_trans_sub_total = 0;
				$pos_total_descuento = 0;
				$pos_total_sub_total = 0;
				$pos_base_imp_iva_0 = 0;
				$pos_base_imp_iva_12 = 0;
				$pos_base_imp_iva_14 = 0;
				$pos_base_imp_iva_no_sujeto = 0;
				$pos_base_imp_iva_exento = 0;
				$pos_base_imp_iva_diferenciado = 0;
				$pos_calc_iva_12 = 0;
				$pos_calc_iva_14 = 0;
				$pos_calc_iva_diferenciado = 0;
				$pos_porcentaje_iva = 0;
				$pos_calc_ice = 0;
				$pos_calc_irbpnr = 0;

				$data_tabla = '<table class="table table-striped dct_table"><tr><th style="text-align:center;">Código Ítem</th><th style="text-align:center;">Descripción</th><th style="text-align:center;">Cantidad</th><th style="text-align:center;">Precio Unitadrio</th><th style="text-align:center;">Descuento</th><th style="text-align:center;">Sub Total</th><th style="text-align:center;">Acciones</th></tr>';
    			foreach ($data_catalogo_pago as $data_catalogo_pago) {
					$pos_cant_item += 1;

					/* Descuentos */
					$pos_trans_descuento = $data_catalogo_pago[0]->prs_valor_unitario * $data_catalogo_pago[0]->fdt_cantidad * $data_catalogo_pago[0]->prs_descuento / 100;
					$pos_total_descuento += $pos_trans_descuento;
					$pos_trans_sub_total = ($data_catalogo_pago[0]->prs_valor_unitario * $data_catalogo_pago[0]->fdt_cantidad) - $pos_trans_descuento;
					$pos_total_sub_total += $pos_trans_sub_total;

					/* Diferenciacion IVA */
					switch ($data_catalogo_pago[0]->prs_iva_cod_tarifa) {
						case 2:
						  $pos_base_imp_iva_12 += $pos_trans_sub_total;
						  $pos_calc_iva_12 += $pos_trans_sub_total * $data_catalogo_pago[0]->trf_porcentaje_iva / 100;
						  $pos_porcentaje_iva = $data_catalogo_pago[0]->trf_porcentaje_iva;
						  break;
						case 3:
						  $pos_base_imp_iva_14 += $pos_trans_sub_total;
						  $pos_calc_iva_14 += $pos_trans_sub_total * $data_catalogo_pago[0]->trf_porcentaje_iva / 100;
						  $pos_porcentaje_iva = $data_catalogo_pago[0]->trf_porcentaje_iva;
						  break;
						case 8:
						  $pos_base_imp_iva_diferenciado += $pos_trans_sub_total;
						  $pos_calc_iva_diferenciado += $pos_trans_sub_total * $data_catalogo_pago[0]->prs_iva_dif_porc / 100;
						  $pos_porcentaje_iva = $data_catalogo_pago[0]->prs_iva_dif_porc;
						  break;
						case 0:
						  $pos_base_imp_iva_0 += $pos_trans_sub_total;
						  break;
						case 6:
						  $pos_base_imp_iva_no_sujeto += $pos_trans_sub_total;
						  break;
						case 7:
						  $pos_base_imp_iva_exento += $pos_trans_sub_total;
						  break;
					}
				
					/* Diferenciacion ICE */
					$pos_calc_ice += $pos_trans_sub_total * $data_catalogo_pago[0]->trf_porcentaje_ice / 100;
				
					/* Diferenciacion irbpnr */
					$pos_calc_irbpnr += $pos_trans_sub_total * $data_catalogo_pago[0]->trf_porcentaje_irbpnr / 100;
				
					$data_tabla .= '<tr>';
					$data_tabla .= '<td align="center">'.$data_catalogo_pago[0]->prs_codigo_item.'</td>';
					$data_tabla .= '<td>'.$data_catalogo_pago[0]->prs_descripcion_item.'</td>';
					$data_tabla .= '<td align="center"><input type="number" class="form-control fdt_cantidad_tbl" name="fdt_cantidad_tbl" id="itemCant_'.$data_catalogo_pago[0]->fdt_id_factura_detalle.'" value="'.$data_catalogo_pago[0]->fdt_cantidad.'"></td>';
					$data_tabla .= '<td align="right">'.$data_catalogo_pago[0]->prs_valor_unitario.'</td>';
					$data_tabla .= '<td align="right">'.$data_catalogo_pago[0]->prs_descuento.'%</td>';
					$data_tabla .= '<td align="right">'.$pos_trans_sub_total.'</td>';
					$data_tabla .= '<td align="center"><div class="btn-group btn-group-sm"><a href="#" class="btn btn-info refDetalleItemProceso" title="Detalle Ítem" id="item_detalle_'.$data_catalogo_pago[0]->fdt_id_factura_detalle.'"><i class="fas fa-eye"></i><span class="solo_main">'.$data_catalogo_pago[0]->fdt_id_factura_detalle.'</span></a><a href="#" class="btn btn-danger refDescartarItemProceso" title="Descatar Ítem" id="item_descartar_'.$data_catalogo_pago[0]->fdt_id_factura_detalle.'"><i class="fas fa-trash"></i><span class="solo_main">'.$data_catalogo_pago[0]->fdt_id_factura_detalle.'</span></a></div></td>';    
					$data_tabla .= '</tr>';
				}
				$data_tabla .= '</table>';

				if ($data_catalogo_pago) {
					$data_result["pos_base_imp_diff"] = round(($pos_base_imp_iva_12 + $pos_base_imp_iva_14 + $pos_base_imp_iva_diferenciado),2);
					$data_result["pos_base_imp_iva_0"] = round($pos_base_imp_iva_0,2);
					$data_result["pos_base_imp_iva_no_sujeto"] = round($pos_base_imp_iva_no_sujeto,2);
					$data_result["pos_base_imp_iva_exento"] = round($pos_base_imp_iva_exento,2);
					$data_result["pos_total_iva"] = round(($pos_calc_iva_12 + $pos_calc_iva_14 + $pos_calc_iva_diferenciado),2);

					if ($pos_porcentaje_iva != 0) {
						$data_result["pos_porcentaje_iva"] = $pos_porcentaje_iva;
					}
					else {
						$data_result["pos_porcentaje_iva"] = 12;
					}

					$data_result["pos_total_ice"] = round($pos_calc_ice,2);
					$data_result["pos_total_irbpnr"] = round($pos_calc_irbpnr,2);
					$data_result["pos_total_descuento"] = round($pos_total_descuento,2);
					$data_result["pos_total_sub_total"] = round($pos_total_sub_total,2);
					$data_result["pos_total_comprobante"] = round($pos_total_sub_total + $pos_calc_iva_12 + $pos_calc_iva_14 + $pos_calc_iva_diferenciado + $pos_calc_ice + $pos_calc_irbpnr,2);

					$data_result["pos_cant_item"] = $pos_cant_item;
					$data_result["data_tabla"] = $data_tabla;
					$data_result["message"] = "saveOK";
				}
				else {
					Log::error("Salida por error en Proceso");
					Log::error("Archivo: ", [__FILE__]);
					Log::error("Línea: ", [__LINE__]);
					$data_result["message"] = "saveError";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
        }
    }

	public function generarFacturaCabecera(Request $request){
        if ($request->ajax()) {
			DB::beginTransaction();
			try {
				$funcionAcceso = new FuncionesAccesosController();

				$getCedulaPorCorreo = $funcionAcceso->getCedulaPorCorreo(auth()->user()->email);
				$getEmpresaPorCorreo = $funcionAcceso->getEmpresaPorCorreo(auth()->user()->email);

				$verificar_existencia = DB::select("SELECT ftr_id_factura_transaccion, emp_id_empresa
				FROM dct_pos_tbl_factura_transaccion
				WHERE ftr_usuario_creacion = :usr_cod_usuario
				AND ftr_estado_transaccion = 'TMP'
				AND emp_id_empresa = :emp_id_empresa;",
				[
					'usr_cod_usuario' => $getCedulaPorCorreo,
					'emp_id_empresa' => $getEmpresaPorCorreo,
				]);

				if(COUNT($verificar_existencia) == 0) {
					$save_tbl_factura_transaccion = Factura_Transaccion::insert([
						'emp_id_empresa' => $getEmpresaPorCorreo,
						'ftr_estado_transaccion' => 'TMP',
						'ftr_estado' => 1,
						'ftr_usuario_creacion' => $getCedulaPorCorreo,
						'ftr_fecha_creacion' => now(),
						'ftr_ip_creacion' => request()->ip(),
					]);
					if ($save_tbl_factura_transaccion) {
						$max_fact_trans = DB::select("SELECT MAX(ftr_id_factura_transaccion) id_factura_transaccion FROM dct_pos_tbl_factura_transaccion;");
						$_SESSION["id_factura_transaccion"] = $max_fact_trans[0]->id_factura_transaccion;
						DB::commit();
						Log::info("Se crea cabecera para transaccion de factura: ".$_SESSION["id_factura_transaccion"]);
						$data_result["message"] = "saveOK";
					}
					else {
						DB::rollback();
						Log::error("Salida por error en Proceso");
						Log::error("Archivo: ", [__FILE__]);
						Log::error("Línea: ", [__LINE__]);
						$data_result["message"] = "saveError";
					}
				} else {
					$data_result["message"] = "fact_transaccion_registrada";
				}
				echo json_encode($data_result);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
				$data_result["message"] = "exitForException";
				$data_result["exception"] = $e->getMessage();
				echo json_encode($data_result);
			}
        }
    }

}