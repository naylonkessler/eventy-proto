<?php

namespace Plugins\Sales\Actions;

include '../../../bootstrap.php';

use Plugins\Sales\Models\Sale;

/**
 * Store sale action.
 */
class StoreSale
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
        $this->model->done_at = time();
        $this->model->value = request('value');
        $this->model->contact_id = request('contact_id');

        $this->mapper->insert($this->model);

        header('Location: /Plugins/Sales/Actions/Sales.php');
    }
}

$storeSale = new StoreSale();
$storeSale->handle();
