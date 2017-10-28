<?php

/**
 * 职责链模式
 *
 * 职责链（ Chain of Responsibility ）模式也被叫做责任链模式，在《设计模式》属于行为型模式，是一个请求有多个对象来处理，这些对象是一条链，但具体由哪个对象来处理，根据条件判断来确定，如果不能处理会传递给该链中的下一个对象，直到有对象处理它为止。责任链模式将请求和处理分离开来，进行解耦。
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
abstract class Handler
{

    /* @var $nextHandler Handler */
    private $nextHandler;
    public $maxDays;

    public function __construct($maxDays)
    {
        $this->maxDays = $maxDays;
    }

    public function setNextHandler(Handler $handler)
    {
        $this->nextHandler = $handler;
    }

    public function handlerRequest($days)
    {
        if ($days <= $this->maxDays) {
            $this->replay($days);
        } else {
            if ($this->nextHandler) {
                $this->nextHandler->handlerRequest($days);
            } else {
                echo "突破天际。";
            }
        }
    }

    public abstract function replay($days);

}

class groupLeader extends Handler
{

    public function __construct($maxDays)
    {
        parent::__construct($maxDays);
    }

    public function replay($days)
    {
        echo "$days 天，组长批准。";
    }

}

class Manager extends Handler
{

    public function __construct($maxDays)
    {
        parent::__construct($maxDays);
    }

    public function replay($days)
    {
        echo "$days 天，经理批准。";
    }

}

class Boos extends Handler
{

    public function __construct($maxDays)
    {
        parent::__construct($maxDays);
    }

    public function replay($days)
    {
        echo "$days 天，老板批准。";
    }

}

// Test
$groupLeader = new groupLeader(1);
$manager = new Manager(3);
$boos = new Boos(10);
$groupLeader->setNextHandler($manager);
$manager->setNextHandler($boos);

$groupLeader->handlerRequest(11);
