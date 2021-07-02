<?php

//抽象被观察者
abstract class Subject
{
    //观察者数组
    private $observers;

    //增加观察者方法
    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
        echo "add ob succ" . PHP_EOL;
    }

    //通知所有观察者
    public function sendMsg()
    {
        foreach($this->observers as $observer){
            $observer->update();
        }
    }
}

//具体被观察者
class Server extends Subject
{
    public function send()
    {
        $this->sendMsg();
    }
}

//抽象观察者接口
interface Observer
{
    public function update();
}

//具体观察者
class Web implements Observer
{
    public function update()
    {
        echo 'web  is  get';
    }
}

class App implements Observer
{
    public function update()
    {
        echo 'App  is  get';
    }
}

//实例化被观察者
$server = new Server();
//实例化观察者
$web = new Web();
$app = new App();
//添加被观察者
$server->addObserver($web);
$server->addObserver($app);

//被观察者发布消息
$server->send();
