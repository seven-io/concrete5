<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Options {
    public const general = [
        'apiKey' => null,
    ];

    public const sms = [
        'debug' => false,
        'flash' => false,
        'foreign_id' => null,
        'from' => null,
        'label' => null,
        'no_reload' => false,
        'performance_tracking' => false,
    ];

    public const voice = [
        'from' => null,
    ];

    public static function all(): array {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function keys(): array {
        return array_keys(self::all());
    }
}