<?php

use Flarum\Extend;
use Flarum\Discussion\Event\Started;
use Andrexdd\AiRealtimeResponder\Listener\SendAiResponse;

return [
    // Flarum'un yerleşik Event sistemine kanca atıyoruz
    (new Extend\Event())
        ->listen(Started::class, SendAiResponse::class)
];
