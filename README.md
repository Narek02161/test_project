# Test

## Запуск с нуля с подготовленной базой
```bash
make init
```

- Запускается вместе с базой данных (PgsqlDB), Swagger и Redis
- Достпуна документация по адресу [http://localhost:8081](http://localhost:8081)

## Запуск всех тестов
```bash
make test
```

## Остановка приложения
``` bash
make down
```

## Доступы к бд
**БД:** `test`

**Юзер:** `test`

**Пароль:** `mysecretpassword`

**Порт:** `5432`

## Версии
**PHP-FPM:** 8.1.9 под Alpine 3.16

**PgsqlDB:** 14.4 под Alpine 3.16

**Nginx:** 1.23.1 под Alpine 3.16

**Redis:** 7.0.4 под Alpine 3.16
