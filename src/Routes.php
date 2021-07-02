<?php namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use ReflectionClass;

abstract class Routes {
    /** @var string $BULK_SMS */
    public static $BULK_SMS = '/dashboard/sms77/bulk_sms';

    /** @var string $BULK_VOICE */
    public static $BULK_VOICE = '/dashboard/sms77/bulk_voice';

    /** @var string $DASHBOARD */
    public static $DASHBOARD = '/dashboard/sms77';

    /**
     * @return array
     */
    public static function all(){
        return (new ReflectionClass(static::class))->getStaticProperties();
    }

    /**
     * @param string $route
     * @return string
     */
    public static function getAbsoluteURL($route) {
        return Page::getByPath($route)->getCollectionLink();
    }
}
