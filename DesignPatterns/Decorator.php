<?php

/**
 * 装饰器
 *
 * PHP装饰器设计模式(Decorator)的目的是为类的对象实例动态添加新的功能。可以动态添加继承自Decorator抽象类的实体类和实体类方法。
 * @author hiscaler <hiscaler@gmail.com>
 */
interface RenderInterface
{

    public function renderData();

}

class WebService implements RenderInterface
{

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function renderData()
    {
        return $this->data;
    }

}

abstract class Decorator implements RenderInterface
{

    protected $render;

    public function __construct(RenderInterface $render)
    {
        $this->render = $render;
    }

}

class Json extends Decorator
{

    public function renderData()
    {
        $output = $this->render->renderData();
        return json_encode($output);
    }

}

class XML extends Decorator
{

    public function renderData()
    {
        $output = $this->render->renderData();
        $doc = new \DOMDocument();

        foreach ($output as $key => $val) {
            $doc->appendChild($doc->createElement($key, $val));
        }

        return $doc->saveXML();
    }

}

// Test
$data = array('One' => '1', 'Two' => '2');
$service = new Webservice($data);

$json = new Json($service);
echo $json->renderData() . PHP_EOL;

$xml = new XML($service);
echo $xml->renderData() . PHP_EOL;
