<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Http\Client\Client;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\Group\Group;
use Concrete\Core\User\Group\GroupList;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;

abstract class AbstractMessageController extends AbstractSinglePageDashboardController {
    public static int $ALL_GROUPS_ID = -2; // ID used to send to all groups

    protected UserInfoRepository $repo;

    protected ApiClient|null $client;

    private string $apiKey;

    public function __construct(Page $c, UserInfoRepository $repo, string $configKey) {
        parent::__construct($c);
        $this->repo = $repo;
        $this->apiKey = $this->config['general']['apiKey'];
        $this->config = $this->config[$configKey];
    }

    /**
     * @return mixed
     */
    abstract protected function onSubmit(array $recipients);

    /**
     *
     */
    public function submit() {
        if ($this->isValidSubmission()) {
            $to = $this->buildRecipients();

            if (!$this->error->has()) {
                $this->onSubmit($to);
            }
        }

        $this->view();
    }

    protected function buildRecipients(): array {
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

    protected function getText(): string {
        $text = $this->post('text', '');

        if ('' === $text) {
            $this->error->add(t('Text cannot be empty.'));
        }

        return $text;
    }

    /**
     * @param object $json
     */
    protected function encode($json): string {
        return json_encode($json, JSON_PRETTY_PRINT);
    }

    /**
     *
     */
    public function on_start() {
        parent::on_start();

        $this->initClient();
    }

    /** @return void */
    public function view() {
        if (!$this->client) {
            $this->set('dashboardLink', URL::to(Routes::$DASHBOARD));
        }

        $this->set('group', $this->post('group', self::$ALL_GROUPS_ID));
        $this->setGroups();
    }

    /**
     *
     */
    private function setGroups() {
        $groups = [self::$ALL_GROUPS_ID => t('All Groups')];

        foreach ((new GroupList)->getResults() as $group) {
            /** @var Group $group */
            $groups[$group->getGroupID()] = $group->getGroupDisplayName();
        }

        $this->set('groups', $groups);
    }

    /** @return UserInfo[] */
    private function getGroupMembers(): array|null {
        $groupId = (int)$this->post('filter_group');
        if ($groupId === self::$ALL_GROUPS_ID) { // groupID is set to "All"
            return $this->repo->all(true); // return all active users
        }

        $group = Group::getByID($groupId);
        if (!$group) {
            $this->error->add(t('Group with ID %s not found.', $groupId));

            return null;
        }

        return $group->getGroupMembers();
    }

    /**
     *
     */
    private function initClient(): void {
        if ('' === $this->apiKey) {
            $this->error->add(t('An API key is needed for sending.'));
            return;
        }

        /** @var Client $client */
        $client = $this->app->make('http/client');
        $this->client = new ApiClient($client, $this->apiKey);
    }

    protected function setMessage(string|array|null $msg): void {
        if (!isset($msg)) {
            $this->set('error', t('Nothing has been sent.'));
            return;
        }

        $this->set('apiResponses', is_array($msg) ? $msg : [$msg]);
    }
}
