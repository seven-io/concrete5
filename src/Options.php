<?php
namespace Sms77\Concrete5;

use ReflectionClass;

abstract class Options {
    const general = [
        'apiKey' => null,
    ];

    const sms = [
        'debug' => false,
        'flash' => false,
        'foreign_id' => null,
        'from' => null,
        'label' => null,
        'no_reload' => false,
        'performance_tracking' => false,
    ];

    const voice = [
        'from' => null,
    ];

    public static function all() {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function keys() {
        return array_keys(self::all());
    }
}