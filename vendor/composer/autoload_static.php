<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc0972e42da5008c459193b7ee2ac2ccb
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Alura\\Pdo\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Alura\\Pdo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc0972e42da5008c459193b7ee2ac2ccb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc0972e42da5008c459193b7ee2ac2ccb::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc0972e42da5008c459193b7ee2ac2ccb::$classMap;

        }, null, ClassLoader::class);
    }
}