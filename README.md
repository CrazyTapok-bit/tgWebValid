# Library for Telegram Web App User Validation and Telegram Login Widget for PHP
[![Testing Status](https://github.com/CrazyTapok-bit/tgWebValid/workflows/PHP%20CI/badge.svg)](https://github.com/CrazyTapok-bit/tgWebValid/actions)
[![Minimum PHP Version](https://img.shields.io/packagist/dependency-v/tg/tgwebvalid/php)](https://packagist.org/packages/tg/tgwebvalid)
[![Latest version](https://img.shields.io/packagist/v/tg/tgWebValid)](https://packagist.org/packages/tg/tgwebvalid)
[![License](https://img.shields.io/packagist/l/tg/tgwebvalid)](https://packagist.org/packages/tg/tgwebvalid)

[![StandWithUkraine](./badges/StandWithUkraine.svg)](https://stand-with-ukraine.pp.ua)
[![StandWithUkraine](./badges/RussianWarship.svg)](https://stand-with-ukraine.pp.ua)

[![StandWithUkraine](./StandWithUkraine.svg)](https://stand-with-ukraine.pp.ua)

## About TgWebValid
User authentication occurs by encrypting the received, raw, user data and comparing it with the hash provided by the telegram. A failed check can be equated with a possible attempt to bypass or hack the system.

The library verifies users Telegram Login Widget and Telegram Web App

`WARNING`: Use user data only after successful authentication

To quickly and safely verify a user, we recommend following a few simple steps

## Installation
You can install the TgWebValid library through the [composer](https://getcomposer.org/) package manager by executing the command 
```bash
composer require tg/tgwebvalid --no-dev
```
With the `--no-dev` flag, only the dependencies needed to run your project in a production environment will be installed.

## Using
The first thing you need to do is to set in the constructor of the TgWebValid class the token of the Telegram bot on behalf of which authentication is performed by default. And store the result in a variable.

Also, if you want to throw an exception in case of a validation error, set the second parameter to true. But be sure to use the `try catch` structure

```php
<?php

use TgWebValid\TgWebValid;

include './vendor/autoload.php';

$tgWebValid = new TgWebValid('TELEGRAM_BOT_TOKEN', false);
```

If your project uses multiple bots, you can easily interact with them, just add them all

```php
<?php

use TgWebValid\BotConfig;

$tgWebValid->addBot(new BotConfig('secondary' 'TELEGRAM_BOT_TOKEN_2'));
$tgWebValid->addBot(new BotConfig('minor' 'TELEGRAM_BOT_TOKEN_3'));
```

Getting a bot to work is easy. Specify the name of the bot to work with, or leave the argument empty to get the default bot

```php
$bot = $tgWebValid->bot('minor');
```
Next, you need to decide on the type of authentication you need to do.
* Web App Authentication [Example](#telegram-web-app-authentication)
* Login Widget Authentication [Example](#telegram-login-widget-authentication)

## Telegram Web App authentication
To perform this type of verification, you should use the `validateInitData` method. Which argument accepts data for processing. If the validation is successful, you will be returned an `InitData` object with the data, or `false` if the validation fails. 

Use the second argument to enable or disable an exception on failed validation
```php
$initData = $bot->validateInitData('query_id=...');

if (!$initData) {
    // validation fails
}

/**
 * The initData object can contain the following data:
 */

// Time opening a web application
$initData->authDate;

// An object containing data about the current user
$initData->user;

// May contain a chat partner data object
$initData->receiver;

// May contain an object with chat data
$initData->chat;

// and other data
```
`Note`. Certain data is present depending on the situation, so sometimes it can be `null` instead of data or a data object. More details in the [Telegram official documentation](https://core.telegram.org/bots/webapps#webappinitdata)

## Telegram Login Widget authentication
To perform this type of check, you should use the `validateLoginWidget` method. Which argument accepts an array with raw user data. You will be returned a `LoginWidget` object with the data, or `false` if the validation fails

Use the second argument to enable or disable an exception on failed validation
```php
$loginWidget = $bot->validateLoginWidget([
    'auth_date' => 1679130118,
    'first_name' => 'Сергій',
    // other fields
]);

if (!$loginWidget) {
    // validation fails
}

/**
 * The LoginWidget object can contain the following data:
 */

// User token
$loginWidget->id;

// User first name
$loginWidget->firstName;

// Username
$loginWidget->username;

// Link to profile photo
$loginWidget->photoUrl;

// Authorization time
$loginWidget->authDate;

// and other data

```
`Note`. Certain data is present depending on the situation, so sometimes it can be `null` instead of data or a data object.

## Full example

```php
<?php

use TgWebValid\TgWebValid;
use TgWebValid\BotConfig;
use TgWebValid\Exceptions\BotException;
use TgWebValid\Exceptions\ValidationException;
use Exception;

include './vendor/autoload.php';

try {
    $tgWebValid = new TgWebValid('TELEGRAM_BOT_TOKEN', true);

    // Add bots only when needed
    $tgWebValid->addBot(new BotConfig('secondary' 'TELEGRAM_BOT_TOKEN_2'));
    $tgWebValid->addBot(new BotConfig('minor' 'TELEGRAM_BOT_TOKEN_3'));

    $initData = $tgWebValid->bot()->validateInitData('query_id=...');

    var_dump($initData);

} catch (ValidationException $e) {
    // Verification failed
} catch (BotException $e) {
    // The bot name is incorrect
} catch (Exception $e) {
    // Other exceptions
}
```
## Additionally
Our library is autonomous, so it can be used in any frameworks, or without them.

## Security
If you discover a security vulnerability in TgWebValid, please [create an issue](https://github.com/CrazyTapok-bit/tgWebValid/issues) with a detailed description. All security vulnerabilities will be fixed immediately. [Pull requests](https://github.com/CrazyTapok-bit/tgWebValid/fork) are also welcome.

## Assistance
We will be glad if you join the development and improvement of the project. You can [create an issue](https://github.com/CrazyTapok-bit/tgWebValid/issues) and/or a [pull request](https://github.com/CrazyTapok-bit/tgWebValid/fork)

## License
TgWebValid - is open source software available under the [MIT](LICENSE). See the [license file](LICENSE) for more information.
