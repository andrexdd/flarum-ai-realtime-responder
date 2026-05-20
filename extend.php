<?php

use Flarum\Extend;
use Flarum\Discussion\Event\Started;
use Andrexdd\AiRealtimeResponder\Listener\SendAiResponse;

return [
    (new Extend\Event())
        ->listen(Started::class, SendAiResponse::class)
];
