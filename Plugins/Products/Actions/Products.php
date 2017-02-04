<?php

namespace Plugins\Products\Actions;

include '../../../bootstrap.php';

use Plugins\Products\Models\Product;

/**
 * Products action.
 */
class Products
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
        $products = $this->mapper->all($this->model);

        include '../views/products.php';
    }
}

$products = new Products();
$products->handle();
