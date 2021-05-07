<?php
namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard\Sms77;

use Sms77\Concrete5\AbstractMessageController;

class BulkSms extends AbstractMessageController {
    protected function onSubmit() {
        $text = $this->getText();
        $to = implode(',', $this->buildRecipients());

        if (!$this->error->has()) {
            $this->set('message', $this->client
                ->sms($to, $text, $this->buildExtraParams('sms', ['type' => 'direct',])));
        }
    }
}