# AI Realtime Responder for Flarum 2.0

An extension that automatically generates AI responses to newly started discussions using OpenAI's chat completion models.

## Features

- Listens for newly created discussions instantly.
- Generates contextual responses based on the discussion title and first post content.
- Utilizes fast and cost-effective OpenAI models (`gpt-4o-mini`).
- Built directly on top of Flarum 2.0 extension architecture.

## Installation

Install manually or via composer inside your Flarum root directory:

```bash
composer require andrexdd/flarum-ai-realtime-responder
Configuration
Before running the extension, open src/Listener/SendAiResponse.php and replace the placeholder value with your actual OpenAI API key:

PHP
$apiKey = 'YOUR_OPENAI_API_KEY';
License
This project is licensed under the MIT License.
