<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class VoiceParams {
    private string|null $from;

    private string|null $text;

    private string|null $to;

    /**
     * @unused
     */
    private bool $json = true;

    public function getFrom(): string|null {
        return $this->from;
    }

    /**
     * @param string|null $from
     * @return $this
     */
    public function setFrom($from) {
        $this->from = $from;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText() {
        return $this->text;
    }

    public function setText(string $text): self {
        $this->text = $text;

        return $this;
    }

    public function getTo(): string|null {
        return $this->to;
    }

    public function setTo(string $to): self {
        $this->to = $to;

        return $this;
    }

    private bool|null $xml;

    public function getXml(): bool|null {
        return $this->xml;
    }

    public function setXml(bool|null $xml): self {
        $this->xml = $xml;

        return $this;
    }
}
