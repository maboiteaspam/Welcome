# C - Welcome

The welcome kick-start module for a C based module.

### Usage

Boot the Welcome module on `/` to enable your power to compose the desired view
in a resources less environment.

Preferred way to consume is to use the provided `c2-bin`.

See more about the `c2-bin generate` command at https://github.com/maboiteaspam/c2-bin


## Install

```
php composer require git@github.com:maboiteaspam/Welcome.git
```

## Register

```php

<?php

require 'vendor/autoload.php';

$app = ...;

$welcome = new C\Welcome\ControllersProvider();

$app->register($welcome);

$app->mount('/', $welcome);

```

### Description

The main purpose of this module is to expose three new __routes__.

__home__

Displays a helpful list of layout files available within the current module executed.

__yml__

Render a selected layout yml file.

__yml_file_post__

Submit a form defined within the layout and render its errors.

