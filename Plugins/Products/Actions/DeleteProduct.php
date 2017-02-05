<?php

namespace Plugins\Product\Actions;

include '../../../bootstrap.php';

use Plugins\Products\Models\Product;

/**
 * Delete product action.
 */
class DeleteProduct
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
     * @var \Plugins\Product\Models\Product
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
        $model = $this->mapper->find($_REQUEST['product'], $this->model);

        $this->mapper->delete($model);

        redirect('/Plugins/Products/Actions/Products.php');
    }
}

$deleteProduct = new DeleteProduct();
$deleteProduct->handle();
