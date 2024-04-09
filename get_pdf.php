<?php
// Path to the PDF file
$pdfPath = 'letterpad.pdf';

// Set the appropriate content-type header
header('Content-Type: application/pdf');

// Output the PDF file
readfile($pdfPath);
