<?php

declare(strict_types=1);

namespace Tropa\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SetorController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Action to add change records
     */
    public function editAction() : void {
        
    }

    /**
     * Action to save a record
     */
    public function saveAction() : void {
        
    }

    /**
     * Action to remove records
     */
    public function removeAction() : void {
        
    }
}
