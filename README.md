# Test Work

Тестовое задание:
* Взять любой микрофреймворк, любую базу,
* наполнить базу любыми данными в количестве 3-х значений,
* написать консольную команду, которая будет возвращать эти данные в любом виде.
* Развернуть приложение под докером.
* Отправить код в любой паблик репозиторий (github).
* Написать Readme как запускать приложение и выполнять консольную команду.

## Для локальной разработки

### Команды make

| команда | действие                            |
|---------|-------------------------------------|
| init    | пересборка контейнеров              |
| up      | запускает контейнеры                |
| down    | останавливает запущенные контейнеры |

Для изменений внутри контейнера

```bash
docker-compose run --rm <контейнер> <команда>
```
