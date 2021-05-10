<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use ReflectionClass;

abstract class Routes {
    public const BULK_SMS = self::DASHBOARD . '/bulk_sms';
    public const BULK_VOICE = self::DASHBOARD . '/bulk_voice';
    public const DASHBOARD = '/dashboard/sms77';

    public static function all(): array {
        return (new ReflectionClass(static::class))->getConstants();
    }

    public static function getAbsoluteURL(string $route): string {
        return Page::getByPath($route)->getCollectionLink();
    }
}
