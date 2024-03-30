<?php

// Example of CMYK, RGB and Grayscale colors using TCPDF

// Include the main TCPDF library
if (!require_once('tcpdf_include.php')) {
    die('Error: could not include tcpdf_include.php.');
}

// Create a new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 022');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 022', PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// Set font
$pdf->SetFont('helvetica', 'B', 18);

// Add a page
$pdf->AddPage();

$pdf->Write(0, 'Example of CMYK, RGB and Grayscale colours', '', 0, 'L', true, 0, false, false, 0);

// Define style for border
$border_style = array('all' => array('width' => 2, 'cap' => 'square', 'join' => 'miter', 'dash' => 0, 'phase' => 0));

// --- CMYK ------------------------------------------------

$cmyk_colors = array(
    array(50, 0, 0, 0), // Cyan
    array(0, 50, 0, 0), // Magenta
    array(0, 0, 50, 0), // Yellow
    array(0, 0, 0, 50), // Black
);

foreach ($cmyk_colors as $color) {
    $pdf->SetDrawColor($color[0], $color[1], $color[2], $color[3]);
    $pdf->SetFillColor($color[0], $color[1], $color[2], $color[3]);
    $pdf->SetTextColor($color[0], $color[1], $color[2], $color[3]);
    $pdf->Rect(30, 60 + (30 * (array_search($color, $cmyk_colors))), 30, 30, 'DF', $border_style);
    $pdf->Text(30, 92 + (30 * (array_search($color, $cmyk_colors))), $color[0] . ',' . $color[1] . ',' . $color[2] . ',' . $color[3]);
}

// --- RGB -------------------------------------------------

$rgb_colors = array(
    array(255, 127, 127), // Red
    array(127, 255, 127), // Green
    array(127, 127, 255), // Blue
);

foreach ($rgb_colors as $color) {
    $pdf->SetDrawColor($color[0], $color[1], $color[2]);
    $pdf->SetFillColor($color[0], $color[1], $color[2]);
    $pdf->SetTextColor($color[0], $color[1], $color[2]);
    $pdf->Rect(100, 60 + (30 * (array_search($color, $rgb_colors))), 30, 30, 'DF', $border_style);
    $pdf->Text(100, 92 + (30 * (array_search($color, $rgb_colors))), $color[0] . ',' . $color[1] . ',' . $color[2]);
}

// --- GRAY ------------------------------------------------

$gray_colors = array(
    array(191), // Gray
);

foreach ($gray_colors as $color) {
    $pdf->SetDrawColor($color[0]);
    $pdf->SetFillColor($color[0]);
    $pdf->SetTextColor($color[0]);
    $pdf->Rect(170, 60, 30, 30, 'DF', $border_style);
    $pdf->Text(170, 92, $color[0]);
}

// Close and output PDF document
if (!$pdf->Output('example_022.pdf', 'I')) {
    die('Error: could not output the PDF.');
}
