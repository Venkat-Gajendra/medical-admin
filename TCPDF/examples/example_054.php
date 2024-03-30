<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Create a new PDF document with the given orientation, unit, format, and TCPDF constructor parameters
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 054');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 054', PDF_HEADER_STRING);

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
if (file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// Disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// Set font
$pdf->SetFont('helvetica', '', 10);

// Add a page
$pdf->AddPage();

// Create HTML content
$html = '
<h1>XHTML Form Example</h1>
<form method="post" action="printvars.php" enctype="multipart/form-data">
	<!-- Text field -->
	<label for="name">name:</label>
	<input type="text" name="name" value="" size="20" maxlength="30" />
	<br />
	<!-- Password field -->
	<label for="password">password:</label>
	<input type="password" name="password" value="" size="20" maxlength="30" />
	<br /><br />
	<!-- File input -->
	<label for="infile">file:</label>
	<input type="file" name="userfile" size="20" />
	<br /><br />
	<!-- Checkbox -->
	<input type="checkbox" name="agree" value="1" checked="checked" />
	<label for="agree">I agree </label>
	<br /><br />
	<!-- Radio buttons -->
	<input type="radio" name="radioquestion" id="rqa" value="1" />
	<label for="rqa">one</label>
	<br />
	<input type="radio" name="radioquestion" id="rqb" value="2" checked="checked"/>
	<label for="rqb">two</label>
	<br />
	<input type="radio" name="radioquestion" id="rqc" value="3" />
	<label for="rqc">three</label>
	<br /><br />
	<!-- Select -->
	<label for="selection">select:</label>
	<select name="selection" size="0">
		<option value="0">zero</option>
		<option value="1">one</option>
		<option value="2">two</option>
		<option value="3">three</option>
	</select>
	<br /><br />
	<!-- Multi-select -->
	<label for="multiselection">select:</label>
	<select name="multiselection[]" size="2" multiple="multiple">
		<option value="0">zero</option>
		<option value="1">one</option>
		<option value="2">two</option>
		<option value="3">three</option>
	</select>
	<br /><br /><br />
	<!-- Textarea -->
	<label for="text">text area:</label>
	<br />
	<textarea cols="40" rows="3" name="text">line one
line two</textarea>
	<br />
	<br /><br /><br />
	<!-- Reset button -->
	<input type="reset" name="reset" value="Reset" />
	<!-- Submit button -->
	<input type="submit" name="submit" value="Submit" />
	<!-- Print button (JavaScript) -->
	<input type="button" name="print" value="Print" onclick="print()" />
	<!-- Hidden field -->
	<input type="hidden" name="hiddenfield" value="OK" />
	<br />
</form>
';

// Output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// Close and output PDF document
$pdf->Output('example_054.pdf', 'D');
