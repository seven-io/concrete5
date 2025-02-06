<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class VoiceParams {
    private ?string $from;
    private ?string $text;
    private ?string $to;
    private ?bool $xml;

    /**
     * @unused
     */
    private bool $json = true;

    public function getFrom(): ?string {
        return $this->from;
    }

    public function setFrom(?string $from): static {
        $this->from = $from;

        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(string $text): static {
        $this->text = $text;

        return $this;
    }

    public function getTo(): ?string {
        return $this->to;
    }

    public function setTo(string $to): static {
        $this->to = $to;

        return $this;
    }


    public function getXml(): ?bool {
        return $this->xml;
    }

    public function setXml(?bool $xml): static {
        $this->xml = $xml;

        return $this;
    }
}
