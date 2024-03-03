# LWS
## LWS - code challenge (03/2024)

### Author

Cláudio Varandas

Software Engineer @ Velv

### Project 

This project was created to submit the code challenge for LW.

It consists in a api that provides servers information. It has a endpoint to provide the servers
list, and endpoints to provide the options for the filters, to filter the servers list.

Tech stack:

- Framework Laravel 10
- PHPUnit 10.5.11 

Repository:

The souce code repository is available here :
https://github.com/ClaudioVarandas/lws-poc

### How to setup 

Requirements:

- Docker / Docker desktop (WSL/MacOs)
- Docker composer
- Git

Instructions:

- Open the command line interface , then :

```bash

git clone https://github.com/ClaudioVarandas/lws-poc.git
cd lws-poc

cp ./servers-api/.env.example ./servers-api/.env

docker compose up -d

mkdir ./servers-api/storage/app/import
cp ./etc/import/servers_filters_assignment.csv ./servers-api/storage/app/import/

./comp.sh install
./artisan.sh servers:import

```

You should see this result of the `servers:import` command :
```bash
./artisan.sh servers:import

Done importing file.

+---------------+---------------+-----------------+
| original_rows | imported_rows | locations_count |
+---------------+---------------+-----------------+
| 486           | 486           | 7               |
+---------------+---------------+-----------------+
```

Api base url : `http://localhost:8181/api/v1`

#### Services available

Service            | Container Name   | Host:Port
-------------------|------------------|-----------------
 API               | lws-nginx        | `localhost:8181`
 Nginx             | lws-api          | `9000` 
 SwaggerUI         | lws-swagger-ui-1 | `localhost:8188`


Notes:

To access to the php container shell :
`docker exec -it --user www-data lws-api sh`

### API Documentation

The api documentation follows openapi standard, and is exposed in a friendly ui (Swagger UI), 
which is available in this url :

- `http://localhost:8188`

### Tests (PhpUnit)

To run the tests do `./artisan.sh test` in the project root folder.

You should see a result like this :

```bash
   PASS  Tests\Unit\ServerImportHandlerTest
  ✓ it should handle ram and return proper data array with data set "valid value"
  ✓ it should handle ram and return proper data array with data set "invalid value"

   PASS  Tests\Feature\ApiTest
  ✓ base url returns success                                                                                                                                     0.17s
  ✓ servers endpoint returns success                                                                                                                             0.03s

   PASS  Tests\Feature\ServersEndpointTest
  ✓ servers endpoint returns correct data structure                                                                                                              0.02s
  ✓ servers endpoint should return exact records with data set "all possible filters"                                                                            0.01s
  ✓ servers endpoint should return exact records with data set "filter by location hdd ram"                                                                      0.01s
  ✓ servers endpoint should return exact records with data set "filter by location hdd"                                                                          0.01s
  ✓ servers endpoint should return exact records with data set "filter by location"                                                                              0.01s
  ✓ servers endpoint should return 422 when validation fails for storage                                                                                         0.01s
  ✓ servers endpoint should return 422 when validation fails for location                                                                                        0.01s
  ✓ servers endpoint should return 422 when validation fails for hdd type                                                                                        0.01s
  ✓ servers endpoint should return 422 when validation fails for ram                                                                                             0.01s

   PASS  Tests\Feature\ServersImportCommandTest
  ✓ it should import data into db files                                                                                                                          0.08s

  Tests:    14 passed (72 assertions)
  Duration: 0.48s

```

Or you can run Phpunit directly, just run this in the project root :
```bash
docker exec -it --user www-data lws-api sh
./vendor/bin/phpunit
```

and you should see a result like this one:
```
PHPUnit 10.5.11 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.15
Configuration: /application/phpunit.xml

..............                                                    14 / 14 (100%)

Time: 00:00.412, Memory: 34.00 MB

OK (14 tests, 72 assertions)
```