<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Http\Client\Client;

class ApiClient {
    /** @var string $apiKey */
    private $apiKey;

    /** @var Client $client */
    private $client;

    public function __construct(Client $client, string $apiKey) {
        $this->client = $client->setHeaders([
            'SentWith' => 'concrete5',
            'X-Api-Key' => $apiKey,
        ]);
        $this->client->setMethod('POST');
        $this->apiKey = $apiKey;
    }

    private function request(string $endpoint, AbstractParams $data): object {
        return json_decode($this->client
            ->setParameterPost($data->toArray())
            ->setUri("https://gateway.sms77.io/api/$endpoint")
            ->send()->getBody());
    }

    public function sms(SmsParams $params): object {
        return $this->request('sms', $params);
    }

    public function voice(VoiceParams $params): object {
        return $this->request('voice', $params);
    }
}
