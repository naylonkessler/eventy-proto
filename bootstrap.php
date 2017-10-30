<?php

/**
 * Execute all bootstrap processes.
 */

define('ROOT', __DIR__);
define('PLUGINS', __DIR__.'/Plugins/');

include 'autoload.php';
include 'start.php';
include 'Lib/wrappers.php';
