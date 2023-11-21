<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Options {
    /** @var array $general */
    public static $general = [
        'apiKey' => null,
    ];

    /** @var array $sms */
    public static $sms = [
        'flash' => false,
        'foreign_id' => null,
        'from' => null,
        'label' => null,
        'no_reload' => false,
        'performance_tracking' => false,
    ];

    /** @var array $voice */
    public static $voice = [
        'from' => null,
    ];

    /**
     * @return array
     */
    public static function all() {
        return (new ReflectionClass(static::class))->getStaticProperties();
    }

    /**
     * @return array
     */
    public static function keys() {
        return array_keys(self::all());
    }
}
