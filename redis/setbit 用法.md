# setbit 用法 

## 官方解释

SETBIT key offset value

设置或者清空key的value(字符串)在offset处的bit值。

那个位置的bit要么被设置，要么被清空，这个由value（只能是0或者1）来决定。

当key不存在的时候，就创建一个新的字符串value。

要确保这个字符串大到在offset处有bit值。

参数offset需要大于等于0，并且小于232(限制bitmap大小为512)。

当key对应的字符串增大的时候，新增的部分bit值都是设置为0。

**注意**

当set最后一个bit(offset等于232-1)并且key还没有一个字符串value或者其value是个比较小的字符串时，Redis需要立即分配所有内存，这有可能会导致服务阻塞一会。在一台2010MacBook Pro上，offset为232-1（分配512MB）需要～300ms，offset为230-1(分配128MB)需要～80ms，offset为228-1（分配32MB）需要～30ms，offset为226-1（分配8MB）需要8ms。注意，一旦第一次内存分配完，后面对同一个key调用[SETBIT](http://www.redis.cn/commands/setbit.html)就不会预先得到内存分配。

返回值

[integer-reply](http://www.redis.cn/topics/protocol.html#integer-reply)：在offset处原来的bit值

### 个人理解

![img](https://easyreadfs.nosdn.127.net/bFxn73tfrlnNzJDOe-0WzA==/8796093023252283210)

- setbit只有两个值0和1，8个位正好是1b，所以位操作是非常节省空间的一种操作

- Redis 中字符串的最大长度是 512M，其最大值是：Max = 8 * 1024 * 1024 * 512  =  2^32
- offset 最大为Max - 1（原因：C语言中字符串的末尾都要存储一位分隔符）

## 相关命令

```shell
# 设置值，其中value只能是 0 和 1
setbit key offset value

# 获取值
getbit key offset

# 获取指定范围内值为 1 的个数
# start 和 end 以字节为单位
bitcount key start end

# BitMap间的运算
# operations 位移操作符，枚举值
  AND 与运算 &
  OR 或运算 |
  XOR 异或 ^
  NOT 取反 ~
# result 计算的结果，会存储在该key中
# key1 … keyn 参与运算的key，可以有多个，空格分割，not运算只能一个key
# 当 BITOP 处理不同长度的字符串时，较短的那个字符串所缺少的部分会被看作 0。返回值是保存到 destkey 的字符串的长度（以字节byte为单位），和输入 key 中最长的字符串长度相等。
bitop [operations] [result] [key1] [keyn…]

# 返回指定key中第一次出现指定value(0/1)的位置
bitpos [key] [value]
```



## 用法案例

- 用户今日是否签到
- 今日是否打开
- 是否已经完成某个任务
- 用户是否在线
- 等等

## 示例

### 签到场景

- 1亿用户，
- 今日签到过

- 连续2天签到用户数量
- 第一天或第二天签到的用户数量

### 实现

```sh
# 条件: key 为日期
# 3天日期：date1  date2  date3
# userId: 123  456  789

# 设置用户123在第1天签到
>setbit date1 123 1

# 设置用户123在第2天签到
>setbit date2 123 1

# 设置用户234在第1天签到
>setbit date1 456 1

# 设置用户234在第2天没有签到
>setbit date2 456 0

#判断用户123今日是否签到（返回1则签到过，0则没有）
>getbit date1 456

#获取连续2天签到的用户数量
>bitop and resd12 date1 date2 #(把统计结果保存到 resd12 的字符串的长度)
>bitcount resd12#(连续2天签到的用户数量)

#获取第一天或第二天签到的用户数量
>bitop or resd12 date1 date2 #(把统计结果保存到 resd12 的字符串的长度)
>bitcount resd12#(连续2天签到的用户数量)

```



