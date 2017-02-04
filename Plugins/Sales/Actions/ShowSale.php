<?php

namespace Plugins\Sales\Actions;

include '../../../bootstrap.php';

use Lib\App;
use Plugins\Sales\Models\Sale;

/**
 * Show sale action.
 */
class ShowSale
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
     * @var \Plugins\Sales\Models\Sale
     */
    protected $model;

    /**
     * Initialize the action.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->model = new Sale();
    }

    /**
     * Handles the action action.
     */
    public function handle()
    {
        $sale = $this->mapper->find($_REQUEST['sale'], $this->model);

        $sale->contact = App::$pubSub->publishToFirst('contacts.request.one', $sale->contact_id);

        include '../views/show-sale.php';
    }
}

$showSale = new ShowSale();
$showSale->handle();
