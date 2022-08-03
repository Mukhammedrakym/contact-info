<?php

namespace app\controllers;

use app\core\Controller;

class AccountController extends Controller
{
    public function loginAction() {
        $this->oView->render('Login Page');
    }

    public function registerAction() {
        $this->oView->sLayout = 'custom';
        $this->oView->render('Registration');
    }
}