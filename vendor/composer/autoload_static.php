<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf46fe31f7cf4c8bcb3d0631bf376864
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf46fe31f7cf4c8bcb3d0631bf376864::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf46fe31f7cf4c8bcb3d0631bf376864::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaf46fe31f7cf4c8bcb3d0631bf376864::$classMap;

        }, null, ClassLoader::class);
    }
}
