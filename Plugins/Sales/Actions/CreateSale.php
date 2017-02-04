<?php

namespace Plugins\Sales\Actions;

include '../../../bootstrap.php';

use Lib\App;

/**
 * Create sale action.
 */
class CreateSale
{
    /**
     * Handles the action action.
     */
    public function handle()
    {
        $contacts = App::$pubSub->publishToFirst('contacts.request.all');

        include '../views/create-sale.php';
    }
}

$createSale = new CreateSale();
$createSale->handle();
