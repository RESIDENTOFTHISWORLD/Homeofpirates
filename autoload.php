<?php
// PSR-4 Autoloader
spl_autoload_register(
    function ($class) {
        // The root namespace for the project
        $namespaceRoot = 'Homeofpirates\\';

        // The base directory for your project
        $baseDir = __DIR__ . '/';

        // Check if the class belongs to the TAL namespace
        if (strpos($class, $namespaceRoot) === 0) {
//        if (str_starts_with($class, $namespaceRoot)) {
            // Remove the namespace root part
            $relativeClass = substr($class, strlen($namespaceRoot));

            // Replace namespace separators with directory separators
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

            // Check if the file exists and require it
            if (file_exists($file)) {
                require $file;
            } else {
                // Log and throw an error if the file is not found
                error_log("Autoload failed: {$file} not found for class {$class}");
                throw new Exception("Class {$class} not found");
            }
        }
    },true);