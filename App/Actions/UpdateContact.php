<?php

namespace App\Actions;

include '../../bootstrap.php';

use App\Models\Contact;

/**
 * Update contact action.
 */
class UpdateContact
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
        $model = $this->mapper->find($_REQUEST['id'], $this->model);

        $model->name = $_REQUEST['name'];
        $model->email = $_REQUEST['email'];
        $model->mobile = $_REQUEST['mobile'];
        $model->phone = $_REQUEST['phone'];

        $this->mapper->update($model);

        redirect('/App/Actions/Contacts.php');
    }
}

$updateContact = new UpdateContact();
$updateContact->handle();
