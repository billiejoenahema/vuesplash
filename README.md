# Vuesplash

## front

- Vue 3.2
- Vue-router
- Vuex

## backend

- Laravel 8

---

```bash
docker-compose up -d --build
docker-compose exec web composer create-project --prefer-dist laravel/laravel .
docker-compose exec web npm install
docker-compose exec web npm run watch
```

http://localhost:8081

```bash
cp .env.example .env
```

```bash
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=secret
```
