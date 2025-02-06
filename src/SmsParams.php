<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class SmsParams {
    use ToArray;

    private ?bool $flash;
    private ?bool $performance_tracking;
    private ?string $delay;
    private ?string $foreign_id;
    private ?string $from;
    private ?string $label;
    private ?string $text;
    private ?string $to;

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


    public function getDelay(): ?string {
        return $this->delay;
    }

    public function setDelay(?string $delay): static {
        $this->delay = $delay;

        return $this;
    }

    public function getFlash(): ?bool {
        return $this->flash;
    }

    public function setFlash(?bool $flash): static {
        $this->flash = $flash;

        return $this;
    }

    public function getForeignId(): ?string {
        return $this->foreign_id;
    }

    public function setForeignId(?string $foreign_id): static {
        $this->foreign_id = $foreign_id;

        return $this;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $label): static {
        $this->label = $label;

        return $this;
    }

    public function getPerformanceTracking(): ?bool {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(?bool $performance_tracking): static {
        $this->performance_tracking = $performance_tracking;

        return $this;
    }
}
