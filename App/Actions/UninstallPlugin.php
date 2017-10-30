<?php

namespace App\Actions;

include '../../bootstrap.php';

use Lib\App;

/**
 * Action for uninstall a plugin.
 */
class UninstallPlugin
{
    /**
     * Handles the action.
     */
    public function handle()
    {
        App::$pluginManager->uninstall(request('plugin'));

        redirect('/App/Actions/Plugins.php');
    }
}

$uninstallPlugin = new UninstallPlugin();
$uninstallPlugin->handle();
