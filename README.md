# LWS
## LWS - code challenge (03/2024)

### Author

Cláudio Varandas

Software Engineer @ Velv

### Code Repository

The souce code repository is available here :
https://github.com/ClaudioVarandas/lws-poc

### How to setup 

Requirements:

- Docker
- Docker composer
- Git


```bash



```

#### Services

Service  | Container Name   | Host:Port
-------------------|------------------|-------------------------------------
 API               | lws-nginx        | `localhost:8181`
 Nginx             | lws-api          | `9000` 
 SwaggerUI         | lws-swagger-ui-1 | `localhost:8188`

Api base url : `http://localhost:8181/api/v1`



### API Documentation

The api documentation follows openapi standard, and is exposed in a friendly ui (Swagger UI), 
which is available in this url :

- `http://localhost:8188`
