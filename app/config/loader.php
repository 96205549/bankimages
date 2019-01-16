<?php
/**
 * Autochargement des classes
 */

$loader = new \Phalcon\Loader();
$loader->registerDirs(array(
    $config->application->path . $config->application->pluginsDir,
    $config->application->path . $config->application->libraryDir,
    $config->application->path . $config->application->modelsDir,
))->register();

$namespaces = [
    "AfriqueStock\Model" => $config->application->path . $config->application->modelsDir,
    "AfriqueStock\Library" => $config->application->path . $config->application->libraryDir
];
$map = require $config->application->path . $config->application->vendorDir . 'composer/autoload_namespaces.php';
foreach ($map as $k => $values) {
    $k = trim($k, '\\');
    if (!isset($namespaces[$k])) {
        $dir = '/' . str_replace('\\', '/', $k) . '/';
        $namespaces[$k] = implode($dir . ';', $values) . $dir;
    }
}
$loader->registerNamespaces($namespaces);
$classMap = require $config->application->path . $config->application->vendorDir . 'composer/autoload_classmap.php';
$loader->registerClasses($classMap);

return $loader;