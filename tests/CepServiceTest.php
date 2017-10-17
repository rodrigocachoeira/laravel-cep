<?php

namespace Tests;

use Orion\Cep\Service\CepService;
use Illuminate\Foundation\Testing\TestCase;

/**
 * Class CepServiceTest
 *
 * Classe de testes do serviço de consulta
 * de CEP
 *
 * @package Tests
 * @author Rodrigo Cachoeira
 * @version 1.0
 */
class CepServiceTest extends TestCase
{

    use CreatesApplication;

    protected $validCep, $invalidCep, $validCepWithMask, $faker;

    /**
     * CepServiceTest constructor.
     *
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->faker = \Faker\Factory::create();
        $this->validCep = '01001000';
        $this->invalidCep = '00000000';
        $this->validCepWithMask = '01001-000';
    }
    
    /**
    * @test
    */
    public function the_service_must_have_the_sarch_method()
    {
        $this->assertTrue(method_exists(CepService::class, 'search'));
    }

    /**
    * @test
    * @expectedException \Orion\Core\Business\Services\Cep\Exceptions\InvalidCepException
    */
    public function when_fetching_an_invalid_cep_an_exception_must_be_returned()
    {
        (new CepService())->search($this->faker->word);
    }
    
    /**
    * @test
    */
    public function a_successful_request_should_return_a_self_instance ()
    {
        $this->assertInstanceOf(get_class((new CepService())->search($this->validCep)), new CepService());
    }

    /**
     * @test
     */
    public function the_method_get_json_should_return_a_cep_attribute()
    {
        $this->assertObjectHasAttribute('cep', (new CepService())->search($this->validCep)->getJson());
    }

    /**
     * @test
     */
    public function the_method_get_address_should_be_return_a_cep_and_neighborhood_attribute ()
    {
        $address = (new CepService())->search($this->validCep)->getAddress();

        $this->assertObjectHasAttribute('cep', $address);
        $this->assertObjectHasAttribute('neighborhood', $address);
    }

    /**
    * @test
    */
    public function the_method_get_address_sync_all_attributes_of_web_service()
    {
        $jsonResponse = (new CepService())->search($this->validCep)->getJson();
        $addressResponse = (new CepService())->search($this->validCep)->getAddress();

        $this->assertEquals($jsonResponse->cep, $addressResponse->getCep());
        $this->assertEquals($jsonResponse->logradouro, $addressResponse->getAddress());
        $this->assertEquals($jsonResponse->complemento, $addressResponse->getComplement());
        $this->assertEquals($jsonResponse->bairro, $addressResponse->getNeighborhood());
        $this->assertEquals($jsonResponse->localidade, $addressResponse->getLocal());
        $this->assertEquals($jsonResponse->uf, $addressResponse->getState());
        $this->assertEquals($jsonResponse->unidade, $addressResponse->getUnity());
        $this->assertEquals($jsonResponse->ibge, $addressResponse->getIbge());
        $this->assertEquals($jsonResponse->gia, $addressResponse->getGia());
    }

    /**
     * @test
     */
    public function when_passing_a_valid_cep_but_not_existent_to_the_service()
    {
        $response = (new CepService())->search($this->invalidCep);
        $this->assertNotTrue($response->isValid());
    }

    /**
     * @test
     */
    public function when_passing_a_valid_cep_and_existent_to_the_service()
    {
        $response = (new CepService())->search($this->validCep);
        $this->assertTrue($response->isValid());
    }

    /**
     * @test
     */
    public function should_be_accepted_cep_with_mask()
    {
        $response = (new CepService())->search($this->validCepWithMask);
        $this->assertTrue($response->isValid());
    }

}