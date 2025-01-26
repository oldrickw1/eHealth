<?php 

namespace App\Controllers;

use App\Repositories\MedicationRepository;
use App\Core\App;
use Symfony\Component\Yaml\Yaml;

class MedicationController
{
    private $medicationRepository; 

    public function __construct()
    {
        $this->medicationRepository = App::resolve(MedicationRepository::class);

    }

    public function getByUserId($user_id)
    {   

        $medications = $this->medicationRepository->get($user_id);
        if (!empty($medications)) {
            send_json_response($medications, 200);
        } else {
            send_json_response(["status" => "error", "message" => "Failed to retrieve medication(s)"], 404);
        }

    }

    public function create($data = null)
    {
        // This is done for easier testing.
        if (!$data) {
            $data = json_decode(file_get_contents('php://input'), true);
        }
        
        if ($this->medicationRepository->create($data)) {
            send_json_response(["status" => "success"], 201);
        } else {
            send_json_response(["status" => "error", "message" => "Failed to create medication"], 400);
        }
    }

    public function updateByMedicationById($medication_id, $data = null)
    {
        // This is done for easier testing.
        if (!$data) {
            $data = json_decode(file_get_contents('php://input'), true);
        }
        
        if ($this->medicationRepository->update($medication_id, $data)) {
            send_json_response(["status" => "success", "message" => "Medication updated successfully"], 200);
        } else {
            send_json_response(["status" => "error", "message" => "Failed to update medication"], 400);
        }    
    }


    public function deleteByMedicationId($medication_id)
    {

        if ($this->medicationRepository->delete($medication_id)) {
            send_json_response(["status" => "success", "message" => "Medication deleted successfully"], 200);
        } else {
            send_json_response(["status" => "error", "message" => "Failed to delete medication"], 400);
        }
    }

    public function showApi() 
    {
        // TODO: Properly display api
        // $openApiPath = base_path('../openapi.yaml');
        // if (file_exists($openApiPath)) {
        //     try {
        //         $openApiContent = Yaml::parseFile($openApiPath);
        //         send_json_response($openApiContent, 200);
        //     } catch (\Exception $e) {
        //         send_json_response(["status" => "error", "message" => "Failed to parse OpenAPI spec: " . $e->getMessage()], 500);
        //     }
        // } else {
        //     send_json_response(["status" => "error", "message" => "OpenAPI spec not found"], 404);
        // }

        

    }
}
