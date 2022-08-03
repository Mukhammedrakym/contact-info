<?php

namespace app\core;
use app\core\View;
abstract class Controller
{
    public $aRouteParams;
    public $oView;
    public $aAcl;
    public $oModel;

    public function __construct($aRouteParams) {
        $this->aRouteParams = $aRouteParams;
        if(!$this->checkAcl()) {
            View::errorCode(403);
        }
        $this->oView = new View($aRouteParams);
        $this->oModel = $this->loadModel($aRouteParams['controller']);
    }

    public function loadModel($sNameModel) {
        $sPathModel = 'app\models\\' . ucfirst($sNameModel);
        if (class_exists($sPathModel)) {
            return new $sPathModel;
        }

    }

    public  function checkAcl() {
        $this->aAcl = require 'app/acl/' . $this->aRouteParams['controller'] . '.php';
        if ($this->isAcl('guest')) {
            return true;
        } elseif (isset($_SESSION['auth']['user_id']) && $this->isAcl('auth')) {
            return true;
        } elseif (!isset($_SESSION['auth']['user_id']) && $this->isAcl('guest')) {
            return true;
        } elseif (isset($_SESSION['admin']) && $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    public  function isAcl($sAccessType) {
        return in_array($this->aRouteParams['action'], $this->aAcl[$sAccessType]);
    }
}