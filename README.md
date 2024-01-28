
## API for creating customers, their cars, their addresses, creating services and employees. Creation of customer vehicle maintenance with Codeigniter 4. The API provides registration and authentication.


## Features

 - Register
 - Login
 - CRUD Customers
 - CRUD Cars customers
 - CRUD Address customers
 - CRUD Employees
 - CRUD Services
 - CRUD Maintenance cars
 - CRUD Services Maintenance cars association
 
## Server Requirements
- Developed PHP 8.2.7 and Codeigniter 4.4.4
- The following extensions need to be enabled:

1. intl
2. mbstring
3. json

## Installation

1 - Install the project using composer (requires [Composer](https://getcomposer.org/)):

```sh
composer create-project luciocodeigniter/api-ci4-car-workshop
```


2 - Rename the ``` .env-exemple.txt ``` file to ``` .env ``` which can be found in the project root

3 - Place the information in the ``` .env ``` file as per the following example:

```sh
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = 'https://exemplo.com/'
app.indexPage = ''


#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------

database.default.hostname = localhost
database.default.database = db-name
database.default.username = db-user
database.default.password = db-password
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306


#--------------------------------------------------------------------
# JWT Authenticator
#--------------------------------------------------------------------
authjwt.keys.default.0.secret = oGPvp9lLkgTvcqlVIU3rJE46uJmedapcW3EJ6cr/9gw=
```

## Creating and populating tables in the database.

1 - At the root of the project, open the terminal and run the following command:
```sh
php spark api:init
```

2 . If you want to reset the database to its original state, simply run the following command in the root of the project:
```sh
php spark api:reset
```

3 - If you want to change the number of records to be created with seeders, simply change the ``` TOTAL_STEPS ``` constant within each file, which can be found in ``` app\Database\Seeds ```:
```sh

//...

/**
* How many records do you want to create
*/
private const TOTAL_STEPS = 100; //<---- Change here

//..
```

## Registering on the application

1 . Send a ``` POST ``` request to ``` https://exemplo.com/api/register ```

If the request was validated, you should see the access_token in the response:
```sh
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI8SXNzdWVyIG9mIHRoZSBKV1Q-Iiwic3ViIjoiMSIsImlhdCI6MTcwNjMxMDI5NSwiZXhwIjoxNzA2MzEzODk1fQ.G8SaDs_vaMqFnzELllLbfErKSUvYiofNoGzhMYQkqUg"
}
```

When making all future requests to the API, the client should send the JWT in the Authorization header as a Bearer token.

## Authenticating in the application

1 . Send a ``` POST ``` request to ``` https://exemplo.com/api/login ```

If the request was validated, you should see the access_token in the response:
```sh
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiI8SXNzdWVyIG9mIHRoZSBKV1Q-Iiwic3ViIjoiMSIsImlhdCI6MTcwNjMxMDI5NSwiZXhwIjoxNzA2MzEzODk1fQ.G8SaDs_vaMqFnzELllLbfErKSUvYiofNoGzhMYQkqUg"
}
```

When making all future requests to the API, the client should send the JWT in the Authorization header as a Bearer token.

## - Customers endpoints

### List all
```sh
GET https://exemplo.com/api/customers
```

### Get single
```sh
GET https://exemplo.com/api/customers/1
```

### Create
```sh
POST https://exemplo.com/api/customers
```

### Update
```sh
PUT or PATCH https://exemplo.com/api/customers/1
```

### Delete
```sh
DELETE https://exemplo.com/api/customers/1
```

## - Paginating records. All endpoints that list records return 20 per page. You can change this by sending the request as follows:
```sh
api/endpoint?page=1&perPage=50
```

## - Others endpoints
```sh
https://exemplo.com/api/cars
https://exemplo.com/api/employees
https://exemplo.com/api/services
https://exemplo.com/api/maintenance
https://exemplo.com/api/maintenance-services
```
