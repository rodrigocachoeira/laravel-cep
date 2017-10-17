<?php

namespace Orion\Cep\Definition;

/**
 * Class Address
 *
 * Classe de definicao da entidade que eh
 * retornada ao realizar uma consulta com o
 * servico de busca de cep´s
 *
 * @package Orion\Core\Business\Services\Cep
 * @author Rodrigo Cachoeira
 * @version 1.0
 */
class Address
{

    /**
     * @var string
     */
    private $cep, $address, $complement, $neighborhood, $local, $state, $unity, $ibge, $gia;

    /**
     * Address constructor.
     */
    public function __construct()
    {}

    /**
     * @return string
     */
    public function getCep(): string
    {
        return $this->cep;
    }

    /**
     * Retorna o cep sem máscara
     *
     * @return string
     */
    public function getUnmaskedCep(): string
    {
        return str_replace('-', '', $this->cep);
    }

    /**
     * @param string $cep
     */
    public function setCep(string $cep)
    {
        $this->cep = $cep;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     */
    public function setComplement(string $complement)
    {
        $this->complement = $complement;
    }

    /**
     * @return string
     */
    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }

    /**
     * @param string $neighborhood
     */
    public function setNeighborhood(string $neighborhood)
    {
        $this->neighborhood = $neighborhood;
    }

    /**
     * @return string
     */
    public function getLocal(): string
    {
        return $this->local;
    }

    /**
     * @param string $local
     */
    public function setLocal(string $local)
    {
        $this->local = $local;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getUnity(): string
    {
        return $this->unity;
    }

    /**
     * @param string $unity
     */
    public function setUnity(string $unity)
    {
        $this->unity = $unity;
    }

    /**
     * @return string
     */
    public function getIbge(): string
    {
        return $this->ibge;
    }

    /**
     * @param string $ibge
     */
    public function setIbge(string $ibge)
    {
        $this->ibge = $ibge;
    }

    /**
     * @return string
     */
    public function getGia(): string
    {
        return $this->gia;
    }

    /**
     * @param string $gia
     */
    public function setGia(string $gia)
    {
        $this->gia = $gia;
    }

}