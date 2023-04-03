<?php

namespace TgWebValid\Entities\InitData;

use TgWebValid\Make\Make;

class Receiver extends Make
{
    /**
     * A unique identifier for the user or bot.
     * This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it.
     * It has at most 52 significant bits, so a 64-bit integer or a double-precision float type is safe for storing this identifier.
     */
    public int $id;

    /**
     * Optional. True, if this user is a bot.
     */
    public ?bool $isBot = null;

    /**
     * First name of the bot.
     */
    public string $firstName;

    /**
     * Optional. Last name of the bot.
     */
    public ?string $lastName = null;

    /**
     * Optional. Username of the bot.
     */
    public ?string $username = null;

    /**
     * Optional. True, if this user is a Telegram Premium user
     */
    public ?bool $isPremium = null;

    /**
     * Optional. URL of the user’s profile photo. The photo can be in .jpeg or .svg formats.
     * Only returned for Web Apps launched from the attachment menu.
     */
    public ?string $photoUrl = null;
}
