<?php

namespace App\Actions;

include '../../bootstrap.php';

use Lib\App;

/**
 * Action for install a plugin.
 */
class InstallPlugin
{
    /**
     * Handles the action.
     */
    public function handle()
    {
        App::$pluginManager->install($_REQUEST['plugin']);

        redirect('/App/Actions/Plugins.php');
    }
}

$installPlugin = new InstallPlugin();
$installPlugin->handle();
