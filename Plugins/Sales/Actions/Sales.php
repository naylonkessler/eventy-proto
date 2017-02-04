<?php

namespace Plugins\Sales\Actions;

include '../../../bootstrap.php';

use Plugins\Sales\Models\Sale;

/**
 * Sales action.
 */
class Sales
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
        $sales = $this->mapper->all($this->model);

        include '../views/sales.php';
    }
}

$sales = new Sales();
$sales->handle();
