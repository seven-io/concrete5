<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Http\Client\Client;

class ApiClient {
    private Client $client;

    public function __construct(Client $client, string $apiKey) {
        $this->client = $client->setHeaders([
            'SentWith' => 'concrete5',
            'X-Api-Key' => $apiKey,
        ]);
        $this->client->setMethod('POST');
    }

    private function request(string $endpoint, SmsParams|VoiceParams $data): object {
        return json_decode($this->client
            ->setParameterPost($data->toArray())
            ->setUri('https://gateway.seven.io/api/' . $endpoint)
            ->send()
            ->getBody());
    }

    public function sms(SmsParams $params): object {
        return $this->request('sms', $params);
    }

    public function voice(VoiceParams $params): object {
        return $this->request('voice', $params);
    }
}
