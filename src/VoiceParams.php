<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class VoiceParams extends AbstractParams {
    private bool|null $xml;

    public function getXml(): bool|null {
        return $this->xml;
    }

    public function setXml(bool|null $xml): self {
        $this->xml = $xml;

        return $this;
    }
}
