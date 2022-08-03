<?php

namespace app\core;
use app\core\View;

class Router {

    protected $aRoutes = [];
    protected $aParams = [];
    public function __construct()
    {
        $aRoutes = require 'app/config/routes.php';
        foreach ($aRoutes as $sRoute => $aVal) {
            $this->add($sRoute, $aVal);
        }
    }

    public function add($sRoute, $aParams)
    {
        $sRoute = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $sRoute);
        $sRoute = '#^' . $sRoute . '$#';
        $this->aRoutes[$sRoute] = $aParams;
    }

    public function match()
    {
        $sUrl = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->aRoutes as $sRoute => $aParams) {
            if (preg_match($sRoute, $sUrl, $aMatches)) {
                foreach ($aMatches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $aParams[$key] = $match;
                    }
                }
                $this->aParams = $aParams;
                return true;
            }
        }
        return false;
    }

    public function run() {
        if ($this->match()) {
            $sPathClass = 'app\controllers\\' . ucfirst($this->aParams['controller']) . 'Controller';

            if (class_exists($sPathClass)) {
                $sAction = $this->aParams['action'] . 'Action';
                if (method_exists($sPathClass, $sAction)) {
                    $oController = new $sPathClass($this->aParams);
                    $oController->$sAction();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}