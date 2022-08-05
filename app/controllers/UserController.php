<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Pagination;
use app\models\Main;

class UserController extends Controller
{
    public function __construct($aRouteParams)
    {
        parent::__construct($aRouteParams);
        $this->oView->sLayout = 'user';
    }

    public function loginAction() {
//        if (isset($_SESSION['auth']['user_id'])) {
//            $this->oView->redirect('contacts');
//        }
        if (!empty($_POST)) {
            if (!$this->oModel->userLoginValidate($_POST)) {
                $this->oView->message('error', $this->oModel->sError);
            }
            $this->oView->location('user/contacts');
        }
        $this->oView->render('Login Page');
    }

    public function logoutAction() {
        unset($_SESSION['auth']['user_id']);
        $this->oView->redirect('login');
    }

    public function registerAction() {
        if (!empty($_POST)) {
            if (!$this->oModel->registerValidate($_POST)) {
                $this->oView->message('error', $this->oModel->sError);
            }
            $sUserId = $this->oModel->registerUser($_POST);
            if (!$sUserId) {
                $this->oView->message('error', 'Request processing error');
            }
            $_SESSION['auth']['user_id'] = $sUserId;
            $this->oView->location('user/contacts');
        }
        $this->oView->render('Registration');
    }

    public function contactsAction() {
        $sUserId = $_SESSION['auth']['user_id'];
        $oMain = new Main;
        $oPagination = new Pagination($this->aRouteParams, $oMain->contactsCount());
        $aData = [
            'pagination' => $oPagination->get(),
            'aContacts' => $oMain->contactsList($this->aRouteParams),
            'aFavourites' => $this->oModel->getFavouriteContacts($sUserId),
        ];
        $this->oView->render('Contacts', $aData);

    }
    public function favouritesAction() {
        $sUserId = $_SESSION['auth']['user_id'];
        $oPagination = new Pagination($this->aRouteParams, $this->oModel->getCountOfFavourites($sUserId));
        $aFavouriteData = [
            'pagination' => $oPagination->get(),
            'aFavourites' => $this->oModel->getFavouriteContacts($sUserId),
        ];
        $this->oView->render('Favourites', $aFavouriteData);
    }
    public function saveContactToFavouritesAction() {
        if (!empty($_POST)) {
            $this->oModel->saveFavourites($_POST);
        }
    }

    public function deleteContactFromFavouritesAction() {
        if (!empty($_POST)) {
            $this->oModel->deleteFavouriteContact($_POST);
        }
    }
}