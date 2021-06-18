<?php declare(strict_types=1);
namespace Concrete\Package\Sms77;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Exception;
use Sms77\Concrete5\Options;
use Sms77\Concrete5\Routes;

final class Controller extends Package {
    private $MIN_PHP_VERSION = '7.3.0';

    protected $appVersionRequired = '8.5.2';
    protected $pkgAutoloaderRegistries = [
        'src' => '\Sms77\Concrete5',
    ];
    protected $pkgHandle = 'sms77';
    protected $pkgVersion = '2.0.0';

    public function getPackageDescription(): string {
        return t('Send SMS via Sms77.');
    }

    public function getPackageName(): string {
        return t('Sms77');
    }

    private function commonTasks(PackageEntity $pkg): void {
        if (version_compare(PHP_VERSION, $this->MIN_PHP_VERSION, '<')) {
            throw new Exception(sprintf('PHP %s or greater needed to use this package.',
                $this->MIN_PHP_VERSION));
        }

        $this->installContentFile('install.xml');

        $this->getConfig();

        foreach (Options::all() as $group => $arr) {
            foreach ($arr as $k => $default) {
                $key = "$group.$k";

                if ($this->config->has($key)) {
                    continue;
                }

                $this->config->save(
                    $key, (string)(is_bool($default) ? (int)$default : $default));
            }
        }

        foreach (Routes::all() as $route) {
            SinglePage::add($route, $pkg);
        }
    }

    public function install(): void {
        $this->commonTasks(parent::install());
    }

    public function upgrade(): void {
        parent::upgrade();

        $this->commonTasks($this->getPackageEntity());
    }

    public function uninstall(): void {
        parent::uninstall();

        /** @var Connection $db */
        $db = \Database::connection();
        $db->createQueryBuilder()->delete('Config')
            ->where('configNamespace = :namespace')
            ->setParameters([':namespace' => $this->pkgHandle])->execute();
    }
}
