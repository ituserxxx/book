# GMP 模型

****

-  M (thread) 
- G (goroutine)
-  P (Processor）

调度模型图

![avatar](https://cdn.learnku.com/uploads/images/202003/11/58489/Ugu3C2WSpM.jpeg!large)



**全局队列**（Global Queue）：存放等待运行的 G

**P 的本地队列**：同全局队列类似，存放的也是等待运行的 G，存的数量有限，不超过 256 个。新建 G’时，G’优先加入到 P 的本地队列，如果队列满了，则会把本地队列中一半的 G 移动到全局队列。

**P 列表**：所有的 P 都在程序启动时创建，并保存在数组中，最多有 `GOMAXPROCS`(可配置) 个。

**M**：线程想运行任务就得获取 P，从 P 的本地队列获取 G，P 队列为空时，M 也会尝试从全局队列拿一批 G 放到 P 的本地队列，或从其他 P 的本地队列偷一半放到自己 P 的本地队列。M 运行 G，G 执行之后，M 会从 P 获取下一个 G，不断重复下去

**Goroutine 调度器和 OS 调度器是通过 M 结合起来的，每个 M 都代表了 1 个内核线程，OS 调度器负责把内核线程分配到 CPU 的核上执行**。

未完

参考：https://learnku.com/articles/41728

