# laravel-api
This project using 
```
Laravel 9
MongoDB 4
```

## Configuration
First step is clone this repository. Then, run command below
```
composer update
```
Generate key
```
php artisan key:generate
```
Setup mongodb environment
```
DB_CONNECTION=mongodb
DB_HOST=<your localhost>
DB_PORT=27017
DB_DATABASE=<your database name>
DB_USERNAME=<your mongodb username>
DB_PASSWORD=<your mongodb password>
```
Setup email smtp environment, example using gmail smtp
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=<your email address>
MAIL_PASSWORD=<your email password>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=<your email address>
```
]Migrate the migrations
```
php artisan migrate
or
php artisan migrate:fresh
```
And then, run the service
```
php artisan serve
```

Open new terminal and run command below to run task scheduling
```
php artisan schedule:work
```

## Services
| Name  | Method | Route |
| ------------- | ------------- | ------------- |
| Get Transaction List | GET | {{baseUrl}}/api/v1/transactions  |
| Create Transaction | POST | {{baseUrl}}/api/v1/transactions  |
| Get Transaction | GET | {{baseUrl}}/api/v1/transactions{{id}}  |
| Update Transaction | PUT | {{baseUrl}}/api/v1/transactions{{id}}  |
| Delete Transaction | DELETE | {{baseUrl}}/api/v1/transactions{{id}}  |
| Get Transaction Summary | GET | {{baseUrl}}/api/v1/transactions-summary  |

### Get Transaction List
**Request :**
```
GET /api/v1/transactions HTTP/1.1
Host: localhost:8000
```
**Response :**
``` 
HTTP STATUS 200
{
    "data": [
        {
            "_id": "6490732377108a1b93034952",
            "name": "topup",
            "email": "cntest@mailinator.com",
            "amount": 1000,
            "updated_at": "2023-06-19T15:24:19.669000Z",
            "created_at": "2023-06-19T15:24:19.669000Z"
        }
    ],
    "links": {
        "first": "http://localhost:8000/api/v1/transactions?page=1",
        "last": "http://localhost:8000/api/v1/transactions?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8000/api/v1/transactions?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8000/api/v1/transactions",
        "per_page": 10,
        "to": 1,
        "total": 1
    }
}
```

### Create Transaction
**Request :**
```
POST /api/v1/transactions HTTP/1.1
Host: localhost:8000
Accept: application/json
Content-Type: application/json
Content-Length: 85

{
    "name": "topup",
    "email": "cntest@mailinator.com",
    "amount": 1000
}
```
**Response :**
``` 
HTTP STATUS 200
{
    "data": {
        "name": "topup",
        "email": "cntest@mailinator.com",
        "amount": 1000,
        "updated_at": "2023-06-19T15:24:55.767000Z",
        "created_at": "2023-06-19T15:24:55.767000Z",
        "_id": "6490734777108a1b93034953"
    }
}
```

### Get Transaction
**Request :**
```
GET /api/v1/transactions/6490734777108a1b93034953 HTTP/1.1
Host: localhost:8000
Accept: application/json
```
**Response :**
``` 
HTTP STATUS 200
{
    "data": {
        "_id": "6490732377108a1b93034952",
        "name": "topup",
        "email": "cntest@mailinator.com",
        "amount": 1000,
        "updated_at": "2023-06-19T15:24:19.669000Z",
        "created_at": "2023-06-19T15:24:19.669000Z"
    }
}
```

### Update Transaction
**Request :**
```
PUT /api/v1/transactions/6490734777108a1b93034953 HTTP/1.1
Host: localhost:8000
Accept: application/json
Content-Type: application/json
Content-Length: 83

{
    "name": "topup",
    "email": "test@mailinator.com",
    "amount": 1000
}
```
**Response :**
``` 
HTTP STATUS 200
{
    "data": {
        "_id": "6490732377108a1b93034952",
        "name": "topup",
        "email": "test@mailinator.com",
        "amount": 1000,
        "updated_at": "2023-06-19T15:24:41.152000Z",
        "created_at": "2023-06-19T15:24:19.669000Z"
    }
}
```

### Delete Transaction
**Request :**
```
DELETE /api/v1/transactions/6490734777108a1b93034953 HTTP/1.1
Host: localhost:8000
Accept: application/json
```
**Response :**
``` 
HTTP STATUS 200
{
    "message": "Data has been deleted"
}
```
