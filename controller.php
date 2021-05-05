<?php
namespace Concrete\Package\Sms77;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Config\Repository\Liaison;
use Concrete\Core\Database\Connection\Connection;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Http\Request;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Page\Page;
use Concrete\Core\Page\Single as SinglePage;
use Exception;
use ReflectionClass;
use Sms77\Api\Client;

abstract class AbstractSinglePageDashboardController extends DashboardPageController {
    /** @var array $config */
    protected $config;

    /** @var Liaison $Config */
    protected $Config;

    public function __construct(Page $c) {
        parent::__construct($c);

        $this->setConfig();
    }

    private function setConfig() {
        $pkg = Package::getByHandle('sms77');
        assert($pkg instanceof PackageEntity);

        $ctrl = $pkg->getController();
        assert($ctrl instanceof Controller);

        $this->Config = $ctrl->getConfig();
        assert($this->Config instanceof Controller);

        foreach (array_keys(Controller::$options) as $k) {
            $this->config[$k] = $this->Config->get($k);
        }
    }

    protected function initClient($apiKey) {
        return new Client($apiKey, 'concrete5');
    }

    protected function isValidSubmission() {
        $req = $this->getRequest();

        if ($req instanceof Request && $req::isPost()
            && $this->token->validate('submit')) {
            return true;
        }

        $this->error->add(t('Invalid submission!'));

        return false;
    }
}

abstract class Routes {
    const DASHBOARD = '/dashboard/sms77';
    const BULK_SMS = '/dashboard/sms77/bulk_sms';

    public static function all() {
        $class = new ReflectionClass(static::class);
        return $class->getConstants();
    }

    public static function getAbsoluteURL($route) {
        return Page::getByPath($route)->getCollectionLink();
    }
}

class Controller extends Package {
    const MIN_PHP_VERSION = '5.6.0';

    public static $options = [
        'general' => [
            'apiKey' => null,
        ],
        'sms' => [
            'debug' => false,
            'flash' => false,
            'foreign_id' => null,
            'from' => null,
            'label' => null,
            'no_reload' => false,
            'performance_tracking' => false,
        ],
    ];
    protected $appVersionRequired = '5.7.4.3b1';
    protected $pkgHandle = 'sms77';
    protected $pkgVersion = '1.0';

    public function getPackageDescription() {
        return t('Send SMS via Sms77.');
    }

    public function getPackageName() {
        return t('Sms77');
    }

    private function commonTasks($pkg) {
        if (version_compare(PHP_VERSION, self::MIN_PHP_VERSION, '<')) {
            throw new Exception(sprintf("PHP %s or greater needed to use this package.",
                self::MIN_PHP_VERSION));
        }

        $this->on_start();

        $this->installContentFile('install.xml');

        $this->getConfig();

        foreach (self::$options as $group => $arr) {
            foreach ($arr as $k => $default) {
                $key = "$group.$k";

                if ($this->config->has($key)) {
                    continue;
                }

                $this->config->save($key, is_bool($default) ? (int)$default : $default);
            }
        }

        foreach (Routes::all() as $route) {
            SinglePage::add($route, $pkg);
        }
    }

    public function install() {
        $this->commonTasks(parent::install());
    }

    public function upgrade() {
        parent::upgrade();

        $this->commonTasks($this->getPackageEntity());
    }

    public function uninstall() {
        parent::uninstall();

        /** @var Connection $db */
        $db = \Database::connection();
        $db->createQueryBuilder()->delete('Config')
            ->where('configNamespace = :namespace')
            ->setParameters([':namespace' => $this->pkgHandle])->execute();
    }

    /** Initialize the autoloader when the system boots up. */
    public function on_start() {
        $file = $this->getPackagePath() . '/vendor/autoload.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
}