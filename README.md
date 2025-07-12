<p align="center">
    <a href="https://larasense.com" target="_blank"><img src="https://larasense.com/img/logo.png" width="70%" alt="Larasense logo"></a>
</p>

<p align="center">
<a href="https://github.com/nabilhassen/larasense/actions"><img src="https://github.com/nabilhassen/larasense/actions/workflows/test.yml/badge.svg" alt="Test Status"></a>
</p>

## About Larasense

Larasense is a dedicated, Laravel-focused content aggregator designed for developers who want to stay informed on everything happening in the Laravel ecosystem. It curates the latest articles, YouTube videos, and podcasts from credible sources we know and love, bringing official Laravel news, top community blogs, YouTube channels, and podcasts into one distraction-free hub. Browse and bookmark high-quality Laravel content without juggling tabs or sifting through social media.

## Features

-   Discover high-quality Laravel content from trusted, handpicked sources.
-   Fresh content, always.
-   Clean and minimal UI focused solely on Laravel content.
-   Easily browse by content type: articles, YouTube videos, or podcasts.
-   View content organized by the source it's published from.
-   Watch YouTube videos and listen to podcasts directly on the platform.
-   Quickly find what you’re looking for with built-in search functionality.
-   Interact with content by liking, disliking, or bookmarking content for later.
-   Social login support. Sign in with Google or GitHub for a faster, secure experience.
-   Free to use.

## Requirements

-   PHP 8.3+
-   Node.js 16+
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

touch database/database.sqlite

php artisan migrate --graceful

php artisan storage:link
```

## Run Development Servers

```bash
# Runs php artisan serve & npm run dev
composer run dev
```

## Usage

1.  Start by creating an admin user by running: `php artisan make:admin`.
2.  Navigate to `/admin` path and use the credentials from step 1 to login to filament admin panel.
3.  Once logged in, navigate to the Publishers page in the sidebar and create a new publisher.
    -   **Make sure the "Allow Publisher" and "Track Publisher" toggles are turned ON.**
4.  Next, go to the Sources page in the sidebar and create a source associated with the publisher you just added **(one source is enough)**.
    -   Example Source 1:
        -   RSS URL: https://nabilhassen.com/feed
        -   Type: Article
    -   Example Source 2:
        -   RSS URL: https://www.youtube.com/feeds/videos.xml?channel_id=UC5vAu93DnzOS6LLDnHA9SfQ
        -   Type: Youtube
    -   **Make sure the "Track Source" and "Allow Source" toggles are turned ON.**
5.  In a separate terminal, trigger the content collection bot by running: `php artisan larasense:bot`. It pushes jobs to the queue to pull content from the source(s) you created.
6.  Start the queue worker: `php artisan queue:listen`
7.  Navigate to `/home` path in your browser to explore the collected content.

> [!NOTE]
> If you run into any issues installing or running Larasense locally, feel free to open an issue or submit a pull request.

## Testing

```bash
# Runs the test suite
composer pest

# Fix code style & run tests
composer pint
composer test:pint

# Runs all tests
composer test
```

## Contributing

Pull requests are welcome! Please write tests for new features. You may start with the [Roadmap](#roadmap).

## Roadmap

-   [ ] Upgrade to Tailwind 4 and daisyUI 5
-   [ ] Filter feed by predefined date range (daisyUI dropdown): today, yesterday, this week, this month.
-   [ ] PWA capability

## License

Larasense is an open-sourced software created by [Nabil Hassen](https://x.com/nabilhassen08) licensed under the **[GNU Affero General Public License](LICENSE.md)**
