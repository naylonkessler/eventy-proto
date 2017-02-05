<?php

namespace App\Listeners;

use App\Models\Contact;
use Lib\App;

/**
 * Contacts listener for events.
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
     * Initializes and return a new instance.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->model = new Contact();
    }

    /**
     * Subscribe to events.
     */
    public function subscribe()
    {
        App::$pubSub->subscribe('contacts.request.all', [$this, 'requestContacts']);
        App::$pubSub->subscribe('contacts.request.one', [$this, 'requestContact']);
    }

    /**
     * Fetch and return a contact.
     *
     * @param  mixed  $id
     * @return \Lib\Model
     */
    public function requestContact($id)
    {
        return $this->mapper->find($id, $this->model);
    }

    /**
     * Fetch and return the contacts.
     *
     * @return \Lib\Model[]
     */
    public function requestContacts()
    {
        return $this->mapper->all($this->model);
    }
}
