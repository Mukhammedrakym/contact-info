<?php

namespace app\core;

class View
{
    public $sPath;
    public $aRouteParams;
    public $sLayout = 'default';

    public function __construct($aRouteParams)
    {
        $this->aRouteParams = $aRouteParams;
        $this->sPath = $aRouteParams['controller'] . '/' . $aRouteParams['action'];
    }

    public function render($sTitle, $aData = []) {
        extract($aData);
        $sViewPagePath = 'app/views/' . $this->sPath . '.php';
        if (file_exists($sViewPagePath)) {
            ob_start();
            require $sViewPagePath;
            $sContent = ob_get_clean();
            require 'app/views/layouts/' . $this->sLayout . '.php';
        }
    }

    public static function errorCode($iCode) {
        http_response_code($iCode);
        $sPathErrorPage = 'app/views/errors/' . $iCode . '.php';
        require $sPathErrorPage;
        exit;
    }

    public function redirect($sUrl) {
        header('location: '. $sUrl);
        exit;
    }

    public  function message($sStatus, $sMessage) {
        exit(json_encode(['status' => $sStatus, 'message' => $sMessage]));
    }

    public function location($sUrl) {
        exit(json_encode(['url' => $sUrl]));
    }
}