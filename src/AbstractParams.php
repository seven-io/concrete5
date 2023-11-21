<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class AbstractParams {
    /** @var string|null $from */
    private $from;

    /** @var string|null $from */
    private $text;

    /** @var string|null $to */
    private $to;

    /**
     * @unused
     * @var bool $json
     */
    private $json = true;

    /**
     * @return array
     */
    public function toArray() {
        $arr = [];
        $reflect = new ReflectionClass($this);

        foreach (array_merge($reflect->getParentClass()->getProperties(),
            $reflect->getProperties()) as $property) {
            $property->setAccessible(true);
            $value = $property->getValue($this);

            if (is_bool($value)) {
                $value = (int)$value;
            }

            $arr[$property->getName()] = $value;
        }

        return $arr;
    }

    /**
     * @return string|null
     */
    public function getFrom() {
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

    /**
     * @param string $text
     * @return $this
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTo() {
        return $this->to;
    }

    /**
     * @param string $to
     * @return $this
     */
    public function setTo($to) {
        $this->to = $to;

        return $this;
    }
}
