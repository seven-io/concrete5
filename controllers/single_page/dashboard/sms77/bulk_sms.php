<?php
namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard\Sms77;

use Concrete\Core\Page\Page;
use Concrete\Core\User\Group\Group;
use Concrete\Core\User\Group\GroupList;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;
use Concrete\Package\Sms77\AbstractSinglePageDashboardController;
use Concrete\Package\Sms77\Routes;

class BulkSms extends AbstractSinglePageDashboardController {
    const ALL_GROUPS_ID = -2; // ID used to send to all groups

    /** @var UserInfoRepository $repository */
    private $repo;

    public function __construct(Page $c, UserInfoRepository $repo) {
        parent::__construct($c);

        $this->repo = $repo;
    }

    public function submit() {
        if ($this->isValidSubmission()) {
            $text = $this->getText();
            $apiKey = $this->getApiKey();
            $to = $this->buildRecipients();

            if (!$this->error->has()) {
                $this->set('message', $this->initClient($apiKey)
                    ->sms($to, $text, $this->buildExtraParams()));
            }
        }

        $this->view();
    }

    private function getText() {
        $text = $this->post('text', '');

        if ('' === $text) $this->error->add(t('Text cannot be empty.'));

        return $text;
    }

    private function getApiKey() {
        $apiKey = $this->config['general']['apiKey'];

        if ('' === ($apiKey || '')) $this->error->add(t('API key cannot be empty.'));

        return $apiKey;
    }

    private function buildRecipients() {
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

        return implode(',', $to);
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

    private function buildExtraParams() {
        return array_merge($this->config['sms'], [
            'json' => true,
            'type' => 'direct',
        ]);
    }

    /** @return void */
    public function view() {
        if ('' === $this->config['general']['apiKey']) {
            $this->error->add(t('An API key is needed for sending.'));

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
}