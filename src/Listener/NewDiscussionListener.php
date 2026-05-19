<?php

namespace AndreXdd\AiResponder;

namespace AndreXdd\AiResponder\Listener;

use Flarum\Discussion\Event\Started;
use Flarum\Settings\SettingsRepositoryInterface;
use Flarum\User\UserRepository;
use Flarum\Post\CommentPost;
use GuzzleHttp\Client;
use Exception;

class NewDiscussionListener
{
    protected $settings;
    protected $users;

    public function __construct(SettingsRepositoryInterface $settings, UserRepository $users)
    {
        $this->settings = $settings;
        $this->users = $users;
    }

    public function handle(Started $event)
    {
        $discussion = $event->discussion;
        $firstPost = $discussion->firstPost;

        if (!$firstPost) {
            return;
        }

        $apiEndpoint = $this->settings->get('andrexdd-ai-responder.api_endpoint');
        $apiKey = $this->settings->get('andrexdd-ai-responder.api_key');
        $aiUserId = (int) $this->settings->get('andrexdd-ai-responder.ai_user_id');
        $systemPrompt = $this->settings->get('andrexdd-ai-responder.system_prompt');

        if (empty($apiEndpoint) || empty($aiUserId)) {
            return;
        }

        try {
            $actor = $this->users->findOrFail($aiUserId);
        } catch (Exception $e) {
            return;
        }

        try {
            $client = new Client();
            $response = $client->post($apiEndpoint, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type'  => 'application/json',
                    'X-Signature'   => 'AndreSoftwareHub'
                ],
                'json' => [
                    'prompt' => $systemPrompt,
                    'title' => $discussion->title,
                    'content' => $firstPost->content,
                    'discussion_id' => $discussion->id
                ],
                'timeout' => 30
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                $replyContent = isset($data['reply']) ? $data['reply'] : null;

                if (!empty($replyContent)) {
                    CommentPost::reply(
                        $discussion->id,
                        $replyContent,
                        $actor->id,
                        '127.0.0.1'
                    );
                }
            }
        } catch (Exception $e) {
            return;
        }
    }
}