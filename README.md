# URL Shortener

---

## Возможности

* создание короткой ссылки из URL
* генерация 6-символьного кода
* редирект по коду
* подсчёт переходов
* получение статистики по ссылке
* повторное использование кода для одинакового URL

---

## Стек

* PHP 8.4
* Laravel 11
* PostgreSQL
* Docker / Docker Compose

---

## Запуск проекта

### 1. Клонирование

```bash
git clone <repo_url>
cd <repo_folder>
```

---

### 2. Создание .env файлов

```bash
make init-env
```

Создаёт:

* `.env` (для Docker)
* `app/.env` (для Laravel)

---

### 3. Поднятие контейнеров

```bash
make up
```

---

### 4. Установка зависимостей

```bash
make composer-install
```

---

### 5. Инициализация Laravel

```bash
make setup
```

Выполняет:

* генерацию `APP_KEY`
* запуск миграций

---

## API

### Создание короткой ссылки

```http
POST /api/links
```

**Request:**

```json
{
  "url": "https://example.com/some/long/path"
}
```

**Response:**

```json
{
  "code": "ABC123",
  "short_url": "http://localhost:8080/ABC123"
}
```

---

### Редирект

```http
GET /{code}
```

* редирект на оригинальный URL (302)
* увеличивает счётчик переходов
* 404 если код не найден

---

### Статистика ссылки

```http
GET /api/links/{code}/stats
```

**Response:**

```json
{
  "url": "https://example.com",
  "code": "ABC123",
  "clicks": 10,
  "created_at": "2026-06-20T12:00:00+00:00"
}
```

---

## Docker

Сервисы:

* nginx (8080 → 80)
* php-fpm
* php-cli
* composer
* postgres (5432)

---

## Makefile

### Основные команды

```bash
make up              # поднять контейнеры
make down            # остановить контейнеры
make restart         # перезапуск
make logs            # логи
```

### Инициализация

```bash
make init-env        # создать .env файлы
make setup           # APP_KEY + миграции
```

### База данных

```bash
make migrate         # миграции
make migrate-fresh   # пересоздать БД + seed
make seed            # сиды
```

### Composer

```bash
make composer-install # установка зависимостей
make composer-update  # обновление зависимостей
make composer-dump    # пересборка autoload
```

### Утилиты

```bash
make bash            # вход в php-cli контейнер
make cache-clear     # очистка кеша Laravel
make cache-optimize  # оптимизация кеша Laravel
```

---

## Архитектура

* Controller — HTTP слой
* Service — бизнес-логика
* Repository — работа с БД
* Model — сущности Eloquent
* Request — валидация входящих данных

---

## Тесты

```bash
php artisan test
```