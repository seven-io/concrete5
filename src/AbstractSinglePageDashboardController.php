<?php namespace Seven\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Config\Repository\Liaison;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Http\Request;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Page\Page;
use Concrete\Package\Seven\Controller;

abstract class AbstractSinglePageDashboardController extends DashboardPageController {
    /** @var array $config */
    protected $config;

    /** @var Liaison $Config */
    protected $Config;

    /**
     * @param Page $c
     */
    public function __construct(Page $c) {
        parent::__construct($c);
        $this->setConfig();
    }

    /**
     * @param $val
     * @return string
     */
    public static function stringify($val) {
        if (true === $val) return 'true';
        if (false === $val) return 'false';
        if (null === $val) return '-';
        return $val;
    }

    /**
     *
     */
    private function setConfig() {
        $pkg = Package::getByHandle('seven');
        assert($pkg instanceof PackageEntity);

        $ctrl = $pkg->getController();
        assert($ctrl instanceof Controller);

        $this->Config = $ctrl->getConfig();
        assert($this->Config instanceof Controller);

        foreach (Options::keys() as $k) {
            $this->config[$k] = $this->Config->get($k);
        }
    }

    /**
     * @return bool
     */
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
