<?php


////抽象产品
//class Button{}
////抽象产品
//class Border{}
//
////具体产品
//class MacButton extends Button{}
////具体产品
//class WinButton extends Button{}
////具体产品
//class MacBorder extends Border{}
////具体产品
//class WinBorder extends Border{}
//
////抽象工厂
//interface AbstractFactory {
//    public function CreateButton();
//    public function CreateBorder();
//}
////具体工厂
//class MacFactory implements AbstractFactory{
//    public function CreateButton(){ return new MacButton(); }
//    public function CreateBorder(){ return new MacBorder(); }
//}
////具体工厂
//class WinFactory implements AbstractFactory{
//    public function CreateButton(){ return new WinButton(); }
//    public function CreateBorder(){ return new WinBorder(); }
//}


//抽象产品
class Button
{
    public function get (){
        echo '具体产品';
    }
}
//具体产品
class WinButton extends Button
{

}

//具体产品
class MacButton extends Button
{
}

//抽象工厂
interface ButtonFactory
{
    public function createButton($type);
}

//具体工厂
class MyButtonFactory implements ButtonFactory
{
    // 实现工厂方法
    public function createButton($type)
    {
        switch ($type) {
            case 'Mac':
                return new MacButton();
            case 'Win':
                return new WinButton();
        }
    }
}

$button_obj = new MyButtonFactory();
var_dump($button_obj->createButton('Mac')->get());
var_dump($button_obj->createButton('Win')->get());

/*
//具体产品角色
class web
{
    public function create()
    {
        echo "web";
    }
}
//具体产品角色

class app
{
    public function create()
    {
        echo "app";
    }

}

//工厂角色
class factory
{
    //抽象产品角色
    public function ConcreteProduct($key)
    {
        if ($key == 'air') {
            return new web();
        }
        if ($key == 'app') {
            return new app();
        }
    }
}
$factory = new factory();
$app = $factory->ConcreteProduct('app');
$app->create();




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

*/
