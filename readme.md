# Andre AI Real-Time Responder Extension for Flarum

An enterprise-grade automation extension for Flarum that bridges your discussion board with real-time AI capabilities via secure webhook integrations. Designed specifically for developer forums and technical communities to eliminate dead threads and provide instant, context-aware support.

---

## Directory Structure

```text
andrexdd-ai-responder/
├── composer.json
├── extend.php
├── src/
│   └── Listener/
│       └── NewDiscussionListener.php
└── js/
    ├── package.json
    ├── webpack.config.js
    └── src/
        └── admin/
            └── index.js
Architectural Features
Event-Driven Execution: Hooks directly into Flarum's lifecycle (Flarum\Discussion\Event\Started) to intercept new discussions immediately.

Granular Custom Blueprints: Allows full administration control over the system behavior via centralized backend configurations.

Isolated Payload Exchange: Features a payload structure utilizing customized verification signatures (X-Signature: AndreSoftwareHub).

Fault-Tolerant Fallbacks: Implements silent fail-catch blocks ensuring that even if external AI APIs drop or time out, the core Flarum board continues running safely.

Configuration Setup
Once installed, navigate to your Flarum Admin Panel under the Extensions tab to configure your interactive gateway parameters:

Interactive Hook Gateway Target (API Endpoint URL):
Input your custom microservice or mock server endpoint (e.g., https://api.fikiral.net.tr/v1/stream-ai).

Security Bearer Token / API Secret Authorization Key:
Provide the authorization credentials required by your endpoint gateway.

Automated Bot Account Context Assignment (User Identity ID):
Specify the internal user database ID allocated for your AI Bot profile.

Behavioral Directive Template Configuration (System Instructions Blueprint):
Define the persona, boundaries, and technical expertise your AI bot should project while replying.

Manual Developer Installation
To deploy this extension directly inside your local or production environment, clone the structure or move the folder to your workbench/ directory, then enforce the autoloader rules:

Bash
# Register the extension locally via composer
composer config repositories.andrexdd-ai-responder path "workbench/andrexdd-ai-responder"

# Require the package into your active Flarum instance
composer require andrexdd/flarum-ai-responder:*

# Run the asset compiler and migrations
php flarum migrate
php flarum cache:clear
License & Credits
Developer: Andre Software (AndreXdd)

Platform: Developed for high-performance Flarum forum systems.

License: MIT License - Free to use, modify, and scale globally.