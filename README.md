# Workforce API - PHP Implementation

Change this section to use the previously provided credentials:
```php
$apiKey = "api_SECRET";
$sessionToken = "SESSION_TOKEN_SECRET";
$username = "USERNAME_SECRET";
$password = "PASSWORD_SECRET";
```


### Overview
This project involves several tasks focused on API interaction using PHP. The tasks include obtaining an access token, retrieving workforce data, filtering that data, and processing it to meet specific criteria. The results are displayed in an HTML table format.
## Task Summaries
### Task 1: Obtain Access Token
- Create a function to obtain an access token from the API.
- Endpoint: `http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja`
- Method: POST
- Body: {username: ```CREDENTIAL```, password: ```CREDENTIAL```}
  
Successfully implemented a function to request an access token from the provided API endpoint. The access token is necessary for authenticating further API requests.
### Task 2: API Usage and Displaying Data
- Fetch workforce data from the API and display it in an HTML table.
- Endpoint: `http://34.101.235.69/ekatalog/apiv1/datatable/tenagakerja`
- Method: `GET`
- Headers:
    - `X-DreamFactory-Api-Key: (Password from Task 1)`
    - `X-DreamFactory-Session-Token: (session token)`
- Parameter: offset: 0
  
Developed a PHP script that retrieves workforce data from the API and presents it in a structured HTML table. The data includes information such as province, city/district, workforce type, unit, and pricing details.
### Task 3: Filtering Data from API
- Fetch workforce data filtered by the province of Aceh and the city/district of Banda Aceh with IDs 11 and 1171.
- Display the results in an HTML table.
  
The script filters workforce data to display only records related to the province of Aceh and the city of Banda Aceh. This task was successfully executed by applying specific search parameters in the API request.
### Task 4: Programming Algorithm
- Implement an algorithm to group workforce data by harga_oh from the highest to the lowest.

An algorithm was created to group workforce data by the `harga_oh` (OH price) field and sort each group from highest to lowest price. This provides a clear, organized view of the most expensive workforce data first.
## Conclusion
The project successfully demonstrates how to interact with an API in PHP, perform data filtering, and process the data to meet specific requirements. The implementation showcases skills in API integration, data handling, and algorithm development within a PHP environment.
# aisfarhan415-Tenaga-Kerja-API
