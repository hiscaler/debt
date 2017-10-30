<?php

/**
 * 适配器模式
 *
 * PHP适配器设计模式(Adapter)可以将一个类的接口转换为一个兼容性接口。适配器可以将原来类中不兼容的接口转换为适配器的兼容接口，从而可以使这些类一起正常工作。一般适配器会对不兼容的对象进行封装(Wrapper).
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
interface ChineseInterface
{

    public function sayNiHao();

}

class Chinese implements ChineseInterface
{

    public function sayNiHao()
    {
        echo '你好';
    }

}

interface EnglishInterface
{

    public function sayHello();

}

class English implements EnglishInterface
{

    public function sayHello()
    {
        echo "Hello";
    }

}

class SayAdapter implements EnglishInterface
{

    protected $chinese;

    public function __construct(ChineseInterface $chinese)
    {
        $this->chinese = $chinese;
    }

    public function sayHello()
    {
        return $this->chinese->sayNiHao();
    }

}

// Test
$langs = [
    new English(),
    new SayAdapter(new Chinese())
];
foreach ($langs as $lang) {
    echo $lang->sayHello() . PHP_EOL;
}
