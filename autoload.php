<?php

/**
 * Register default behavior of files autoloading.
 */

spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class).'.php';
});
