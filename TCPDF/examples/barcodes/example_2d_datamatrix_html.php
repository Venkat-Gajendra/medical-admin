<?php

/**
 * Example for TCPDF 2D Barcode class
 *
 * This example demonstrates how to generate a DataMatrix barcode using the TCPDF library.
 *
 * @package TCPDF
 * @author Nicola Asuni <info@tecnick.com>
 * @version 1.0.009
 */

// Include 2D barcode class
$barcodeIncludePath = dirname(__FILE__) . '/tcpdf_barcodes_2d_include.php';
if (!file_exists($barcodeIncludePath)) {
    die('Error: 2D barcode class not found.');
}
require_once $barcodeIncludePath;

// Set the barcode content and type
$barcodeObj = new TCPDF2DBarcode('https://www.tcpdf.org', 'DATAMATRIX');

// Output the barcode as HTML object
echo $barcodeObj->getBarcodeHTML(6, 6, 'black');
