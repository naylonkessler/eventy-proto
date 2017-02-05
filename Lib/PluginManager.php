<?php

namespace Lib;

/**
 * Application plugin manager.
 */
class PluginManager
{
    /**
     * Single instance of class.
     *
     * @var \Lib\PubSub
     */
    private static $instance;

    /**
     * Hidden constructor.
     */
    private function __construct()
    {
    }

    /**
     * Return all available plugins with installation data.
     *
     * @return array
     */
    public function available()
    {
        $available = [];
        $installed = $this->installedKeys();
        $iterator = new \FilesystemIterator(ROOT.'/Plugins');

        foreach ($iterator as $entry) {
            if ( ! $entry->isDir()) continue;

            $path = $entry->getPathname().'/manifest.json';
            $meta = json_decode(file_get_contents($path));
            $meta->installed = in_array($meta->key, $installed);
            $available[$meta->key] = $meta;
        }

        return $available;
    }

    /**
     * Initialize all plugins.
     */
    public function initialize()
    {
        $setup = new \App\Setup();
        $setup->initialize();

        $config = json_decode(file_get_contents(ROOT.'/config.json'), true);

        array_walk($config['plugins']['installed'], [$this, 'initializePlugin']);
    }

    /**
     * Initialize a plugin by its key.
     *
     * @param  string  $key
     */
    public function initializePlugin($key)
    {
        $class = $this->className($key);

        $setup = new $class();
        $setup->initialize();
    }

    /**
     * Install a plugin by its key.
     *
     * @param  string  $key
     * @return boolean
     */
    public function install($key)
    {
        $config = json_decode(file_get_contents(ROOT.'/config.json'), true);
        $class = $this->className($key);

        $setup = new $class();
        $setup->install();

        $config['plugins']['installed'][] = $key;
        $data = json_encode($config, JSON_PRETTY_PRINT);

        return (boolean) file_put_contents(ROOT.'/config.json', $data);
    }

    /**
     * Return all installed plugins keys.
     *
     * @return array
     */
    public function installedKeys()
    {
        $config = json_decode(file_get_contents(ROOT.'/config.json'), true);

        return $config['plugins']['installed'];
    }

    /**
     * Singleton method. Return a single instance of class.
     *
     * @return \Lib\PluginManager
     */
    public static function instance()
    {
        if ( ! static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Uninstall a plugin by its key.
     *
     * @param  string  $key
     * @return boolean
     */
    public function uninstall($key)
    {
        $config = json_decode(file_get_contents(ROOT.'/config.json'), true);
        $class = $this->className($key);

        $setup = new $class();
        $setup->uninstall();

        $installed = array_filter($config['plugins']['installed'], function ($plugin) use ($key) {
            return $plugin != $key;
        });

        $config['plugins']['installed'] = $installed;
        $data = json_encode($config, JSON_PRETTY_PRINT);

        return (boolean) file_put_contents(ROOT.'/config.json', $data);
    }

    /**
     * Return a plugin setup class name.
     *
     * @param  string  $key
     * @return string
     */
    protected function className($key)
    {
        $folder = str_replace(' ', '', ucwords(str_replace('-', ' ', $key)));

        return "\\Plugins\\{$folder}\\Setup";
    }

    /**
     * Hidden clone behavior.
     */
    private function __clone()
    {
    }
}
