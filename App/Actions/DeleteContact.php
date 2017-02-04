<?php

namespace App\Actions;

include '../../bootstrap.php';

use App\Models\Contact;

/**
 * Delete contact action.
 */
class DeleteContact
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
        $model = $this->mapper->find($_REQUEST['contact'], $this->model);

        $this->mapper->delete($model);

        header('Location: /App/Actions/Contacts.php');
    }
}

$deleteContact = new DeleteContact();
$deleteContact->handle();
