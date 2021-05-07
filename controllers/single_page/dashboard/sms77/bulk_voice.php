<?php
namespace Concrete\Package\Sms77\Controller\SinglePage\Dashboard\Sms77;

use Sms77\Concrete5\AbstractMessageController;

class BulkVoice extends AbstractMessageController {
    protected function onSubmit() {
        $text = $this->getText();

        if (!$this->error->has()) {
            $extraParams = $this->buildExtraParams(
                'voice', ['xml' => $this->post('xml', false)]);

            foreach ($this->buildRecipients() as $to) {
                $msg[] = $this->client->voice($to, $text, $extraParams);
            }

            if (isset($msg)) {
                $this->set('message', implode(PHP_EOL, $msg));
            }
        }
    }
}