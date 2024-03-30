<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

class MyTCPDF extends TCPDF {

    // Override the default header to add a title
    public function Header() {
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 10, 'Graphic Transformations', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }
}

// create new PDF document
$pdf = new MyTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 013');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Scaling
$pdf->Rect(50, 70, 40, 10, 'D');
$pdf->Text(50, 66, 'Scale');
$pdf->StartTransform();
$pdf->ScaleXY(150, 50, 80);
$pdf->Rect(50, 70, 40, 10, 'D');
$pdf->Text(50, 66, 'Scale');
$pdf->StopTransform();

// Translation
$pdf->Rect(125, 70, 40, 10, 'D');
$pdf->Text(125, 66, 'Translate');
$pdf->StartTransform();
$pdf->Translate(7, 5);
$pdf->Rect(125, 70, 40, 10, 'D');
$pdf->Text(125, 66, 'Translate');
$pdf->StopTransform();

// Rotation
$pdf->Rect(70, 100, 40, 10, 'D');
$pdf->Text(70, 96, 'Rotate');
$pdf->StartTransform();
$pdf->Rotate(20, 70, 110);
$pdf->Rect(70, 100, 40, 10, 'D');
$pdf->Text(70, 96, 'Rotate');
$pdf->StopTransform();

// Skewing
$pdf->Rect(125, 100, 40, 10, 'D');
$pdf->Text(125, 96, 'Skew');
$pdf->StartTransform();
$pdf->SkewX(30, 125, 110);
$pdf->Rect(125, 100, 40, 10, 'D');
$pdf->Text(125, 96, 'Skew');
$pdf->StopTransform();

// Mirroring horizontally
$pdf->Rect(70, 130, 40, 10, 'D');
$pdf->Text(70, 126, 'MirrorH');
$pdf->StartTransform();
$pdf->MirrorH(70);
$pdf->Rect(70, 130, 40, 10, 'D');
$pdf->Text(70, 126, 'MirrorH');
$pdf->StopTransform();

// Mirroring vertically
$pdf->Rect(125, 130, 40, 10, 'D');
$pdf->Text(125, 126, 'MirrorV');
$pdf->StartTransform();
$pdf->MirrorV(140);
$pdf->Rect(125, 130, 40, 10, 'D');
$pdf->Text(125, 126, 'MirrorV');
$pdf->StopTransform();

// Point reflection
$pdf->Rect(70, 160, 40, 10, 'D');
$pdf->Text(70, 156, 'MirrorP');
$pdf->StartTransform();
$pdf->MirrorP(70,170);
$pdf->Rect(70, 160, 40, 10, 'D');
$pdf->Text(70, 156, 'MirrorP');
$pdf->StopTransform();

// Mirroring against a straight line
$angle = -20;
$px = 120;
$py = 170;

$pdf->SetDrawColor(200);
$pdf->Line($px-1,$py-1,$px+1,$py+1);
$pdf->Line($px-1,$py+1,$px+1,$py-1);
$pdf->StartTransform();
$pdf->Rotate($angle, $px, $py);
$pdf->Line($px-5, $py, $px+60, $py);
$pdf->StopTransform();

$pdf->Rect(125, 160, 40, 10,
