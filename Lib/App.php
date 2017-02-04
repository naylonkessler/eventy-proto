<?php

namespace Lib;

/**
 * Application class.
 */
class App
{
    /**
     * Plugin manager instance.
     *
     * @var \Lib\PluginManager
     */
    public static $pluginManager;

    /**
     * Event broadcaster instance.
     *
     * @var \Lib\PubSub
     */
    public static $pubSub;

    /**
     * Compose and return a new application instance.
     */
    public function __construct()
    {
        static::$pubSub = PubSub::instance();
        static::$pluginManager = PluginManager::instance();
    }
}
