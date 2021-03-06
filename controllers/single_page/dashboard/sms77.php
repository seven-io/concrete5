<?php namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Url;
use Sms77\Concrete5\AbstractSinglePageDashboardController;
use Sms77\Concrete5\Options;
use Sms77\Concrete5\Routes;

final class Sms77 extends AbstractSinglePageDashboardController {
    /**
     *
     */
    public function submit(){
        $msg = '';

        if ($this->isValidSubmission()) {
            foreach (Options::all() as $group => $data) {
                foreach (array_keys($data) as $setting) {
                    $this->Config->save(
                        "$group.$setting", $this->post("$group:$setting"));
                }
            }

            $msg = t('Settings updated!');
        }

        $to = Url::to(Routes::$DASHBOARD);
        if ('' !== $msg) $to .= "?message=$msg";

        $this->redirect($to);
    }

    /**
     *
     */
    public function view() {
        $this->set('message', $this->get('message'));

        foreach (Options::keys() as $group) {
            $this->set($group, $this->config[$group]);
        }
    }
}
