<?php

/**
 * 抽象工厂模式
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
// 抽象工厂
abstract class TvFactory
{

    abstract public function createTv($className);
}

// 具体工厂
class HairFactory extends TvFactory
{

    public function createTv($className)
    {
        return new $className();
    }

}

class TclFactory extends TvFactory
{

    public function createTv($className)
    {
        return new $className();
    }

}

// 抽象产品
interface HairTv
{

    public function open();
}

interface TclTv
{

    public function open();
}

// 具体产品
class HairTv1 implements HairTv
{

    public function open()
    {
        echo 'Hair1 open';
    }

}

class TclTv1 implements TclTv
{

    public function open()
    {
        echo 'Tcl1 open';
    }

}

// test
class Client
{

    public static function main()
    {
        $factory = new HairFactory();
        $tv = $factory->createTv('HairTv1');
        $tv->open();

        $factory = new TclFactory();
        $tv = $factory->createTv('TclTv1');
        $tv->open();
    }

}

Client::main();
