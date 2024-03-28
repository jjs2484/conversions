<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfc52364ec4983ffd88b3649ecd587fe0
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitfc52364ec4983ffd88b3649ecd587fe0', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfc52364ec4983ffd88b3649ecd587fe0', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfc52364ec4983ffd88b3649ecd587fe0::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
