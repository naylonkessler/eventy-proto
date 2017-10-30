<?php

namespace Plugins\Sales\Actions;

include '../../../bootstrap.php';

use Plugins\Sales\Models\Sale;

/**
 * Delete sale action.
 */
class DeleteSale
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
        $model = $this->mapper->find(request('sale'), $this->model);

        $this->mapper->delete($model);

        redirect('/Plugins/Sales/Actions/Sales.php');
    }
}

$deleteSale = new DeleteSale();
$deleteSale->handle();
