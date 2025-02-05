<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Routes {
    public static string $BULK_SMS = '/dashboard/seven/bulk_sms';

    public static string $BULK_VOICE = '/dashboard/seven/bulk_voice';

    public static string $DASHBOARD = '/dashboard/seven';

    public static function all(): array {
        return (new ReflectionClass(static::class))->getStaticProperties();
    }
}
