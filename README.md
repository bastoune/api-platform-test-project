# API Platform Base test-project

## Installation & Usage with Docker

### Step 0 - Prerequisites
- Docker installed
- Docker-Compose installed

### Step 1 - Env Vars
- modify .env variables as you like

### Step 2 - Init
- `docker-compose up -d`
- `docker-compose exec app php bin/console doctrine:schema:update --force`
- `docker-compose exec app php bin/console doctrine:fixtures:load --no-interaction`

### Step 3 - Reproduce
The goal is to show the name of the Organization thanks to the serialization group "User:read"


- Work in Rest:  `http://localhost:8000/api/users?page=1`
- Doesnt in graphql: `http://localhost:8000/docs/graphiql?query=query%20%7B%0A%20%20users%20%7B%0A%20%20%20%20edges%20%7B%0A%20%20%20%20%20%20node%20%7B%0A%20%20%20%20%20%20%20%20email%2C%0A%20%20%20%20%20%20%20%20organization%20%7B%0A%20%20%20%20%20%20%20%20%20%20id%0A%20%20%20%20%20%20%20%20%7D%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D`