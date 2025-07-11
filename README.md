<p align="center">
    <img src="https://larasense.com/img/logo.png" width="70%" alt="Larasense logo">
</p>

## About

[![test](https://github.com/nabilhassen/larasense/actions/workflows/test.yml/badge.svg?branch=main)](https://github.com/nabilhassen/larasense/actions/workflows/test.yml)

[larasense.com's](https://larasense.com) website source code.

## Features

-   WIP

## Requirements

-   PHP >= 8.3
-   Node.js 18+
-   NPM
-   SQLite
-   [PHP extensions required by Laravel](https://laravel.com/docs/12.x/deployment#server-requirements)

## Installation

```bash
git clone https://github.com/nabilhassen/larasense.git
cd larasense.com
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan make:admin
```

## Run Development Servers

```bash
composer run dev
```

## Testing

```bash
composer test
```

## Contributing

Pull requests are welcome! Please write tests for new features.

## License

WIP
