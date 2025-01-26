<?php
$router->get('/', '\\App\\Controllers\\MedicationController', 'showApi');


$router->get('/medications/{user_id}', '\\App\\Controllers\\MedicationController', 'getByUserId');
$router->put('/medications/{medication_id}', '\\App\\Controllers\\MedicationController', 'updateByMedicationId');
$router->delete('/medications/{medication_id}', '\\App\\Controllers\\MedicationController', 'deleteByMedicationID');
$router->post('/medications', '\\App\\Controllers\\MedicationController', 'create');

