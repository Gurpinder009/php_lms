<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita24e7d47f384a45a877dd361b7e08437
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Database\\' => 9,
        ),
        'C' => 
        array (
            'Config\\' => 7,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/database',
        ),
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita24e7d47f384a45a877dd361b7e08437::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita24e7d47f384a45a877dd361b7e08437::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita24e7d47f384a45a877dd361b7e08437::$classMap;

        }, null, ClassLoader::class);
    }
}
