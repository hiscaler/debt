<?php

/**
 * 钩子
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class ResponseBase
{

    public function render()
    {
        $hook = new Hook();
        $hook->add('BeforeResponse')->exec();
        echo 'Normal Response...' . PHP_EOL;
        $hook->add('AfterResponse')->exec();
    }

}

class Response extends ResponseBase
{

}

class Hook
{

    private $_hook;

    public function exec()
    {
        if ($this->_hook) {
            $this->_hook->exec();
        } else {
            throw new Exception('请先注册钩子。');
        }
    }

    public function add($event)
    {
        $this->_hook = new $event;
        return $this;
    }

}

interface Event
{

    public function exec();

}

class BeforeResponse implements Event
{

    public function exec()
    {
        echo "Before Response..." . PHP_EOL;
    }

}

class AfterResponse implements Event
{

    public function exec()
    {
        echo "After Response..." . PHP_EOL;
    }

}

// Test
$request = new Response;
$request->render();
