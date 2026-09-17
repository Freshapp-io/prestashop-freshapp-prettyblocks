<?php
/**
 * Simple PSR-4 autoloader for FreshAppPrettyBlocks namespace.
 * No Composer machinery needed.
 */
spl_autoload_register(function (string $class): void {
    static $prefix = 'FreshAppPrettyBlocks\\';
    static $baseDir = null;
    if ($baseDir === null) {
        $baseDir = \dirname(__DIR__) . '/src/';
    }
    $len = \strlen($prefix);
    if (\strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $file = $baseDir . \str_replace('\\', '/', \substr($class, $len)) . '.php';
    if (\is_file($file)) {
        require $file;
    }
});
