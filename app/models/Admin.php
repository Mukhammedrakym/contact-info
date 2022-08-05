<?php

namespace app\models;

use app\core\Model;

class Admin extends Model
{
    public $sError;

    public function loginValidate($aPostData) {
        $aConfig = require 'app/config/admin.php';
        if ($aPostData['login'] != $aConfig['login'] || $aPostData['password'] != $aConfig['password']) {
            $this->sError = 'Wrong login or password';
            return false;
        }
        return true;
    }

    public  function contactValidate($aPostData, $sTypeAction) {
        $sUserName = $aPostData['name'];
        $sEmail = $aPostData['email'];
        $sPhone = $aPostData['phone'];
        if (mb_strlen($sUserName) < 3 || mb_strlen($sUserName) > 30) {
            $this->sError = 'Username length should be from 3 to 30 symbols';
            return false;
        } elseif (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
            $this->sError = 'Wrong Email';
            return false;
        } elseif (!filter_var($sPhone, FILTER_SANITIZE_NUMBER_INT) || strlen($sPhone) != 10) {
            $this->sError = 'Phone Number shold be 7778881122';
            return false;
        }
        return true;
    }

    public function createContact($aPostData) {
        $aTableData = [
            'id' => '',
            'name' => $aPostData['name'],
            'email' => $aPostData['email'],
            'phone' => $aPostData['phone'],
            'is_favourite' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => ''
        ];
        $sSql = 'INSERT INTO contacts VALUES (:id, :name, :email, :phone, :is_favourite :created_at, :updated_at)';
        $this->oDb->query($sSql, $aTableData);
    }

    public function contactEdit($aPostData, $id) {
        $aParams = [
            'id' => $id,
            'name' => $aPostData['name'],
            'email' => $aPostData['email'],
            'phone' => $aPostData['phone'],
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->oDb->query('UPDATE contacts SET name = :name, email = :email, phone = :phone, updated_at = :updated_at WHERE id = :id', $aParams);
    }

    public function isContactExists($id) {
        $aParams = [
            'id' => $id,
        ];
        return $this->oDb->column('SELECT id FROM contacts WHERE id = :id', $aParams);
    }

    public function contactDelete($id) {
        $aParams = [
            'id' => $id,
        ];
        $this->oDb->query('DELETE FROM contacts WHERE id = :id', $aParams);
    }

    public function contactDatabyId($id) {
        $aParams = [
            'id' => $id,
        ];
        return $this->oDb->row('SELECT * FROM contacts WHERE id = :id', $aParams);
    }
    public function getAllContacts() {
        return $this->oDb->row('SELECT * FROM contacts');
    }
}