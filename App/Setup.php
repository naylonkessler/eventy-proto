<?php

namespace App;

/**
 * Application setup class.
 */
class Setup
{
    /**
     * Initialize the module.
     */
    public function initialize()
    {
        (new Listeners\Contacts())->subscribe();
    }

    /**
     * Install the module.
     */
    public function install()
    {
    }

    /**
     * Uninstall the module.
     */
    public function uninstall()
    {
    }
}
