<?php

/**
 * 单例模式
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class Singleton
{

    private static $_singleton = null;
    protected static $_counter = 0;

    public function __construct()
    {
        
    }

    public function __clone()
    {
        
    }

    public static function getInstance()
    {
        if (self::$_singleton === null) {
            self::$_singleton = new Singleton();
            self::$_counter += 1;
        }

        return self::$_singleton;
    }

    public static function test()
    {
        echo self::$_counter;
    }

}

/**
 * Test
 */
for ($i = 1; $i <= 10; $i++) {
    Singleton::getInstance();
    Singleton::test();

    // New instance
    $a = new Singleton();
    $a::test();
}
