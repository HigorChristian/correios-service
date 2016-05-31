<?php

namespace Correios\ServiceInterface;

/**
 * Description of Services
 *
 * @author Higor Christian Ferreira
 * @copyright (c) 2016, Higor Christian Ferreira
 */
interface FreteInterface {

    public function getPreco();

    public function getPrazo();

    public function getEntregaDomiciliar();

    public function getEntregaSabado();
}
