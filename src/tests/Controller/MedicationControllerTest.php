<?php
namespace Tests\Controller;

use PHPUnit\Framework\TestCase;
use App\Controllers\MedicationController;
use App\Repositories\MedicationRepository;




class MedicationControllerTest extends TestCase
{
    private $controller;
    private $repositoryMock;

    public function setUp(): void
    {


        $this->repositoryMock = $this->createMock(MedicationRepository::class);
        
        $this->controller = new MedicationController();
    }

    public function testGetByUserIdReturns200IfMedicationsFound()
    {
        $medications = [
            ['id' => 1, 'name' => 'Aspirin', 'dosage' => 100],
        ];

        $this->repositoryMock
            ->method('get')
            ->willReturn($medications);

        $this->controller->getByUserId(1);

        $this->assertEquals(200, http_response_code());
    }

    public function testCreateReturns201WhenCreatedSuccessfully()
    {
        $data = [
            'name' => 'Paracetamol',
            'started_at' => '2025-01-01 10:00:00',
            'dosage' => 500,
        ];

        $this->repositoryMock
            ->method('create')
            ->willReturn(true);

        $this->controller->create( $data);

        $this->assertEquals(201, http_response_code());
    }

}
