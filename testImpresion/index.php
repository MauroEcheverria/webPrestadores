<?php
require __DIR__ . '/vendor/autoload.php';
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
$profile = CapabilityProfile::load("simple");
$connector = new WindowsPrintConnector("smb://172.16.177.104/EPSON");
$printer = new Printer($connector, $profile);
$printer -> text("Hello World!\n");
$printer -> cut();
$printer -> close();