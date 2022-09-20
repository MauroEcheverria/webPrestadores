<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

$profile = CapabilityProfile::load("simple");
$connector = new WindowsPrintConnector("smb://DESKTOP-8N19MD6/EPSON TM-T88V Receipt");
$printer = new Printer($connector,$profile);
$printer -> initialize();

$printer -> text("Hello World!\n");
$printer -> cut();
$printer -> close();
