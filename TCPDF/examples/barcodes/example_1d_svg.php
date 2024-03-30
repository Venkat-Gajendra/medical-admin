<?php
// example_1d_svg.php

// include 1D barcode class
require_once(dirname(__FILE__).'/tcpdf_barcodes_1d_include.php');

// set the barcode content and type
$barcodeContent = 'http://www.tcpdf.org';
$barcodeType = 'C128';
$barcodeObj = new TCPDFBarcode($barcodeContent, $barcodeType);

// output the barcode as SVG image
$svg = $barcodeObj->getBarcodeSVG(2, 30, ['rgb' => [0, 0, 0]]);

// set the HTTP response headers for SVG image
header('Content-Type: image/svg+xml');
header('Content-Length: ' . strlen($svg));

// output the SVG image
echo $svg;
