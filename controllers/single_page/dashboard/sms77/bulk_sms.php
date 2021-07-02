<?php namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard\Sms77;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use Concrete\Core\User\UserInfoRepository;
use Sms77\Concrete5\AbstractMessageController;
use Sms77\Concrete5\SmsParams;

final class BulkSms extends AbstractMessageController {
    public function __construct(Page $c, UserInfoRepository $repo) {
        parent::__construct($c, $repo, 'sms');
    }

    protected function onSubmit(array $recipients) {
        $this->setMessage($this->encode($this->client->sms((new SmsParams)
            ->setDebug((bool)$this->config['debug'])
            ->setFlash((bool)$this->config['flash'])
            ->setForeignId($this->config['foreign_id'])
            ->setFrom($this->config['from'])
            ->setLabel($this->config['label'])
            ->setNoReload((bool)$this->config['no_reload'])
            ->setPerformanceTracking((bool)$this->config['performance_tracking'])
            ->setText($this->getText())
            ->setTo(implode(',', $recipients)))));
    }
}
