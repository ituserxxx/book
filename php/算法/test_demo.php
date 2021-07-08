<?php

$a = [ 9, 2, 3, 4,1, 5, 8,9];
function insertSort($arr)
{
    $count = count($arr);
    if ($count < 2) {
        return $arr;
    }
    for ($i = 1; $i < $count; $i++) {
        $temp = $arr[$i];
        for ($k = $i - 1; $k >= 0; $k--) {
            if ($temp< $arr[$k]) {
                $arr[$k + 1] = $arr[$k];
                $arr[$k] = $temp;
            }
        }
    }
    return $arr;
}
print_r(insertSort($a));

/**
 * 冒泡排序
 * @param array $arr
 * @return array
 */
function BubbleSort(array $arr): array
{
    // 判断参数是否为数组，且不为空
    if (!is_array($arr) || empty($arr)) {
        return $arr;
    }
    $len = count($arr) - 1;
    // 循环需要冒泡的轮数
    for ($i = 0; $i < $len; $i++) {
        // 循环每轮需要比较的次数
        for ($j = 0; $j < $len - $i; $j++) {
            // 大的数，交换位置，往后挪
            if ($arr[$j] > $arr[$j + 1]) {
                list($arr[$j], $arr[$j + 1]) = [$arr[$j + 1], $arr[$j]];
            }
        }
    }
    return $arr;
}

/**
 * 选择排序
 * @param array $arr
 * @return array
 */
function SelectSort(array $arr): array
{
    $len = count($arr);
    if ($len <= 1) {
        return $arr;
    }
    //控制最大循环次数,未排序区的第一个值
    for ($i = 0; $i < $len; $i++) {
        //假设最小的数的为未排序区的第一个数
        $min = $i;
        //拿未排序区的每一个值与最小数比较，总是记录最小的数，这样就可以找到未排序区的最小值
        for ($j = $i + 1; $j < $len; $j++) {
            if ($arr[$j] < $arr[$min]) {
                $min = $j;
            }
        }
        //把未排序区的最小值与未排序区第一个数交换位置，也就是把未排序区中的最小值放到已排序区的后面
        if ($min != $i) {
            list($arr[$i], $arr[$min]) = [$arr[$min], $arr[$i]];
        }
    }
    return $arr;
}


/**
 * 二分查找法-while方式
 * @param $arr
 * @param $search
 * @return string
 */
function BinSearchByWhile($arr,$search): string
{
    $height=count($arr)-1;
    $low=0;
    while($low<=$height){
        $mid=intval(($low+$height)/2);//获取中间数
        if($arr[$mid]==$search){
            return $mid.":succ";//返回
        }elseif($arr[$mid]<$search){
            // 去右边查
            $low=$mid+1;
        }elseif($arr[$mid]>$search){
            // 去右边查
            $height=$mid-1;
        }
    }
    return 'fail';
}

/**
 * 二分查找法-递归方式
 * @param $arr
 * @param $number
 * @param $lower
 * @param $high
 * @return int
 */
function BinarySearchByRecursion($arr, $number, $lower, $high): int
{
    // 中间点
    $middle = intval(($lower + $high) / 2);
    // 最低点比最高点大就退出
    if ($lower > $high) {
        return -1;
    }
    if ($number > $arr[$middle]) {
        // 去左边查
        return BinarySearchByRecursion($arr, $number, $middle + 1, $high);
    } elseif ($number < $arr[$middle]) {
        // 去右边查
        return BinarySearchByRecursion($arr, $number, $lower, $middle - 1);
    } else {
        return $middle;
    }
}
