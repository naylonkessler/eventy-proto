<?php

namespace Plugins\Products\Listeners;

use Lib\App;
use Lib\Model;
use Plugins\Products\Models\Product;
use Plugins\Products\Models\SaleItem;

/**
 * Products listener for UI events.
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
     * Product model.
     *
     * @var \Plugins\Product\Models\Product
     */
    protected $product;

    /**
     * Initializes and return a new instance.
     */
    public function __construct()
    {
        $this->mapper = \Lib\DataMapper::instance();
        $this->product = new Product();
    }

    /**
     * Subscribe to events.
     */
    public function subscribe()
    {
        App::$pubSub->subscribe('app.render.main-menu', [$this, 'addMainMenuLink']);
        App::$pubSub->subscribe('model.inserted: Plugins\Sales\Models\Sale', [$this, 'insertSaleItems']);
        App::$pubSub->subscribe('model.read: Plugins\Products\Models\SaleItem', [$this, 'fetchItemProduct']);
        App::$pubSub->subscribe('sales.render.create-after', [$this, 'addProductsToSaleCreate']);
        App::$pubSub->subscribe('sales.render.show-after', [$this, 'addItemsToSaleShow']);
    }

    /**
     * Add the items to sale show view.
     *
     * @param  \Lib\Model  $model
     * @return string
     */
    public function addItemsToSaleShow(Model $model)
    {
        $criteria = ['sale_id' => $model->id];

        $items = $this->mapper->filter($criteria, new SaleItem());

        return include PLUGINS.'Products/views/sale-items.php';
    }

    /**
     * Add a link to main menu
     *
     * @return string
     */
    public function addMainMenuLink()
    {
        return '<a href="/Plugins/Products/Actions/Products.php">Products</a> ';
    }

    /**
     * Add the products to sale create view.
     *
     * @return string
     */
    public function addProductsToSaleCreate()
    {
        $products = $this->mapper->all($this->product);

        return include PLUGINS.'Products/views/sale-products.php';
    }

    /**
     * Fetch an item product after read it.
     *
     * @param  \Lib\Model  $model
     */
    public function fetchItemProduct(Model $model)
    {
        $model->product = $this->mapper->find($model->product_id, $this->product);
    }

    /**
     * Add the products to sale create view.
     *
     * @param  \Lib\Model  $model
     */
    public function insertSaleItems(Model $model)
    {
        $products = request('products', []);

        $products = array_filter($products, function ($product) {
            return (boolean) $product['product_id'];
        });

        foreach ($products as $product) {
            $item = new SaleItem();
            $item->sale_id = $model->id;
            $item->product_id = $product['product_id'];
            $item->quantity = $product['quantity'];
            $item->value = $product['value'];

            $this->mapper->insert($item);
        }
    }
}
