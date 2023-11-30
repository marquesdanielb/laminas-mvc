<?php

namespace Tropa\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class SetorController extends AbstractActionController
{
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function indexAction()
    {
        return new ViewModel(
            ['models' => $this->table->fetchAll()]
        );
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
