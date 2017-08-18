<?php namespace at\Zarinpal\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Transactions extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'at.zarinpal.manage_transaction' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('at.Zarinpal', 'main-menu-item', 'side-menu-item');
    }
}