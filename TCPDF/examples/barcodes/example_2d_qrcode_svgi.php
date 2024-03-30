<?php

// Set the URL for the barcode
$url = 'http://www.tcpdf.org';

// Include the 2D barcode class
if (file_exists(dirname(__FILE__) . '/tcpdf_barcodes_2d_include.php')) {
    require_once(dirname(__FILE__) . '/tcpdf_barcodes_2d_include.php');
} else {
    die('Error: 2D barcode class not found');
}

// Create a new TCPDF2DBarcode object
try {
    $barcodeObj = new TCPDF2DBarcode($url, 'QRCODE,H');
} catch (Exception $e) {
    die('Error: Could not create barcode object: ' . $e->getMessage());
}

// Get the SVG code for the barcode
$svgCode = $barcodeObj->getBarcodeSVGcode(6, 6, 'black');

// Output the SVG code
echo $svgCode;
