<?php namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Http\Client\Client;

class ApiClient {
    /** @var Client $client */
    private $client;

    /**
     * @param Client $client
     * @param string $apiKey
     */
    public function __construct(Client $client, $apiKey) {
        $this->client = $client->setHeaders([
            'SentWith' => 'concrete5',
            'X-Api-Key' => $apiKey,
        ]);
        $this->client->setMethod('POST');
    }

    /**
     * @param string $endpoint
     * @param AbstractParams $data
     * @return object
     */
    private function request($endpoint, AbstractParams $data) {
        return json_decode($this->client
            ->setParameterPost($data->toArray())
            ->setUri("https://gateway.sms77.io/api/$endpoint")
            ->send()->getBody());
    }

    /**
     * @param SmsParams $params
     * @return object
     */
    public function sms(SmsParams $params) {
        return $this->request('sms', $params);
    }

    /**
     * @param VoiceParams $params
     * @return object
     */
    public function voice(VoiceParams $params) {
        return $this->request('voice', $params);
    }
}
