<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit77024f0f55cd26d2d2e7c5483aa34fdf
{
    public static $files = array (
        'e471bf351add62873bc0289ccd6a937f' => __DIR__ . '/..' . '/league/plates/src/Template/match.php',
        '152c98af9456eeb8f53697d6a7dfd689' => __DIR__ . '/..' . '/league/plates/src/Extension/Data/data.php',
        'e20239a76b73b9912f51f0005956d1db' => __DIR__ . '/..' . '/league/plates/src/Extension/Path/path.php',
        'd513f8e004e152493580ca1917e308ba' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/func.php',
        '27980683f1626a3fd1405d27b171c0fe' => __DIR__ . '/..' . '/league/plates/src/Extension/RenderContext/render-context.php',
        'bdc465a053da7f7ddb072631f6d41d45' => __DIR__ . '/..' . '/league/plates/src/Extension/LayoutSections/layout-sections.php',
        'afa76803f24616d7599be3b7b0846adc' => __DIR__ . '/..' . '/league/plates/src/Extension/Folders/folders.php',
        '16c5be35e32c6cf916d875518b909210' => __DIR__ . '/..' . '/league/plates/src/Util/util.php',
        'b0859f995e1499da711eff9c99e63335' => __DIR__ . '/../..' . '/src/Core/Config.php',
        '6c99861477c3d1cfeddfbc949790d567' => __DIR__ . '/../..' . '/src/Core/Functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stonks\\Router\\' => 14,
            'Stonks\\DataLayer\\' => 17,
            'Source\\' => 7,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stonks\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/stonks/router/src',
        ),
        'Stonks\\DataLayer\\' => 
        array (
            0 => __DIR__ . '/..' . '/stonks/datalayer/src',
        ),
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit77024f0f55cd26d2d2e7c5483aa34fdf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit77024f0f55cd26d2d2e7c5483aa34fdf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit77024f0f55cd26d2d2e7c5483aa34fdf::$classMap;

        }, null, ClassLoader::class);
    }
}
