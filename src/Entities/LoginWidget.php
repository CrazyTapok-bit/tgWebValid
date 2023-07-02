<?php

namespace TgWebValid\Entities;

use Carbon\CarbonInterface;
use TgWebValid\Make\LoginWidget as MakeLoginWidget;

final class LoginWidget extends MakeLoginWidget
{
    /**
     * A unique identifier for the user or bot.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * It has at most 52 significant bits, so a 64-bit integer or a double-precision float type is safe for storing this identifier.
     */
    public int $id;

    /**
     * First name of the user.
     */
    public string $firstName;

    /**
     * Optional. Last name of the user.
     */
    public ?string $lastName = null;

    /**
     * Optional. Username of the user.
     */
    public ?string $username = null;

    /**
     * Optional. URL of the user’s profile photo. The photo can be in .jpeg or .svg formats.
     */
    public ?string $photoUrl = null;

    /**
     * Unix time when the form was opened.
     */
    public CarbonInterface $authDate;

    /**
     * A hash of all passed parameters, which the bot server can use to check their validity.
     */
    public string $hash;
}
