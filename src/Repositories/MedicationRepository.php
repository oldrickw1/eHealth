<?php
namespace App\Repositories;

use App\Core\App;
use App\Core\Database;
use PDOException;

class MedicationRepository
{
    private $db;
    
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
        
    }
    
    public function create($data)
    {
        try {
            $image = $this->handleImage($data["image"]);
           
    
            $this->db->query("INSERT INTO medications (user_id, name, started_at, dosage, note, image) 
                VALUES (:user_id, :name, :started_at, :dosage, :note, :image);", 
                [
                    "user_id" => $data["user_id"], 
                    "name" => $data["name"],
                    "started_at" => $data["started_at"],
                    "dosage" => $data["dosage"],
                    "note" => $data["note"],
                    "image" => $image
                ]);
            return true;
        } catch (PDOException $e) {
            $this->handle($e);
            return false;
        }
    }
    
   
    public function get($user_id)
    {
        try {
            $medications = $this->db->query("SELECT * FROM medications WHERE user_id = :user_id;", 
            [
                "user_id" => $user_id
            ])->get();         
               
            return $medications;
        } catch (PDOException $e) {
            $this->handle($e);
            return false;
        }
       
    }

    
    public function update($medication_id, $data)
    {
        try {
            $image = $this->handleImage($data["image"]);
    
            $this->db->query("UPDATE medications 
                              SET user_id = :user_id, name = :name, started_at = :started_at, dosage = :dosage, note = :note, image = :image
                              WHERE id = :id", 
                [
                    "id" => $medication_id, 
                    "user_id" => $data["user_id"], 
                    "name" => $data["name"],
                    "started_at" => $data["started_at"],
                    "dosage" => $data["dosage"],
                    "note" => $data["note"],
                    "image" => $image 
                ]);
    
            return true; 
        } catch (PDOException $e) {
            $this->handle($e);

            return false; 
        }
    }
    
    
    public function delete($medicationId)
    {
        try {
            $this->db->query("DELETE FROM medications WHERE id = :id", 
            [
                "id" => $medicationId
            ]);         
               
            return true;
        } catch (PDOException $e) {
            $this->handle($e);
            return false;
        }
    }

    private function handle($e) {
        var_dump($e);
        // todo: log and handle
    }

    private function handleImage($image) {
        // This functionality should not be in here, but in the Core/Validator class. 
        if (isset($image) && !empty($image)) {
            $image = null; // Leave out image functionality for now. TODO
        }
        return $image; 
    }
}











