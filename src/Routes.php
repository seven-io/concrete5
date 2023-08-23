<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use ReflectionClass;

abstract class Routes {
    /** @var string $BULK_SMS */
    public static $BULK_SMS = '/dashboard/seven/bulk_sms';

    /** @var string $BULK_VOICE */
    public static $BULK_VOICE = '/dashboard/seven/bulk_voice';

    /** @var string $DASHBOARD */
    public static $DASHBOARD = '/dashboard/seven';

    /**
     * @return array
     */
    public static function all(){
        return (new ReflectionClass(static::class))->getStaticProperties();
    }
}
