<?php

namespace Andrexdd\AiRealtimeResponder\Listener;

use Flarum\Discussion\Event\Started;
use Flarum\Post\CommentPost;
use Flarum\User\User;
use Exception;

class SendAiResponse
{
    public function handle(Started $event)
    {
        $discussion = $event->discussion;
        $firstPost = $discussion->firstPost;

       
        if (!$firstPost) {
            return;
        }

       
        $userContent = $firstPost->content;
        $discussionTitle = $discussion->title;

     
        $apiKey = 'YOUR_OPENAI_API_KEY'; 
        
        
        $botUserId = 1; 
        $botUser = User::find($botUserId);

        if (!$botUser) {
            return;
        }

        
        $url = 'https://api.openai.com/v1/chat/completions';
        $data = [
            'model' => 'gpt-4o-mini', 
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful forum assistant. Respond to the user\'s forum post naturally and concisely in the language they used.'
                ],
                [
                    'role' => 'user',
                    'content' => "Title: {$discussionTitle}\n\nContent: {$userContent}"
                ]
            ],
            'max_tokens' => 500
        ];

        try {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);

            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                $responseData = json_decode($response, true);
                $aiReply = $responseData['choices'][0]['message']['content'] ?? null;

               
                if ($aiReply) {
                    CommentPost::reply(
                        $discussion->id,
                        $aiReply,
                        $botUser->id,
                        '127.0.0.1' 
                    );
                }
            }
        } catch (Exception $e) {
            
            error_log('AI Realtime Responder Error: ' . $e->getMessage());
        }
    }
}
