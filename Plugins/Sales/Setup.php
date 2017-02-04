<?php

namespace Plugins\Sales;

/**
 * Sales plugin setup class.
 */
class Setup
{
    /**
     * Initialize the module.
     */
    public function initialize()
    {
        (new Listeners\UI())->subscribe();
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
