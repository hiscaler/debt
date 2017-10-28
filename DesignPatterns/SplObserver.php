<?php

/**
 * 使用 SplSubject、SplObserver、SplObjectStorage 实现观察者模式
 *
 * @author hiscaler <hiscaler@gmail.com>
 */
class User implements SplSubject, ArrayAccess
{

    private $username;
    private $password;
    private $email;
    private $mobile;
    private $observers = null;

    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : 'ERROR VALUE';
    }

    public function __construct($username, $password, $email, $mobile)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->observers = new SplObjectStorage();
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        $user = [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];

        foreach ($this->observers as $observer) {
            $observer->update($this, $user);
        }
    }

    public function create()
    {
        echo __METHOD__ . PHP_EOL;
        $this->notify();
    }

    public function changePassword($newPassword)
    {
        echo __METHOD__ . PHP_EOL;
        $this->password = $newPassword;
        $this->notify();
    }

    public function resetPassword()
    {
        echo __METHOD__ . PHP_EOL;
        $this->password = mt_rand(1, 99);
        $this->notify();
    }

    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

}

class EmailSender implements SplObserver
{

    public function update(\SplSubject $subject)
    {
        echo "向 {$subject['email']} 发送邮件成功，内容：您好 {$subject['username']}，新密码为：{$subject['password']}。" . PHP_EOL;
    }

}

class SmsSender implements SplObserver
{

    public function update(\SplSubject $subject)
    {
        echo "向 {$subject->username} 发送短信成功，内容：您的密码为{$subject->password}。" . PHP_EOL;
    }

}

// Test
$emailSender = new EmailSender();
$smsSender = new SmsSender();
$user = new User('Tom', 'tomPWD', 'tom@gmail.com', '15811111111');
$user->attach($emailSender);
$user->attach($smsSender);
$user->detach($emailSender);
$user->create();
echo '################################################################################' . PHP_EOL;
$user = new User('Jack', 'jackPWD', 'jack@gmail.com', '15822222222');
$user->attach($emailSender);
$user->attach($smsSender);
$user->create();
