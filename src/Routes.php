<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use ReflectionClass;

abstract class Routes {
    public static $BULK_SMS = '/dashboard/sms77/bulk_sms';
    public static $BULK_VOICE = '/dashboard/sms77/bulk_voice';
    public static $DASHBOARD = '/dashboard/sms77';

    public static function all(): array {
        return (new ReflectionClass(static::class))->getStaticProperties();
    }

    public static function getAbsoluteURL(string $route): string {
        return Page::getByPath($route)->getCollectionLink();
    }
}
