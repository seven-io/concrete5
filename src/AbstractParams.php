<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class AbstractParams {
    private string|null $from;

    private string|null $text;

    private string|null $to;

    /**
     * @unused
     */
    private bool $json = true;

    public function toArray(): array {
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
}
