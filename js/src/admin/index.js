import app from 'flarum/admin/app';

app.initializers.add('andrexdd-ai-responder', () => {
  app.extensionData
    .for('andrexdd-ai-responder')
    .registerSetting({
      setting: 'andrexdd-ai-responder.api_endpoint',
      label: 'Interactive Hook Gateway Target (API Endpoint URL)',
      type: 'text',
      placeholder: 'https://api.fikiral.net.tr/v1/stream-ai'
    })
    .registerSetting({
      setting: 'andrexdd-ai-responder.api_key',
      label: 'Security Bearer Token / API Secret Authorization Key',
      type: 'password',
      placeholder: 'Bearer secret_token_key'
    })
    .registerSetting({
      setting: 'andrexdd-ai-responder.ai_user_id',
      label: 'Automated Bot Account Context Assignment (User Identity ID)',
      type: 'number',
      placeholder: '2'
    })
    .registerSetting({
      setting: 'andrexdd-ai-responder.system_prompt',
      label: 'Behavioral Directive Template Configuration (System Instructions Blueprint)',
      type: 'textarea',
      placeholder: 'Act as an expert software architect specialized in systems optimization.'
    });
});