
# 单例模式
## 特点
- 单例类只能有一个实例
- 单例类必须自己创建自己的唯一实例
- 单例类必须给所有其他对象提供这一实例
- 避免大量的new操作（new 对象都会消耗内存）

## 场景：
- 数据库连接 
- 日志 (多种不同用途的日志也可能会成为多例模式)
- 在应用中锁定文件 (系统中只存在一个 ...)
- 线程池
## 种类
懒汉式单例、饿汉式单例、登记式单例
```php

<?php
class Singleton
{
    /**
    * 一个私有静态变量
    * @var Singleton
    */
    private static $instance;

    /**
    * 通过懒加载获得实例（在第一次使用的时候创建）返回唯一实例的一个引用 
    */
    public static function getInstance(): Singleton
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
    * 不允许从外部调用以防止创建多个实例
    * 要使用单例，必须通过 Singleton::getInstance() 方法获取实例
    */
    private function __construct()
    {
    }

    /**
    * 防止实例被克隆（这会创建实例的副本）
    */
    private function __clone()
    {
    }

    /**
    * 防止反序列化（这将创建它的副本）
    */
    private function __wakeup()
    {
    }
    public static helloWord(){
        return "helloWord";
    }
}
$test = Singleton::getInstance()->helloWord();
var_dump($test);
```