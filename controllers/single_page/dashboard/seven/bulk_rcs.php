<?php namespace Concrete\Package\Seven\Controller\SinglePage\Dashboard\Seven;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use Concrete\Core\User\UserInfoRepository;
use Seven\Concrete5\AbstractMessageController;
use Seven\Concrete5\RcsParams;

final class BulkRcs extends AbstractMessageController {
    public function __construct(Page $c, UserInfoRepository $repo) {
        parent::__construct($c, $repo, 'rcs');
    }

    protected function onSubmit(array $recipients) {
        $res = $this->client->rcs((new RcsParams)
            ->setForeignId($this->config['foreign_id'])
            ->setFrom($this->config['from'])
            ->setLabel($this->config['label'])
            ->setPerformanceTracking((bool)$this->config['performance_tracking'])
            ->setText($this->getText())
            ->setTo(implode(',', $recipients)));

        $this->setMessage($res);
    }
}
