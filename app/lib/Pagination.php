<?php

namespace app\lib;

class Pagination {

    private $iMax = 10;
    private $aRouteParams;
    private $sIndex = '';
    private $iCurrentPage;
    private $iTotal;
    private $iLimit;

    public function __construct($aRouteParams, $iTotal, $iLimit = 10) {
        $this->aRouteParams = $aRouteParams;
        $this->iTotal = $iTotal;
        $this->iLimit = $iLimit;
        $this->iAmount = $this->amount();
        $this->setCurrentPage();
    }

    public function get() {
        $sLinks = null;
        $aLimits = $this->limits();
        $sHtml = '<nav><ul class="pagination">';
        for ($iPage = $aLimits[0]; $iPage <= $aLimits[1]; $iPage++) {
            if ($iPage == $this->iCurrentPageage) {
                $sLinks .= '<li class="page-item active"><span class="page-link">'. $iPage. '</span></li>';
            } else {
                $sLinks .= $this->generateHtml($iPage);
            }
        }
        if (!is_null($sLinks)) {
            if ($this->iCurrentPageage > 1) {
                $sLinks = $this->generateHtml(1, 'Next') . $sLinks;
            }
            if ($this->iCurrentPageage < $this->iAmount) {
                $sLinks .= $this->generateHtml($this->iAmount, 'Previous');
            }
        }
        $sHtml .= $sLinks . ' </ul></nav>';
        return $sHtml;
    }

    private function generateHtml($iPage, $sText = null) {
        if (!$sText) {
            $sText = $iPage;
        }
        return '<li class="page-item"><a class="page-link" href="/'.$this->aRouteParams['controller'].'/'.$this->aRouteParams['action'].'/'. $iPage . '">' . $sText . '</a></li>';
    }

    private function limits() {
        $iLeft = $this->iCurrentPageage - round($this->iMax / 2);
        $iStart = $iLeft > 0 ? $iLeft : 1;
        if ($iStart + $this->iMax <= $this->iAmount) {
            $iEnd = $iStart > 1 ? $iStart + $this->iMax : $this->iMax;
        }
        else {
            $iEnd = $this->iAmount;
            $iStart = $this->iAmount - $this->iMax > 0 ? $this->iAmount - $this->iMax : 1;
        }
        return array($iStart, $iEnd);
    }

    private function setCurrentPage() {
        if (isset($this->aRouteParams['page'])) {
            $iCurrentPage = $this->aRouteParams['page'];
        } else {
            $iCurrentPage = 1;
        }
        $this->iCurrentPageage = $iCurrentPage;
        if ($this->iCurrentPageage > 0) {
            if ($this->iCurrentPageage > $this->iAmount) {
                $this->iCurrentPageage = $this->iAmount;
            }
        } else {
            $this->iCurrentPageage = 1;
        }
    }

    private function amount() {
        return ceil($this->iTotal / $this->iLimit);
    }
}