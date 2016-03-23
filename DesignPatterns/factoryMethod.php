<?php

/**
 * 工厂方法模式
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
abstract class Fruit
{

    abstract public function eat();
}

class Apple extends Fruit
{

    public function eat()
    {
        return 'Eat apple.';
    }

}

class Banana extends Fruit
{

    public function eat()
    {
        return 'Eat banana';
    }

}
