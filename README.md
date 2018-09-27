# Tasks testing assignment

## Installation

1. Clone repo

```
git clone https://github.com/dimichspb/beejee
```

2. Change directory

```
cd beejee
```

3. Install dependenies

```
composer install
```

## Configuration

1. Define default values

```
web\index.php
```

2. Setup apache configuration

```
<VirtualHost *:80>
    DocumentRoot "C:/Projects/PHP/beejee/web"
    ServerName beejee.localhost
    <Directory "C:/Projects/PHP/beejee/web">
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all Granted
    </Directory>
</VirtualHost>
```

3. Restart apache service

```
apachectl restart
```

4. Apply migrations:

```
vendor\bin\doctrine-migrations migrations:migrate
```

## Usage

1. Web GUI

```
http://beejee.localhost
```

## Tests

no tests implemented

## TODOs

1. Tests
2. Image upload
3. Task Preview