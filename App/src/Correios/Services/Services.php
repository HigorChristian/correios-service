<?php

namespace Correios\Services;

use Correios\ServiceInterface\ServiceInterface;
use Correios\Error\Error;

/**
 * Description of Services
 *
 * @author Higor Christian Ferreira
 * @copyright (c) 2016, Higor Christian Ferreira
 */
class Services extends Error implements ServiceInterface {

    private $preco;
    private $prazo;
    private $entregaDomiciliar;
    private $entregaSabado;

    /** Atributos de entrada do webservice dos correios */

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

    /**
     * Método retorna o preço do frete
     * 
     * @return String Preço
     */
    public function getPreco() {
        $this->setPreco();
        return $this->preco;
    }

    /**
     * Método retorna o prazo do frete
     * @return String Prazo
     */
    public function getPrazo() {
        $this->setPrazo();
        return $this->prazo;
    }

    /**
     * Método retorna se entraga no domicilio
     * 
     * @return String Sim se entragar e Não se não entragar
     */
    public function getEntregaDomiciliar() {
        $this->setEntregaDomiciliar();
        return $this->entregaDomiciliar;
    }

    /**
     * Método retorna se entraga no sabado
     * 
     * @return String Sim se entragar e Não se não entragar
     */
    public function getEntregaSabado() {
        $this->setEntregaSabado();
        return $this->entregaSabado;
    }

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
     * 
     * @param String $codigo
     */
    public function setServico($codigo) {
        $this->nCdServico = $codigo;
    }

    /**
     * Método seta os cep de origem e destino
     * 
     * @param String $cepOrigem
     * @param String $cepDestino
     */
    public function setCepOrigemDestino($cepOrigem, $cepDestino) {
        $this->sCepOrigem = $cepOrigem;
        $this->sCepDestino = $cepDestino;
    }

    /**
     * Métedo seta o formato da encomenda
     * 
     * 1 – Formato caixa/pacote
     * 2 – Formato rolo/prisma
     * 3 - Envelope
     * 
     * @param Int $formato
     */
    public function setFormato($formato) {
        $this->nCdFormato = $formato;
    }

    /**
     * Método seta os atributos da encomenda PESO, COMPRIMENTO, ALTURA, LARGURA,
     * DIAMETRO
     * 
     * @param String $peso Peso da encomenda, incluindo sua embalagem. 
     * O peso deve ser informado em quilogramas. Se o formato for Envelope, 
     * o valor máximo permitido será 1 kg.
     * @param Decimal $comprimento Comprimento da encomenda (incluindo embalagem),
     * em centímetros.
     * @param Decimal $altura Altura da encomenda (incluindo embalagem), 
     * em centímetros. Se o formato for envelope, informar zero (0).
     * @param Decimal $largura Largura da encomenda (incluindo embalagem), 
     * em centímetros.
     * @param Decimal $diametro Diâmetro da encomenda (incluindo embalagem), 
     * em centímetros.
     */
    public function setAttrEncomenda($peso, $comprimento, $altura, $largura, $diametro) {
        $this->nVlPeso = $peso;
        $this->nVlComprimento = $comprimento;
        $this->nVlAltura = $altura;
        $this->nVlLargura = $largura;
        $this->nVlDiametro = $diametro;
    }

    /**
     * Indica se a encomenda será entregue com o serviço adicional mão própria.
     *
     * É o serviço adicional pelo qual o remetente recebe a garantia de que o 
     * objeto, por ele postado sob Registro, será entregue somente ao próprio 
     * destinatário, através da confirmação de sua identidade.
     * 
     * @param String $confirmar S ou N (S – Sim, N – Não)
     */
    public function setSevicoMaoPropria($confirmar) {
        $this->sCdMaoPropria = $confirmar;
    }

    /**
     * Método seta o serviço adicional que garante o valor real do objeto postado 
     * sob registro em caso eventual de avaria ou extravio.
     * 
     * Se não optar pelo serviço informar zero.
     * 
     * @param Decimal $valor Neste campo deve ser apresentado o valor declarado 
     * desejado, em Reais.
     */
    public function setSevicoValorDeclarado($valor) {
        $this->nVlValorDeclarado = $valor;
    }

    /**
     * Método seta o serviço adicional que, por meio do preenchimento de formulário 
     * próprio, permite comprovar, junto ao remetente, a entrega do objeto.
     * 
     * @param String $confirmar S ou N (S – Sim, N – Não)
     */
    public function setSevicoAvisoRecebimento($confirmar) {
        $this->sCdAvisoRecebimento = $confirmar;
    }

    /**
     * Método seta o preço do frete
     * 
     * @throws Exception
     */
    private function setPreco() {

        $response = $this->correriosConsultation();

        $error = new Error;
        $error->setCodeError($response->cServico->Erro);

        if (!$error->thereError()):
            $this->preco = $response->cServico->Valor;
        else:
            throw new \Exception($error->getError());
        endif;
    }

    /**
     * Método seta o prazo do frete
     * 
     * @throws Exception
     */
    private function setPrazo() {

        $response = $this->correriosConsultation();

        $error = new Error;
        $error->setCodeError($response->cServico->Erro);

        if (!$error->thereError()):

            $prazo = $response->cServico->PrazoEntrega;
            if ($prazo == 0):
                $error->setCodeError(2016);
                throw new \Exception($error->getError());
            else:
                $this->prazo = $prazo;
            endif;

        else:
            throw new \Exception($error->getError());
        endif;
    }

    /**
     * Método seta a entraga Sabado
     * 
     * @throws \Exception
     */
    private function setEntregaSabado() {
        $response = $this->correriosConsultation();

        $error = new Error;
        $error->setCodeError($response->cServico->Erro);

        if (!$error->thereError()):
            $sabado = $response->cServico->EntregaSabado;
            $this->entregaSabado = ($sabado == "S" ? "Sim" : "Não");
        else:
            throw new \Exception($error->getError());
        endif;
    }

    /**
     * Método seta a entraga domiciliar
     * 
     * @throws \Exception
     */
    private function setEntregaDomiciliar() {
        $response = $this->correriosConsultation();

        $error = new Error;
        $error->setCodeError($response->cServico->Erro);

        if (!$error->thereError()):
            $domiciliar = $response->cServico->EntregaDomiciliar;
            $this->entregaDomiciliar = ($domiciliar == "S" ? "Sim" : "Não");
        else:
            throw new \Exception($error->getError());
        endif;
    }

    /**
     * Método monta a query e faz a consulta no webservice dos correios
     * 
     * @return Response
     */
    private function correriosConsultation() {

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
        $resultado = simplexml_load_file($url);

        return $resultado;
    }

}
