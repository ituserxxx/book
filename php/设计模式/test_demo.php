<?php

/**
 * 创建渲染接口。
 * 这里的装饰方法 renderData() 返回的是字符串格式数据。
 */
interface RenderableInterface
{
    public function renderData(): string;
}

/**
 * 创建 Webservice 服务类实现 RenderableInterface。
 * 该类将在后面为装饰者实现数据的输入。
 */
class WebService implements RenderableInterface
{
    private $data;
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * 实现 RenderableInterface 渲染接口中的 renderData() 方法。 返回传入的数据。
     */
    public function renderData(): string
    {
        return $this->data;
    }
}

/**
 * 装饰者 必须实现渲染接口类 RenderableInterface 契约，这是该设计模式的关键点。否则，这将不是一个装饰者而只是一个自欺欺人的包装。
 * 创建抽象类 RendererDecorator （渲染器装饰者）实现渲染接口。
 */
abstract class RendererDecorator implements RenderableInterface
{
    /**
     * @var RenderableInterface
     * 定义渲染接口变量。
     */
    protected $wrapped;

    /**
     * @param RenderableInterface $renderer
     * 传入渲染接口类对象 $renderer。
     */
    public function __construct(RenderableInterface $renderer)
    {
        $this->wrapped = $renderer;
    }
}

/**
 * 创建 Xml 修饰者 并继承抽象类 RendererDecorator 。
 */
class XmlRenderer extends RendererDecorator
{
    /**
     * 对传入的渲染接口对象进行处理，生成 DOM 数据文件。
     */
    public function renderData(): string
    {
        $doc = new \DOMDocument();
        $data = $this->wrapped->renderData();
        $doc->appendChild($doc->createElement('content', $data));

        return $doc->saveXML();
    }
}

/**
 * 创建 Json 修饰者 并继承抽象类 RendererDecorator 。
 */
class JsonRenderer extends RendererDecorator
{
    /**
     * 对传入的渲染接口对象进行处理，生成 JSON 数据。
     */
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}

$webService = new WebService("test string");

$xmlRender = new XmlRenderer($webService);
var_dump($xmlRender->renderData());

//输出 json 数据
$jsonRender = new JsonRenderer($webService);
var_dump($jsonRender->renderData());
/*
//抽象产品
class Button{}
//抽象产品
class Border{}

//具体产品
class MacButton extends Button{}
//具体产品
class WinButton extends Button{}
//具体产品
class MacBorder extends Border{}
//具体产品
class WinBorder extends Border{}

//抽象工厂
interface AbstractFactory {
    public function CreateButton();
    public function CreateBorder();
}
//具体工厂
class MacFactory implements AbstractFactory{
    public function CreateButton(){ return new MacButton(); }
    public function CreateBorder(){ return new MacBorder(); }
}
//具体工厂
class WinFactory implements AbstractFactory{
    public function CreateButton(){ return new WinButton(); }
    public function CreateBorder(){ return new WinBorder(); }
}


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
