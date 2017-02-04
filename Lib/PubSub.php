<?php

namespace Lib;

/**
 * Main event broadcaster.
 */
class PubSub
{
    /**
     * Single instance of class.
     *
     * @var \Lib\PubSub
     */
    private static $instance;

    /**
     * Collection of events subscriptions.
     *
     * @var array
     */
    private $subscriptions = [];

    /**
     * Hidden constructor.
     */
    private function __construct()
    {
    }

    /**
     * Singleton method. Return a single instance of class.
     *
     * @return \Lib\PubSub
     */
    public static function instance()
    {
        if ( ! static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Publish an event to registered subscribers.
     *
     * @param  string  $event
     * @param  mixed...  $params
     * @return mixed
     */
    public function publish($event)
    {
        if (empty($this->subscriptions[$event])) {
            return;
        }

        $params = func_get_args();
        array_shift($params);

        $results = [];

        foreach ($this->subscriptions[$event] as $handler) {
            $result = call_user_func_array($handler, $params);

            if ($result) {
                $results[] = $result;
            }
        }

        return $results;
    }

    /**
     * Publish an event to registered subscribers and return the first result.
     *
     * @param  string  $event
     * @param  mixed...  $params
     * @return mixed
     */
    public function publishToFirst($event)
    {
        $results = call_user_func_array([$this, 'publish'], func_get_args());

        return $results? $results[0] : null;
    }

    /**
     * Publish an event to registered subscribers and render the results.
     *
     * @param  string  $event
     * @param  mixed...  $params
     */
    public function publishToRender($event)
    {
        $results = call_user_func_array([$this, 'publish'], func_get_args());

        echo implode('', array_filter((array) $results, 'is_string'));
    }

    /**
     * Subscribe a handler for an event.
     *
     * @param  string  $event
     * @param  callable  $handler
     * @return \Lib\PubSub
     */
    public function subscribe($event, callable $handler)
    {
        if (empty($this->subscriptions[$event])) {
            $this->subscriptions[$event] = [];
        }

        $hash = spl_object_hash((object) $handler);

        $this->subscriptions[$event][$hash] = $handler;

        return $this;
    }

    /**
     * Unsubscribe all handlers of an event.
     *
     * @param  string  $event
     * @param  callable  $handler
     * @return \Lib\PubSub
     */
    public function unsubscribe($event, callable $handler = null)
    {
        if (empty($this->subscriptions[$event])) {
            return $this;
        }

        if ( ! $handler) {
            unset($this->subscriptions[$event]);
        }

        $hash = spl_object_hash((object) $handler);

        if ( ! empty($this->subscriptions[$event][$hash])) {
            unset($this->subscriptions[$event][$hash]);
        }

        return $this;
    }

    /**
     * Hidden clone behavior.
     */
    private function __clone()
    {
    }
}
