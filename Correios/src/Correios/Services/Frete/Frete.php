<?php

namespace Correios\Services\Frete;

use Correios\ServiceInterface\FreteInterface;
use Correios\Services\Services;

/**
 * Description of Frete
 *
 * @author Hc
 */
class Frete extends Services implements FreteInterface {

    private $preco;
    private $prazo;
    private $entregaDomiciliar;
    private $entregaSabado;

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
     * Método seta o preço do frete
     * 
     * @throws Exception
     */
    private function setPreco() {

        $response = parent::correriosConsultation();

        $error = parent::getObjError();
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

        $response = parent::correriosConsultation();

        $error = parent::getObjError();
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
        $response = parent::correriosConsultation();

        $error = parent::getObjError();
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
        $response = parent::correriosConsultation();

        $error = parent::getObjError();
        $error->setCodeError($response->cServico->Erro);

        if (!$error->thereError()):
            $domiciliar = $response->cServico->EntregaDomiciliar;
            $this->entregaDomiciliar = ($domiciliar == "S" ? "Sim" : "Não");
        else:
            throw new \Exception($error->getError());
        endif;
    }

}
