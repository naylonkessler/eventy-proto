<?php

namespace Plugins\Sales\Listeners;

use Lib\App;
use Lib\Model;
use Plugins\Sales\Models\Sale;

/**
 * Sales listener for UI events.
 */
class UI
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
     * @var \Plugins\Sale\Models\Sale
     */
    protected $model;

    /**
     * Initializes and return a new instance.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->model = new Sale();
    }

    /**
     * Subscribe to events.
     */
    public function subscribe()
    {
        App::$pubSub->subscribe('app.render.main-menu', [$this, 'addMainMenuLink']);
        App::$pubSub->subscribe('contacts.render.show-after', [$this, 'addSalesToContactShow']);
        App::$pubSub->subscribe('contacts.render.list-item-after', [$this, 'addSalesToContactItem']);
    }

    /**
     * Add a link to main menu.
     *
     * @return string
     */
    public function addMainMenuLink()
    {
        return '<a href="/Plugins/Sales/Actions/Sales.php">Sales</a> ';
    }

    /**
     * Add the sales view to contact item view.
     *
     * @param  \Lib\Model  $contact
     * @return string
     */
    public function addSalesToContactItem(Model $contact)
    {
        $criteria = ['contact_id' => $contact->id];

        $sales = $this->mapper->filter($criteria, $this->model);
        $count = count($sales);

        return ' &mdash; '.$count.' sale'.($count == 1? '' : 's');
    }

    /**
     * Add the sales view to contact show view.
     *
     * @param  \Lib\Model  $contact
     * @return string
     */
    public function addSalesToContactShow(Model $contact)
    {
        $criteria = ['contact_id' => $contact->id];

        $sales = $this->mapper->filter($criteria, $this->model);

        return include PLUGINS.'Sales/views/contact-sales.php';
    }
}
