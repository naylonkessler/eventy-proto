<?php

namespace App\Actions;

include '../../bootstrap.php';

use App\Models\Contact;

/**
 * Store contact action.
 */
class StoreContact
{
    /**
     * Main data mapper.
     *
     * @var \Lib\DataMapper
     */
    protected $mapper;

    /**
     * Model of action.
     *
     * @var \App\Models\Contact
     */
    protected $model;

    /**
     * Initialize the action.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->model = new Contact();
    }

    /**
     * Handles the action action.
     */
    public function handle()
    {
        $this->model->name = $_REQUEST['name'];
        $this->model->email = $_REQUEST['email'];
        $this->model->mobile = $_REQUEST['mobile'];
        $this->model->phone = $_REQUEST['phone'];

        $this->mapper->insert($this->model);

        header('Location: /App/Actions/Contacts.php');
    }
}

$storeContact = new StoreContact();
$storeContact->handle();
