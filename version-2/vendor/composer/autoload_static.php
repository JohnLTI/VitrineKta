<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76fe2b2b28f48b2b0e70437de97b5ade
{
    public static $files = array (
        '5ec26a44593cffc3089bdca7ce7a56c3' => __DIR__ . '/../..' . '/core/helpers.php',
    );

    public static $classMap = array (
        'App\\Controllers\\ExampleController' => __DIR__ . '/../..' . '/app/controllers/ComercioController.php',
        'App\\Core\\Database\\Connection' => __DIR__ . '/../..' . '/core/database/Connection.php',
        'App\\Core\\Database\\QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'ComposerAutoloaderInit76fe2b2b28f48b2b0e70437de97b5ade' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit76fe2b2b28f48b2b0e70437de97b5ade' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit76fe2b2b28f48b2b0e70437de97b5ade::$classMap;

        }, null, ClassLoader::class);
    }
}
