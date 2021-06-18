<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class AbstractParams {
    private $debug;
    private $from;
    private $text;
    private $to;

    /**
     * @unused
     * @var bool $json
     */
    private $json = true;

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

    public function getDebug(): ?bool {
        return $this->debug;
    }

    public function setDebug(?bool $debug): self {
        $this->debug = $debug;

        return $this;
    }

    public function getFrom(): ?string {
        return $this->from;
    }

    public function setFrom(?string $from): self {
        $this->from = $from;

        return $this;
    }

    public function getText(): ?string {
        return $this->text;
    }

    public function setText(string $text): self {
        $this->text = $text;

        return $this;
    }

    public function getTo(): ?string {
        return $this->to;
    }

    public function setTo(string $to): self {
        $this->to = $to;

        return $this;
    }
}
