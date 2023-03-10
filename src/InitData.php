<?php

namespace TgWebValid;

use TgWebValid\Entities\TgWebChat;
use TgWebValid\Entities\TgWebReceiver;
use TgWebValid\Entities\TgWebUser;

class InitData extends Make
{
    /**
     * Optional. A unique identifier for the Web App session, required for sending messages via the answerWebAppQuery method.
     */
    public ?string $queryId;

    /**
     * An object containing data about the current user.
     */
    public ?TgWebUser $user = null;

    /**
     * An object containing data about the chat partner of the current user in
     * the chat where the bot was launched via the attachment menu. Returned only for
     * private chats and only for Web Apps launched via the attachment menu.
     */
    public ?TgWebReceiver $receiver = null;


    /**
     * Optional. An object containing data about the chat where the bot was launched via the attachment menu.
     * Returned for supergroups, channels and group chats – only for Web Apps launched via the attachment menu.
     */
    public ?TgWebChat $chat = null;

    /**
     * Optional. The value of the startattach parameter, passed via link. Only returned for Web Apps when launched from the attachment menu via link.
     * The value of the start_param parameter will also be passed in the GET-parameter tgWebAppStartParam, so the Web App can load the correct interface right away.
     */
    public ?string $startParam = null;

    /**
     * Optional. Time in seconds, after which a message can be sent via the answerWebAppQuery method.
     */
    public ?int $canSendAfter = null;

    /**
     * Unix time when the form was opened.
     */
    public int $authDate;

    /**
     * A hash of all passed parameters, which the bot server can use to check their validity.
     */
    public string $hash;

    public function __construct(array $props)
    {
        parent::__construct($props);
    }
}
