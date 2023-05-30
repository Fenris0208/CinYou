# Install
run in die dir
``` bash
docker-compose -f ./docker/docker-compose.yml up
```

WebApp: Port 80

PHPMYADMIN: Port 8001

DB_USER = 'authentificator'

Create File to store passwords in:
 
    /docker/.env 
it has to look like this 
``` 
DB_PASSWORD='set_db_password'
TMDB_API_KEY='get_an_tmdb_api_key'
```
