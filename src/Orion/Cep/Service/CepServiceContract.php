<?php

namespace Orion\Cep\Service;

use Orion\Definition\Address;
use Orion\Exceptions\InvalidCepException;

/**
 * Interface CepServiceContract
 *
 * Interface de definição do serviço
 * de busca cep
 *
 * @package Orion\Core\Business\Services
 * @author Rodrigo Cachoeira
 * @version 1.0
 */
interface CepServiceContract
{

    /**
     * Retorna uma instância única de uma classe.
     *
     * @staticvar Singleton $instance A instância única dessa classe.
     *
     * @return Singleton A Instância única.
     */
    public static function getInstance();

    /**
     * @param string $cep
     * @return CepServiceContract
     * @throws InvalidCepException
     */
    public function search (string $cep);

    /**
     * Verifica se o cpf requisito existe
     * no web service
     *
     * @return bool
     */
    public function isValid (): bool;

    /**
     * Realiza uma requisicao ao web service
     * em busca das informacoes com base no
     * cep informado
     *
     * @param string $cep
     * @return string
     */
    public function requestWebService (string $cep);

    /**
     * Cria um objeto no formato de endereco
     * para melhor gerenciamento do servico por
     * parte do solicitante
     *
     * @return Address
     */
    public function makeAddressObject(): Address;

    /**
     * Retorna as informacoes requisitadas
     * no formato de um objeto de endereco
     * definido pelo prɔprio servico
     *
     * @return Address
     */
    public function getAddress (): Address;

    /**
     * Retorna as informacoes requisitadas no
     * formato json
     *
     * @return object
     */
    public function getJson (): \stdClass;

}