<?php
namespace app\lib;

use PDO;

class Database
{
    protected $oDb;

    public function __construct()
    {
        $aConfig = require 'app/config/db.php';
        $sDsn = 'mysql:host='. $aConfig['host'] . ';dbname=' . $aConfig['dbname'];
        $this->oDb = new PDO($sDsn, $aConfig['user'], $aConfig['password']);
    }

    public function query($sSql, $aParams = []) {
        $sStmt = $this->oDb->prepare($sSql);
        if (!empty($aParams)) {
            foreach ($aParams as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $sStmt->bindValue(':'.$key, $val, $type);
            }
        }
        $sStmt->execute();
        return $sStmt;
    }

    public function row($sSql, $aParams = []) {
        $aResult = $this->query($sSql, $aParams);
        return $aResult->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sSql, $aParams = []) {
        $aResult = $this->query($sSql, $aParams);
        return $aResult->fetchColumn();
    }

    public function lastInsertId() {
        return $this->oDb->lastInsertId();
    }
}