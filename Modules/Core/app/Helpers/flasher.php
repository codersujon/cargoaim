<?php

use Flasher\Laravel\Facade\Flasher;

if (!function_exists('flasher_success')) {
    function flasher_success(string $message, array $options = [])
    {
        Flasher::addSuccess($message, $options);
    }
}

if (!function_exists('flasher_error')) {
    function flasher_error(string $message, array $options = [])
    {
        Flasher::addError($message, $options);
    }
}

if (!function_exists('flasher_info')) {
    function flasher_info(string $message, array $options = [])
    {
        Flasher::addInfo($message, $options);
    }
}

if (!function_exists('flasher_warning')) {
    function flasher_warning(string $message, array $options = [])
    {
        Flasher::addWarning($message, $options);
    }
}

?>