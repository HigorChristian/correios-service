<?php

namespace Correios\Error;

use Correios\ErrorInterface\ErrorInterface;

/**
 * Description of Error
 *
 * @author Higor Christian Ferreira
 * @copyright (c) 2016, Higor Christian Ferreira
 */
class Error implements ErrorInterface {

    private $error;
    private $codeError;

    /**
     * Método retorna os mensagens de erro
     * 
     * @return string Mensagem de erro
     */
    public function getError() {
        $this->setError();
        return $this->error;
    }

    /**
     * Método retorna o codigo do erro
     * 
     * @return int codigo do erro
     */
    public function getCodeError() {
        return $this->codeError;
    }

    /**
     * Método seta o codigo de erro
     * 
     * @param int $codeError
     */
    public function setCodeError($codeError) {
        $this->codeError = $codeError;
    }

    /**
     * Método verifica se existe erro
     * 
     * @return boolean false se não existir erros e true se existir
     */
    public function thereError() {
        if ($this->getCodeError() == 0):
            return false;
        else:
            return true;
        endif;
    }

    /**
     * Método seta os erros
     */
    private function setError() {
        if ($this->getCodeError() == -1):
            $this->error = "Código de serviço inválido";
        elseif ($this->getCodeError() == -2):
            $this->error = "CEP de origem inválido";
        elseif ($this->getCodeError() == -3):
            $this->error = "CEP de destino inválido";
        elseif ($this->getCodeError() == -4):
            $this->error = "Peso excedido";
        elseif ($this->getCodeError() == -5):
            $this->error = "O Valor Declarado não deve exceder R$ 10.000,00";
        elseif ($this->getCodeError() == -6):
            $this->error = "Serviço indisponível para o trecho informado";
        elseif ($this->getCodeError() == -7):
            $this->error = "O Valor Declarado é obrigatório para este serviço";
        elseif ($this->getCodeError() == -8):
            $this->error = "Este serviço não aceita Mão Própria";
        elseif ($this->getCodeError() == -9):
            $this->error = "Este serviço não aceita Aviso de Recebimento";
        elseif ($this->getCodeError() == -10):
            $this->error = "Precificação indisponível para o trecho informado";
        elseif ($this->getCodeError() == -11):
            $this->error = "Para definição do preço deverão ser informados, também, o comprimento, a largura e altura do objeto em centímetros (cm).";
        elseif ($this->getCodeError() == -12):
            $this->error = "Comprimento inválido.";
        elseif ($this->getCodeError() == -13):
            $this->error = "Largura inválida.";
        elseif ($this->getCodeError() == -14):
            $this->error = "Altura inválida.";
        elseif ($this->getCodeError() == -15):
            $this->error = "O comprimento não pode ser maior que 105 cm.";
        elseif ($this->getCodeError() == -16):
            $this->error = "A largura não pode ser maior que 105 cm.";
        elseif ($this->getCodeError() == -17):
            $this->error = "A altura não pode ser maior que 105 cm.";
        elseif ($this->getCodeError() == -18):
            $this->error = "A altura não pode ser inferior a 2 cm.";
        elseif ($this->getCodeError() == -20):
            $this->error = "A largura não pode ser inferior a 11 cm.";
        elseif ($this->getCodeError() == -22):
            $this->error = "O comprimento não pode ser inferior a 16 cm.";
        elseif ($this->getCodeError() == -23):
            $this->error = "A soma resultante do comprimento + largura + altura não deve superar a 200 cm.";
        elseif ($this->getCodeError() == -24):
            $this->error = "Comprimento inválido.";
        elseif ($this->getCodeError() == -25):
            $this->error = "Diâmetro inválido";
        elseif ($this->getCodeError() == -26):
            $this->error = "Informe o comprimento.";
        elseif ($this->getCodeError() == -27):
            $this->error = "Informe o diâmetro.";
        elseif ($this->getCodeError() == -28):
            $this->error = "O comprimento não pode ser maior que 105 cm.";
        elseif ($this->getCodeError() == -29):
            $this->error = "O diâmetro não pode ser maior que 91 cm.";
        elseif ($this->getCodeError() == -30):
            $this->error = "O comprimento não pode ser inferior a 18 cm.";
        elseif ($this->getCodeError() == -31):
            $this->error = "O diâmetro não pode ser inferior a 5 cm.";
        elseif ($this->getCodeError() == -32):
            $this->error = "A soma resultante do comprimento + o dobro do diâmetro não deve superar a 200 cm.";
        elseif ($this->getCodeError() == -33):
            $this->error = "Sistema temporariamente fora do ar. Favor tentar mais tarde.";
        elseif ($this->getCodeError() == -34):
            $this->error = "Código Administrativo ou Senha inválidos.";
        elseif ($this->getCodeError() == -35):
            $this->error = "Senha incorreta.";
        elseif ($this->getCodeError() == -36):
            $this->error = "Cliente não possui contrato vigente com os Correios.";
        elseif ($this->getCodeError() == -37):
            $this->error = "Cliente não possui serviço ativo em seu contrato.";
        elseif ($this->getCodeError() == -38):
            $this->error = "Serviço indisponível para este código administrativo.";
        elseif ($this->getCodeError() == -39):
            $this->error = "Peso excedido para o formato envelope";
        elseif ($this->getCodeError() == -40):
            $this->error = "Para definicao do preco deverao ser informados, tambem, o comprimento e a largura e altura do objeto em centimetros (cm).";
        elseif ($this->getCodeError() == -41):
            $this->error = "O comprimento nao pode ser maior que 60 cm.";
        elseif ($this->getCodeError() == -42):
            $this->error = "O comprimento nao pode ser inferior a 16 cm.";
        elseif ($this->getCodeError() == -43):
            $this->error = "A soma resultante do comprimento + largura nao deve superar a 120 cm.";
        elseif ($this->getCodeError() == -44):
            $this->error = "A largura nao pode ser inferior a 11 cm.";
        elseif ($this->getCodeError() == -45):
            $this->error = "A largura nao pode ser maior que 60 cm.";
        elseif ($this->getCodeError() == -888):
            $this->error = "Erro ao calcular a tarifa";
        elseif ($this->getCodeError() == 006):
            $this->error = "Localidade de origem não abrange o serviço informado";
        elseif ($this->getCodeError() == 007):
            $this->error = "Localidade de destino não abrange o serviço informado";
        elseif ($this->getCodeError() == 008):
            $this->error = "Serviço indisponível para o trecho informado";
        elseif ($this->getCodeError() == 009):
            $this->error = "CEP inicial pertencente a Área de Risco.";
        elseif ($this->getCodeError() == 010):
            $this->error = "Área com entrega temporariamente sujeita a prazo diferenciado.";
        elseif ($this->getCodeError() == 011):
            $this->error = "CEP inicial e final pertencentes a Área de Risco";
        elseif ($this->getCodeError() == 7):
            $this->error = "Serviço indisponível, tente mais tarde";
        elseif ($this->getCodeError() == 2016):
            $this->error = "Desculpe, o prazo não foi retornado corretamente.";
        endif;
    }

}
