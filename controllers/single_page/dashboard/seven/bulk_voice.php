<?php namespace Concrete\Package\Seven\Controller\SinglePage\Dashboard\Seven;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use Concrete\Core\User\UserInfoRepository;
use Seven\Concrete5\AbstractMessageController;
use Seven\Concrete5\VoiceParams;

final class BulkVoice extends AbstractMessageController {
    public function __construct(Page $c, UserInfoRepository $repo) {
        parent::__construct($c, $repo, 'voice');
    }

    protected function onSubmit(array $recipients) {
        $params = (new VoiceParams)
            ->setFrom($this->config['from'])
            ->setText($this->getText())
            ->setXml((bool)$this->post('xml', false));

        foreach ($recipients as $to) {
            $msg[] = $this->client->voice($params->setTo($to));
        }

        $this->setMessage($msg);
    }
}
