<?php
// example_2d_html.php

// include 2D barcode class (search for installation path)
require_once(dirname(__FILE__).'/tcpdf_barcodes_2d_include.php');

// Set the barcode content and type
$url = 'http://www.tcpdf.org';
$barcodeType = 'QRCODE,H';
$barcodeObj = new TCPDF2DBarcode($url, $barcodeType);

// Output the barcode as HTML object
$barcodeHtml = $barcodeObj->getBarcodeHTML(6, 6, 'black');
echo $barcodeHtml;
