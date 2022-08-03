<?php

namespace app\controllers;
use app\core\Controller;
use app\models\Main;
use app\lib\Pagination;

class AdminController extends Controller
{
    public function __construct($aRouteParams)
    {
        parent::__construct($aRouteParams);
        $this->oView->sLayout = 'admin';
    }

    public function loginAction() {
//        if (isset($_SESSION['admin'])) {
//            $this->oView->redirect('admin/contacts');
//        }
        if (!empty($_POST)) {
            if (!$this->oModel->loginValidate($_POST)) {
                $this->oView->message('error', $this->oModel->sError);
            }
            $_SESSION['admin'] = 1;
            $this->oView->location('admin/contacts/create');
        }
        $this->oView->render('Log In');
    }

    public function logoutAction() {
        unset($_SESSION['admin']);
        $this->oView->redirect('login');
    }

    public function createAction() {
        if (!empty($_POST)) {
            if (!$this->oModel->contactValidate($_POST, 'create')) {
                $this->oView->message('error', $this->oModel->sError);
            }
            $this->oModel->createContact($_POST);
            $this->oView->message('success', 'OK');
            $this->oView->redirect('/admin/contacts');
        }
        $this->oView->render('Create contact');
    }

    public function editAction() {
        if (!$this->oModel->isContactExists($this->aRouteParams['id'])) {
            $this->oView->errorCode(404);
        }
        if (!empty($_POST)) {
            if (!$this->oModel->contactValidate($_POST, 'edit')) {
                $this->oView->message('error', $this->oModel->sError);
            }
            $this->oModel->contactEdit($_POST, $this->aRouteParams['id']);
            $this->oView->message('success', 'Saved');
        }
        $aData = [
            'aData' => $this->oModel->contactDatabyId($this->aRouteParams['id'])[0],
        ];
        $this->oView->render('Edit contact', $aData);
    }

    public function deleteAction() {
        if (!$this->oModel->isContactExists($this->aRouteParams['id'])) {
            $this->oView->errorCode(404);
        }

        $this->oModel->contactDelete($this->aRouteParams['id']);

        $this->oView->redirect('/admin/contacts');
    }

    public function contactsAction() {
        $oMain = new Main;
        $oPagination = new Pagination($this->aRouteParams, $oMain->contactsCount());
        $aData = [
            'pagination' => $oPagination->get(),
            'aContacts' => $this->oModel->getAllContacts(),
        ];
        $this->oView->render('Contacts', $aData);

    }
}