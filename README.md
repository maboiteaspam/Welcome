# C - Welcome

The welcome kick-start module for a C based module.

Find more about C framework here https://github.com/maboiteaspam/Foundation/blob/master/doc/1-Introduction.md

### Usage

Boot the Welcome module on `/` to enable your power to compose the desired view
in a resources less environment.

Preferred way to consume is to use the provided `c2-bin`.

See more about the `c2-bin generate` command at https://github.com/maboiteaspam/c2-bin


## Install

Until the module is published,
add this repository to the `composer` file
then run `composer update`.
```
# composer.json
,
    {
      "type": "git",
      "url": "git@github.com:maboiteaspam/Welcome.git
    }

shell
# composer update
```

or run `c2-bin require-gh -m=...`

```
c2-bin require-gh -m=maboiteaspam/Welcome
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

This module expose three new __routes__.

__home__

Displays a helpful list of layout files available within the current module executed.

__yml__

Render a selected layout yml file.

__yml_file_post__

Submit a form defined within the layout and render its errors.

### Tests

To run the tests, please install `phpunit`.

`c2-bin get-phpunit` can help you to get ready.

To run it,
```
php phpunit.phar
phpunit
c2-bin phpunit
```

### Other notes

You can get some interesting information about common tasks and resources
by taking a look to those files

__Boot__

Please check

- the bootstrap file which declare all the application modules
https://github.com/maboiteaspam/Welcome/blob/master/bootstrap.php

- the app file which execute a web request against the application
https://github.com/maboiteaspam/Welcome/blob/master/app.php

- the cli file which execute a cli invocation of the application
https://github.com/maboiteaspam/Welcome/blob/master/cli.php

__Intl__

Please check some examples of `yaml` usage for intl.

the file https://github.com/maboiteaspam/Welcome/blob/master/src/intl/en.yml

__forms__

Please check

- the layout file example with comments
https://github.com/maboiteaspam/Welcome/blob/master/src/layouts/formDemo.yml

- The Form data class example with constraint declaration
https://github.com/maboiteaspam/Welcome/blob/master/src/FormDemo.php

