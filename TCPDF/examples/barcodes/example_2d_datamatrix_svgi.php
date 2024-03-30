<?php

// Example for generating a DataMatrix barcode as SVG code using TCPDF library

// Include the 2D barcode class
$barcodeIncludePath = dirname(__FILE__) . '/tcpdf_barcodes_2d_include.php';
if (!file_exists($barcodeIncludePath) || !is_readable($barcodeIncludePath)) {
    throw new RuntimeException('Barcode include file not found or not readable.');
}
require_once $barcodeIncludePath;

// Set the barcode content and type
$barcodeUrl = 'http://www.tcpdf.org';
$barcodeType = 'DATAMATRIX';
$barcodeObj = new TCPDF2DBarcode($barcodeUrl, $barcodeType);

// Generate the barcode as SVG inline code
$svgCode = $barcodeObj->getBarcodeSVGcode(6, 6, 'black');

// Output the SVG code
echo $svgCode;
