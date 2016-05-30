<?php

namespace Correios\ErrorInterface;

/**
 * Description of Services
 *
 * @author Higor Christian Ferreira
 * @copyright (c) 2016, Higor Christian Ferreira
 */
interface ErrorInterface {

    public function getError();

    public function getCodeError();

    public function setCodeError($codeError);
}
