<?php

namespace app\controllers;
use app\core\Controller;
use app\lib\Pagination;
class MainController extends Controller
{
    public function indexAction() {
        $oPagination = new Pagination($this->aRouteParams, $this->oModel->contactsCount());
        $aData = [
            'pagination' => $oPagination->get(),
            'list' => $this->oModel->contactsList($this->aRouteParams),
        ];
        $this->oView->render('Main Page', $aData);
    }

    public function aboutAction() {
        $this->oView->render('About us');
    }

    public function contactAction() {
        if (!empty($_POST)) {
            if (!$this->oModel->contactValidate($_POST)) {
                $this->oView->message('error', $this->oModel->sError);
            }
            mail('mmanmurynov@mail.ru', 'Message from blog UserInfo', $_POST['name'] . ' , ' . $_POST['email'] . ', ' . $_POST['text']);
            $this->oView->message('success', 'success');
        }
        $this->oView->render('Contacts');
    }

    public function usersAction() {
        $this->oView->render('Users');
    }
}