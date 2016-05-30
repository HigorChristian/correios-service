<?php

require __DIR__ . '/../vendor/autoload.php';

use Correios\Services\Services;

$correios = new Services;

try {

    $correios->setAttrEncomenda(3, 50, 20, 70, 10);
    $correios->setFormato(1);
    $correios->setSevicoValorDeclarado(0);
    $correios->setCepOrigemDestino('74672-053', '7564-0000');
    $correios->setServico('41106');
    $correios->setSevicoAvisoRecebimento('N');
    $correios->setSevicoMaoPropria('N');

    echo "A entrega será realizada em: <b>" . $correios->getPrazo() . '</b> dias. <br>';
    echo "Entrega domiciliar: <b>" . $correios->getEntregaDomiciliar() . '</b><br>';
    echo "Entrega no sabado: <b>" . $correios->getEntregaSabado() . '</b><br>';
    echo "Preço: <b>" . $correios->getPreco() . '<b>';
    //
} catch (Exception $e) {
    echo $e->getMessage();
}
