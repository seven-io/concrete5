<?php namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class VoiceParams extends AbstractParams {
    /** @var bool|null $xml */
    private $xml;

    /**
     * @return bool|null
     */
    public function getXml() {
        return $this->xml;
    }

    /**
     * @param bool|null $xml
     * @return $this
     */
    public function setXml($xml) {
        $this->xml = $xml;

        return $this;
    }
}
