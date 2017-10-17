<?php

namespace Orion\Cep\Service;

use Orion\Definition\Address;
use Orion\Exceptions\InvalidCepException;
use GuzzleHttp\Client as Http;

/**
 * Class CepService
 *
 * Classe responsável por realizar consultas
 * de CEP com base nas informações passadas
 *
 * @package Orion\Core\Business\Services
 * @author Rodrigo Cachoeira
 * @version 1.0
 */
class CepService implements CepServiceContract
{

    /**
     * @var string
     */
    private $response;

    /**
     * @var
     */
    private $request;

    /**
     * Endereco do web-service
     *
     * @var string
     */
    const webService = 'https://viacep.com.br/ws/{cep}/json/';

    /**
     * @var string
     */
    private $key = '{cep}';

    /**
     * CepService constructor.
     */
    public function __construct()
    {
        $this->request = new Http();
    }

    /**
     * Retorna uma instância única de uma classe.
     *
     * @staticvar Singleton $instance A instância única dessa classe.
     *
     * @return Singleton A Instância única.
     */
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param string $cep
     * @return object
     * @throws InvalidCepException
     */
    public function search (string $cep)
    {
        $cepUnmasked = str_replace('-', '', $cep);
        if (preg_match('/^[0-9]{8}/', $cepUnmasked)) { // O CEP informado possui uma cadeia de 8 digitos
            $this->response = $this->requestWebService($cepUnmasked);

            return $this;
        }
        throw new InvalidCepException();
    }

    /**
     * Verifica se o cpf requisito existe
     * no web service
     *
     * @return bool
     */
    public function isValid (): bool
    {
        if (isset($this->getJson()->erro)) {
            if ($this->getJson()->erro)
                return false;
        }
        return true;
    }

    /**
     * Realiza uma requisicao ao web service
     * em busca das informacoes com base no
     * cep informado
     *
     * @param string $cep
     * @return string
     */
    public function requestWebService (string $cep)
    {
        try {
            $response = $this->request->get(str_replace($this->key, $cep, self::webService));
            if ($response->getStatusCode() === 200) { //success request
                return $response->getBody();
            }
            return null;
        } catch (\Exception $exception) {
            //dispatch error log
            return false;
        }

    }

    /**
     * Cria um objeto no formato de endereco
     * para melhor gerenciamento do servico por
     * parte do solicitante
     *
     * @return Address
     */
    public function makeAddressObject(): Address
    {
        $address = new Address();
        $response = $this->getJson();

        $address->setCep($response->cep);
        $address->setAddress($response->logradouro);
        $address->setComplement($response->complemento);
        $address->setNeighborhood($response->bairro);
        $address->setLocal($response->localidade);
        $address->setState($response->uf);
        $address->setUnity($response->unidade);
        $address->setIbge($response->ibge);
        $address->setGia($response->gia);

        return $address;
    }

    /**
     * Retorna as informacoes requisitadas
     * no formato de um objeto de endereco
     * definido pelo prɔprio servico
     *
     * @return Address
     */
    public function getAddress (): Address
    {
        return $this->makeAddressObject();
    }

    /**
     * Retorna as informacoes requisitadas no
     * formato json
     *
     * @return string
     */
    public function getJson (): \stdClass
    {
        return \GuzzleHttp\json_decode($this->response);
    }

}