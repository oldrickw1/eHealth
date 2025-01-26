# Backend Developer Coding Challenge: eHealth Platform

## Usage
Run `docker compose up --build` from the project root. The `.env` file is used to pass the DB data. This file is also used in the PHP backend to connect with the MySQL DB in the container. 

Upon creation of the MySQL container, the file `db/init.sql` should run to initialize and seed some records in the DB (but a data volume is declared, so it will persist under `db/mysql_data` after changes).

You can connect to the app on `localhost:8081` using the following paths:

- `POST /medications`
- `GET /medications/{user_id}`
- `PUT /medications/{medication_id}`
- `DELETE /medications/{medication_id}`

See `requests.txt` for some examples. 

## TODO
- **Testing**: A setup is made, but there aren't any tests.
- **Data Validation**: Implement `Core/Validation` class, and use its static methods in the `MedicationController`.
- **Status Codes**: Check if appropriate status codes are used in the `MedicationController`.
- **File Upload Functionality**: Implement file upload functionality.
- **OpenAPI Specification**: Specify the API with OpenAPI and display on `GET` request to `/`.

