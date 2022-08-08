<?php

require_once('fpdf/fpdf.php');
require_once('fpdf/code.php');
require_once('barcode/class/BCGcode128.barcode.php');
require_once('barcode/class/BCGColor.php');
require_once('barcode/class/BCGDrawing.php');
require_once('barcode/class/BCGFontFile.php');

class generarPDF {

    public function facturaPDF($document, $claveAcceso) {
        
        $pdf = new PDF_Code();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 8);
		//Caja Emisor
		$pdf->RoundedRect(10, 50, 85, 52, 3, 'D');
		//Caja Documento
		$pdf->RoundedRect(100, 17, 100, 85, 3, 'D');
		//Caja Adquiriente
		$pdf->SetXY(10, 107);
		$pdf->Cell(190, 18, "", 1);
		$pdf->SetXY(15, 20);
        $pdf->image('../../webPosOperaciones/logosEmpresas/0919664854001.png', null, null, 70, 23);

        if ($document->infoFactura->obligadoContabilidad == 'SI') {
			$contabilidad = "SI";
        } else {
            $contabilidad = "NO";
        }
        
		//Datos Documento
		$pdf->SetXY(103, 18);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(97, 8, "R.U.C.: " . $document->infoTributaria->ruc, 0);
		$pdf->SetXY(103, 26);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(97, 8, "FACTURA", 0);
		$pdf->SetXY(103, 34);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(97, 8, "No.: ".$document->infoTributaria->estab ."-". $document->infoTributaria->ptoEmi ."-". $document->infoTributaria->secuencial, 0);
		$pdf->SetXY(103, 42);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(97,8,utf8_decode("NÚMERO DE AUTORIZACIÓN"),0);
		$pdf->SetXY(103, 50);
		$pdf->Cell(97,8,$claveAcceso,0);
		
		if ($document->infoTributaria->ambiente == 2) {
            $ambiente = 'PRODUCCION';
        } else {
            $ambiente = 'PRUEBAS';
        }
		
		$pdf->SetXY(103, 58);
		$pdf->Cell(97,8,utf8_decode("AMBIENTE: ".$ambiente),0);
		
		if ($document->infoTributaria->tipoEmision == 1) {
            $emision = 'NORMAL';
        } else {
            $emision = 'NORMAL';
        }
		
		$pdf->SetXY(103, 66);
		$pdf->Cell(97,8,utf8_decode("EMISIÓN: ".$emision),0);
		$pdf->SetXY(103, 74);
		$pdf->Cell(97,8,"CLAVE DE ACCESO:",0);
		$pdf->SetXY(103, 82);
		$pdf->Code128(103,82,$claveAcceso,94,12);
		$pdf->SetXY(103, 93);
		$pdf->Cell(97,8,$claveAcceso,0,0,'C');
		
		//Datos Emisor
		$pdf->SetXY(13, 55);
		$pdf->Cell(82,8,$document->infoTributaria->razonSocial,0);
		$pdf->SetXY(13, 63);
		$pdf->Cell(82,8,"Matriz: ".substr($document->infoTributaria->dirMatriz, 0, 39),0);
		$pdf->SetXY(13, 71);
		$pdf->Cell(82,8,"Sucursal: ".substr($document->infoTributaria->dirMatriz, 0, 39),0);
		$pdf->SetXY(13, 79);
		$pdf->Cell(82,8,"Contribuyente Especial Nro: -- ",0);
		$pdf->SetXY(13, 87);
		$pdf->Cell(82,8,"OBLIGADO LLEVAR CONTABILIDAD: ".$contabilidad,0);
		
		//Datos Adquiriente
		$pdf->SetXY(11, 108);
		$pdf->Cell(120,8,utf8_decode("Razón Social / Nombres y Apellidos: ".$document->infoFactura->razonSocialComprador),0);
		$pdf->SetXY(132, 108);
		$pdf->Cell(67,8,"R.U.C. / C.I.: ".$document->infoFactura->identificacionComprador,0);
		$pdf->SetXY(11, 116);
		$pdf->Cell(120,8,utf8_decode("Fecha Emisión: ".$document->infoFactura->fechaEmision),0);
		$pdf->SetXY(132, 116);
		$pdf->Cell(67,8,utf8_decode("Guía Remisión: ".$document->infoFactura->guiaRemision),0);
		
		//Datos Detalles
		$pdf->SetFont('Arial', '', 7);
		$pdf->SetXY(10, 130);
		$pdf->Cell(20,8,"Cod. Principal",1,0,'C');
		$pdf->SetXY(30, 130);
		$pdf->Cell(20,8,"Cantidad",1,0,'C');
		$pdf->SetXY(50, 130);
		$pdf->Cell(80,8,utf8_decode("Descripción"),1,0,'C');
		$pdf->SetXY(130, 130);
		$pdf->Cell(20,8,"Precio Uni.",1,0,'C');
		$pdf->SetXY(150, 130);
		$pdf->Cell(20,8,"Desc.",1,0,'C');
		$pdf->SetXY(170, 130);
		$pdf->Cell(30,8,"Precio Total",1,0,'C');
		
		//Detalles Lineas
		$ejeX = 130;
		foreach ($document->detalles->detalle as $a => $b) {
		$pdf->SetFont('Arial', '', 7);
		$ejeX = $ejeX + 8;
		$pdf->SetXY(10, $ejeX);
		$pdf->Cell(20,8,$b->codigoPrincipal,1,0,'C');
		$pdf->SetXY(30, $ejeX);
		$pdf->Cell(20,8,$b->cantidad,1,0,'C');
		$pdf->SetXY(50, $ejeX);
		$pdf->Cell(80,8,utf8_decode($b->descripcion),1,0,'C');
		$pdf->SetXY(130, $ejeX);
		$pdf->Cell(20,8,"100.00",1,0,'C');
		$pdf->SetXY(150, $ejeX);
		$pdf->Cell(20,8,$b->descuento,1,0,'C');
		$pdf->SetXY(170, $ejeX);
		$pdf->Cell(30,8,$b->precioTotalSinImpuesto,1,0,'C');
		}
		
		$iva = 0;
        $ice = 0;
        $IRBPNR = 0;
        $subtotal12 = 0;
        $subtotal0 = 0;
        $subtotal_no_impuesto = 0;
        $subtotal_no_iva = 0;
        foreach ($document->infoFactura->totalConImpuestos->totalImpuesto as $a => $b) {
            if ($b->codigo == 2) {
                $iva = $b->valor;
                if ($b->codigoPorcentaje == 0) {
                    $subtotal0 = $b->baseImponible;
                }
                if ($b->codigoPorcentaje == 2) {
                    $subtotal12 = $b->baseImponible;
                }
                if ($b->codigoPorcentaje == 6) {
                    $subtotal_no_impuesto = $b->baseImponible;
                }
                if ($b->codigoPorcentaje == 7) {
                    $subtotal_no_iva = $b->baseImponible;
                }
            }
            if ($b->codigo == 3) {
                $ice = $b->valor;
            }
            if ($b->codigo == 5) {
                $IRBPNR = $b->valor;
            }
        }
		
		//Sub Totales
		$ejeX = $ejeX + 8;
		$pdf->SetXY(165, $ejeX);
		$pdf->Cell(35,8,$subtotal12,1,0,'C');
		$pdf->SetXY(130, $ejeX);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"SUBTOTAL 12%",1,0,'C');

		$pdf->SetXY(165, $ejeX + 8);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$subtotal0,1,0,'C');
		$pdf->SetXY(130, $ejeX + 8);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"SUBTOTAL 0%",1,0,'C');

		$pdf->SetXY(165, $ejeX + 16);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$subtotal_no_impuesto,1,0,'C');
		$pdf->SetXY(130, $ejeX + 16);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"SUBTOTAL  No sujeto IVA",1,0,'C');

		$pdf->SetXY(165, $ejeX + 24);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$subtotal_no_iva,1,0,'C');
		$pdf->SetXY(130, $ejeX + 24);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"SUBTOTAL Exento de IVA",1,0,'C');

		$pdf->SetXY(165, $ejeX + 32);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$document->infoFactura->totalDescuento,1,0,'C');
		$pdf->SetXY(130, $ejeX + 32);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"DESCUENTO",1,0,'C');

		$pdf->SetXY(165, $ejeX + 40);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$iva,1,0,'C');
		$pdf->SetXY(130, $ejeX + 40);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"IVA 12%",1,0,'C');

		$pdf->SetXY(165, $ejeX + 48);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$ice,1,0,'C');
		$pdf->SetXY(130, $ejeX + 48);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"ICE",1,0,'C');

		$pdf->SetXY(165, $ejeX + 56);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$IRBPNR,1,0,'C');
		$pdf->SetXY(130, $ejeX + 56);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"IRBPNR",1,0,'C');

		$pdf->SetXY(165, $ejeX + 64);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35,8,$document->infoFactura->importeTotal,1,0,'C');
		$pdf->SetXY(130, $ejeX + 64);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35,8,"VALOR TOTAL",1,0,'C');
		
		//Forma de Pago
		$pdf->SetXY(10, $ejeX + 8);
		$pdf->Cell(30,8,"Forma de Pago",1,0,'C');
		$pdf->SetXY(40, $ejeX + 8);
		$pdf->Cell(25,8,"Total",1,0,'C');
		$pdf->SetXY(65, $ejeX + 8);
		$pdf->Cell(25,8,"Plazo",1,0,'C');
		$pdf->SetXY(90, $ejeX + 8);
		$pdf->Cell(25,8,"Unidad de Tiempo",1,0,'C');
		
		foreach ($document->infoFactura->pagos->pago as $e => $f) {
            if ($f->formaPago == '01') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->MultiCell(30,8,utf8_decode("Sin utilizacion del sistema financiero"),1,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,16,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,16,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,16,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '15') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->MultiCell(30,8,utf8_decode("Compensacion de deudas"),1,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,16,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,16,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,16,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '16') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->Cell(30,8,utf8_decode("Tarjeta debito"),1,0,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,8,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,8,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,8,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '17') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->Cell(30,8,utf8_decode("Dinero Electronico"),1,0,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,8,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,8,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,8,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '18') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->Cell(30,8,utf8_decode("Tarjeta Prepago"),1,0,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,8,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,8,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,8,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '198') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->Cell(30,8,utf8_decode("Tarjeta de credito"),1,0,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,8,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,8,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,8,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			 if ($f->formaPago == '20') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->MultiCell(30,8,utf8_decode("Otros con utilizacion del sistema financiero"),1,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,16,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,16,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,16,utf8_decode($f->unidadTiempo),1,0,'C');
            }
			if ($f->formaPago == '21') {
				$pdf->SetFont('Arial', '', 7);
				$pdf->SetXY(10, $ejeX + 16);
				$pdf->Cell(30,8,utf8_decode("Endoso de titulos"),1,0,'C');
				$pdf->SetXY(40, $ejeX + 16);
				$pdf->Cell(25,8,$f->total,1,0,'C');
				$pdf->SetXY(65, $ejeX +16);
				$pdf->Cell(25,8,$f->plazo,1,0,'C');
				$pdf->SetXY(90, $ejeX + 16);
				$pdf->Cell(25,8,utf8_decode($f->unidadTiempo),1,0,'C');
            }
        }

		$infoAdicional = "";
        $correo = "";

        foreach ($document->infoAdicional->campoAdicional as $a) {
            foreach ($a->attributes() as $b) {
                if ($b == 'Email' || $b == 'email' || $b == '=correo' || $b == 'Correo') {
                    $correo = $a;
                    $infoAdicional .= $b . ': ' . $a . "\n";
                } else {
                    $infoAdicional .= $b . ': ' . $a . "\n";
                }
            }
        }
		
		//Información Adicional
		$pdf->SetXY(10, $ejeX + 40);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(100,8,utf8_decode("Información Adicional"),0,0,'C');
		
		$pdf->SetXY(10, $ejeX + 48);
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(100, 5, "" . $infoAdicional . "", 0);
             
    $pdf->Output('../../webPosOperaciones/comprobantesAutorizados/'.$claveAcceso.'.pdf','F');
    /*$data_result["message"] = "pdf_ok";
    echo json_encode($data_result);*/

    }

    public function notaDebitoPDF($document, $claveAcceso) {
        $pdf = new PDF_Code();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
				//$pdf->Cell(40, 10, 'Hello World!');
        if ($document->infoNotaDebito->obligadoContabilidad == 'SI') {

            $contabilidad = "Obligado a llevar contabilidad : SI";
        } else {
            $contabilidad = "Obligado a llevar contabilidad : NO";
        }
        $pdf->SetXY(10, 0);
        $pdf->image('../../webPosOperaciones/logosEmpresas/0919664854001.png', null, null, 80, 30);

        $pdf->SetXY(110, 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->MultiCell(100, 10, "RUC: " . $document->infoTributaria->ruc, 0, 'J', true);
        $pdf->SetXY(110, 15);
        $pdf->MultiCell(100, 10, "Nota Debito Nro: " . $document->infoTributaria->estab . $document->infoTributaria->ptoEmi . $document->infoTributaria->secuencial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(110, 20);
        $pdf->MultiCell(100, 10, 'Nro Autorizacion: ', 0);
        $pdf->SetXY(110, 25);
        $pdf->MultiCell(100, 10, $claveAcceso, 0);
        $pdf->SetXY(110, 30);
        if ($document->infoTributaria->ambiente == 2) {
            $ambiente = 'PRODUCCION';
        } else {
            $ambiente = 'PRUEBAS';
        }
        $pdf->MultiCell(100, 10, 'Ambiente: ' . $ambiente, 0);
        $pdf->SetXY(110, 35);
        if ($document->infoTributaria->tipoEmision == 1) {
            $emision = 'NORMAL';
        } else {
            $emision = 'NORMAL';
        }
        $pdf->MultiCell(100, 10, 'Emision: ' . $emision, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 20);
        $pdf->MultiCell(100, 10, $document->infoTributaria->razonSocial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(100, 10, $document->infoTributaria->dirMatriz, 0);
        $pdf->SetXY(10, 30);
        $pdf->MultiCell(100, 10, $contabilidad, 0);
        //Codigo de barras

        $pdf->SetXY(110, 45);
        $pdf->Code128(110,45,$claveAcceso,100,20);
        $pdf->SetXY(110, 63);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $claveAcceso, 0, 0, "C", true);
        //informacion del cliente
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        $pdf->SetXY(10, 35);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(100, 10, "INFORMACION DEL CLIENTE", 0);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(100, 10, "RUC/CI: " . $document->infoNotaDebito->identificacionComprador, 0);
        $pdf->SetXY(10, 45);
        $pdf->MultiCell(100, 10, "Razon Social/Nombre: " . $document->infoNotaDebito->razonSocialComprador, 0);
        $pdf->SetXY(10, 50);
        $pdf->MultiCell(100, 10, "Direccion: " . $document->infoNotaDebito->dirEstablecimiento, 0);
        $pdf->SetXY(10, 70);
        $pdf->MultiCell(100, 10, "Fecha Emision: " . $document->infoNotaDebito->fechaEmision, 0);

        $ejeX = 80;

        $pdf->SetXY(10, $ejeX);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(100, 10, "FORMAS DE PAGO", 0);
        $pdf->SetFont('Arial', '', 8);
        $ejeX = $ejeX + 10;
        $pdf->SetXY(10, $ejeX);
        foreach ($document->infoNotaDebito->pagos->pago as $e => $f) {
            if ($f->formaPago == '01') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Sin utilizacion del sistema financiero', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(5, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(5, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(13, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '15') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Compensacion de deudas', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '16') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Tarjeta debito', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '17') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Dinero Electronico', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '18') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Tarjeta Prepago', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '19') {
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(20, 10, 'Tarjeta de credito', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(1, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '20') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Otros con utilizacion del sistema financiero', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }
            if ($f->formaPago == '21') {
                $pdf->SetXY(22, $ejeX);
                $pdf->Cell(30, 10, 'Endoso de titulos', 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(4, $ejeX);
                $pdf->Cell(30, 10, 'Total: ' . $f->total, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(0, $ejeX);
                $pdf->Cell(30, 10, 'Plazo: ' . $f->plazo, 0, 0, "C", true);
                $ejeX = $ejeX + 6;
                $pdf->SetXY(10, $ejeX);
                $pdf->Cell(30, 10, 'Unidad de tiempo: ' . $f->unidadTiempo, 0, 0, "C", true);
            }

            $ejeX = $ejeX + 10;
            $pdf->SetX($ejeX);
        }

        //detalle de la factura
        $ejeX = $ejeX + 10;

        $pdf->SetXY(10, $ejeX);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);

        $pdf->Cell(50, 10, "Comprobante que se modifica", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Numero documento modific", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Fecha Emision (Comprobante a", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Razon de la modifi", 1, 0, "C", true);


        $ejeX = $ejeX + 10;
        $pdf->SetXY(10, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        if ($document->infoNotaDebito->codDocModificado == "01") {
            $pdf->Cell(50, 10, "FACTURA", 1, 0, "L");
        } else {
            $pdf->Cell(50, 10, $document->infoNotaDebito->codDocModificado, 1, 0, "L");
        }

        $pdf->Cell(50, 10, $document->infoNotaDebito->numDocModificado, 1, 0, "L");
        $pdf->Cell(50, 10, $document->infoNotaDebito->fechaEmisionDocSustento, 1, 0, "L");

        foreach ($document->motivos->motivo as $a => $b) {
            $pdf->Cell(50, 10, $b->razon, 1, 0, "C", true);
            $ejeX = $ejeX + 10;
            $pdf->SetXY(10, $ejeX);
        }


        $pdf->SetXY(150, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $iva = 0;
        $ice = 0;
        $IRBPNR = 0;
        $subtotal12 = 0;
        $subtotal0 = 0;
        $subtotal_no_impuesto = 0;
        $subtotal_no_iva = 0;
        foreach ($document->infoNotaDebito->impuestos->impuesto as $a => $b) {
            if ($b->codigo == 2) {
                $iva = number_format(floatval($b->valor), 2);
                if ($b->codigoPorcentaje == 0) {
                    $subtotal0 = number_format(floatval($b->baseImponible), 2);
                }
                if ($b->codigoPorcentaje == 2) {
                    $subtotal12 = number_format(floatval($b->baseImponible), 2);
                }
                if ($b->codigoPorcentaje == 6) {
                    $subtotal_no_impuesto = number_format(floatval($b->baseImponible), 2);
                }
                if ($b->codigoPorcentaje == 7) {
                    $subtotal_no_iva = number_format(floatval($b->baseImponible), 2);
                }
            }
            if ($b->codigo == 3) {
                $ice = number_format(floatval($b->valor), 2);
            }
            if ($b->codigo == 5) {
                $IRBPNR = number_format(floatval($b->valor), 2);
            }
        }
        if ($ejeX >= 243) {
            $ejeX = 10;
            $pdf->AddPage();
        } else {
            $ejeX = $ejeX;
        }
        $pdf->SetXY(130, $ejeX + 10);
        $pdf->Cell(25, 10, "Subtotal 12%: ", 0, 0, "L", true);
        $pdf->SetXY(180, $ejeX + 10);
        $pdf->Cell(25, 10, " $subtotal12 ", 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 16);
        $pdf->Cell(25, 10, "SubTotal 0%: ", 0, 0, "L", true);
        $pdf->SetXY(180, $ejeX + 16);
        $pdf->Cell(25, 10, $subtotal0, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 22);
        $pdf->Cell(25, 10, "SubTotal no sujeto de IVA: ", 0, 0, "L", true);
        $pdf->SetXY(180, $ejeX + 22);
        $pdf->Cell(25, 10, $subtotal_no_impuesto, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 28);
        $pdf->Cell(25, 10, "SubTotal exento de IVA: ", 0, 0, "L", true);
        $pdf->SetXY(180, $ejeX + 28);
        $pdf->Cell(25, 10, $subtotal_no_iva, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 34);
        $pdf->Cell(25, 10, "SubTotal sin Impuestos: ", 0, 0, "L", true);
        $pdf->SetXY(180, $ejeX + 34);
        $pdf->Cell(25, 10, number_format(floatval($document->infoNotaDebito->totalSinImpuestos), 2), 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 40);
        $pdf->Cell(25, 10, "IVA 12%: ", 0, 0, "L");
        $pdf->SetXY(180, $ejeX + 40);
        $pdf->Cell(25, 10, $iva, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 46);
        $pdf->Cell(25, 10, "ICE: ", 0, 0, "L");
        $pdf->SetXY(180, $ejeX + 46);
        $pdf->Cell(25, 10, $ice, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 52);
        $pdf->Cell(25, 10, "IRBPNR: ", 0, 0, "L");
        $pdf->SetXY(180, $ejeX + 52);
        $pdf->Cell(25, 10, $IRBPNR, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 58);
        $pdf->Cell(25, 10, "Valor Total: ", 0, 0, "L");
        $pdf->SetXY(180, $ejeX + 58);
        $pdf->Cell(25, 10, number_format(floatval($document->infoNotaDebito->valorTotal), 2), 0, 0, "R");
        $infoAdicional = "";
        $correo = "";

        foreach ($document->infoAdicional->campoAdicional as $a) {
            foreach ($a->attributes() as $b) {
                if ($b == 'Email' || $b == 'email' || $b == '=correo' || $b == 'Correo') {
                    $correo = $a;
                    $infoAdicional .= $b . ': ' . $a . "\n";
                } else {
                    $infoAdicional .= $b . ': ' . $a . "\n";
                }
            }
        }
        $pdf->SetXY(10, $ejeX + 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(100, 10, "Informacion Adicional", 0);
        $pdf->SetXY(10, $ejeX + 40);
        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(100, 5, "" . $infoAdicional . "", 0);

        $pdf->Output('../../webPosOperaciones/comprobantesAutorizados/'.$claveAcceso.'.pdf','F');
	    /*$data_result["message"] = "pdf_ok";
	    echo json_encode($data_result);*/
    }

    public function guiaRemisionPDF($document, $claveAcceso) {
        $pdf = new PDF_Code();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(40, 10, 'Hello World!');
        if ($document->infoGuiaRemision->obligadoContabilidad == 'SI') {

            $contabilidad = "Obligado a llevar contabilidad : SI";
        } else {
            $contabilidad = "Obligado a llevar contabilidad : NO";
        }

        $pdf->SetXY(10, 0);
        $pdf->image('../../webPosOperaciones/logosEmpresas/0919664854001.png', null, null, 50, 30);
        $pdf->SetXY(110, 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->MultiCell(100, 10, "RUC: " . $document->infoTributaria->ruc, 0, 'J', true);
        $pdf->SetXY(110, 15);
        $pdf->MultiCell(100, 10, "Guia Remision Nro: " . $document->infoTributaria->estab . $document->infoTributaria->ptoEmi . $document->infoTributaria->secuencial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(110, 20);
        $pdf->MultiCell(100, 10, 'Nro Autorizacion: ', 0);
        $pdf->SetXY(110, 25);
        $pdf->MultiCell(100, 10, $claveAcceso, 0);
        $pdf->SetXY(110, 30);
        if ($document->infoTributaria->ambiente == 2) {
            $ambiente = 'PRODUCCION';
        } else {
            $ambiente = 'PRUEBAS';
        }
        $pdf->MultiCell(100, 10, 'Ambiente: ' . $ambiente, 0);
        $pdf->SetXY(110, 35);
        if ($document->infoTributaria->tipoEmision == 1) {
            $emision = 'NORMAL';
        } else {
            $emision = 'NORMAL';
        }
        $pdf->MultiCell(100, 10, 'Emision: ' . $emision, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(100, 10, $document->infoTributaria->razonSocial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 30);
        $pdf->MultiCell(100, 10, $document->infoTributaria->dirMatriz, 0);
        $pdf->SetXY(10, 35);
        $pdf->MultiCell(100, 10, $contabilidad, 0);
        //Codigo de barras

        $pdf->SetXY(110, 45);
        $pdf->Code128(110,45,$claveAcceso,100,20);
        $pdf->SetXY(110, 63);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $claveAcceso, 0, 0, "C", true);

        //informacion del cliente
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        $pdf->SetXY(10, 40);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(100, 10, "INFORMACION DEL TRASPORTISTA", 0);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 45);
        $pdf->MultiCell(100, 10, "RUC/CI: " . $document->infoGuiaRemision->rucTransportista, 0);
        $pdf->SetXY(10, 50);
        $pdf->MultiCell(100, 10, "Razon Social/Nombre: " . $document->infoGuiaRemision->razonSocialTransportista, 0);
        $pdf->SetXY(10, 55);
        $pdf->MultiCell(100, 10, "Direccion: " . $document->infoGuiaRemision->dirEstablecimiento, 0);
        $pdf->SetXY(10, 60);
        $pdf->MultiCell(100, 10, "Placa: " . $document->infoGuiaRemision->placa, 0);



        //Fin Encabezado

        $pdf->SetXY(10, 75);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);

        $pdf->Cell(50, 10, "Punto de Partida", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Fecha Inicio", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Fecha Fin", 1, 0, "C", true);

        $pdf->SetXY(10, 85);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $codigo = rand(1000, 9999);

        $pdf->Cell(50, 10, $document->infoGuiaRemision->dirPartida, 1, 0, "L");
        $pdf->Cell(50, 10, $document->infoGuiaRemision->fechaIniTransporte, 1, 0, "L");
        $pdf->Cell(50, 10, $document->infoGuiaRemision->fechaFinTransporte, 1, 0, "L");



        $pdf->SetXY(10, 100);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);
        $pdf->SetFont('Arial', 'B', 6);

        $pdf->Cell(30, 10, "NIT/CI Destinatario", 1, 0, "C", true);
        $pdf->Cell(40, 10, "Destinatario", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Direccion", 1, 0, "C", true);
        $pdf->Cell(30, 10, "Nro Sustento", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Motivo", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Fecha Emision", 1, 0, "C", true);

        $pdf->SetFont('Arial', '', 6);
        $pdf->SetXY(10, 110);
        $ejeX = 110;
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        foreach ($document->destinatarios->destinatario as $a => $b) {
            $pdf->Cell(30, 10, $b->identificacionDestinatario, 1);
            $pdf->Cell(40, 10, $b->razonSocialDestinatario, 1);
            $pdf->Cell(50, 10, $b->dirDestinatario, 1);
            $pdf->Cell(30, 10, $b->numDocSustento, 1);
            $pdf->Cell(20, 10, $b->motivoTraslado, 1);
            $pdf->Cell(20, 10, $b->fechaEmisionDocSustento, 1);
            $ejeX = $ejeX + 10;
            $pdf->SetX($ejeX);
        }
        //detalle de la factura
        $ejeX = $ejeX + 10;
        $pdf->SetXY(10, $ejeX);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);
        $pdf->Cell(25, 10, "Codigo", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Descripcion", 1, 0, "C", true);
        $pdf->Cell(25, 10, "Cantidad", 1, 0, "C", true);


        $ejeX = $ejeX + 10;
        $pdf->SetXY(10, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        foreach ($document->destinatarios->destinatario as $a => $b) {
            foreach ($b->detalles->detalle as $c => $d) {
                $pdf->Cell(25, 10, $d->codigoInterno, 1, 0, "C", true);
                $pdf->Cell(50, 10, $d->descripcion, 1, 0, "C", true);
                $pdf->Cell(25, 10, $d->cantidad, 1, 0, "C", true);
                $ejeX = $ejeX + 10;
                $pdf->SetXY(10, $ejeX);
            }
        }
        if ($ejeX >= 243) {
            $ejeX = 10;
            $pdf->AddPage();
        } else {
            $ejeX = $ejeX;
        }
        $infoAdicional = "";
        $correo = "";
        foreach ($document->infoAdicional->campoAdicional as $a) {
            foreach ($a->attributes() as $b) {
                if ($b == 'Email' || $b == 'email' || $b == '=correo' || $b == 'Correo') {
                    $correo = $a;
                    $infoAdicional .= $b . ': ' . $a . "\n";
                } else {
                    $infoAdicional .= $b . ': ' . $a . "\n";
                }
            }
        }
        $pdf->SetXY(10, $ejeX + 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(100, 10, "Informacion Adicional", 0);
        $pdf->SetXY(10, $ejeX + 40);
        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(100, 5, "" . $infoAdicional . "", 0);

				$pdf->Output('../../webPosOperaciones/comprobantesAutorizados/'.$claveAcceso.'.pdf','F');
		    /*$data_result["message"] = "pdf_ok";
		    echo json_encode($data_result);*/
    }

    public function comprobanteRetencionPDF($document, $claveAcceso) {
        $pdf = new PDF_Code();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(40, 10, 'Hello World!');
        if ($document->infoCompRetencion->obligadoContabilidad == 'SI') {

            $contabilidad = "Obligado a llevar contabilidad : SI";
        } else {
            $contabilidad = "Obligado a llevar contabilidad : NO";
        }
        $pdf->SetXY(10, 0);
        $pdf->image('../../webPosOperaciones/logosEmpresas/0919664854001.png', null, null, 50, 30);
        $pdf->SetXY(110, 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->MultiCell(100, 10, "RUC: " . $document->infoTributaria->ruc, 0, 'J', true);
        $pdf->SetXY(110, 15);
        $pdf->MultiCell(100, 10, "Comprobante Retencion Nro: " . $document->infoTributaria->estab . $document->infoTributaria->ptoEmi . $document->infoTributaria->secuencial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(110, 20);
        $pdf->MultiCell(100, 10, 'Nro Autorizacion: ', 0);
        $pdf->SetXY(110, 25);
        $pdf->MultiCell(100, 10, $claveAcceso, 0);
        $pdf->SetXY(110, 30);
        if ($document->infoTributaria->ambiente == 2) {
            $ambiente = 'PRODUCCION';
        } else {
            $ambiente = 'PRUEBAS';
        }
        $pdf->MultiCell(100, 10, 'Ambiente: ' . $ambiente, 0);
        $pdf->SetXY(110, 35);
        if ($document->infoTributaria->tipoEmision == 1) {
            $emision = 'NORMAL';
        } else {
            $emision = 'NORMAL';
        }
        $pdf->MultiCell(100, 10, 'Emision: ' . $emision, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(100, 10, $document->infoTributaria->razonSocial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 30);
        $pdf->MultiCell(100, 10, $document->infoTributaria->dirMatriz, 0);
        $pdf->SetXY(10, 35);
        $pdf->MultiCell(100, 10, $contabilidad, 0);
        //Codigo de barras

        $pdf->SetXY(110, 45);
        $pdf->Code128(110,45,$claveAcceso,100,20);
        $pdf->SetXY(110, 63);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $claveAcceso, 0, 0, "C", true);
        //informacion del cliente
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        $pdf->SetXY(10, 40);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(100, 10, "INFORMACION DEL SUJETO RETENIDO", 0);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 45);
        $pdf->MultiCell(100, 10, "RUC/CI: " . $document->infoCompRetencion->identificacionSujetoRetenido, 0);
        $pdf->SetXY(10, 50);
        $pdf->MultiCell(100, 10, "Razon Social/Nombre: " . $document->infoCompRetencion->razonSocialSujetoRetenido, 0);
        $pdf->SetXY(10, 55);
        $pdf->MultiCell(100, 10, "Direccion: " . $document->infoCompRetencion->dirEstablecimiento, 0);
        $pdf->SetXY(10, 60);
        $pdf->MultiCell(100, 10, "Fecha Emision: " . $document->infoCompRetencion->fechaEmision, 0);




        //detalle de la factura
        $pdf->SetXY(10, 70);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);
        $pdf->Cell(20, 10, "Impuesto", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Cod. Retenci", 1, 0, "C", true);
        $pdf->Cell(21, 10, "Base Imponible", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Porcentaje", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Sustento", 1, 0, "C", true);
        $pdf->Cell(30, 10, "Documento", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Ejercicio", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Fecha", 1, 0, "C", true);
        $pdf->Cell(20, 10, "Valor Retenido", 1, 0, "C", true);

        $ejeX = 80;
        $pdf->SetXY(10, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $total = 0;
        foreach ($document->impuestos->impuesto as $a => $b) {
            if ($b->codigo == 1) {
                $pdf->Cell(20, 10, "IVA", 1, 0, "C", true);
            } else if ($b->codigo == 2) {
                $pdf->Cell(20, 10, "Renta", 1, 0, "C", true);
            } else {
                $pdf->Cell(20, 10, $b->codigo, 1, 0, "C", true);
            }

            $pdf->Cell(20, 10, $b->codigoRetencion, 1, 0, "C", true);
            $pdf->Cell(21, 10, $b->baseImponible, 1, 0, "C", true);
            $pdf->Cell(20, 10, $b->porcentajeRetener . "%", 1, 0, "C", true);
            if ($b->codDocSustento = '01') {
                $pdf->Cell(20, 10, 'Factura', 1, 0, "C", true);
            } else {
                $pdf->Cell(20, 10, $b->codDocSustento, 1, 0, "C", true);
            }
            $pdf->Cell(30, 10, $b->numDocSustento, 1, 0, "C", true);
            $pdf->Cell(20, 10, date("Y"), 1, 0, "C", true);
            $pdf->Cell(20, 10, $b->fechaEmisionDocSustento, 1, 0, "C", true);
            $pdf->Cell(20, 10, $b->valorRetenido, 1, 0, "C", true);
            $ejeX = $ejeX + 10;
            $pdf->SetXY(10, $ejeX);
            $total += floatval($b->valorRetenido);
        }

        //Total de la factura
        $ejeX = $ejeX + 5;
        $pdf->SetXY(155, $ejeX);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);

        $pdf->Cell(25, 10, "Total", 1, 0, "C", true);

        $pdf->SetXY(180, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        $pdf->Cell(20, 10, number_format(floatval($total), 2), 1, 0, "C");
        if ($ejeX >= 243) {
            $ejeX = 10;
            $pdf->AddPage();
        } else {
            $ejeX = $ejeX;
        }
        // Pie de pagina
        $infoAdicional = "";
        $correo = "";
        foreach ($document->infoAdicional->campoAdicional as $a) {
            foreach ($a->attributes() as $b) {
                if ($b == 'Email' || $b == 'email' || $b == '=correo' || $b == 'Correo') {
                    $correo = $a;
                    $infoAdicional .= $b . ': ' . $a . "\n";
                } else {
                    $infoAdicional .= $b . ': ' . $a . "\n";
                }
            }
        }
        $pdf->SetXY(10, $ejeX + 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(100, 10, "Informacion Adicional", 0);
        $pdf->SetXY(10, $ejeX + 50);
        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(100, 5, "" . $infoAdicional . "", 0);


        $pdf->Output('../../webPosOperaciones/comprobantesAutorizados/'.$claveAcceso.'.pdf','F');
		    /*$data_result["message"] = "pdf_ok";
		    echo json_encode($data_result);*/
    }

    public function notaCreditoPDF($document, $claveAcceso) {
        $pdf = new PDF_Code();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
//$pdf->Cell(40, 10, 'Hello World!');
        if ($document->infoNotaCredito->obligadoContabilidad == 'SI') {

            $contabilidad = "Obligado a llevar contabilidad : SI";
        } else {
            $contabilidad = "Obligado a llevar contabilidad : NO";
        }

        $pdf->SetXY(10, 0);
        $pdf->image('../../webPosOperaciones/logosEmpresas/0919664854001.png', null, null, 80, 30);
        $pdf->SetXY(110, 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->MultiCell(100, 10, "RUC: " . $document->infoTributaria->ruc, 0, 'J', true);
        $pdf->SetXY(110, 15);
        $pdf->MultiCell(100, 10, "Nota Credito Nro: " . $document->infoTributaria->estab . $document->infoTributaria->ptoEmi . $document->infoTributaria->secuencial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(110, 20);
        $pdf->MultiCell(100, 10, 'Nro Autorizacion: ', 0);
        $pdf->SetXY(110, 25);
        $pdf->MultiCell(100, 10, $claveAcceso, 0);
        $pdf->SetXY(110, 30);
        if ($document->infoTributaria->ambiente == 2) {
            $ambiente = 'PRODUCCION';
        } else {
            $ambiente = 'PRUEBAS';
        }
        $pdf->MultiCell(100, 10, 'Ambiente: ' . $ambiente, 0);
        $pdf->SetXY(110, 35);
        if ($document->infoTributaria->tipoEmision == 1) {
            $emision = 'NORMAL';
        } else {
            $emision = 'NORMAL';
        }
        $pdf->MultiCell(100, 10, 'Emision: ' . $emision, 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetXY(10, 20);
        $pdf->MultiCell(100, 10, $document->infoTributaria->razonSocial, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 25);
        $pdf->MultiCell(100, 10, $document->infoTributaria->dirMatriz, 0);
        $pdf->SetXY(10, 30);
        $pdf->MultiCell(100, 10, $contabilidad, 0);
        //Codigo de barras

        $pdf->SetXY(110, 45);
        $pdf->Code128(110,45,$claveAcceso,100,20);
        $pdf->SetXY(110, 63);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(100, 10, $claveAcceso, 0, 0, "C", true);
        //informacion del cliente
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);

        $pdf->SetXY(10, 35);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->MultiCell(100, 10, "INFORMACION DEL COMPRADOR", 0);

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(100, 10, "RUC/CI: " . $document->infoNotaCredito->identificacionComprador, 0);
        $pdf->SetXY(10, 45);
        $pdf->MultiCell(100, 10, "Razon Social/Nombre: " . $document->infoNotaCredito->razonSocialComprador, 0);
        $pdf->SetXY(10, 50);
        $pdf->MultiCell(100, 10, "Direccion: " . $document->infoNotaCredito->dirEstablecimiento, 0);
        $pdf->SetXY(10, 55);
        $pdf->MultiCell(100, 10, "Fecha Emision: " . $document->infoNotaCredito->fechaEmision, 0);



        //Fin Encabezado
        //informacion de la factura
        $pdf->SetXY(10, 70);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);

        $pdf->Cell(30, 10, "Doc. Modif.", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Nro Documento", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Fecha Emision", 1, 0, "C", true);
        $pdf->Cell(30, 10, "Motivo", 1, 0, "C", true);

        $pdf->SetXY(10, 80);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Cell(30, 10, "FACTURA", 1, 0, "C", true);
        $pdf->Cell(50, 10, $document->infoNotaCredito->numDocModificado, 1, 0, "C", true);
        $pdf->Cell(50, 10, $document->infoNotaCredito->fechaEmisionDocSustento, 1, 0, "C", true);
        $pdf->Cell(30, 10, $document->infoNotaCredito->motivo, 1, 0, "C", true);


        //detalle de la factura
        $pdf->SetXY(10, 100);
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(0, 255, 255);
        $pdf->Cell(35, 10, "Codigo", 1, 0, "C", true);
        $pdf->Cell(50, 10, "Descripcion", 1, 0, "C", true);
        $pdf->Cell(25, 10, "Cantidad", 1, 0, "C", true);
        $pdf->Cell(25, 10, "Precio", 1, 0, "C", true);
        $pdf->Cell(25, 10, "% Desc", 1, 0, "C", true);
        $pdf->Cell(25, 10, "Total", 1, 0, "C", true);

        $ejeX = 110;
        $pdf->SetXY(10, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $descuento = 0;
        foreach ($document->detalles->detalle as $a => $b) {
            $descuento = $b->descuento;
            $pdf->Cell(35, 10, $b->codigoInterno, 1, 0, "C", true);
            $pdf->Cell(50, 10, $b->descripcion, 1, 0, "C", true);
            $pdf->Cell(25, 10, $b->cantidad, 1, 0, "C", true);
            $pdf->Cell(25, 10, number_format(floatval($b->precioUnitario), 2), 1, 0, "C", true);
            $pdf->Cell(25, 10, $b->descuento, 1, 0, "C", true);
            $pdf->Cell(25, 10, $b->precioTotalSinImpuesto, 1, 0, "C", true);
            $ejeX = $ejeX + 10;
            $pdf->SetXY(10, $ejeX);
        }

        //Total de la factura
        $pdf->SetXY(150, $ejeX);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFillColor(255, 255, 255);
        $iva = 0;
        $ice = 0;
        $IRBPNR = 0;
        $subtotal12 = 0;
        $subtotal0 = 0;
        $subtotal_no_impuesto = 0;
        $subtotal_no_iva = 0;
        foreach ($document->infoNotaCredito->totalConImpuestos->totalImpuesto as $a => $b) {
            if ($b->codigo == 2) {

                if ($b->codigoPorcentaje == 0) {
                    $subtotal0 = number_format(floatval($b->baseImponible), 2);
                }
                if ($b->codigoPorcentaje == 2) {
                    $subtotal12 = number_format(floatval($b->baseImponible), 2);
                    $iva = $b->valor;
                }
                if ($b->codigoPorcentaje == 6) {
                    $subtotal_no_impuesto = number_format(floatval($b->baseImponible), 2);
                }
                if ($b->codigoPorcentaje == 7) {
                    $subtotal_no_iva = number_format(floatval($b->baseImponible), 2);
                }
            }
            if ($b->codigo == 3) {
                $ice = number_format(floatval($b->valor), 2);
            }
            if ($b->codigo == 5) {
                $IRBPNR = number_format(floatval($b->valor), 2);
            }
        }
        if ($ejeX >= 243) {
            $ejeX = 10;
            $pdf->AddPage();
        } else {
            $ejeX = $ejeX;
        }
        $pdf->SetXY(130, $ejeX + 10);
        $pdf->Cell(25, 10, "Subtotal 12%: ", 0, 0, "L", true);
        $pdf->SetXY(170, $ejeX + 10);
        $pdf->Cell(25, 10, " $subtotal12 ", 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 16);
        $pdf->Cell(25, 10, "SubTotal 0%: ", 0, 0, "L", true);
        $pdf->SetXY(170, $ejeX + 16);
        $pdf->Cell(25, 10, $subtotal0, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 22);
        $pdf->Cell(25, 10, "SubTotal no sujeto de IVA: ", 0, 0, "L", true);
        $pdf->SetXY(170, $ejeX + 22);
        $pdf->Cell(25, 10, $subtotal_no_impuesto, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 28);
        $pdf->Cell(25, 10, "SubTotal exento de IVA: ", 0, 0, "L", true);
        $pdf->SetXY(170, $ejeX + 28);
        $pdf->Cell(25, 10, $subtotal_no_iva, 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 34);
        $pdf->Cell(25, 10, "SubTotal sin Impuestos: ", 0, 0, "L", true);
        $pdf->SetXY(170, $ejeX + 34);
        $pdf->Cell(25, 10, number_format(floatval($document->infoNotaCredito->totalSinImpuestos), 2), 0, 0, "R", true);
        $pdf->SetXY(130, $ejeX + 40);
        $pdf->Cell(25, 10, "IVA 12%: ", 0, 0, "L");
        $pdf->SetXY(170, $ejeX + 40);
        $pdf->Cell(25, 10, $iva, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 46);
        $pdf->Cell(25, 10, "ICE: ", 0, 0, "L");
        $pdf->SetXY(170, $ejeX + 46);
        $pdf->Cell(25, 10, $ice, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 52);
        $pdf->Cell(25, 10, "IRBPNR: ", 0, 0, "L");
        $pdf->SetXY(170, $ejeX + 52);
        $pdf->Cell(25, 10, $IRBPNR, 0, 0, "R");
        $pdf->SetXY(130, $ejeX + 58);
        $pdf->Cell(25, 10, "Valor Total: ", 0, 0, "L");
        $pdf->SetXY(170, $ejeX + 58);
        $pdf->Cell(25, 10, number_format(floatval($document->infoNotaCredito->valorModificacion), 2), 0, 0, "R");
        // Pie de pagina
        $infoAdicional = "";
        $correo = "";
        foreach ($document->infoAdicional->campoAdicional as $a) {
            foreach ($a->attributes() as $b) {
                if ($b == 'Email' || $b == 'email' || $b == '=correo' || $b == 'Correo') {
                    $correo = $a;
                    $infoAdicional .= $b . ': ' . $a . "\n";
                } else {
                    $infoAdicional .= $b . ': ' . $a . "\n";
                }
            }
        }
        $pdf->SetXY(10, $ejeX + 30);
        $pdf->SetFont('Arial', 'B', 7);
        $pdf->MultiCell(100, 10, "Informacion Adicional", 0);
        $pdf->SetXY(10, $ejeX + 50);
        $pdf->SetFont('Arial', '', 7);
        $pdf->MultiCell(100, 5, "" . $infoAdicional . "", 0);

        $pdf->Output('../../webPosOperaciones/comprobantesAutorizados/'.$claveAcceso.'.pdf','F');
		    /*$data_result["message"] = "pdf_ok";
		    echo json_encode($data_result);*/
    }

    public function generarCodigoBarras($claveAcceso) {
        $colorFront = new BCGColor(0, 0, 0);
        $colorBack = new BCGColor(255, 255, 255);

        $code = new BCGcode128();
        $code->setScale(4);
        $code->setThickness(30);
        $code->setForegroundColor($colorFront);
        $code->setBackgroundColor($colorBack);
        $code->parse($claveAcceso);

        $codigobarrasMod = "../../webPosOperaciones/codigoBarras/".$claveAcceso."_mod.png";
        $codigobarras = "../../webPosOperaciones/codigoBarras/".$claveAcceso.".png";
        $drawing = new BCGDrawing($codigobarrasMod,$colorBack);
        $drawing->setBarcode($code);

        $drawing->draw();
        $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
        $this->redim($codigobarrasMod,$codigobarras, 1000, 200);
    }

    public function redim($ruta1, $ruta2, $ancho, $alto) {
        # se obtene la dimension y tipo de imagen 
        $datos = getimagesize($ruta1);

        $ancho_orig = $datos[0]; # Anchura de la imagen original 
        $alto_orig = $datos[1];    # Altura de la imagen original 
        $tipo = $datos[2];

        if ($tipo == 1) { # GIF 
            if (function_exists("imagecreatefromgif"))
                $img = imagecreatefromgif($ruta1);
            else
                return false;
        }
        else if ($tipo == 2) { # JPG 
            if (function_exists("imagecreatefromjpeg"))
                $img = imagecreatefromjpeg($ruta1);
            else
                return false;
        }
        else if ($tipo == 3) { # PNG 
            if (function_exists("imagecreatefrompng"))
                $img = imagecreatefrompng($ruta1);
            else
                return false;
        }

        # Se calculan las nuevas dimensiones de la imagen 
        if ($ancho_orig > $alto_orig) {
            $ancho_dest = $ancho;
            $alto_dest = ($ancho_dest / $ancho_orig) * $alto_orig;
        } else {
            $alto_dest = $alto;
            $ancho_dest = ($alto_dest / $alto_orig) * $ancho_orig;
        }

        // imagecreatetruecolor, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        $img2 = @imagecreatetruecolor($ancho_dest, $alto_dest) or $img2 = imagecreate($ancho_dest, $alto_dest);

        // Redimensionar 
        // imagecopyresampled, solo estan en G.D. 2.0.1 con PHP 4.0.6+ 
        @imagecopyresampled($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig) or imagecopyresized($img2, $img, 0, 0, 0, 0, $ancho_dest, $alto_dest, $ancho_orig, $alto_orig);

        // Crear fichero nuevo, según extensión. 
        if ($tipo == 1) // GIF 
            if (function_exists("imagegif"))
                imagegif($img2, $ruta2);
            else
                return false;

        if ($tipo == 2) // JPG 
            if (function_exists("imagejpeg"))
                imagejpeg($img2, $ruta2);
            else
                return false;

        if ($tipo == 3)  // PNG 
            if (function_exists("imagepng"))
                imagepng($img2, $ruta2);
            else
                return false;

        return true;
    }

}
