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

### Step 3
- No Error: "http://localhost:8000/docs/graphiql?query=query%20%7B%0A%20%20users%20(first%3A%201)%20%7B%0A%20%20%20%20edges%20%7B%0A%20%20%20%20%20%20node%20%7B%0A%20%20%20%20%20%20%20%20username%2C%0A%20%20%20%20%20%20%20%20sampleNullableDate%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D"
- Error: "http://localhost:8000/docs/graphiql?query=query%20%7B%0A%20%20users%20(first%3A%202)%20%7B%0A%20%20%20%20edges%20%7B%0A%20%20%20%20%20%20node%20%7B%0A%20%20%20%20%20%20%20%20username%2C%0A%20%20%20%20%20%20%20%20sampleNullableDate%0A%20%20%20%20%20%20%7D%0A%20%20%20%20%7D%0A%20%20%7D%0A%7D"