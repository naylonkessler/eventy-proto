<?php

namespace Plugins\Products\Actions;

include '../../../bootstrap.php';

use Plugins\Products\Models\Product;

/**
 * Store product action.
 */
class StoreProduct
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
     * @var \Plugins\Products\Models\Product
     */
    protected $model;

    /**
     * Initialize the action.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->model = new Product();
    }

    /**
     * Handles the action action.
     */
    public function handle()
    {
        $this->model->name = $_REQUEST['name'];
        $this->model->value = $_REQUEST['value'];

        $this->mapper->insert($this->model);

        redirect('/Plugins/Products/Actions/Products.php');
    }
}

$storeProduct = new StoreProduct();
$storeProduct->handle();
