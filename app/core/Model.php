<?php

namespace app\core;

use app\lib\Database;

abstract class Model
{
    public $oDb;

    public function __construct()
    {
        $this->oDb = new Database();
    }
}