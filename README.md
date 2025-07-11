<p align="center">
    <a href="https://larasense.com" target="_blank"><img src="https://larasense.com/img/logo.png" width="70%" alt="Larasense logo"></a>
</p>

<p align="center">
<a href="https://github.com/nabilhassen/larasense/actions"><img src="https://github.com/nabilhassen/larasense/actions/workflows/test.yml/badge.svg" alt="Test Status"></a>
</p>

## 🚀 About Larasense

Larasense is a dedicated, Laravel-focused content aggregator designed for developers who want to stay informed on everything happening in the Laravel ecosystem. It curates the latest articles, YouTube videos, and podcasts from credible sources we know and love, bringing official Laravel news, top community blogs, YouTube channels, and podcasts into one distraction-free hub. Browse and bookmark high-quality Laravel content without juggling tabs or sifting through social media.

## ✨ Features

-   Curated content from handpicked sources
-   Browse feed by content type: articles, youtube videos, or podcasts
-   Browse feed by sources
-   Watch YouTube videos
-   Listen Podcasts
-   Distraction-free UI
-   Search functionality
-   Interact with content; like, dislike, bookmark
-   Frequent content update
-   Free to use
-   Social login; Google, GitHub

## Requirements

-   PHP >= 8.3
-   Node.js >= 22
-   NPM > 10.9
-   SQLite
-   [PHP extensions required by Laravel](https://laravel.com/docs/12.x/deployment#server-requirements)

## Installation

```bash
git clone https://github.com/nabilhassen/larasense.git
cd larasense
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
