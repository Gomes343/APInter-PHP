<?php

require_once "../../vendor/autoload.php";
use ctodobom\APInterPHP\BancoInter;
use ctodobom\APInterPHP\BancoInterException;
use ctodobom\APInterPHP\Cobranca\Boleto;
use ctodobom\APInterPHP\Cobranca\Pagador;
use ctodobom\APInterPHP\Aplication\Correntista;

$correntista = new Correntista();
$banco = new BancoInter($correntista->getNumero_da_Conta(),$correntista->getCertificado(), $correntista->getChavePrivada());

try {
    header('Content-type: text/plain');
    echo "Download do PDF\n";
    $pdf = $banco->getPdfBoleto("00684058185");

    echo "\n\nSalvo PDF em ".$pdf."\n";
} catch ( BancoInterException $e ) {
    echo "\n\n".$e->getMessage();
    echo "\n\nCabeçalhos: \n";
    echo $e->reply->header;
    echo "\n\nConteúdo: \n";
    echo $e->reply->body;
}
