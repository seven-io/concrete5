<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

class SmsParams extends AbstractParams {
    private $delay;
    private $flash;
    private $foreign_id;
    private $label;
    private $no_reload;
    private $performance_tracking;

    public function getDelay(): ?string {
        return $this->delay;
    }

    public function setDelay(?string $delay): self {
        $this->delay = $delay;

        return $this;
    }

    public function getFlash(): ?bool {
        return $this->flash;
    }

    public function setFlash(?bool $flash): self {
        $this->flash = $flash;

        return $this;
    }

    public function getForeignId(): ?string {
        return $this->foreign_id;
    }

    public function setForeignId(?string $foreign_id): self {
        $this->foreign_id = $foreign_id;

        return $this;
    }

    public function getLabel(): ?string {
        return $this->label;
    }

    public function setLabel(?string $label): self {
        $this->label = $label;

        return $this;
    }

    public function getNoReload(): ?bool {
        return $this->no_reload;
    }

    public function setNoReload(?bool $no_reload): self {
        $this->no_reload = $no_reload;

        return $this;
    }

    public function getPerformanceTracking(): ?bool {
        return $this->performance_tracking;
    }

    public function setPerformanceTracking(?bool $performance_tracking): self {
        $this->performance_tracking = $performance_tracking;

        return $this;
    }
}
