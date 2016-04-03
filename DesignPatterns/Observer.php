<?php

/**
 * 观察者模式
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
interface Observer
{

    public function update($event = null);
}

abstract class EventGenerator
{

    private $observers = array();

    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

}

class Event extends EventGenerator
{

    function trigger()
    {
        echo "Event\n";
        $this->notify();
    }

}

// Test
function main()
{

    class Observer1 implements Observer
    {

        public function update($event = null)
        {
            echo "Logic 1\n";
        }

    }

    class Observer2 implements Observer
    {

        public function update($event = null)
        {
            echo "Logic 2\n";
        }

    }

    $event = new Event();
    $event->addObserver(new Observer1());
    $event->addObserver(new Observer2());
    $event->trigger();
}

main();
