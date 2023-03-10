# TgWebValid допомагає перевірити дані з поля Telegram.WebApp.initData на PHP
[![Остання версія](https://img.shields.io/packagist/v/tg/tgWebValid)](https://packagist.org/packages/tg/tgwebvalid)
[![Ліцензія](https://img.shields.io/packagist/l/tg/tgwebvalid)](https://packagist.org/packages/tg/tgwebvalid)

Перевірка даних відбувається шляхом шифрування отриманих, необроблених, даних користувача та звірка з хешем який нам надає телеграм. Провалену перевірку можна прирівняти з можливою спробою обходу або злому системи.

Необроблені дані знаходяться в полі `window.Telegram.WebApp.initData` - це поле доступне на фронтенді, після виконання дій описаних [тут](https://core.telegram.org/bots/webapps#initializing-web-apps). Саме дані з цього поля треба передати на бекенд для перевірки.

`ПОПЕРЕДЖЕННЯ`: Даним із цього поля не можна довіряти. Ви повинні використовувати лише дані з initData на сервері бота і лише після їх перевірки.

Щоб отримати змогу швидко та безпечно перевірити дані. Треба виконати наступні дії

## Встановлення TgWebValid
Встановити пакет tgWebValid можна через пакетний менеджер [composer](https://getcomposer.org/) виконавши команду 
```bash
composer require tg/tgwebvalid
```
Ми йдемо слідом за технологіями, тому пакет починає працювати з версії `PHP >= 8.0.2`.

## Як користуватись
Для початку використання достатньо передати рядок з необробленими даними в контейнер класу TgWebValid.

```php
<?php

use TgWebValid\TgWebValid;

include './vendor/autoload.php';

const INIT_DATA = 'query_id=...';

$tgWebValid = new TgWebValid(INIT_DATA);

```

Після цього викликавши метод isValid виконати перевірку даних. Перевірка даних відбувається безпечним шляхом з використанням токену від Telegram боту. Ми не зберігаємо та не продаємо ваш токен на стороні джерела. Вся робота автономна та не виходить за межі файлів.

```php
const TG_BOT_TOKEN = 'XXX-XXX-XXX';

if($tgWebValid->isValid(TG_BOT_TOKEN)) {
    // перевірка успішно пройдена
} else {
    // провалена перевірка
}
```

Результатом перевірки буде повернуто тип Boolean зі значенням true/false.

У разі успішного проходження перевірки користувач вважається верифікованим та вірним. Тому можемо спокійно користуватись його даними.

В залежності від ситуації ви можете мати доступ до об’єктів даних наступним чином.
```php
// Об'єкт, що містить дані про поточного користувача
$user = $tgWebValid->initData->user;

// Об’єкт, що містить дані про чат-партнера поточного користувача в чаті
$receiver = $tgWebValid->initData->receiver;

// Об’єкт, що містить дані про чат
$chat = $tgWebValid->initData->chat;

// та багато іншого
```
Зверніть увагу що певні дані присутні в залежності від ситуації, тому інколи можуть мати значення null замість об'єкта даних. Більш детальніше можна ознайомитись в [офіційній документації Telegram](https://core.telegram.org/bots/webapps#webappinitdata)

## Додатково
Наш пакет автономний, тому може спокійно використовуватись в популярних фреймворках. Таких як Laravel, Symfony, Yii та інші. Або без них.

## Безпека
Якщо ви виявите вразливість у безпеці TgWebValid, вам треба [створити запит](https://github.com/CrazyTapok-bit/tgWebValid/issues) з детальним описом. Усі вразливості системи безпеки будуть негайно усунені.

## Сприяння
Будемо раді якщо ви долучитесь до розвитку та покращеню проекта. Для початку можна [створити запит](https://github.com/CrazyTapok-bit/tgWebValid/issues), або клонувати репозиторій та запропонувати свої зміни

## Ліцензія
TgWebValid - це програмне забезпечення з відкритим вихідним кодом, доступне за ліцензією MIT (MIT). Перегляньте [файл ліцензії](LICENSE) для отримання додаткової інформації
