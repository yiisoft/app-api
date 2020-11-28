<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://github.com/yiisoft.png" height="100px">
    </a>
    <h1 align="center">Yii API template</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/app-api/v/stable.png)](https://packagist.org/packages/yiisoft/app-api)
[![Total Downloads](https://poser.pugx.org/yiisoft/app-api/downloads.png)](https://packagist.org/packages/yiisoft/app-api)
[![Build status](https://github.com/yiisoft/app-api/workflows/build/badge.svg)](https://github.com/yiisoft/app-api/actions?query=workflow%3Abuild)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/yiisoft/app-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/yiisoft/app-api/?branch=master)
[![static analysis](https://github.com/yiisoft/app-api/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/app-api/actions?query=workflow%3A%22static+analysis%22)

API application template for Yii 3.

## Installation

Install docker:

```
docker-compose up -d
```

Enter into the container:

```
docker exec -it yii-php bash
```

Install packages:

```
composer install
```

Usually the application is available at http://localhost:8080.

### Endpoints:

| Method           | Requires auth | Description          |
| :--------------- |:--------------| :--------------------|
| GET  /           | no            | get application info |
| GET  /blog/      | no            | get blog records     |
| GET  /blog/[id]  | no            | get blog record      |
| POST /blog/      | yes           | create blog record   |
| PUT  /blog/[id]  | yes           | update blog record   |
| GET  /users/     | yes           | get users            |
| GET  /users/[id] | yes           | get user             |
| POST /auth/      | no            | auth                 |

Authorization is performed via the `X-Api-Key` header.

## API documentation

API documentation is available at `/docs`. It is built from OpenAPI annotations (`@OA`).
See [Swagger-PHP documentation](https://zircote.github.io/swagger-php/Getting-started.html#write-annotations) for details
on how to annotate your code.

## Codeception testing

```php
./vendor/bin/codecept run
```


## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```php
./vendor/bin/psalm
```
