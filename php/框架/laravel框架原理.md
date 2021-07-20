# laravel框架原理
Laravel的请求周期可以分成6步骤
- 注册类文件，自动加载预设文件
- 创建服务容器
- 创建 HTTP / Console 内核
- 载入服务提供者到容器
- 分发请求
- 发送响应并结束

Laravel是单一入口方式，所有的数据请求都需要经过public/index.php的文件，
首先会检测是否处于维护阶段（maintenance.php）


## 注册类文件自动加载器
Laravel然后通过composer进行依赖管理，从composer的autoload.php文件里面自动预加载设置好的文件

## 创建服务容器
index.php加载和运行bootstrap/app.php文件，获取应用实例，创建服务容器(函数方法，类等的代码结构体)。

## 创建 HTTP / Console 内核 - 各种配置和中间件
HTTP内核 继承自Illuminate\Foundation\Http\Kernel类，该类定义了一个bootstrappers数组，该数组中的类在请求被执行前运行，bootstrappers配置了错误处理、日志、检测应用环境、其他在请求被处理前需要处理的任务。

## 载入服务提供者到容器- config/app.php的providers数组
内核启动会为应用载入服务提供者，服务提供者都被配置在config/app.php配置文件的providers数组中。服务提供者被注册后，boot方法被调用。
服务提供者负责启动框架的所有组件，如数据库、队列、验证器、路由组件等。因他们启动并配置框架提供的所有特性，服务提供者是整个Laravel启动过程中最重要部分。

## 分发请求
一旦应用被启动且所有服务提供者被注册，Request将会被交给路由器进行分发，路由器将会分发请求到路由或控制器，同时运行所有路由指定的中间件。

## 发送响应和结束
Laravel的设计模式
依赖注入。如User 控制器依赖 UserModel，实例化的时候，直接注入。
服务容器通过依赖注入，实现灵活的高度解耦
门面：在服务提供者上面再封装一层静态调用，提供一个静态类调用容器中的绑定对象作用

参考：
https://learnku.com/laravel/t/1954/on-laravel-design-pattern
https://blog.csdn.net/weixin_42980713/article/details/84997338
