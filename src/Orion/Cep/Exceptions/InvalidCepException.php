<?php

namespace Orion\Cep\Exceptions;

use Exception;

/**
 * Class InvalidCepException
 *
 * Exceção de quando um CEP inválido é passado
 * para o serviço de busca de informações da
 * aplicação
 *
 * @package Orion\Core\Exceptions
 * @author Rodrigo Cachoeira
 * @version 1.0
 */
class InvalidCepException extends Exception
{

    /**
     * @var int
     */
    protected $code = 101;

    /**
     * @var string
     */
    protected $message = 'An invalid CEP was reported';
}
