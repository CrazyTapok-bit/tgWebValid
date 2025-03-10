# Library for Telegram Web App User Validation and Telegram Login Widget for PHP
[![Testing Status](https://github.com/CrazyTapok-bit/tgWebValid/workflows/PHP%20CI/badge.svg)](https://github.com/CrazyTapok-bit/tgWebValid/actions)
[![Minimum PHP Version](https://img.shields.io/packagist/dependency-v/tg/tgwebvalid/php)](https://packagist.org/packages/tg/tgwebvalid)
[![Latest version](https://img.shields.io/packagist/v/tg/tgWebValid)](https://packagist.org/packages/tg/tgwebvalid)
[![Downloads](https://img.shields.io/packagist/dt/tg/tgwebvalid.svg)](https://packagist.org/packages/tg/tgwebvalid)
[![License](https://img.shields.io/packagist/l/tg/tgwebvalid)](https://packagist.org/packages/tg/tgwebvalid)

[![Documentation](https://img.shields.io/badge/%20Documentation-tgwebvalid.com-blue?logo=data:image/png;base64,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)](https://tgwebvalid.com/)
[![StandWithUkraine](./badges/StandWithUkraine.svg)](https://stand-with-ukraine.pp.ua)
[![StandWithUkraine](./badges/RussianWarship.svg)](https://stand-with-ukraine.pp.ua)

[![StandWithUkraine](./StandWithUkraine.svg)](https://stand-with-ukraine.pp.ua)

## About TgWebValid

They say we are cool 😎

⭐️ Support us, give us a star on GitHub and become our sponsor 😊

🙏 Please let us know on GitHub if something isn't working for you
or if you need additional functionality

<hr />

User authentication occurs by encrypting the received, raw, user data and comparing it with the hash provided by the telegram. A failed check can be equated with a possible attempt to bypass or hack the system.

The library verifies users Telegram Login Widget and Telegram Web App

`WARNING`: Use user data only after successful authentication

To quickly and safely verify a user, we recommend following a few simple steps

## Installation
You can install the TgWebValid library through the [composer](https://getcomposer.org/) package manager by executing the command 
```bash
composer require tg/tgwebvalid
```
Add the `--no-dev` flag to install only the dependencies needed to run your project in a production environment.

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

$tgWebValid->addBot('secondary', 'TELEGRAM_BOT_TOKEN_2');
$tgWebValid->addBot('minor', 'TELEGRAM_BOT_TOKEN_3');
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
use TgWebValid\Exceptions\BotException;
use TgWebValid\Exceptions\ValidationException;
use Exception;

include './vendor/autoload.php';

try {
    $tgWebValid = new TgWebValid('TELEGRAM_BOT_TOKEN', true);

    // Add bots only when needed
    $tgWebValid->addBot('secondary', 'TELEGRAM_BOT_TOKEN_2');
    $tgWebValid->addBot('minor', 'TELEGRAM_BOT_TOKEN_3');

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
