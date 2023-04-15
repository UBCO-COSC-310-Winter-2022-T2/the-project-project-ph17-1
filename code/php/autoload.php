<?php
function my_autoloader($class) {
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';
    echo "Attempting to load class: " . $class . " from file: " . $filename . "<br>";
    if (file_exists($filename)) {
        require_once($filename);
        echo "Class " . $class . " loaded successfully.<br>";
    } else {
        echo "Failed to load class: " . $class . "<br>";
    }
}
spl_autoload_register('my_autoloader');
