# RESTful API for Customer and Address
<h3>This repository is a simple API that can you learn for practice</h3> 
<h3>Goals: to create customer that can have more than one address</h3> 

how to run this repository locally:
1. clone repository  
2. vendor install `composer install`
3. generate key `php artisan key:generate`
4. migrate database `php artisan migrate`
5. `php artisan serve`

hyperlink:  
+ Customer API:  
    - [get all customer](#1-get-all-customer)
    - [find customer by id](#2-find-customer-by-id)
    - [create customer](#3-create-customer)
    - [update customer](#4-update-customer)
    - [delete customer](#5-delete-customer)

+ Address API:  
    - [create address](#1-create-address)
    - [update address](#2-update-address)
    - [delete address](#3-delete-address)

## Customer API

### 1. get all customer
**endpoint**    : `/api/customer`  
**method**      : **<code style="color:#10B981">GET</code>**  
**description** : return a list of customer in JSON format with sorted by rating and alphabetically  
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : [
        {
            "id"            : 1,
            "title          : "Mr",
            "name"          : "Budi Wiranto"m
            "gender"        : "M",
            "phone_number"  : "08123456789",
            "image"         : "asset/image/202506122343.jpg",
            "email"         : "budi.wiranto@gmail.com",
            "created_at"    : "2025-06-12T16:44:46.000000Z",
            "updated_at"    : "2025-06-12T17:14:00.000000Z",
            "addresses"     : [
                {
                    "id"            : 1,
                    "customer_id"   : 1,
                    "address"       : "jln.in aja dulu",
                    "district"      : "ketingtang",
                    "city"          : "surabaya",
                    "province"      : "jawa timur",
                    "postal_code"   : 1508,
                    "created_at"    : "2025-06-13T16:27:27.000000Z",
                    "updated_at"    : "2025-06-13T16:27:27.000000Z"
                },
                {
                    "id"            : 2,
                    "customer_id"   : 1,
                    "address"       : "jln. kemana enaknya",
                    "district"      : "pucang",
                    "city"          : "surabaya",
                    "province"      : "jawa timur",
                    "postal_code"   : 1508,
                    "created_at"    : "2025-06-13T16:27:27.000000Z",
                    "updated_at"    : "2025-06-13T16:27:27.000000Z"
                }
            ]
        },
        {
            "id"            : 3,
            "title"         : "Ms",
            "name"          : "annisa wahyu",
            "gender"        : "F",
            "phone_number"  : "0898764321",
            "image"         : "asset/image/202506131954.jpg",
            "email"         : "anwah@gmail.com",
            "created_at"    : "2025-06-13T12:54:49.000000Z",
            "updated_at"    : "2025-06-13T12:54:49.000000Z",
            "address": [
                {
                    "id"            : 3,
                    "customer_id"   : 3,
                    "address"       : "jln. ke hati mu",
                    "district"      : "Bintaro",
                    "city"          : "Jakarta Barat",
                    "province"      : "DKJ",
                    "postal_code"   : 1512,
                    "created_at"    : "2025-06-13T16:31:48.000000Z",
                    "updated_at"    : "2025-06-13T16:31:48.000000Z"
                }
            ]
        }
    ]
}
```

### 2. find customer by id
**endpoint**    : `/api/customer/:id`  
**method**      : **<code style="color:#10B981">GET</code>**  
**description** : return detail of customer and address in JSON format.
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : {
        "id"            : 1,
        "title          : "Mr",
        "name"          : "Budi Wiranto"m
        "gender"        : "M",
        "phone_number"  : "08123456789",
        "image"         : "asset/image/202506122343.jpg",
        "email"         : "budi.wiranto@gmail.com",
        "created_at"    : "2025-06-12T16:44:46.000000Z",
        "updated_at"    : "2025-06-12T17:14:00.000000Z",
        "addresses"     : [
            {
                "id"            : 1,
                "customer_id"   : 2,
                "address"       : "jln.in aja dulu",
                "district"      : "ketingtang",
                "city"          : "surabaya",
                "province"      : "jawa timur",
                "postal_code"   : 1508,
                "created_at"    : "2025-06-13T16:27:27.000000Z",
                "updated_at"    : "2025-06-13T16:27:27.000000Z"
            }
        ]
    }
}
```

### 3. create customer
**endpoint**    : `/api/customer`  
**method**      : **<code style="color:#EAB308">POST</code>**  
**description** : Add a customer to customer table and sent data as JSON format  
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : {
        "title          : "Mr",
        "name"          : "Budi Wiranto"m
        "gender"        : "M",
        "phone_number"  : "08123456789",
        "image"         : "asset/image/202506122343.jpg",
        "email"         : "budi.wiranto@gmail.com",
    }
}
```

### 4. update customer
**endpoint**    : `/api/customer/:id`  
**method**      : **<code style="color:#8B5CF6">PATCH</code>**  
**description** : Update a customer on customer table and sent data as JSON format
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : {
        "title          : "Mr",
        "name"          : "Budi Wiranto"m
        "gender"        : "M",
        "phone_number"  : "08123456789",
        "image"         : "asset/image/202506122343.jpg",
        "email"         : "budi.wiranto@gmail.com",
    }
}
```

### 5. delete customer
**endpoint**    : `/api/customer/:id`  
**method**      : **<code style="color:#F43F5E">DELETE</code>**  
**description** : delete a customer and address from database  
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok"
}
```

## Address API

### 1. create address
**endpoint**    : `/api/address`  
**method**      : **<code style="color:#EAB308">POST</code>**  
**description** : Add a address to address table and sent data as JSON format  
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : {
        "address"       : "jln. ke hati mu",
        "district"      : "Bintaro",
        "city"          : "Jakarta Barat",
        "province"      : "DKJ",
        "postal_code"   : 1512
    }
}
```

### 2. update address
**endpoint**    : `/api/address/:id`  
**method**      : **<code style="color:#8B5CF6">PATCH</code>**  
**description** : Update a address on address table and sent data as JSON format
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok",
    "data"      : {
        "title          : "Mr",
        "name"          : "Budi Wiranto"m
        "gender"        : "M",
        "phone_number"  : "08123456789",
        "image"         : "asset/image/202506122343.jpg",
        "email"         : "budi.wiranto@gmail.com",
    }
}
```

### 3. delete address
**endpoint**    : `/api/address/:id`  
**method**      : **<code style="color:#F43F5E">DELETE</code>**  
**description** : delete a address and address from database  
**example**     :
```
{
    "code"      : 200,
    "message"   : "Ok"
}
```