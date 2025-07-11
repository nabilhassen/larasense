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
php artisan migrate --graceful
php artisan storage:link
```

## Run Development Servers

```bash
composer run dev
```

## Usage

1.  Create an admin user `php artisan make:admin`.
2.  Use the credentials from step 1 and login to filament admin panel at the `/admin` path.
3.  From the sidebar, go to publishers and create a publisher.
4.  Again, from the sidebar, go to sources and create a source for the publisher you already created.
5.  Run `php artisan queue:listen` in a separate terminal.
6.  Run `php artisan larasense:bot`, which will push jobs to the queue to pull content from the source(s) you created.
7.  Now, go to `/home` path to see the content.

## Testing

```bash
# Run the test suite
composer pest

# Run pint to fix code style
composer pint
composer test:pint

# Run all tests
composer test
```

## Contributing

Pull requests are welcome! Please write tests for new features.

## License

Larasense is an open-sourced software licensed under the **[GNU Affero General Public License](LICENSE.md)**
