<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class VoiceParams extends AbstractParams {
    private $xml;

    public function getXml(): ?bool {
        return $this->xml;
    }

    public function setXml(?bool $xml): self {
        $this->xml = $xml;

        return $this;
    }
}
