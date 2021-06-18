<?php declare(strict_types=1);
namespace Sms77\Concrete5;

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Config\Repository\Liaison;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Http\Request;
use Concrete\Core\Package\Package;
use Concrete\Core\Page\Controller\DashboardPageController;
use Concrete\Core\Page\Page;
use Concrete\Package\Sms77\Controller;

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

        foreach (Options::keys() as $k) {
            $this->config[$k] = $this->Config->get($k);
        }
    }

    protected function isValidSubmission(): bool {
        $req = $this->getRequest();

        if ($req instanceof Request && $req::isPost()
            && $this->token->validate('submit')) {
            return true;
        }

        $this->error->add(t('Invalid submission!'));

        return false;
    }
}
