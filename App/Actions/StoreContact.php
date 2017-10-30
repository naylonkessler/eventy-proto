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
        $this->model->name = request('name');
        $this->model->email = request('email');
        $this->model->mobile = request('mobile');
        $this->model->phone = request('phone');

        $this->mapper->insert($this->model);

        redirect('/App/Actions/Contacts.php');
    }
}

$storeContact = new StoreContact();
$storeContact->handle();
