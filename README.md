<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://yiisoft.github.io/docs/images/yii_logo.svg" height="100px" alt="Yii">
    </a>
    <h1 align="center">Yii API template</h1>
    <br>
</p>

[![Latest Stable Version](https://poser.pugx.org/yiisoft/app-api/v)](https://packagist.org/packages/yiisoft/app-api)
[![Total Downloads](https://poser.pugx.org/yiisoft/app-api/downloads)](https://packagist.org/packages/yiisoft/app-api)
[![build](https://github.com/yiisoft/app-api/actions/workflows/build.yml/badge.svg)](https://github.com/yiisoft/app-api/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/yiisoft/app-api/graph/badge.svg?token=8XE1MPAZD4)](https://codecov.io/gh/yiisoft/app-api)
[![static analysis](https://github.com/yiisoft/app-api/workflows/static%20analysis/badge.svg)](https://github.com/yiisoft/app-api/actions?query=workflow%3A%22static+analysis%22)

API application template for Yii 3.

## Requirements

- PHP 8.1 or higher.

## Local installation

If you do not have [Composer](https://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](https://getcomposer.org/doc/00-intro.md).

Create a project:

```shell
composer create-project yiisoft/app-api --stability=dev myproject
cd myproject
```

To run the app:

```
./yii serve
```

Now you should be able to access the application through the URL printed to console.
Usually it is `https://127.0.0.1:8080`.

Authorization is performed via the `X-Api-Key` header.

## Installation with Docker

Fork the repository, clone it, then:

```shell
cd myproject
make composer update
```

To run the app:

```shell
make up
```

To stop the app:

```shell
make down
```

The application is available at `https://localhost`.
Authorization is performed via the `X-Api-Key` header.

## API Documentation

API documentation is available at `/docs`. It is built from OpenAPI annotations (`@OA`).

See [Swagger-PHP documentation](https://zircote.github.io/swagger-php/guide/annotations.html) for details
on how to annotate your code.

## Getting help

If you need help or have a question, the [Yii Forum](https://forum.yiiframework.com/c/yii-3-0/63) is a good place for that.
You may also check out other [Yii Community Resources](https://www.yiiframework.com/community).

## Codeception testing

The template comes with ready to use [Codeception](https://codeception.com/) configuration.
To execute tests, in local installation run:

```shell
./vendor/bin/codecept build

./yii serve > ./runtime/yii.log 2>&1 &
./vendor/bin/codecept run
```

For Docker:

```shell
make codecept build

make codecept run
```

## Static analysis

The code is statically analyzed with [Psalm](https://psalm.dev/). To run static analysis:

```shell
./vendor/bin/psalm
```

or, using Docker:

```shell
make psalm
```

## License

The Yii API template is free software. It is released under the terms of the BSD License.
Please see [`LICENSE`](./LICENSE.md) for more information.

Maintained by [Yii Software](https://www.yiiframework.com/).

## Support the project

[![Open Collective](https://img.shields.io/badge/Open%20Collective-sponsor-7eadf1?logo=open%20collective&logoColor=7eadf1&labelColor=555555)](https://opencollective.com/yiisoft)

## Follow updates

[![Official website](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](https://www.yiiframework.com/)
[![Twitter](https://img.shields.io/badge/twitter-follow-1DA1F2?logo=twitter&logoColor=1DA1F2&labelColor=555555?style=flat)](https://twitter.com/yiiframework)
[![Telegram](https://img.shields.io/badge/telegram-join-1DA1F2?style=flat&logo=telegram)](https://t.me/yii3en)
[![Facebook](https://img.shields.io/badge/facebook-join-1DA1F2?style=flat&logo=facebook&logoColor=ffffff)](https://www.facebook.com/groups/yiitalk)
[![Slack](https://img.shields.io/badge/slack-join-1DA1F2?style=flat&logo=slack)](https://www.yiiframework.com/go/slack)
