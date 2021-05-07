<?php
namespace Sms77\Concrete5;

use Concrete\Core\Page\Page;
use ReflectionClass;

abstract class Routes {
    const DASHBOARD = '/dashboard/sms77';
    const BULK_SMS = self::DASHBOARD . '/bulk_sms';

    public static function all() {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function getAbsoluteURL($route) {
        return Page::getByPath($route)->getCollectionLink();
    }
}
