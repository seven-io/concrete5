<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

/**
 *
 */
class SmsParams extends AbstractParams {
    private string|null $delay;

    private bool|null $flash;

    private string|null $foreign_id;

    private string|null $label;

    private bool|null $no_reload;

    private bool|null $performance_tracking;

    public function getDelay(): string|null {
        return $this->delay;
    }

    public function setDelay(string|null $delay): self {
        $this->delay = $delay;

        return $this;
    }

    public function getFlash(): bool|null {
        return $this->flash;
    }

    public function setFlash(bool|null $flash): self {
        $this->flash = $flash;

        return $this;
    }

    public function getForeignId(): string|null {
        return $this->foreign_id;
    }

    public function setForeignId(string|null $foreign_id): self {
        $this->foreign_id = $foreign_id;

        return $this;
    }

    public function getLabel(): string|null {
        return $this->label;
    }

    public function setLabel(string|null $label): self {
        $this->label = $label;

        return $this;
    }

    public function getNoReload(): bool|null {
        return $this->no_reload;
    }

    public function setNoReload(bool|null $no_reload): self {
        $this->no_reload = $no_reload;

        return $this;
    }

    public function getPerformanceTracking(): bool|null {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(bool|null $performance_tracking): self {
        $this->performance_tracking = $performance_tracking;

        return $this;
    }
}
