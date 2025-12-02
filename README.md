# Overview

This is a simple blog website built using [Jawan Framework](https://github.com/fhddev/jawan).

## Requirements
- PHP ^7.0
- Composer
- Apache web server (if you don't want to use the built-in web server)
- MySQL (optional, for database features)

## Getting started

Clone the repo:
```shell
git clone git@github.com:fhddev/jawan-blog.git
```

Move to the folder:

```
cd jawan-blog
```

Create database:

    Install database by importing sql file located in (App\data\schema.sql)

Install composer packages:

```shell
composer install
```

or use a pre-defined shell file:

```shell
./install-prod.sh
```

Run the server:

```shell
php jwnc serve
```

## Pages

Create admin user:

```
http://127.0.0.1:8000/admin/install
```

Admin login:

```
http://127.0.0.1:8000/admin/login
```

Public page:

```
http://127.0.0.1:8000
```

## License

This project uses the following license: [MIT license](LICENSE).
