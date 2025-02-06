<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Routes {
    public const BULK_RCS = '/dashboard/seven/bulk_rcs';

    public const BULK_SMS = '/dashboard/seven/bulk_sms';

    public const BULK_VOICE = '/dashboard/seven/bulk_voice';

    public const DASHBOARD = '/dashboard/seven';

    public static function all(): array {
        return (new ReflectionClass(static::class))->getConstants();
    }
}
