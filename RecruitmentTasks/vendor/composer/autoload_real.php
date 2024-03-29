<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit3ec49d2f1482b4d16616be0e09e34c15
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

        spl_autoload_register(array('ComposerAutoloaderInit3ec49d2f1482b4d16616be0e09e34c15', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit3ec49d2f1482b4d16616be0e09e34c15', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit3ec49d2f1482b4d16616be0e09e34c15::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
