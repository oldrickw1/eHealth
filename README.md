# Backend Developer Coding Challenge: eHealth platform

## Usage: 
Run `docker compose up --build` from the project root. The .env file is used to pass the db data. This file is also used in the PHP backend to connect with the mysql db in the contain. 
On creation of mysql container, the file db/init.sql should run to initialize and seed some records in the db. 
You can connect to the app on localhost:8081



## TODO:
- Testing. Made a set up but there aren't any test. 
- Need to validate data. Implement Core/Validation class, and use its static methods in the MedicationController.
- Check if used appropriate status codes in MedicationController.
- Implement file upload functionality. 
- Specify API with OpenAPI and display on GET request to /. 

