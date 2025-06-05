<?php
// Include autoloader 
require_once 'autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// if ($_GET['term']=='invview') {
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();
$html = "<span>f</span>";
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$font = $dompdf->getFontMetrics()->get_font("helvetica", "normal");
$dompdf->getCanvas()->page_text(294, 785, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 13);

// Output
// $mask = 'dompdfsave/Invoice-Reports-*.*';
// array_map('unlink', glob($mask));
$output = $dompdf->output();
$dompdf->stream("codexworld", array("Attachment" => 0));
// file_put_contents("dompdfsave/".$_GET['names'].".pdf", $output);
// }
?>