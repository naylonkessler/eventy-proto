<?php

namespace Plugins\Products\Actions;

include '../../../bootstrap.php';

/**
 * Create product action.
 */
class CreateProduct
{
    /**
     * Handles the action action.
     */
    public function handle()
    {
        include '../views/create-product.php';
    }
}

$createProduct = new CreateProduct();
$createProduct->handle();
