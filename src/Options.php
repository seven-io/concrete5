<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Options {
    public static array $general = [
        'apiKey' => null,
    ];

    public static array $sms = [
        'flash' => false,
        'foreign_id' => null,
        'from' => null,
        'label' => null,
        'no_reload' => false,
        'performance_tracking' => false,
    ];

    public static array $voice = [
        'from' => null,
    ];

    public static function all(): array {
        return (new ReflectionClass(static::class))->getStaticProperties();
    }

    public static function keys(): array {
        return array_keys(self::all());
    }
}
