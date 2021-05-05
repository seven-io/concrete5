<?php
namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard;

use Concrete\Package\Sms77\AbstractSinglePageDashboardController;
use Concrete\Package\Sms77\Controller;
use Concrete\Package\Sms77\Routes;

class Sms77 extends AbstractSinglePageDashboardController {
    public function submit() {
        $msg = '';

        if ($this->isValidSubmission()) {
            foreach (Controller::$options as $group => $data) {
                foreach (array_keys($data) as $setting) {
                    $this->Config->save("$group.$setting", $this->post("$group:$setting"));
                }
            }

            $msg = t('Settings updated!');
        }

        $to = Routes::getAbsoluteURL(Routes::DASHBOARD);
        if ('' !== $msg) $to .= "?message=$msg";

        $this->redirect($to);
    }

    public function view() {
        $this->set('message', $this->get('message'));

        foreach (array_keys(Controller::$options) as $group) {
            $this->set($group, $this->config[$group]);
        }
    }
}