<?php

namespace AndreXdd\AiResponder;

use Flarum\Extend;
use Flarum\Discussion\Event\Started;
use AndreXdd\AiResponder\Listener\NewDiscussionListener;

return [
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    (new Extend\Event())
        ->listen(Started::class, NewDiscussionListener::class),

    (new Extend\Settings())
        ->serializeToForum('andreAiEndpoint', 'andrexdd-ai-responder.api_endpoint')
        ->serializeToForum('andreAiUserId', 'andrexdd-ai-responder.ai_user_id')
];