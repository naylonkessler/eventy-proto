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
        $model = $this->mapper->find(request('id'), $this->model);

        $model->name = request('name');
        $model->email = request('email');
        $model->mobile = request('mobile');
        $model->phone = request('phone');

        $this->mapper->update($model);

        redirect('/App/Actions/Contacts.php');
    }
}

$updateContact = new UpdateContact();
$updateContact->handle();
