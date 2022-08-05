<?php

namespace app\models;

use app\core\Model;

class User extends Model
{
    public $sError;

    public function userLoginValidate($aPostData) {
        $sEmail = $aPostData['email'];
        $sPassword = md5($aPostData['password']);
        $aParams = [
            'email' => $sEmail,
            'password' => $sPassword
        ];
        if (!$sEmail || !$sPassword) {
            $this->sError = 'Wrong email or password';
            return false;
        } else {
            $sSQL = 'SELECT id, name, email FROM users WHERE email = :email AND password = :password';
            $aUserData = $this->oDb->row($sSQL, $aParams);
            if (!$aUserData) {
                $this->sError = 'Wrong email or password';
                return false;
            }
        }

        $_SESSION['auth']['user_id'] = $aUserData[0]['id'];
        return true;
    }

    public function registerValidate($aPostData) {
        $sName = $aPostData['name'];
        $sEmail = $aPostData['email'];
        $sPassword = $aPostData['password'];
        $sPasswordConfirm = $aPostData['password_confirm'];
        if (!$sName || mb_strlen($sName) < 2 && mb_strlen($sName) > 50) {
            $this->sError = 'Username length should be from 2 to 50';
            return false;
        } elseif (!filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
            $this->sError = 'Wrong Email';
            return false;
        }
        if (!$sPassword) {
            $this->sError = 'Empty password';
            return false;
        } else {
            if ($sPassword != $sPasswordConfirm) {
                $this->sError = 'Confirm password is wrong';
                return false;
            }
        }
        return true;
    }

    public function registerUser($aPostData) {
        $aTableData = [
            'id' => '',
            'name' => $aPostData['name'],
            'email' => $aPostData['email'],
            'password' => md5($aPostData['password']),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => NULL,
        ];
        $sSql = 'INSERT INTO users VALUES (:id, :name, :email, :password, :created_at, :updated_at)';
        $this->oDb->query($sSql, $aTableData);
        return $this->oDb->lastInsertId();
    }

    public function getCountOfFavourites($sUserId) {
        $aParams = [
            'user_id' => $sUserId
        ];
        $sSql = 'SELECT COUNT(user_id) FROM favourites WHERE user_id = :user_id';
        return $this->oDb->column($sSql, $aParams);
    }

    public function getFavouriteContacts($sUserId) {
        $aParams = [
            'user_id' => $sUserId
        ];
        $sSql = 'SELECT contact.* FROM contacts contact JOIN favourites favourite ON contact.id = favourite.contact_id AND favourite.user_id = :user_id';
        return $this->oDb->row($sSql, $aParams);
    }
    public function saveFavourites($aPostData) {
        $aTableData = [
            'id' => '',
            'user_id' => $aPostData['user_id'],
            'contact_id' => $aPostData['contact_id'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $aParams = [
            'user_id' => $aPostData['user_id'],
            'contact_id' => $aPostData['contact_id'],
        ];
        $sSqlCount = 'SELECT COUNT(user_id) FROM favourites WHERE user_id = :user_id AND contact_id = :contact_id';
        $iCount = $this->oDb->column($sSqlCount, $aParams);
        if (!$iCount) {
            $sSql = 'INSERT INTO favourites VALUES (:id, :user_id, :contact_id, :created_at)';
            $this->oDb->query($sSql, $aTableData);
        }
    }

    public function deleteFavouriteContact($aPostData) {
        $aParams = [
            'user_id' => $aPostData['user_id'],
            'contact_id' => $aPostData['contact_id'],
        ];
        $this->oDb->query('DELETE FROM favourites WHERE user_id = :user_id AND contact_id = :contact_id', $aParams);
        $this->setValueColumnIsFavourite($aPostData['user_id'], $aPostData['contact_id'], 0);
    }

    public function setValueColumnIsFavourite($sUserId, $sContactsId, $isFavourite) {
        $aParams = [
            'contact_id' => $sContactsId,
            'is_favourite' => $isFavourite,
            'user_id' => $sUserId
        ];
        $this->oDb->query('UPDATE contacts SET is_favourite = :is_favourite WHERE id IN (SELECT contact_id FROM favourites WHERE user_id = :user_id AND contact_id = :contact_id)', $aParams);
    }

    public function getAllContacts($sUserId, $aRouteParams) {
        $iMax = 10;
        $aParams = [
            'max' => $iMax,
            'start' => (((isset($aRouteParams['page']) ? $aRouteParams['page'] : 1) - 1) * $iMax),
        ];
        return $this->oDb->row('SELECT * FROM contacts ORDER BY id DESC LIMIT :start, :max', $aParams);
    }
}