<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

trait ToArray {
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
}
