<?php 



require_once dirname(__FILE__).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {

    //ob_start();
    //dirname(__FILE__).'/Ficha.php';
    //$content = file_get_contents('./Ficha.php');
    //str_replace();


    ob_start();
    $_GET['exportPDF'] = 1;
    include dirname(__FILE__).'/Ficha.php';
    $content = ob_get_clean();
    //$content = ob_get_contents();

    //var_dump($content);die();

    //$html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8');
    //$html2pdf->setTestTdInOnePage(false);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example11.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}