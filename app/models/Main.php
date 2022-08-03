<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
    public $sError;
    public function contactValidate($aPostData) {
        $sName = $aPostData['name'];
        $sEmail = $aPostData['email'];
        $sMessage = $aPostData['text'];
        if (!$sName) {
            $this->sError = 'Empty Name';
            return false;
        } elseif (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
            $this->sError = 'Wrong Email';
            return false;
        } elseif (mb_strlen($sMessage) < 10 || mb_strlen($sMessage) > 1000) {
            $this->sError = 'Message length should be from 10 to 1000 symbols';
            return false;
        }
        return true;
    }

    public function contactsCount() {
        return $this->oDb->column('SELECT COUNT(id) FROM contacts');
    }

    public function contactsList($aRouteParams) {
        $iMax = 10;
        $aParams = [
            'max' => $iMax,
            'start' => (((isset($aRouteParams['page']) ? $aRouteParams['page'] : 1) - 1) * $iMax),
        ];
        return $this->oDb->row('SELECT * FROM contacts ORDER BY id DESC LIMIT :start, :max', $aParams);
    }
}