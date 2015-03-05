# api.data.gov Admin API

Simple PHP SDK to connect to the api.data.gov API Umbrella.

## Prerequisites
- [Composer](https://getcomposer.org/)

## Installation
- Clone repo
- Run `composer install`

## Examples
Create Client
```php
$client = new ApiDataGovClient('apiKey','adminAuthToken');
```
### Get Users
```php
$response = $client->getUsers();
```
#### Response
```json
{
    "draw": 0,
    "recordsTotal": 5323,
    "recordsFiltered": 5323,
    "data": [
        {
            "created_at": "2013-05-02T18:53:42Z",
            "created_by": null,
            "deleted_at": null,
            "disabled_at": null,
            "email": "emailAddress1@example.gov",
            "first_name": "John",
            "last_name": "Doe",
            "registration_source": "web",
            "roles": null,
            "throttle_by_ip": null,
            "updated_at": "2014-01-20T12:59:02Z",
            "updated_by": null,
            "use_description": "",
            "version": 3,
            "website": null,
            "api_key_preview": "string...",
            "id": "long-hash-String"
        },
        {
            "created_at": "2012-06-28T02:54:37Z",
            "created_by": null,
            "deleted_at": null,
            "disabled_at": null,
            "email": "emailAddress@example.gov",
            "first_name": "Jane",
            "last_name": "Doe",
            "registration_source": "web",
            "roles": null,
            "throttle_by_ip": null,
            "updated_at": "2014-01-20T12:59:02Z",
            "updated_by": null,
            "use_description": "",
            "version": 3,
            "website": "http://gsa.gov",
            "api_key_preview": "string...",
            "id": "long-hash-String"
        },
        ....
    ]
 }
 ```
 
### Get User
```php
$users = $client->getUser('unique-user-id');
```
#### Response
```json
{
    "user": {
        "id": "unique-user-id",
        "api_key_preview": "string...",
        "first_name": "John",
        "last_name": "Doe",
        "email": "example.email@example.com",
        "website": null,
        "use_description": "here is a description",
        "registration_source": "web_admin",
        "throttle_by_ip": false,
        "roles": [
            "api_write"
        ],
        "enabled": true,
        "created_at": "2015-02-19T16:08:21Z",
        "updated_at": "2015-02-19T16:08:21Z",
        "settings": {
            "id": "hash-string",
            "rate_limit_mode": null,
            "allowed_ips": null,
            "allowed_referers": null,
            "rate_limits": []
        },
        "creator": {
            "username": "creator@example.gov"
        },
        "updater": {
            "username": "creator@example.gov"
        }
    }
}
```

## More Information
- [API Umbrella Admin API Docs](http://nrel.github.io/api-umbrella/docs/admin-api/)
- [NREL API Umbrella Repo](https://github.com/NREL/api-umbrella)


## More Information
- [API Umbrella Admin API Docs](http://nrel.github.io/api-umbrella/docs/admin-api/)
- [NREL API Umbrella Repo](https://github.com/NREL/api-umbrella)
