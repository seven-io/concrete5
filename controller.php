<?php namespace Concrete\Package\Seven;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Single as SinglePage;
use Exception;
use Seven\Concrete5\Options;
use Seven\Concrete5\Routes;

final class Controller extends Package {
    /** @var string $MIN_PHP_VERSION */
    private $MIN_PHP_VERSION = '5.6.0';

    /** @var string $appVersionRequired */
    protected $appVersionRequired = '8.5.2';

    /** @var string[] $pkgAutoloaderRegistries */
    protected $pkgAutoloaderRegistries = [
        'src' => '\Seven\Concrete5',
    ];

    /** @var string $pkgHandle */
    protected $pkgHandle = 'seven';

    /** @var string $pkgVersion */
    protected $pkgVersion = '2.3.1';

    /** @return string */
    public function getPackageDescription() {
        return t('Send SMS via seven.');
    }

    /** @return string */
    public function getPackageName() {
        return t('seven');
    }

    /**
     * @param PackageEntity $pkg
     * @throws Exception
     */
    private function commonTasks(PackageEntity $pkg) {
        if (version_compare(PHP_VERSION, $this->MIN_PHP_VERSION, '<')) {
            throw new Exception(sprintf('PHP %s or greater needed to use this package.',
                $this->MIN_PHP_VERSION));
        }

        $this->installContentFile('install.xml');

        $this->getConfig();

        foreach (Options::all() as $group => $arr) {
            foreach ($arr as $k => $default) {
                $key = $group . '.' . $k;

                if ($this->config->has($key)) {
                    continue;
                }

                $this->config->save($key, (string)(is_bool($default) ? (int)$default : $default));
            }
        }

        foreach (Routes::all() as $route) {
            SinglePage::add($route, $pkg);
        }
    }

    /** @throws Exception */
    public function install() {
        $this->commonTasks(parent::install());
    }

    /** @throws Exception */
    public function upgrade() {
        parent::upgrade();

        $this->commonTasks($this->getPackageEntity());
    }

    /**
     *
     */
    public function uninstall() {
        parent::uninstall();

        /** @var Connection $db */
        $db = $this->app->make('database/connection');
        $db->createQueryBuilder()->delete('Config')
            ->where('configNamespace = :namespace')
            ->setParameters([':namespace' => $this->pkgHandle])->execute();
    }
}
