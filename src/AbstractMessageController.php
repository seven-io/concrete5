<?php
namespace Sms77\Concrete5;

use Concrete\Core\Page\Page;
use Concrete\Core\User\Group\Group;
use Concrete\Core\User\Group\GroupList;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;
use Sms77\Api\Client;

abstract class AbstractMessageController extends AbstractSinglePageDashboardController {
    const ALL_GROUPS_ID = -2; // ID used to send to all groups

    /** @var UserInfoRepository $repository */
    protected $repo;

    /** @var Client|null $client */
    protected $client;

    public function __construct(Page $c, UserInfoRepository $repo) {
        parent::__construct($c);
        $this->repo = $repo;
    }

    abstract protected function onSubmit();

    public function submit() {
        if ($this->isValidSubmission()) {
            $this->onSubmit();
        }

        $this->view();
    }

    protected function buildRecipients() {
        $to = [];

        foreach ($this->getGroupMembers() as $groupMember) {
            $phone = $groupMember->getAttribute('phone');

            if ($phone) {
                $to[] = $phone;
            }
        }

        if (!count($to)) {
            $this->error->add('No recipient(s) found.');
        }

        return $to;
    }

    protected function getText() {
        $text = $this->post('text', '');

        if ('' === $text) {
            $this->error->add(t('Text cannot be empty.'));
        }

        return $text;
    }

    public function on_start() {
        parent::on_start();

        $this->initClient();
    }

    /** @return void */
    public function view() {
        if (!$this->client) {
            $this->set('dashboardLink', Routes::getAbsoluteURL(Routes::DASHBOARD));
        }

        $this->set('group', $this->post('group', self::ALL_GROUPS_ID));
        $this->setGroups();
    }

    private function setGroups() {
        $groups = [self::ALL_GROUPS_ID => t('All Groups')];

        foreach ((new GroupList)->getResults() as $group) {
            /** @var Group $group */
            $groups[$group->getGroupID()] = $group->getGroupDisplayName();
        }

        $this->set('groups', $groups);
    }

    /** @return UserInfo[] */
    private function getGroupMembers() {
        $groupId = (int)$this->post('filter_group');
        if ($groupId === self::ALL_GROUPS_ID) { // groupID is set to "All"
            return $this->repo->all(true); // return all active users
        }

        $group = Group::getByID($groupId);
        if (!$group) {
            $this->error->add(t('Group with ID %s not found.', $groupId));

            return null;
        }

        return $group->getGroupMembers();
    }

    private function initClient() {
        $apiKey = $this->config['general']['apiKey'];

        if ('' === $apiKey) {
            $this->error->add(t('An API key is needed for sending.'));
        }
        else {
            $this->client = new Client($apiKey, 'concrete5');
        }
    }

    protected function buildExtraParams($configKey, $extras = []) {
        $cfg = $this->config[$configKey];

        foreach ($cfg as $k => $v) {
            if ('' === $v) { // TODO: sms77/api throws on empty string values
                unset($cfg[$k]);
            }
        }

        return array_merge($cfg, ['json' => true], $extras);
    }
}