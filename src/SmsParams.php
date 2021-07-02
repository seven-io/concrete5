<?php namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

/**
 *
 */
class SmsParams extends AbstractParams {
    /** @var string|null $delay */
    private $delay;

    /** @var bool|null $flash */
    private $flash;

    /** @var string|null $foreign_id */
    private $foreign_id;

    /** @var string|null $label */
    private $label;

    /** @var bool|null $no_reload */
    private $no_reload;

    /** @var bool|null $performance_tracking */
    private $performance_tracking;

    /**
     * @return string|null
     */
    public function getDelay(){
        return $this->delay;
    }

    /**
     * @param string|null $delay
     * @return $this
     */
    public function setDelay($delay) {
        $this->delay = $delay;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFlash(){
        return $this->flash;
    }

    /**
     * @param bool|null $flash
     * @return $this
     */
    public function setFlash($flash) {
        $this->flash = $flash;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getForeignId() {
        return $this->foreign_id;
    }

    /**
     * @param string|null $foreign_id
     * @return $this
     */
    public function setForeignId($foreign_id) {
        $this->foreign_id = $foreign_id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string|null $label
     * @return $this
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getNoReload() {
        return $this->no_reload;
    }

    /**
     * @param bool|null $no_reload
     * @return $this
     */
    public function setNoReload($no_reload) {
        $this->no_reload = $no_reload;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPerformanceTracking() {
        return $this->performance_tracking;
    }

    /**
     * @param bool|null $performance_tracking
     * @return $this
     */
    public function setPerformanceTracking($performance_tracking) {
        $this->performance_tracking = $performance_tracking;

        return $this;
    }
}
