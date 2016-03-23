<?php

/**
 * 工厂模式
 * @see http://design-patterns.readthedocs.org/zh_CN/latest/creational_patterns/simple_factory.html
 * @author hiscaler <hiscaler@gmail.com>
 */
interface Person
{

    public function getName();
}

class Teacher implements Person
{

    public function getName()
    {
        return 'Teacher';
    }

}

class Student implements Person
{

    public function getName()
    {
        return 'Student';
    }

}

// 简单工厂
class SimpleFactory
{

    public static function getPerson($type)
    {
        $person = null;
        if ($type == 'teacher') {
            $person = new Teacher();
        } elseif ($type == 'student') {
            $person = new Student();
        }

        return $person;
    }

}

class SimpleClient
{

    public function main()
    {
        $person = SimpleFactory::getPerson('teacher');
        echo $person->getName();
        $person = SimpleFactory::getPerson('student');
        echo $person->getName();
    }

}

// Test
$simpleClient = new SimpleClient();
$simpleClient->main();
