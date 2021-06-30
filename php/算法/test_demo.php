<?php
/**
 * @param array $arr
 * @return array
 */
function BubbleSort(array $arr): array
{
    // 判断参数是否为数组，且不为空
    if (!is_array($arr) || empty($arr)) {
        return $arr;
    }
    $len = count($arr) -1;
    // 循环需要冒泡的轮数
    for ($i = 0; $i < $len; $i++) {
        // 循环每轮需要比较的次数
        for ($j = 0; $j < $len - $i; $j++) {
            // 大的数，交换位置，往后挪
            if ($arr[$j] > $arr[$j + 1]) {
                list($arr[$j],$arr[$j + 1]) = [$arr[$j + 1],$arr[$j]];
            }
        }
    }
    return $arr;
}

/**
 * @param array $arr
 * @return array
 */
function SelectSort(array $arr): array{
    if(count($arr) <= 1){
        return $arr;
    }
    //控制最大循环次数,未排序区的第一个值
    for($i=0;$i<count($arr);$i++){
        //假设最小的数的为未排序区的第一个数
        $min = $i;
        //拿未排序区的每一个值与最小数比较，总是记录最小的数，这样就可以找到未排序区的最小值
        for($j=$i+1;$j<count($arr);$j++){
            if($arr[$j] < $arr[$min]){
                $min = $j;
            }
        }
        //把未排序区的最小值与未排序区第一个数交换位置，也就是把未排序区中的最小值放到已排序区的后面
        if($min != $i){
            list($arr[$i],$arr[$min]) = [$arr[$min], $arr[$i]];
        }
    }
    return $arr;
}

var_dump(implode("<",SelectSort([1,-3,4,5,2,6,0])));
