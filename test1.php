<?php

/**
 * 被观察者类
 */
class TestSubject implements SplSubject
{
    /**
     * 保存观察者对象
     *
     * @var array
     */
    private $observer = [];

    /**
     * 成员属性
     *
     * @var
     */
    private $value;

    /**
     *
     * @param SplObserver $observer
     */
    public function  attach(SplObserver $observer)
    {
        $this->observer[] = $observer;
    }

    /**
     *
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $key = array_search($observer, $this->observer, true);
        if ($key) {
            unset($this->observer[$key]);
        }
    }

    /**
     * 通知观察者
     */
    public function notify()
    {
        foreach ($this->observer as $observer) {
            $observer->update($this);
        }
    }

    /**
     * 设置成员属性
     * @param $vaule
     */
    public function setValue($vaule)
    {
        $this->value = $vaule;
        //成员属性发生变化，通知观察者
        $this->notify();
    }

    /**
     * 获取成员属性
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}

/**
 * 观察者类
 */
class TestObserver implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo 'The TestSubject Value = ' . $subject->getValue();
    }
}

$subject = new TestSubject();
$observer = new TestObserver();
$subject->attach($observer);
$subject->setValue('value 1');
$subject->setValue('value 2');
