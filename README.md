# api.data.gov Admin API

Simple PHP SDK to connect to the api.data.gov API Umbrella.

## Prerequisites
- [Composer](https://getcomposer.org/)

## Installation
- Clone repo
- Run `composer install`

## Example Request
`$client = new ApiDataGovClient('apiKey','adminAuthToken');
$response = $client->getUsers();`

## More Information
- [API Umbrella Admin API Docs](http://nrel.github.io/api-umbrella/docs/admin-api/)
- [NREL API Umbrella Repo](https://github.com/NREL/api-umbrella)
