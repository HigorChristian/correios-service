<?php

namespace Correios\Services;

use Correios\Error\Error;

/**
 * Description of Services
 *
 * @author Higor Christian Ferreira
 * @copyright (c) 2016, Higor Christian Ferreira
 */
class Services extends Error {

    /**
     * Seu código administrativo junto à ECT. O código está disponível no 
     * corpo do contrato firmado com os Correios
     * 
     * <b>Obrigatório</b>
     * Não, mas o parâmetro tem que ser passado mesmo vazio.
     * 
     * @var String 
     */
    private $nCdEmpresa = '';

    /**
     * Senha para acesso ao serviço, associada ao seu código administrativo. 
     * A senha inicial corresponde aos 8 primeiros dígitos do CNPJ informado 
     * no contrato. A qualquer momento, é possível alterar a senha no endereço 
     * http://www.corporativo.correios.com.br/encomendas/servicosonline/recuperaSenha.
     * 
     * <b>Obrigatório</b>
     * Não, mas o parâmetro tem que ser passado mesmo vazio.
     * 
     * @var String 
     */
    private $sDsSenha = '';

    /**
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
     * 
     * <b>Obrigatório</b>
     * Sim.
     * Pode ser mais de um numa consulta separados por vírgula
     * 
     * @var String
     */
    private $nCdServico;

    /**
     *  CEP de Origem sem hífen.Exemplo: 05311900
     * 
     * <b>Obrigatório</b>
     * Sim.
     *
     * @var String 
     */
    private $sCepOrigem;

    /**
     * CEP de Destino sem hífen
     * 
     * <b>Obrigatório</b>
     * Sim. 
     * 
     * @var String 
     */
    private $sCepDestino;

    /**
     * Peso da encomenda, incluindo sua embalagem. 
     * O peso deve ser informado em quilogramas. 
     * Se o formato for Envelope, o valor máximo permitido será 1 kg.
     * 
     * <b>Obrigatório</b>
     * Sim. 
     * 
     * @var String 
     */
    private $nVlPeso;

    /**
     * Formato da encomenda (incluindo embalagem).
     * Valores possíveis: 1, 2 ou 3
     * 1 – Formato caixa/pacote
     * 2 – Formato rolo/prisma
     * 3 - Envelope
     * 
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var Int 
     */
    private $nCdFormato;

    /**
     * Comprimento da encomenda (incluindo embalagem), em centímetros.
     * 
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var Decimal 
     */
    private $nVlComprimento;

    /**
     *  Altura da encomenda (incluindo embalagem), em centímetros. 
     * Se o formato for envelope, informar zero (0).
     * 
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var Decimal 
     */
    private $nVlAltura;

    /**
     * Largura da encomenda (incluindo embalagem), em centímetros.
     * 
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var Decimal 
     */
    private $nVlLargura;

    /**
     * Diâmetro da encomenda (incluindo embalagem), em centímetros.
     *
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var Decimal
     */
    private $nVlDiametro;

    /**
     * Indica se a encomenda será entregue com o serviço adicional mão própria.
     * Valores possíveis: S ou N (S – Sim, N – Não)
     * 
     * <b>Obrigatório</b>
     * Sim.
     * 
     * @var String
     */
    private $sCdMaoPropria;

    /**
     * Indica se a encomenda será entregue com o serviço adicional valor declarado. 
     * Neste campo deve ser apresentado o valor declarado desejado, em Reais.
     * 
     * <b>Obrigatório</b>
     * Sim.
     * Se não optar pelo serviço informar zero.
     * 
     * @var Decimal 
     */
    private $nVlValorDeclarado;

    /**
     * Indica se a encomenda será entregue com o serviço adicional aviso de recebimento.
     * Valores possíveis: S ou N (S – Sim, N – Não)
     * 
     * * <b>Obrigatório</b>
     * Sim.
     * Se não optar pelo serviço informar „N‟
     * 
     * @var String 
     */
    private $sCdAvisoRecebimento;

    public function setFrete(array $data) {
        $this->nCdEmpresa = $data['codigo'];
        $this->sDsSenha = $data['senha'];
        $this->nCdServico = $data['servico'];
        $this->sCepOrigem = $data['cepOrigem'];
        $this->sCepDestino = $data['cepDestino'];
        $this->nVlPeso = $data['peso'];
        $this->nCdFormato = $data['formato'];
        $this->nVlComprimento = $data['comprimento'];
        $this->nVlAltura = $data['altura'];
        $this->nVlLargura = $data['largura'];
        $this->nVlDiametro = $data['diametro'];
        $this->sCdMaoPropria = $data['ServicoMaoPropria'];
        $this->nVlValorDeclarado = $data['ServicoValorDeclarado'];
        $this->sCdAvisoRecebimento = $data['ServicoAvisoRecebimento'];
    }

    /**
     * Método retorna o objeto do tipo Error
     * 
     * @return Error
     */
    protected function getObjError() {
        $error = new Error;
        return $error;
    }

    /**
     * Método monta a query e faz a consulta no webservice dos correios
     * 
     * @return Response
     */
    protected function correriosConsultation() {

        $data = array(
            'nCdEmpresa' => $this->nCdEmpresa,
            'sDsSenha' => $this->sDsSenha,
            'nCdServico' => $this->nCdServico,
            'sCepOrigem' => $this->sCepOrigem,
            'sCepDestino' => $this->sCepDestino,
            'nVlPeso' => $this->nVlPeso,
            'nCdFormato' => $this->nCdFormato,
            'nVlComprimento' => $this->nVlComprimento,
            'nVlAltura' => $this->nVlAltura,
            'nVlLargura' => $this->nVlLargura,
            'nVlDiametro' => $this->nVlDiametro,
            'sCdMaoPropria' => $this->sCdMaoPropria,
            'nVlValorDeclarado' => $this->nVlValorDeclarado,
            'sCdAvisoRecebimento' => $this->sCdAvisoRecebimento,
            'StrRetorno' => 'xml'
        );

        $query = http_build_query($data);
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?{$query}";

        return simplexml_load_file($url);
    }

}
