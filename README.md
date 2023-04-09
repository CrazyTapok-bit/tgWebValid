# Бібліотека TgWebValid призначена для перевірки достовірності даних, які надходять від користувачів Telegram WebApp та Telegram Login Widget
[![Minimum PHP Version](https://img.shields.io/packagist/dependency-v/tg/tgwebvalid/php)](https://packagist.org/packages/tg/tgwebvalid)
[![Latest version](https://img.shields.io/packagist/v/tg/tgWebValid)](https://packagist.org/packages/tg/tgwebvalid)
[![License](https://img.shields.io/packagist/l/tg/tgwebvalid)](https://packagist.org/packages/tg/tgwebvalid)

Перевірка даних відбувається шляхом шифрування отриманих, необроблених, даних користувача та звірка з хешем який нам надає телеграм. Провалену перевірку можна прирівняти з можливою спробою обходу або злому системи.

Пакет дозволяє здійснити перевірку деяких типів користувачів. А саме, перевірка даних з поля `window.Telegram.WebApp.initData`, а також перевірка користувача який здійснює логін за допомогою [Telegram Login Widget](https://core.telegram.org/widgets/login)

`ПОПЕРЕДЖЕННЯ`: Даним із цих полів не можна довіряти. Ви повинні використовувати їх лише на сервері бота і лише після їх перевірки.

Щоб отримати змогу швидко та безпечно перевірити дані, рекомендуємо виконати наступні дії

## Встановлення TgWebValid
Встановити пакет TgWebValid можна через пакетний менеджер [composer](https://getcomposer.org/) виконавши команду 
```bash
composer require tg/tgwebvalid
```


## Як користуватись
Перед початком використання достатньо в конструктор класу TgWebValid передати токен від бота, від імені якого здійснюється перевірка.

```php
<?php

use TgWebValid\TgWebValid;

include './vendor/autoload.php';

const TG_BOT_TOKEN = 'XXX-XXX-XXX';

$tgWebValid = new TgWebValid(TG_BOT_TOKEN);
```

Щоб виконати перевірку користувача який відкриває веб-додаток, вам слід скористатись методом `validateInitData`. Який аргументом приймає дані для обробки. У разі успішної перевірки, вам буде повернуто об'єкт `InitData` з даними, або `false` у разі провалу перевірки
```php
const INIT_DATA = 'query_id=...';

$initData = $tgWebValid->validateInitData(INIT_DATA);

if (!$initData) {
    // провалена перевірка
}
```

Якщо ж у вас є потреба перевірити користувача який здійснює вхід в систему за допомогою [Telegram Login Widget](https://core.telegram.org/widgets/login), вам слід скористатись методом `validateLoginWidget` який аргументом приймає необроблені дані користувача для перевірки. У разі успіху, вам буде повернуто об'єкт `LoginWidget` з даними користувача, або `false` у разі провалу перевірки
```php
const LOGIN_USER_DATA = [
    'auth_date' => 1679130118,
    'first_name' => 'Сергій',
    // ... та решта полів
];

$loginWidget = $tgWebValid->validateLoginWidget(LOGIN_USER_DATA);

if (!$loginWidget) {
    // провалена перевірка
}
```
У разі успішного проходження перевірки користувач вважається верифікованим та вірним. Тому можемо спокійно користуватись його даними.

Об'єкт `InitData` може містити наступні дані:
```php
// Об'єкт, що містить дані про поточного користувача
$initData->user;

// Об’єкт, що містить дані про чат-партнера поточного користувача в чаті
$initData->receiver;

// Об’єкт, що містить дані про чат
$initData->chat;

// та багато іншого
```

Об'єкт `LoginWidget` може містити такі дані як:
```php
// Токен користувача
$loginWidget->id;

// Ім'я користувача
$loginWidget->firstName;

// Прізвище користувача
$loginWidget->lastName;

// Нік користувача
$loginWidget->username;

// Посилання на фото профілю
$loginWidget->photoUrl;

// Unix час авторизації
$loginWidget->authDate;

// та інші
```

Зверніть увагу що певні дані присутні в залежності від ситуації, тому інколи можуть мати значення null замість даних, або об'єкта даних. Більш детальніше можна ознайомитись в [офіційній документації Telegram](https://core.telegram.org/bots/webapps#webappinitdata)

## Додатково
Наш пакет автономний, тому може спокійно використовуватись в будь яких фреймворках, або без них.

## Безпека
Якщо ви виявите вразливість у безпеці TgWebValid, ми просимо [створити запит](https://github.com/CrazyTapok-bit/tgWebValid/issues) з детальним описом. Усі вразливості системи безпеки будуть негайно усунені.

## Сприяння
Будемо раді якщо ви долучитесь до розвитку та покращеню проекта. Для початку можна [створити запит](https://github.com/CrazyTapok-bit/tgWebValid/issues), або клонувати репозиторій та запропонувати свої зміни

## Ліцензія
TgWebValid - це програмне забезпечення з відкритим вихідним кодом, доступне за ліцензією MIT (MIT). Перегляньте [файл ліцензії](LICENSE) для отримання додаткової інформації
