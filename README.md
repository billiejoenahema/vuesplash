# Vuesplash

## front
- Vue 3
- Vue-router
- Vuex

## backend
- Laravel 8

---
```
$ docker-compose up -d --build
$ docker-compose exec web bash
# composer create-project --prefer-dist laravel/laravel .
# php artisan serve --host 0.0.0.0 --port 8081
# npm install
# npm run watch
```

http://localhost:8081

```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=secret
```

```
# composer require laravel/ui
# php artisan ui vue --auth
```

remove

```package.json
"vue": "^2.*",
"vue-template-compiler": "^2.*"
```

```
# npm install -save-dev vue@next
```
