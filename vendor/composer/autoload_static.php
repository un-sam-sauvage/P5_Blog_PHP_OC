<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit873b563a40bbf7297c485a3dda9dd9d7
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Models\\DB' => __DIR__ . '/../..' . '/models/DB.php',
        'Models\\UserModel' => __DIR__ . '/../..' . '/models/UserModel.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit873b563a40bbf7297c485a3dda9dd9d7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit873b563a40bbf7297c485a3dda9dd9d7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit873b563a40bbf7297c485a3dda9dd9d7::$classMap;

        }, null, ClassLoader::class);
    }
}