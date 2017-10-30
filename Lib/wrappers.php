<?php

/**
 * Application support wrappers
 */

/**
 * Redirect to a received location.
 *
 * @param  string  $location
 */
function redirect($location) {
    header("Location: {$location}");
    exit;
}

/**
 * Return some data from $_REQUEST.
 *
 * @param  string  $key
 * @param  mixed  $default
 * @return mixed
 */
function request($key, $default = null) {
    return empty($_REQUEST[$key])? $default : $_REQUEST[$key];
}

/**
 * Return value data from received data.
 *
 * @param  string  $key
 * @param  mixed  $from
 * @param  mixed  $default
 * @return mixed
 */
function value($key, $from, $default = null) {
    $from = method_exists($from, 'toArray')? $from->toArray() : (array) $from;

    return empty($from[$key])? $default : $from[$key];
}