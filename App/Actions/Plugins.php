<?php

namespace App\Actions;

include '../../bootstrap.php';

use Lib\App;

/**
 * Plugins action.
 */
class Plugins
{
    /**
     * Handles the action.
     */
    public function handle()
    {
        $plugins = App::$pluginManager->available();

        include '../views/plugins.php';
    }
}

$plugins = new Plugins();
$plugins->handle();
