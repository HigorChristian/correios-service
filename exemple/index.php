<?php

require __DIR__ . '/../vendor/autoload.php';

use Correios\Services\Services;

$correios = new Services;

try {

    // peso em KG, comprimento cm, altura cm, largura cm, diametro cm
    $correios->setAttrEncomenda(30, 50, 20, 70, 10);

    /**
     * formato da encomenda  
     * 1 – Formato caixa/pacote     
     * 2 – Formato rolo/prisma     
     * 3 - Envelope
     */
    $correios->setFormato(1);

    /**
     * Método seta o serviço adicional que garante o valor real 
     * do objeto postado sob registro em caso eventual de avaria 
     * ou extravio. 
     * 
     * Se não optar pelo serviço informar zero.
     */
    $correios->setSevicoValorDeclarado(0);

    // Método seta os cep de origem e destino
    $correios->setCepOrigemDestino('74672-053', '7564-0000');

    /**
     * Método seta o tipo de serviço que será usando para a entraga
     * 
     * -------- Código do serviço --------
     * -----------------------------------
     * Código   |   Serviço
     * -----------------------------------
     * 40010    |   SEDEX Varejo
     * 40045    |   SEDEX a Cobrar Varejo
     * 40215    |   SEDEX 10 Varejo
     * 40290    |   SEDEX Hoje Varejo
     * 41106    |   PAC Varejo
     * -----------------------------------
     */
    $correios->setServico('41106');

    /**
     * Método seta o serviço adicional que, por meio do preenchimento 
     * de formulário próprio, permite comprovar, junto ao remetente, 
     * a entrega do objeto.
     */
    $correios->setSevicoAvisoRecebimento('N');

    /**
     * Indica se a encomenda será entregue com o serviço adicional mão própria. 
     * 
     * É o serviço adicional pelo qual o remetente recebe a garantia de que o 
     * objeto, por ele postado sob Registro, será entregue somente ao próprio 
     * destinatário, através da confirmação de sua identidade.
     */
    $correios->setSevicoMaoPropria('N');

    echo "A entrega será realizada em: <b>" . $correios->getPrazo() . '</b> dias. <br>';
    echo "Entrega domiciliar: <b>" . $correios->getEntregaDomiciliar() . '</b><br>';
    echo "Entrega no sabado: <b>" . $correios->getEntregaSabado() . '</b><br>';
    echo "Preço: <b>" . $correios->getPreco() . '<b>';
    //
} catch (Exception $e) {
    echo $e->getMessage();
}
