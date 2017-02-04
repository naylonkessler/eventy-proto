<?php

namespace App\Actions;

include '../../bootstrap.php';

use App\Models\Contact;

/**
 * Contacts action.
 */
class Contacts
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
        $contacts = $this->mapper->all($this->model);

        include '../views/contacts.php';
    }
}

$contacts = new Contacts();
$contacts->handle();
