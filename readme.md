Nette Web Project Template (fork)
=================================

This is a fork of the simple, skeleton application using the [Nette](https://nette.org). This is meant to
be used as a starting point for your new projects.

[Nette](https://nette.org) is a popular tool for PHP web development.
It is designed to be the most usable and friendliest as possible. It focuses
on security and performance and is definitely one of the safest PHP frameworks.

If you like Nette, **[please make a donation now](https://nette.org/donate)**. Thank you!

If this fork helped you, **[please donate me](https://www.patreon.com/kratocz)**. Thank you!


All fork modifications
----------------------

* [.gitignore](.gitignore)
* This info in the file [readme.md](readme.md)
* [app/Components/BaseControl.php](app/Components/BaseControl.php)
* [app/Components/BaseForm.php](app/Components/BaseForm.php)
* [app/Presenters/BasePresenter.php](app/Presenters/BasePresenter.php)
* [app/Repositories/BaseDatabaseRepository.php](app/Repositories/BaseDatabaseRepository.php)


Requirements
------------

- Web Project for Nette 3.1 requires PHP 8.0


Missing composer or php
-----------------------

Don't you have `composer` installed? Install it or use Docker image:
```shell
docker run --rm --interactive --tty --volume $PWD:/app composer <command>
```
instead of:
```shell
composer <command>
```

Don't you have even `php` installed? Install it or use Docker image:
```shell
docker run --rm --interactive --tty --volume $PWD:/app --workdir /app -p 8000:8000 php:8.2 -S 0.0.0.0:8000 -t www
```
instead of:
```shell
php -S localhost:8000 -t www
```


Installation
------------

The best way to install Web Project is using Composer. If you don't have Composer yet,
download it following [the instructions](https://doc.nette.org/composer). Then use command:

	composer create-project kratocz/nette-web-project-template path/to/install
	cd path/to/install


Make directories `temp/` and `log/` writable.


Web Server Setup
----------------

The simplest way to get started is to start the built-in PHP server in the root directory of your project:

	php -S localhost:8000 -t www

Then visit `http://localhost:8000` in your browser to see the welcome page.

For Apache or Nginx, setup a virtual host to point to the `www/` directory of the project and you
should be ready to go.

**It is CRITICAL that whole `app/`, `config/`, `log/` and `temp/` directories are not accessible directly
via a web browser. See [security warning](https://nette.org/security-warning).**
