<?php

require __DIR__ . '/../vendor/autoload.php';

use Correios\Services\Frete\Frete;

$frete = new Frete;

try {

    $data = array(
        'codigo' => '',
        'senha' => '',
        'servico' => '41106',
        'cepOrigem' => '74672053',
        'cepDestino' => '75640000',
        'peso' => 5,
        'formato' => 1,
        'comprimento' => 50,
        'altura' => 20,
        'largura' => 70,
        'diametro' => 10,
        'ServicoMaoPropria' => 'N',
        'ServicoValorDeclarado' => 0,
        'ServicoAvisoRecebimento' => 'N'
    );

    $frete->setFrete($data);

    echo "A entrega será realizada em: <b>" . $frete->getPrazo() . '</b> dias. <br>';
    echo "Entrega domiciliar: <b>" . $frete->getEntregaDomiciliar() . '</b><br>';
    echo "Entrega no sabado: <b>" . $frete->getEntregaSabado() . '</b><br>';
    echo "Preço: <b>" . $frete->getPreco() . '<b>';
    //
} catch (Exception $e) {
    echo $e->getMessage();
}
